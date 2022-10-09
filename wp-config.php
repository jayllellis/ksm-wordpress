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
/** @desc this loads the composer autoload file */
// require_once dirname(__DIR__, 1) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';
/** @desc this instantiates Dotenv and passes in our path to .env */
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__));
$dotenv->load();

defined('APP_ENV') or define('APP_ENV', $_ENV['APP_ENV']);
defined('DB_NAME') or define('DB_NAME', $_ENV['DB_NAME']);
defined('DB_USER') or define('DB_USER', $_ENV['DB_USER']);
defined('DB_PASSWORD') or define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
defined('DB_HOST') or define('DB_HOST', $_ENV['DB_HOST']);

// defined('WP_REACT_URL') or define('WP_REACT_URL', $_ENV['WP_REACT_URL']);

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'tjb-FY?$XecUG1H+s7crb+o|6I(-Z$FguRyzB-!Ix:f8vj:Q7Rht?Bnt>OZ)R}>x');
define('SECURE_AUTH_KEY',  'e*f<WI]IT+;8~m^:E@)~Vm3ID~[QTwT }%pO+dMj@ET@j9Rm?gI-D9p4c AcD@fp');
define('LOGGED_IN_KEY',    'oOkZHyT |I~]Y(E.# $u:>8q{=8k+I7)uMs4/+-kdiYc]lHe>%&uWj{n}<{f4>h=');
define('NONCE_KEY',        '-+}%835D7=8|p--Tv&LIK,Y^b+shV+GMl.RwulO+&:#2P4Ke$|xOO-.gQ/;9zufG');
define('AUTH_SALT',        'E]) 9K_RC#z?F68G&AGiv#bM`2[XlVZ-2uqw]1{REPkkZGdTjWp|o-5/o6Pv~QWR');
define('SECURE_AUTH_SALT', 'jGnL,*l7 P73Da09517Z!Aj_}`;.ID+>{wNOuebO_eh*qDt/]w ;#H*wo|&SM_aM');
define('LOGGED_IN_SALT',   '(YM&}4/hH~0{^N+R8X0|y3E6jOP #[I*lFF=ifIQLmtjwA<q 5ao#TkTw%}`-;.O');
define('NONCE_SALT',       ',H`-7HajQR>9>/I+WR@U<Kb;6/3Q+U$S;djGvN>9|lV Zs+i=O?jQxwlxAR^vWL^');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ksm_';

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
if (APP_ENV=="local") {
	define( 'WP_DEBUG', true );
	define('WP_DEBUG_DISPLAY', false);// only set this option when you don't want to display it on screen and just log to file (next line)
	define('WP_DEBUG_LOG', true);// stored in wp-content/debug.log
}
else {
	define( 'WP_DEBUG', false );
}

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
