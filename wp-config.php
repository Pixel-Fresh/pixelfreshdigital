<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'i5651340_wp2' );

/** MySQL database username */
define( 'DB_USER', 'i5651340_wp2' );

/** MySQL database password */
define( 'DB_PASSWORD', 'A.753mMs1m6MR4DQuHk17' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'tN18XgFYKXvvorbwuX9Jb3xuZk9NNUhXJHZmutuL92po8AzRjLeRWDXRleb6mJuw');
define('SECURE_AUTH_KEY',  '7NJW5QNbLBCzJ6WkygfW6Qc3bYrMpGGccs9k4rgPaKZincfYWMEdfBvSTJyh1mU1');
define('LOGGED_IN_KEY',    'BvVa2yks2EP6kvkNiNrroib6SBe2oqFo3AAjGReDRB79fRLdntLvq6bypZ6kGXkx');
define('NONCE_KEY',        'SrtpTO2GvtOlEAXAutkpqIgFkWfHGWFDar5UiwQGQRbHMSyfnMr8HPXwhQTGk8dC');
define('AUTH_SALT',        'qwLsqOoy6SKH9Lzy54V4nK1kTX39Gjxu6osITNJ4XJI54yCcKITARCpQ7C9qiYb2');
define('SECURE_AUTH_SALT', '4gbBk1nTGYn68RD6OAIRtpKgLKPHw2lEJCeQpEedOilyTvRPV0kwS1Uq4GCvf4dM');
define('LOGGED_IN_SALT',   'V1cJJ3R3fgPQ5G541C69gv6qlsNh2O9OTZiciXpYTx1qfILszhvQ0Degop1Xm0B8');
define('NONCE_SALT',       'gkWKNDnOIdgtilAhvWMmApjy79QFkevAhdiiQHhm6ESJcsFKgC7McKSKVaQ0yGVQ');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
