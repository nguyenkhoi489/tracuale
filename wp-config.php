<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tracuale' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'eMseTBBxPtFbfxDzqApb642b6URNCfy4lT8GxyqtVaQa1o2MJHLY0eHNdq9WOhgl' );
define( 'SECURE_AUTH_KEY',  'FppToWppu2LnOpZsdZwON0x4DgS25iKUdWpZfba6vQhyLFFbX1tzfaTLnTXdvCQf' );
define( 'LOGGED_IN_KEY',    '9xD6ul2DfBxeRj71dyGLoRqPAjGxAduOflSruoGmSRpKSFHVd8Ha79r85J3mQj5c' );
define( 'NONCE_KEY',        '3vQisZwbiZoeFt1kV2HgW96KXYroOkY0SBasPZY4l3k0dsqstOCtviUJd2vUTeIk' );
define( 'AUTH_SALT',        'air2caVeIYYpS0y1NlAnvwSFuBFjdR8yphT7WaBBOIUxtBhPjr68j1bP5ljZKc5Q' );
define( 'SECURE_AUTH_SALT', 'vTqeKReJvyjKtmJ4Pvl473MAcamgNOV2Pk3lOUB1jT8WE7g2I265ughoDGsCpf8K' );
define( 'LOGGED_IN_SALT',   'bBbdGGOyTmZEyYuXO9cOiaaUKfDBmZ6uMJqg2ZIIPZ5Cp1TyqWdgGuXRUMqVCeqz' );
define( 'NONCE_SALT',       'CHcDqkEHQUvMsQmSbwCCkiQnXfFiiyU9rgb46yhtkfQIQNv8D5aEBP8udqqVkrDn' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
