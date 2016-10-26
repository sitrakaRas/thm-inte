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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'thmarket');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '2,d&-(Sb[s6;W,8.Pq=q!or8TnWGvl*:o{%<SIbst]F`^,;QqeTQgC:e-rs,S<J,');
define('SECURE_AUTH_KEY',  'OB%;D?1pZSK>p-V<[]~wzkRj=RFH#vafWe|6VcIx vg*],zOlFj4g9hU6Y$,~FhW');
define('LOGGED_IN_KEY',    '/{n74|<B*v9om$,}Byvs*:Ug^w)su|mAd]gHoU51y+5!a~-GmgQ?%4LLru.z&5R+');
define('NONCE_KEY',        'tm0;r~}&Xx3QDe2(*^WSpq2)[v)l)Dy%i!hlCwW>h(*tPVg?pr`XzZ++GIz:y/;4');
define('AUTH_SALT',        'T&c6I5}tkyi(`-:+H[R,2;[_.0 {]`Q)oetWDfaxt{PIV1ZVP@8vzxev[EJ;Rb=x');
define('SECURE_AUTH_SALT', 'J@oyWHLhH)%g22Va-{mlxF<k|Ccn}+y!xE1li-5z%%@m_t4~|YX )&.>q*!9&J[z');
define('LOGGED_IN_SALT',   'GqQ8%OF9GQ,Nxf-R:>u/;B/Zh^E&:{69z{`zJ.n}al7s-~I;-.xU@N|UA.>3e=cn');
define('NONCE_SALT',       'r:R5vM!`7|fUN{cc<TNa0UV9S{];-g%iC>EyOs[a#ZZ}g7J`K~r@z)}hW4?:.[}<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'th_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
