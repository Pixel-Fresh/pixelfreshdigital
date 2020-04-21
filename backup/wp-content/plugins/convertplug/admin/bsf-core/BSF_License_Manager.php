<?php

/**
 *
 */
if ( ! class_exists( 'BSF_License_Manager' ) ) {

	class BSF_License_Manager {

		private static $_instance = null;

		private static $inline_form_products = array();

		public static function instance() {
			if ( ! isset( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function __construct() {
			add_action( 'admin_head', array( $this, 'admin_css' ), 100 );

			add_action( 'admin_init', array( $this, 'bsf_activate_license' ) );
			add_action( 'admin_init', array( $this, 'bsf_deactivate_license' ) );
			add_action( 'bsf_product_update_registered', array( $this, 'refresh_products_on_license_activae' ) );
			add_action( 'admin_footer', array( $this, 'render_popup_form_markup' ) );

			$this->includes();
			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		}

		public function refresh_products_on_license_activae() {
			update_site_option( 'bsf_force_check_extensions', true );
		}

		public function includes() {
			require_once BSF_UPDATER_PATH . '/BSF_Envato_Activate.php';
		}

		public function admin_css() {
			?>

			<style type="text/css">
				.bsf-pre {
					white-space: normal;
				}

				/* license consent */
				.bsf-license-consent-container {
					display: flex;
				}

				.bsf-license-consent-container label {
					padding-top: 0;
				}

				.wp-admin p.bsf-license-consent-container input {
					margin-top: 2px;
					margin-right: 10px;
				}
			</style>

			<?php
		}

		public function bsf_deactivate_license() {

			if ( ! isset( $_POST['bsf_deactivate_license'] ) ) {
				return;
			}

			if ( ! isset( $_POST['bsf_license_manager']['license_key'] ) || $_POST['bsf_license_manager']['license_key'] == '' ) {
				return;
			}

			if ( ! isset( $_POST['bsf_license_manager']['product_id'] ) || $_POST['bsf_license_manager']['product_id'] == '' ) {
				return;
			}

			$product_id  = esc_attr( $_POST['bsf_license_manager']['product_id'] );
			$license_key = $this->bsf_get_product_info( $product_id, 'purchase_key' );

			// Check if the key is from EDD
			$is_edd = $this->is_edd( $license_key );

			//
			$path = dt_get_api_url(false, $product_id) . '?referer=deactivate-' . $product_id;

			// Using Brainstorm API v2
			$data = array(
				'action'       => 'bsf_deactivate_license',
				'purchase_key' => $license_key,
				'product_id'   => $product_id,
				'site_url'     => get_site_url(),
				'is_edd'       => $is_edd,
				'referer'      => 'customer',
			);

			$data     = apply_filters( 'bsf_deactivate_license_args', $data );
			$response = wp_remote_post(
				$path, array(
					'body'    => $data,
					'timeout' => '30',
				)
			);

			// Try to make a second request to unsecure URL.
			if ( is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) !== 200 ) {
				$path = dt_get_api_url(true, $product_id) . '?referer=deactivate-' . $product_id;
				$response = wp_remote_post(
					$path, array(
						'body'    => $data,
						'timeout' => '30',
					)
				);
			}

			if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ) {
				$result = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( isset( $result['success'] ) && $result['success'] == true ) {
					// update license saus to the product
					$_POST['bsf_license_deactivation']['success'] = $result['success'];
					$_POST['bsf_license_deactivation']['message'] = $result['message'];
					unset( $result['success'] );
					unset( $result['message'] );

					$this->bsf_update_product_info( $product_id, $result );
				} else {
					$_POST['bsf_license_deactivation']['success'] = $result['success'];
					$_POST['bsf_license_deactivation']['message'] = $result['message'];
				}
			} else {
				// If there is an error, the status will not be changed. hence it's true.
				$_POST['bsf_license_activation']['success'] = true;
				$_POST['bsf_license_activation']['message'] = 'There was an error when connecting to our license API - <pre class="bsf-pre">' . $response->get_error_message() . '</pre>';
			}
		}

		public function bsf_activate_license() {

			if ( ! isset( $_POST['bsf_activate_license'] ) ) {
				return;
			}

			if ( ! isset( $_POST['bsf_license_manager']['license_key'] ) || $_POST['bsf_license_manager']['license_key'] == '' ) {
				return;
			}

			if ( ! isset( $_POST['bsf_license_manager']['product_id'] ) || $_POST['bsf_license_manager']['product_id'] == '' ) {
				return;
			}

			$license_key              = esc_attr( $_POST['bsf_license_manager']['license_key'] );
			$product_id               = esc_attr( $_POST['bsf_license_manager']['product_id'] );
			$user_name                = isset( $_POST['bsf_license_manager']['user_name'] ) ? esc_attr( $_POST['bsf_license_manager']['user_name'] ) : '';
			$user_email               = isset( $_POST['bsf_license_manager']['user_email'] ) ? esc_attr( $_POST['bsf_license_manager']['user_email'] ) : '';
			$privacy_consent          = ( isset( $_POST['bsf_license_manager']['privacy_consent'] ) && 'true' === $_POST['bsf_license_manager']['privacy_consent'] ) ? true : false;
			$terms_conditions_consent = ( isset( $_POST['bsf_license_manager']['terms_conditions_consent'] ) && 'true' === $_POST['bsf_license_manager']['terms_conditions_consent'] ) ? true : false;

			// update product license key
			$args = array(
				'purchase_key' => $license_key,
			);

			$this->bsf_update_product_info( $product_id, $args );

			// Check if the key is from EDD
			$is_edd = $this->is_edd( $license_key );

			// Server side check if the license key is valid

			$path = dt_get_api_url(false, $product_id) . '?referer=activate-' . $product_id;

			// Using Brainstorm API v2
			$data = array(
				'action'                   => 'bsf_activate_license',
				'purchase_key'             => $license_key,
				'product_id'               => $product_id,
				'user_name'                => $user_name,
				'user_email'               => $user_email,
				'privacy_consent'          => $privacy_consent,
				'terms_conditions_consent' => $terms_conditions_consent,
				'site_url'                 => get_site_url(),
				'is_edd'                   => $is_edd,
				'referer'                  => 'customer',
			);

			$data     = apply_filters( 'bsf_activate_license_args', $data );
			$response = wp_remote_post(
				$path, array(
					'body'    => $data,
					'timeout' => '30',
				)
			);

			// Try to make a second request to unsecure URL.
			if ( is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) !== 200 ) {
				$path = dt_get_api_url(true, $product_id) . '?referer=activate-' . $product_id;
				$response = wp_remote_post(
					$path, array(
						'body'    => $data,
						'timeout' => '30',
					)
				);
			}

			if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ) {
				$result = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( isset( $result['success'] ) && $result['success'] == true ) {
					// update license saus to the product
					$_POST['bsf_license_activation']['success'] = $result['success'];
					$_POST['bsf_license_activation']['message'] = $result['message'];
					unset( $result['success'] );

					$this->bsf_update_product_info( $product_id, $result );
				} else {
					$_POST['bsf_license_activation']['success'] = $result['success'];
					$_POST['bsf_license_activation']['message'] = $result['message'];
				}
			} else {
				$_POST['bsf_license_activation']['success'] = false;
				$_POST['bsf_license_activation']['message'] = 'There was an error when connecting to our license API - <pre class="bsf-pre">' . $response->get_error_message() . '</pre>';
			}
		}

		public function is_edd( $license_key ) {

			// Purchase key length for EDD is 32 characters
			if ( strlen( $license_key ) === 32 ) {

				return true;
			}

			return false;
		}

		public function bsf_update_product_info( $product_id, $args ) {
			$brainstrom_products = get_option( 'brainstrom_products', array() );

			foreach ( $brainstrom_products as $type => $products ) {

				foreach ( $products as $id => $product ) {

					if ( $id == $product_id ) {
						foreach ( $args as $key => $value ) {
							$brainstrom_products[ $type ][ $id ][ $key ] = $value;
							do_action( "bsf_product_update_{$value}", $product_id, $value );
						}
					}
				}
			}

			update_option( 'brainstrom_products', $brainstrom_products );
		}

		public static function bsf_is_active_license( $product_id ) {

			$brainstrom_products = get_option( 'brainstrom_products', array() );
			$brainstorm_plugins  = isset( $brainstrom_products['plugins'] ) ? $brainstrom_products['plugins'] : array();
			$brainstorm_themes   = isset( $brainstrom_products['themes'] ) ? $brainstrom_products['themes'] : array();

			$all_products = $brainstorm_plugins + $brainstorm_themes;

			// If a product is marked as free, it is considered as active.
			$is_free = self::is_product_free( $product_id );
			if ( 'true' == $is_free ) {
				return true;
			}

			$is_bundled = BSF_Update_Manager::bsf_is_product_bundled( $product_id );

			// The product is not bundled
			if ( isset( $all_products[ $product_id ] ) ) {

				if ( isset( $all_products[ $product_id ]['status'] ) && $all_products[ $product_id ]['status'] == 'registered' ) {
					return true;
				}
			}

			if ( ! empty( $is_bundled ) ) {

				// The product is bundled
				foreach ( $is_bundled as $key => $value ) {

					$product_id = $value;

					if ( isset( $all_products[ $product_id ] ) ) {

						if ( isset( $all_products[ $product_id ]['status'] ) && $all_products[ $product_id ]['status'] == 'registered' ) {
							return true;
						}
					}
				}
			}

			// Return false by default
			return false;
		}

		public static function is_product_free( $product_id ) {
			$license_manager = BSF_License_Manager::instance();
			$is_free         = $license_manager->bsf_get_product_info( $product_id, 'is_product_free' );

			return $is_free;
		}

		public function bsf_get_product_info( $product_id, $key ) {

			$brainstrom_products = get_option( 'brainstrom_products', array() );
			$brainstorm_plugins  = isset( $brainstrom_products['plugins'] ) ? $brainstrom_products['plugins'] : array();
			$brainstorm_themes   = isset( $brainstrom_products['themes'] ) ? $brainstrom_products['themes'] : array();

			$all_products = $brainstorm_plugins + $brainstorm_themes;

			if ( isset( $all_products[ $product_id ][ $key ] ) && $all_products[ $product_id ][ $key ] !== '' ) {
				return $all_products[ $product_id ][ $key ];
			}
		}

		/**
		 * For Popup License form check `popup_license_form` is `true`.
		 */
		public function license_activation_form( $args ) {
			$html = '';

			$product_id = ( isset( $args['product_id'] ) && ! is_null( $args['product_id'] ) ) ? $args['product_id'] : '';

			// bail out if product id is missing.
			if ( $product_id == '' ) {
				_e( 'Product id is missing.', 'bsf' );

				return;
			}

			$popup_license_form           = ( isset( $args['popup_license_form'] ) ) ? $args['popup_license_form'] : false;
			$form_action                  = ( isset( $args['form_action'] ) && ! is_null( $args['form_action'] ) ) ? $args['form_action'] : '';
			$form_class                   = ( isset( $args['form_class'] ) && ! is_null( $args['form_class'] ) ) ? $args['form_class'] : "bsf-license-form-{$product_id}";
			$submit_button_class          = ( isset( $args['submit_button_class'] ) && ! is_null( $args['submit_button_class'] ) ) ? $args['submit_button_class'] : '';
			$license_form_heading_class   = ( isset( $args['bsf_license_form_heading_class'] ) && ! is_null( $args['bsf_license_form_heading_class'] ) ) ? $args['bsf_license_form_heading_class'] : '';
			$license_active_class         = ( isset( $args['bsf_license_active_class'] ) && ! is_null( $args['bsf_license_active_class'] ) ) ? $args['bsf_license_active_class'] : '';
			$license_not_activate_message = ( isset( $args['bsf_license_not_activate_message'] ) && ! is_null( $args['bsf_license_not_activate_message'] ) ) ? $args['bsf_license_not_activate_message'] : '';

			$size                    = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
			$button_text_activate    = ( isset( $args['button_text_activate'] ) && ! is_null( $args['button_text_activate'] ) ) ? $args['button_text_activate'] : 'Activate License';
			$button_text_deactivate  = ( isset( $args['button_text_deactivate'] ) && ! is_null( $args['button_text_deactivate'] ) ) ? $args['button_text_deactivate'] : 'Deactivate License';
			$placeholder             = ( isset( $args['placeholder'] ) && ! is_null( $args['placeholder'] ) ) ? $args['placeholder'] : 'Enter your license key..';
			$placeholder_name        = ( isset( $args['placeholder_name'] ) && ! is_null( $args['placeholder_name'] ) ) ? $args['placeholder_name'] : 'Your Name..';
			$placeholder_email       = ( isset( $args['placeholder_email'] ) && ! is_null( $args['placeholder_email'] ) ) ? $args['placeholder_email'] : 'Your Email..';
			$bsf_license_allow_email = ( isset( $args['bsf_license_allow_email'] ) && ! is_null( $args['bsf_license_allow_email'] ) ) ? $args['bsf_license_allow_email'] : true;
			$license_form_title      = ( isset( $args['license_form_title'] ) && ! is_null( $args['license_form_title'] ) ) ? $args['license_form_title'] : 'Updates & Support Registration - ';

			$is_active   = self::bsf_is_active_license( $product_id );
			$license_key = $this->bsf_get_product_info( $product_id, 'purchase_key' );

			if ( $bsf_license_allow_email == true ) {
				$form_class .= ' license-form-allow-email ';

				if ( ! $is_active ) {
					$button_text_activate = 'Sign Up & Activate';
					$submit_button_class .= ' button-primary button-hero ';
				}
			}

			// Forcefully disable the subscribe options for uabb.
			// This should be disabled from uabb and removed from graupi.
			if ( 'uabb' == $product_id ) {
				$bsf_license_allow_email = false;
			}

			$purchase_url = $this->bsf_get_product_info( $product_id, 'purchase_url' );
			$product_name = apply_filters( "agency_updater_productname_{$product_id}", $this->bsf_get_product_info( $product_id, 'name' ) );
			if ( empty( $product_name ) ) {
				$product_name = apply_filters( "agency_updater_productname_{$product_id}", $this->bsf_get_product_info( $product_id, 'product_name' ) );
			}

			// License activation messages
			$current_status = $current_message = '';

			if ( isset( $_POST['bsf_license_activation']['success'] ) && isset( $_POST['bsf_license_manager']['product_id'] ) && $product_id == $_POST['bsf_license_manager']['product_id'] ) {
				$current_status = esc_attr( $_POST['bsf_license_activation']['success'] );
				if ( true == $current_status ) {
					$current_status = 'bsf-current-license-success bsf-current-license-success-' . $product_id;
					$is_active      = true;
				} else {
					$current_status = 'bsf-current-license-error bsf-current-license-error-' . $product_id;
					$is_active      = false;
				}
			}

			if ( isset( $_POST['bsf_license_activation']['message'] ) ) {
				$current_message = wp_kses_post( $_POST['bsf_license_activation']['message'] );
			}

			$license_status       = 'Active!';
			$license_status_class = 'bsf-license-active-' . $product_id;

			$html .= '<div class="bsf-license-key-registration">';

			// License not active message
			$form_heading_status = '';
			if ( $is_active == false ) {
				$license_status       = 'Not Active!';
				$license_status_class = 'bsf-license-not-active-' . $product_id;
				$not_activate         = '';
				$html                .= apply_filters( "bsf_license_not_activate_message_{$product_id}", $not_activate, $license_status_class, $license_not_activate_message );

				if ( $bsf_license_allow_email == true ) {
					$popup_license_subtitle = apply_filters( "bsf_license_key_form_inactive_subtitle_{$product_id}", __( '<p>Click on the button below to activate your license and subscribe to our newsletter.</p>', 'bsf' ) );
				} else {
					$popup_license_subtitle = apply_filters( "bsf_license_key_form_inactive_subtitle_{$product_id}", __( '<p>Enter your purchase key and activate automatic updates.</p>', 'bsf' ) );
				}
			} else {
				$form_class            .= " form-submited-{$product_id}";
				$popup_license_subtitle = apply_filters( "bsf_license_key_form_active_subtitle_{$product_id}", '' );
			}

			do_action( "bsf_before_license_activation_form_{$product_id}" );

			$html .= '<form method="post" class="' . $form_class . '" action="' . $form_action . '">';

			if ( $popup_license_form ) {
				$form_heading  = '<h3 class="' . $license_status_class . ' ' . $license_form_heading_class . '">' . $product_name . '</h3>';
				$form_heading .= $popup_license_subtitle;
			} else {
				$form_heading = '<h3 class="' . $license_status_class . ' ' . $license_form_heading_class . '">' . $license_form_title . '<span>' . $license_status . '</span></h3>';
			}

			$html .= apply_filters( "bsf_license_form_heading_{$product_id}", $form_heading, $license_status_class, $license_status );

			if ( $current_status !== '' && $current_message !== '' ) {
				$current_message = '<span class="' . $current_status . '">' . $current_message . '</span>';
				$html           .= apply_filters( "bsf_license_current_message_{$product_id}", $current_message );
			}

			if ( $is_active == true ) {

				$licnse_active_message = __( 'Your license is active.', 'bsf' );
				$licnse_active_message = apply_filters( 'bsf_license_active_message', $licnse_active_message );

				$html .= '<span class="license-form-field">';
				$html .= '<input type="text" readonly class="' . $license_active_class . ' ' . $size . '-text" id="bsf_license_manager[license_key]" name="bsf_license_manager[license_key]" value="' . esc_attr( $licnse_active_message ) . '"/>';
				$html .= '</span>';
				$html .= '<input type="hidden" class="' . $size . '-text" id="bsf_license_manager[product_id]" name="bsf_license_manager[product_id]" value="' . esc_attr( stripslashes( $product_id ) ) . '"/>';

				do_action( "bsf_before_license_activation_submit_button_{$product_id}" );

				$html .= '<input type="submit" class="button ' . $submit_button_class . '" name="bsf_deactivate_license" value="' . esc_attr__( $button_text_deactivate, 'bsf' ) . '"/>';
			} else {

				if ( $bsf_license_allow_email == true ) {

					$html .= '<span class="license-form-field">';
					$html .= '<h4>Your Name</h4>';
					$html .= '<input type="text" class="' . $size . '-text" id="bsf_license_manager[user_name]" name="bsf_license_manager[user_name]" value=""/>';
					$html .= '</span>';

					$html .= '<span class="license-form-field">';
					$html .= '<h4>Your Email Address</h4>';
					$html .= '<input type="email" class="' . $size . '-text" id="bsf_license_manager[user_email]" name="bsf_license_manager[user_email]" value=""/>';
					$html .= '</span>';

					$html .= '<span class="license-form-field">';
					$html .= '<h4>Your License Key</h4>';
					$html .= '<input type="text" class="' . $size . '-text" id="bsf_license_manager[license_key]" name="bsf_license_manager[license_key]" value="" autocomplete="off" required/>';
					$html .= '</span>';

					$html .= '<span class="license-form-field">';
					$html .= '</span>';

				} else {
					$html .= '<span class="license-form-field">';
					$html .= '<input type="text" placeholder="' . esc_attr( $placeholder ) . '" class="' . $size . '-text" id="bsf_license_manager[license_key]" name="bsf_license_manager[license_key]" value="" autocomplete="off"/>';
					$html .= '</span>';
				}

				$html .= '<input type="hidden" class="' . $size . '-text" id="bsf_license_manager[product_id]" name="bsf_license_manager[product_id]" value="' . esc_attr( stripslashes( $product_id ) ) . '"/>';

				do_action( "bsf_before_license_activation_submit_button_{$product_id}" );

				$html .= '<input id="bsf-license-privacy-consent" name="bsf_license_manager[privacy_consent]" type="hidden" value="true" />';
				$html .= '<input id="bsf-license-terms-conditions-consent" name="bsf_license_manager[terms_conditions_consent]" type="hidden" value="true" />';

				$html .= '<div class="submit-button-wrap">';
				$html .= '<input type="submit" class="button ' . $submit_button_class . '" name="bsf_activate_license" value="' . esc_attr__( $button_text_activate, 'bsf' ) . '"/>';

				if ( $bsf_license_allow_email == true ) {
					$get_license_message = "<p class='purchase-license'><a target='_blank' href='$purchase_url'>Purchase License »</a></p>";
				} else {
					$get_license_message = "<p>If you don't have a license, you can <a target='_blank' href='$purchase_url'>get it here »</a></p>";
				}

				$html .= apply_filters( "bsf_get_license_message_{$product_id}", $get_license_message, $purchase_url );
				$html .= '</div>';
			}

			$html .= '</form>';

			do_action( "bsf_after_license_activation_form_{$product_id}" );

			$html = apply_filters( 'bsf_inlne_license_envato_after_form', $html, $product_id );

			$html .= '</div> <!-- envato-license-registration -->';

			if ( isset( $_GET['debug'] ) ) {
				$html .= get_bsf_systeminfo();
			}

			// Output the license activation/deactivation form
			return apply_filters( "bsf_core_license_activation_form_{$product_id}", $html, $args );
		}


		/**
		 * Load Scripts
		 *
		 * @since 1.0.0
		 *
		 * @param  string $hook Current Hook.
		 * @return void
		 */
		function load_scripts( $hook = '' ) {

			if ( 'plugins.php' === $hook ) {
				wp_register_script( 'bsf-core-jquery-history', plugins_url( 'assets/js/jquery-history.js', __FILE__ ), array( 'jquery' ), BSF_UPDATER_VERSION, true );
				wp_enqueue_style( 'bsf-core-license-form', plugins_url( 'assets/css/license-form-popup.css', __FILE__ ), array(), BSF_UPDATER_VERSION, 'all' );
				wp_enqueue_script( 'bsf-core-license-form', plugins_url( 'assets/js/license-form-popup.js', __FILE__ ), array( 'jquery', 'bsf-core-jquery-history' ), BSF_UPDATER_VERSION, true );
			}

		}

		/**
		 * Render the link as well as inline license validation form for a plugin.
		 */
		public function get_bsf_inline_license_form( $links, $args, $license_from_type ) {

			$product_id = $args['product_id'];

			if ( ! isset( $product_id ) ) {
				return $links;
			}

			if ( is_multisite() && ! is_network_admin() && false == apply_filters( "bsf_core_popup_license_form_per_network_site_{$product_id}", false ) ) {
				return $links;
			}

			$status         = 'inactive';
			$license_string = __( 'Activate License', 'bsf-core' );
			if ( BSF_License_Manager::bsf_is_active_license( $product_id ) ) {
				$status         = 'active';
				$license_string = __( 'License', 'bsf-core' );
			}

			$product_id = $args['product_id'];

			// Render the license form only once on a page.
			if ( array_key_exists( $product_id, self::$inline_form_products ) ) {
				return $links;
			}

			$form_args = array(
				'product_id'                       => $product_id,
				'button_text_activate'             => esc_html__( 'Activate License', 'bsf-core' ),
				'button_text_deactivate'           => esc_html__( 'Deactivate License', 'bsf-core' ),
				'license_form_title'               => '',
				'license_deactivate_status'        => esc_html__( 'Your license is not active!', 'bsf-core' ),
				'license_activate_status'          => esc_html__( 'Your license is activated!', 'bsf-core' ),
				'submit_button_class'              => 'bsf-product-license button-default',
				'form_class'                       => 'form-wrap bsf-license-register-' . esc_attr( $product_id ),
				'bsf_license_form_heading_class'   => 'bsf-license-heading',
				'bsf_license_active_class'         => 'success-message',
				'bsf_license_not_activate_message' => 'license-error',
				'size'                             => 'regular',
				'bsf_license_allow_email'          => false,
				'popup_license_form'               => ( isset( $args['popup_license_form'] ) ) ? $args['popup_license_form'] : false,
				'license_from_type'                => $license_from_type,
			);

			$form_args = wp_parse_args( $args, $form_args );

			self::$inline_form_products[ $product_id ] = $form_args;

			$action_links = array(
				'license' => '<a plugin-slug="' . esc_attr( $product_id ) . '" class="bsf-core-plugin-link bsf-core-license-form-btn ' . esc_attr( $status ) . '" aria-label="' . esc_attr( $license_string ) . '">' . esc_html( $license_string ) . '</a>',
			);

			return array_merge( $links, $action_links );
		}

		/**
		 * Render the markup for popup form.
		 */
		public function render_popup_form_markup() {

			$current_screen = get_current_screen();

			// Bail if not on plugins.php screen.
			if( ! is_object( $current_screen ) && null === $current_screen ) {
				return;
			}
			
			if ( 'plugins' !== $current_screen->id && 'plugins-network' !== $current_screen->id ) {
				return;
			}

			foreach ( self::$inline_form_products as $product_id => $product ) {
				?>

				 <div plugin-slug="<?php echo esc_attr( $product_id ); ?>" class="bsf-core-license-form" style="display: none;">
					<div class="bsf-core-license-form-overlay"></div>
					<div class="bsf-core-license-form-inner">
						<button type="button" class="bsf-core-license-form-close-btn">
							<span class="screen-reader-text"><?php esc_html_e( 'Close', 'bsf-core' ); ?></span>
							<span class="dashicons dashicons-no-alt"></span>
						</button>

						<?php
							$licence_form_method = isset( $_GET[ 'license-form-method' ] ) ? sanitize_text_field( $_GET[ 'license-form-method' ] ) : '';
							if ( 'edd' === $product['license_from_type'] || 'license-key' === $licence_form_method ) {
								echo bsf_license_activation_form( $product );
							} elseif ( 'envato' === $product['license_from_type'] || 'oauth' === $licence_form_method ) {
								echo bsf_envato_register( $product );
							}

							do_action( "bsf_inlne_license_form_footer_{$product[ 'license_from_type' ]}", $product_id );

							do_action( 'bsf_inlne_license_form_footer', $product_id );

							// Avoid rendering the markup twice as admin_footer can be called multiple times.
							unset( self::$inline_form_products[ $product_id ] );
						?>
					</div>
				</div>

				<?php
			}

		}


	} // Class BSF_License_Manager

	new BSF_License_Manager();
}


function bsf_license_activation_form( $args ) {
	$license_manager = BSF_License_Manager::instance();

	return $license_manager->license_activation_form( $args );
}


function get_bsf_inline_license_form( $links, $bsf_product_id, $license_from_type ) {
	$license_manager = BSF_License_Manager::instance();

	return $license_manager->get_bsf_inline_license_form( $links, $bsf_product_id, $license_from_type );
}