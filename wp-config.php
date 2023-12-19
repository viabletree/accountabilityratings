<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'algonpme_accountabilityratings' );

/** Database username */
define( 'DB_USER', 'algonpme_accountabilityratings' );

/** Database password */
define( 'DB_PASSWORD', 'Adobe110#' );

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
define( 'AUTH_KEY',         'lVQa+et0{}{NpWF`GjXgiW0kXWsgUXAuJwb}tm#,1Y!F8G9%PldZ[z~88m(wq*FG' );
define( 'SECURE_AUTH_KEY',  '}(Hs!JSwiW<>xs]hL$_AEL[~|8|yEGDei4UBhRAaptZUbIg2|tq>)uF4XAV@%WgK' );
define( 'LOGGED_IN_KEY',    'z|y.o]`h+AJP`zYU%7.re?;z;(p>K8s9lw4)>]rSD)t-!o~qC]m.,9 0~W~~^C4n' );
define( 'NONCE_KEY',        'rA#;:*dDPLugGG}EAZZYim@&_M,&pf|O)kMqb-xWo8-7r}P)=_nLt+n,?!e=>!Pv' );
define( 'AUTH_SALT',        'W|fZy+>};@vK~a6uc-Zg##}Bn&p/y> &DjIeP-n2ZD~zuS2$1ZCV9a}0Xi7Df:OV' );
define( 'SECURE_AUTH_SALT', '*.O(#p;#<p:=&L%`ynXDNaP==$Fu<a5^aE86B&r+99KDg<XnDv`AjodB_dn|I)z,' );
define( 'LOGGED_IN_SALT',   '(c}P1W[g;o(zW[?<SJ;pim.9L~zM;bg)+zgu7{k?}@^B}Q6kE&4a8_/ gI{P%CmI' );
define( 'NONCE_SALT',       '@$!Q{k*jJO=mNj4;CiGnu!ze:gJFw[Sc[PsV.)YHkRb0AjABfu>L0QwbhTvIJby:' );

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
