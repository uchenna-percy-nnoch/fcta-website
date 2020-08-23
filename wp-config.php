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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_fct_pension' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '7LW_v!7Z##<a&JwW' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'D`x3cloKd(VcUnJmt}x4ro[gl3,NI~1c<Q!KQ=`y0aBr)#i/7[nO-lMzFm_0t@:d' );
define( 'SECURE_AUTH_KEY',  'X6{iB7+dq4tF<Z~xx&eX}6wt+boiMn7vnEcPUCd/YiA&p+k_ge$1(31j~br0Cjl.' );
define( 'LOGGED_IN_KEY',    'b16uK6r#f/[RH[7}5ow|/yQk</K:MP4&u;!hmok0zpQJ&eaZiQ(;NI#IT_pZ~}R}' );
define( 'NONCE_KEY',        'P{,4<lAxCC#@Js[ut_kJzJw[c3uw*6:0ecO dnhH&igNLF5l]FBGnIp6)}.k~$^X' );
define( 'AUTH_SALT',        'a3&=N8LQDY+_ 6 $%J&bttZXLwBwreSI<HVtm(!j-1d0_e0R|_xs70k@y1*2LT$r' );
define( 'SECURE_AUTH_SALT', ' :eyP}T6@LY}P&Lp,:>jhD%7ZmCQLQ|g$VL =z9Wbk0&Qlq,##XpRQT;H3aF>=r}' );
define( 'LOGGED_IN_SALT',   ' .5M//7w G4:BKY0YeAs0lN8dEq8aI<h,G8S2r^.cswixPDZ|;-sr+P%WfmWKc>T' );
define( 'NONCE_SALT',       'Q1+6&!#_A_}mzu@mF40819$pUzA@)f^;H1Ize4O*@$zH(Ie.k!jb^DY0xBtmom^K' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
*/ 
define( 'WP_DEBUG', false );
define('FS_METHOD','direct');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
