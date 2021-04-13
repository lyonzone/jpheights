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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lyonzfxb_wp338');

/** MySQL database username */
define('DB_USER', 'lyonzfxb_wp338');

/** MySQL database password */
define('DB_PASSWORD', 'P72!4.DYES');

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
define('AUTH_KEY',         'mpruz4hosq9sb2uencziuvgcbxqzt9s6wvfvty6ezpvfynab8aara8shknrtq6sh');
define('SECURE_AUTH_KEY',  'kzts0wkvlml405pkototsmltxtrww8uogaz23ejgtp6zhgnsfnstkctk8wvglh6o');
define('LOGGED_IN_KEY',    'ohty50lffsyxmjnij7yao0gc8w9wjo4ms8rlg1yi8ta30zgihjpc3dofcaxptauq');
define('NONCE_KEY',        'yavv4uxtmi0m1pwbe8x1qiijpgldivdqpdev2dhp2xr0aavx12cenbphf5hkmsea');
define('AUTH_SALT',        'ytxe4pnoaxrodvpenmrvm1zdwbitbpy0btxcnrdkfxkqjuthkr6urdhyqihajpep');
define('SECURE_AUTH_SALT', 'kiaymnzxrtsrlzktlpbqzqm6ppyl1afhpgca1wcunhkjtgmdx5qjbrzras4ijiwg');
define('LOGGED_IN_SALT',   'zgd078rcdfmwbbnzi8vknpxziczwrhym0emiykumuvf76dvmzrx4volwj3zegkqs');
define('NONCE_SALT',       'uxorrny8lw5a71gtomnlasjoxqjsa3ezjyg0vgaw3qf2db242vrswnwkival4lrc');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
