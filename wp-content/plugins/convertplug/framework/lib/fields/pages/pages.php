<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

// Add new input type "pages".
if ( function_exists( 'smile_add_input_type' ) ) {
	smile_add_input_type( 'pages', 'pages_settings_field' );
}

/**
 * Function Name:pages_settings_field Function to handle new input type "pages".
 *
 * @param  string $name     settings provided when using the input type "pages".
 * @param  string $settings holds the default / updated value.
 * @param  string $value    html output generated by the function.
 * @return string           html output generated by the function.
 */
function pages_settings_field( $name, $settings, $value ) {
	$input_name = $name;
	$type       = isset( $settings['type'] ) ? $settings['type'] : '';
	$class      = isset( $settings['class'] ) ? $settings['class'] : '';
	ob_start();
	?>
	<select name="<?php echo esc_attr( $input_name ); ?>" id="smile_<?php echo esc_attr( $input_name ); ?>" class="select2-pages-dropdown form-control smile-input <?php echo esc_attr( 'smile-' . $type . ' ' . $input_name . ' ' . $type . ' ' . $class ); ?>" multiple="multiple" style="width:260px;"> 
		<optgroup label="<?php echo esc_attr( __( 'Pages' ) ); ?>">
			<?php
			$pages   = get_pages();
			$val_arr = explode( ',', $value );
			foreach ( $pages as $page ) {
				$selected = ( in_array( $page->ID, $val_arr ) ) ? 'selected="selected"' : '';
				$option   = '<option value="' . $page->ID . '" ' . $selected . '>';
				$option  .= $page->post_title;
				$option  .= '</option>';
				echo $option;
			}
			?>
		</optgroup>
		<optgroup label="<?php echo esc_attr( __( 'Posts' ) ); ?>">
			<?php
			$args    = array( 'posts_per_page' => -1 );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) {
				$selected = ( in_array( $post->ID, $val_arr ) ) ? 'selected="selected"' : '';
				$option   = '<option value="' . $post->ID . '" ' . $selected . '>';
				$option  .= $post->post_title;
				$option  .= '</option>';
				echo $option;
			}
			?>
		</optgroup>
	</select>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('select.select2-pages-dropdown').cpselect2({
			placeholder: "Select pages / posts",
		});
	});	
</script>
	<?php
	return ob_get_clean();
}
