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
define( 'DB_NAME', 'land' );

/** Database username */
define( 'DB_USER', 'mysql' );

/** Database password */
define( 'DB_PASSWORD', 'mysql1234' );

/** Database hostname */
define( 'DB_HOST', 'land_mysql' );

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
define( 'AUTH_KEY',         'tKn:TijHTqKa!]1uuGH/APmUKVM`kn%9KM/A[~x:3i8z6A`Rwy4DJXq;l:M+fz3w' );
define( 'SECURE_AUTH_KEY',  '/5#{|j-:@(R<C=$TZ9:&1vSHEe{n+W)KGh_<67UF%+m!&fbGjn`9IZrvy[~FkP%@' );
define( 'LOGGED_IN_KEY',    '2n|2rJHPH+3!F~i3FOe@F%4D4Gl3,NvQeIX=d^@zgUsd}DG@-6.P<I(L_c)npG-M' );
define( 'NONCE_KEY',        'Ue8/me5deLm%;`F}5*_XxvA2jO!KXtdOj]5GOt9 {qy{qkBDR;Z${dC+D<JGtQW`' );
define( 'AUTH_SALT',        'jLIj.0!@[/QE+v1tk?I)+U@#J-Rp<}+F<d5]2lL(7>J*[g*ChYE&!8;Q5rNb/Ack' );
define( 'SECURE_AUTH_SALT', 'xDTGOGb*eX&bnC2lj!B&6m (h{#=o.prnO?fn~HE 3k7gj7:L2#;-~wSB^%.|buy' );
define( 'LOGGED_IN_SALT',   'c&%DL*N,2[VSs%)6e=ZeVEFYizFy]{ r=gsWIFz<vx}Vt4mfKui(rCPL^wA_:J3H' );
define( 'NONCE_SALT',       '|eK)|Z%%<b|%q<h~E;sC0)HrXn4Za:+zDehw#V&5p~p%s6[6~a7YVz_4Q+d&Ggua' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
