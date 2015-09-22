<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'eva_recruit');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'abcdabcd');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^y4|WzPt-^1,Pm/,|&0n{P7csLcFip^(3)fj0]qGS4+SRDR|t#R&RVIS-tJDMEqF');
define('SECURE_AUTH_KEY',  'B|D`UxSQQuJX#V1-8H6Y7.?vvYu?Um+(i;_vI~5^r@d-$E^K:W0o-I4C>xn.?8:m');
define('LOGGED_IN_KEY',    'X5~<gmVx6afWif0jZiK+|ee+(f[5Cbs#>9mYS6u%m40IZS1!`|6<=QHsI#86UX@)');
define('NONCE_KEY',        'YJh-EvEnAk cn+Lz]HB0(^=kt]>+B@Yn{xUrIZdlVABr?dL^H3h9`XORq_54|wAf');
define('AUTH_SALT',        'G(MT$#`|oK)]U8AN++E8-FfJ!RXq5.U!N|GTYt}?FuzAA]Sy*/bP$t#6K}Z]1<Mz');
define('SECURE_AUTH_SALT', 'Wu{QAKs(-Kk}<$CcgIAd=-%<Z!jb!D+{-x,_v`AS/8On[^KnF.XK-6Z:,DyVsT]y');
define('LOGGED_IN_SALT',   '4ZXkf0]|SB0l.`Ebn}p8+]=x5St}f5/F&3=(TljN[bZ+UDHb^ CB8)*D[@zS*E[x');
define('NONCE_SALT',       ')D$fII.Y)K}Kk 5g==`dyNa7m8uX.N5w4u;Oe}vf1ef&o:*J._2ByhCua1 ^rLk@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

define('FS_METHOD', 'direct');

// Disable Plugin and Theme Update and Installation
//define( 'DISALLOW_FILE_MODS', true );

// Disable all automatic updates:
// define( 'AUTOMATIC_UPDATER_DISABLED', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
