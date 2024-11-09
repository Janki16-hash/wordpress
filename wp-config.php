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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         ',PjL`dV+{fi7PWW5]-Yd89p9->5$*(HxEi=Tc(Jz AKkLL2P)waygE!^f&$Saj.[' );
define( 'SECURE_AUTH_KEY',  'w4`hp]{0v:x/Q#.^jJ(|O%QJ1K2b&y[JweI6S?$+)je`O-3m|0m?1@;(nS-UiAR#' );
define( 'LOGGED_IN_KEY',    '7^^4ufM@.C)ai)16PD/nqX(bt P33C:,Vb&}+.0$n <5(oyCok6-Vi/*OH5?<pfh' );
define( 'NONCE_KEY',        '](.x<hr&`(MS1G+hDxVa3*mtwMpnQ%JClI2k4j#oO(DbANP@hR~@;~<2?@wSL0@=' );
define( 'AUTH_SALT',        '6mptH5-8YU{J:)[#EZ45}eP}%jAQnz%T2~+ZE,6La3`UgG N&^6K[ >cO/x??m|T' );
define( 'SECURE_AUTH_SALT', '=p(#N6Ck)os1vEV{FWo8[$.az[+DN7)TB~+kckNv2&h8nguJn0*cq:}A$zJgU,hn' );
define( 'LOGGED_IN_SALT',   'l+g85w/ypFR6@bJM7Z[[[#rP]4R3:&Pg{F43eC5TFi|:RIrzz!ri)NhWi0gL)rnE' );
define( 'NONCE_SALT',       'xtds/bEnNOpWVE4L|nlXUnB=Xc?uu29a00a) PMi5N[*hf9DN_}6EE2ai8A=,A,@' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
