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
define( 'DB_NAME', 'jm-theme' );

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
define( 'AUTH_KEY',         'YaSAPSq<HDCGw$<cL[=bElb+Hb,$A*Yg8[|9 ^OuuQ!*Z`_e`~wF*O(B^:#gj-D-' );
define( 'SECURE_AUTH_KEY',  'C2v^@clN1Esg:+a2VM=tiWDcSx=Rf5L65/YJ;C5JqeeE|)EbgOeent;2FX|D=,40' );
define( 'LOGGED_IN_KEY',    'o9da>y],knQS+Ys/=6.5k`U595WI@i*LG:C>ecs xZ<TkAeT3rcMt_=3&k>f);>c' );
define( 'NONCE_KEY',        '9Z]z8*9z,jw~gv7H~OC;Dvhm0Ux8eTLL.Yo|y0]l&7jM;b vXQfw13^W-aEnNrP6' );
define( 'AUTH_SALT',        '8@%+LV:6wQGN3GEU-ZK ,YgnzANP@bQ>F0c2>m[Eh+aLtZ;6N_X2}*F]0/f3n3;@' );
define( 'SECURE_AUTH_SALT', 'o?5ZZTe2oi`jd{a)K0JYuHQqb9oOB|>4)14Asv(@ Hght<jSxQ;,4t_JNMd#M?`e' );
define( 'LOGGED_IN_SALT',   '~) |m6L<5VrN2u6X]%8Z#&~Y885l}%l)f cz~g:LwmE+N|YI%cM7x2X}E`.D_YE-' );
define( 'NONCE_SALT',       'FR(6gR{Gb#sFVVy]UQ1;C7R^MIep/}Ael(62p/_1yt;Z,:pc4&ers*`_Nk]@o5?g' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'jm02_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
