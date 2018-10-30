<?php

define('FS_METHOD', 'direct');

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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db758622950' );

/** MySQL database username */
define( 'DB_USER', 'dbo758622950' );

/** MySQL database password */
define( 'DB_PASSWORD', 'VJTVidTMBpeWViiyXqXk' );

/** MySQL hostname */
define( 'DB_HOST', 'db758622950.db.1and1.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2JS|Pw&/Q5rtXP ;XFAbaL;}!b8t`rF><S#X-S!z1G{yv`NWJ.J0C-G1L|SBu.gD');
define('SECURE_AUTH_KEY',  'Voo&sTVz.moV-4n<-lVHU mVV;6|2|}mic;);(L2=`!xPvpm*-VhO1zSeXNSw$51');
define('LOGGED_IN_KEY',    'P>),N&?naAd-_g?SqKgN2Bv8;b8uV#DWQtNHB^V,6.HnY0ZPF!|re$QS^ MfAg.6');
define('NONCE_KEY',        'A6|2%Lvi-Cvz|Sl_s|M( }nV}mTLW!16&m+oNVhYPoG^YW&=1,<vDJ@LuzN-9t_F');
define('AUTH_SALT',        ' (?WZ3R :-AL-a#ASWik+0C`7VJ.9qCIu,]_r~b:8VF78,cuq4kyVX2rlM8%1+5^');
define('SECURE_AUTH_SALT', '(,*)5i{g%M7%iZaU+j$(Jc=l(gb.|q5y|y,[#VO0/NT{/-GOG(J?!b6F5`{R;DQv');
define('LOGGED_IN_SALT',   'A`%Q|=$N@-?5Q0y+I:0FI<tn-+T-#hm-+)Oq|pCk7mz^+ r+F55M8YIpp!u8N|m$');
define('NONCE_SALT',       '2Z0F{GEWK,+,5j+f+I_U*Kuzu ?hSVG5|S89_R|#n|XiL^ X:$oG#-;WWv9nek!)');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tFsQkekV';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
