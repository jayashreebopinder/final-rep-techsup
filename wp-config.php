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
define( 'DB_NAME', 'techsup' );

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
define( 'AUTH_KEY',         'O&iw80 tr)f7gbf&o96EKBx}z$.`2cLNxl~o/~79<HnvoS)(;6.ShoMN.).!aR}?' );
define( 'SECURE_AUTH_KEY',  '`E#^=42L4> e4s2GvoLNoR@6QM4lo(aH84p7u^Da*Jo@, VYN`Nt}}+z1.S=}BuY' );
define( 'LOGGED_IN_KEY',    '_=(/7s7 `68ILHjR#oeXUv5xG,^[^<c5{v$sW!Hoxz5<?YqVAG/N7NK-CTty&}%)' );
define( 'NONCE_KEY',        'JLB1$nC,5_*WjO{V8.G+-f}q0Bn91e-$gmF*Sk2xw<f,v+`Uue<A//N_)nA V#@p' );
define( 'AUTH_SALT',        'tLF+K!FAiFBHNarriN5$)!JmqpkG.Tg07xX+V*D?#q@/8r#?|[l Q+-`&K*Ac_-U' );
define( 'SECURE_AUTH_SALT', 's<UaXUy/m,>W>BmdJDpH4!L@bh45!w/p.=+xIqWfyhTwSPs/J>M2y:5|6?p=Y)gg' );
define( 'LOGGED_IN_SALT',   'y{~&VR;/(2Q4eJK).KdtLYX^~NRs3}bU4G`aGFPy``fC~E@#t`xcn:Wrs?ZaMSI:' );
define( 'NONCE_SALT',       ':i34CM6qvpH.6Pg]<c:h7kX.Zd{x!x/CfD6.%b&!3<G:({-|U#4^e#LM!>El @!J' );

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
