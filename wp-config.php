<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
   if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {  
        include( dirname( __FILE__ ) . '/local-config.php' );  
    }  
    else {  
    define('DB_NAME', 'fourtee4_salvins');  
        define('DB_USER', 'fourtee4');  
        define('DB_PASSWORD', 'Brown33$');  
        define('DB_HOST', 'localhost'); 
    }  
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`wVmVj*s&f;j#jKF7!.RG_.GA_1[}2VnTsqkVB&pr-&SM1:/8V~@1=0_Ing/}12>');
define('SECURE_AUTH_KEY',  'J]Qo>uR7*Q4A7_bWu+0}Q?|~IWNQ>|TPldrzj=b+ad[mF5m[jsgw5gkCg2mA[,_v');
define('LOGGED_IN_KEY',    '0*9a,46Def[~$t+&}3u;W309~=r%@Ccq|;Fn!k(|.c|S4YGl%o{@t~u5tgp:ABy9');
define('NONCE_KEY',        '92:UHa7t6kGs)02o>6q;j<2Vy$GI]|jR!llGy<H^x fe 9vL:[(k!6j4@or++hC~');
define('AUTH_SALT',        'v.CUq@v!>>3?Q<^JVBeRPbr!9QgZ<Z{bTxX ~ 5cX<=k}d.}~UmXV_YN5T>sg$Wl');
define('SECURE_AUTH_SALT', 'jR[d`>_n2{VyG9W>{2HahSKOW73CICq!W%N(RG~bCI4+xhA:*.F2~]Iw;e|(hc@8');
define('LOGGED_IN_SALT',   'wzx7iAv/1cZVIE)P2Q3*J>`c@_7L`Bqq$}Vdlv28cUPA(/1=AlFCp&e08$gCJ6sG');
define('NONCE_SALT',       'Ck52Zw-(@+s?TtE|KDK)ya@A*rQqLy(#^n3-V@@Can1N<?V]Nu-z[vEYAUK7z1 )');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
