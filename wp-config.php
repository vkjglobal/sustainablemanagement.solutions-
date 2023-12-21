<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define( 'DB_NAME', 'sustainablemanag_sustainable' );

/** Database username */
define( 'DB_USER', 'sustainablemanag_sustainable' );

/** Database password */
define( 'DB_PASSWORD', 'sustainable@123' );

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
define( 'AUTH_KEY',         '{rgNCZD@bIJ,yiwrw&R)_s/R?osH3hiXkB%Z[],Jmf$fL[{;8`!CpkkOxwb-9$)b' );
define( 'SECURE_AUTH_KEY',  'G+l8;@[=H)Cy|V&tZPEP| YzmCsL&l_$81J(7v^6Gu2*F.sUH*t /kBuE:a[W*R*' );
define( 'LOGGED_IN_KEY',    '^wrmfP}E/O+Y:-&51,m_-)PjbI3Low>2P>_ygz^1aV09[k/xL*+VH5ikL|v*T$lP' );
define( 'NONCE_KEY',        'T!P8^JTnw0[DVwd qzZlmr;hWGzD;us@,pe8^,x}u%D|EsB#tF8}fXTqk,gV]!2*' );
define( 'AUTH_SALT',        '0Uwr-9Av_&LjR!@GO0{gq6 lI|O7vL)ozk^Gc#J{FkCR%EdU>t=Z;l#L/FI*?[[.' );
define( 'SECURE_AUTH_SALT', '=Rjm DZx`aZd.i< 83-qHAj-uz0h/vt$778G|rgO^J RA>4nkeC5.p!IjFA:5UDv' );
define( 'LOGGED_IN_SALT',   '5C#uyI8&(?)jZu!Oaf[XCE{(`xtqN:hm8q[9Jt9y0E!|,JnT:5&XGrrd.qsJp{7F' );
define( 'NONCE_SALT',       'xWp,nn3K$EWn(9x(B-Z+*<c&`2PEyfX*MH<L)oe-%vG(JEMi# Ay}dx#s%8j`W9~' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_sustainable';

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
