<?php
/**
 * wp-config สำหรับ Docker — อ่านค่าจาก environment variables
 * ตั้งค่าผ่าน docker-compose.yml หรือ .env
 */

define( 'DB_NAME',     getenv( 'WORDPRESS_DB_NAME' )     ?: 'wordpress' );
define( 'DB_USER',     getenv( 'WORDPRESS_DB_USER' )     ?: 'wordpress' );
define( 'DB_PASSWORD', getenv( 'WORDPRESS_DB_PASSWORD' ) ?: '' );
define( 'DB_HOST',     getenv( 'WORDPRESS_DB_HOST' )     ?: 'db:3306' );
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  '' );

$table_prefix = getenv( 'WORDPRESS_TABLE_PREFIX' ) ?: 'wp_';

/* Security keys — สร้างใหม่ได้ที่ https://api.wordpress.org/secret-key/1.1/salt/ */
define( 'AUTH_KEY',         getenv( 'WP_AUTH_KEY' )         ?: 'put-your-unique-phrase-here' );
define( 'SECURE_AUTH_KEY',  getenv( 'WP_SECURE_AUTH_KEY' )  ?: 'put-your-unique-phrase-here' );
define( 'LOGGED_IN_KEY',    getenv( 'WP_LOGGED_IN_KEY' )    ?: 'put-your-unique-phrase-here' );
define( 'NONCE_KEY',        getenv( 'WP_NONCE_KEY' )        ?: 'put-your-unique-phrase-here' );
define( 'AUTH_SALT',        getenv( 'WP_AUTH_SALT' )        ?: 'put-your-unique-phrase-here' );
define( 'SECURE_AUTH_SALT', getenv( 'WP_SECURE_AUTH_SALT' ) ?: 'put-your-unique-phrase-here' );
define( 'LOGGED_IN_SALT',   getenv( 'WP_LOGGED_IN_SALT' )   ?: 'put-your-unique-phrase-here' );
define( 'NONCE_SALT',       getenv( 'WP_NONCE_SALT' )       ?: 'put-your-unique-phrase-here' );

define( 'WP_DEBUG',     filter_var( getenv( 'WP_DEBUG' ),     FILTER_VALIDATE_BOOLEAN ) );
define( 'WP_DEBUG_LOG', filter_var( getenv( 'WP_DEBUG_LOG' ), FILTER_VALIDATE_BOOLEAN ) );

/* Site URL — ใช้ HTTPS บน production */
if ( getenv( 'WORDPRESS_SITE_URL' ) ) {
    define( 'WP_HOME',    getenv( 'WORDPRESS_SITE_URL' ) );
    define( 'WP_SITEURL', getenv( 'WORDPRESS_SITE_URL' ) );
}

/* Uploads อยู่ใน volume ที่ mount เข้ามา */
define( 'UPLOADS', 'wp-content/uploads' );

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
