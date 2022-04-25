<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_geip' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'yourpassword' );

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
define( 'AUTH_KEY',         'o*-<v)jDF^|)w8d<T  e#QF}50OrQx949bbQidDV?pD2`cQZ<Pi8ZT*.~@DS_8bv' );
define( 'SECURE_AUTH_KEY',  'X!hcrCbSqj6}vbU>J;ypnfYY5aEFVd`@;CVI94` f[8WlvtwsC;9lJ4kX|s:CZEJ' );
define( 'LOGGED_IN_KEY',    '&T`14U-OwS-@ g2Y7 X7g2lw%2l8;,{c-A7`mFIel}>wTTb57@RkU-iFsP|H|sbK' );
define( 'NONCE_KEY',        '3,fo_VqVRAnF,x@tI>=G.zp8s ciV.8`xmMHl.1Vx#+)S$W}8gskC hdyph%QD]K' );
define( 'AUTH_SALT',        '0ijFmeNj;{yZ[hnwg[64Mez;U(lV_uySU@l,kY0{6K{v7zQaA7GrL@&NOawopRbF' );
define( 'SECURE_AUTH_SALT', ')C))O`xD$B8G`{9sg#wz*.5Ri3.v=E#Vbuo9wllMBBq0/fK{BVHtSE2.dmKVMq;P' );
define( 'LOGGED_IN_SALT',   'ARtM=Nmh u{SMn=,5{Fl6pXgCE5-w~~ZtYepG>Jmb-#/di!UWpD9o~h@[K-)!j<X' );
define( 'NONCE_SALT',       'GZvpRZZmHO4-}D>jBs1$Y0&aCR{i-(YWqEUI}faSt8/oo+]c[`_3uy;+j=)PM fJ' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
