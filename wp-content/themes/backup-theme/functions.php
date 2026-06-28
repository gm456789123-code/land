<?php

if ( ! function_exists( 'backup_theme_setup' ) ) {
    function backup_theme_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption', 'script', 'style' ] );

        register_nav_menus( [
            'primary' => 'เมนูหลัก (Desktop)',
            'mobile'  => 'เมนูมือถือ',
        ] );
    }
}
add_action( 'after_setup_theme', 'backup_theme_setup' );

function backup_theme_enqueue() {
    wp_enqueue_style( 'backup-theme-style', get_stylesheet_uri(), [], '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'backup_theme_enqueue' );

/* ============================================================
   Custom Post Type — ประกาศขายที่ดิน
   ============================================================ */
add_action( 'init', 'backup_register_land_listing_cpt' );
function backup_register_land_listing_cpt() {
    register_post_type( 'land_listing', [
        'labels' => [
            'name'          => 'ประกาศที่ดิน',
            'singular_name' => 'ประกาศที่ดิน',
            'add_new_item'  => 'เพิ่มประกาศใหม่',
            'edit_item'     => 'แก้ไขประกาศ',
        ],
        'public'       => true,
        'show_in_menu' => true,
        'supports'     => [ 'title', 'thumbnail', 'author' ],
        'menu_icon'    => 'dashicons-admin-home',
        'rewrite'      => [ 'slug' => 'listing' ],
    ] );
}

add_action( 'after_switch_theme', 'backup_theme_activate' );
function backup_theme_activate() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
    $wp_rewrite->flush_rules();
    backup_ensure_pages();
}

add_action( 'init', 'backup_ensure_pages', 5 );
function backup_ensure_pages() {
    if ( get_option( 'backup_pages_created_v2' ) ) {
        return;
    }
    $pages = [
        'search'       => 'ค้นหาที่ดิน',
        'compare'      => 'เปรียบเทียบ',
        'latest'       => 'ดูล่าสุด',
        'login'        => 'เข้าสู่ระบบ',
        'register'     => 'สมัครสมาชิก',
        'post-listing' => 'ลงประกาศขายที่ดิน',
        'my-listings'  => 'ประกาศของฉัน',
        'profile'      => 'ข้อมูลส่วนตัว',
    ];
    foreach ( $pages as $slug => $title ) {
        if ( ! get_page_by_path( $slug ) ) {
            wp_insert_post( [
                'post_title'  => $title,
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_type'   => 'page',
            ] );
        }
    }
    update_option( 'backup_pages_created_v2', true );
}

add_action( 'init', 'backup_create_default_menus', 99 );
function backup_create_default_menus() {
    if ( get_option( 'backup_menus_created' ) ) {
        return;
    }

    $page_items = [
        [ 'title' => 'หน้าหลัก',     'slug' => '' ],
        [ 'title' => 'ค้นหาที่ดิน', 'slug' => 'search' ],
        [ 'title' => 'เปรียบเทียบ', 'slug' => 'compare' ],
        [ 'title' => 'ดูล่าสุด',    'slug' => 'latest' ],
    ];

    $locations = get_theme_mod( 'nav_menu_locations', [] );

    foreach ( [ 'primary' => 'เมนูหลัก (Desktop)', 'mobile' => 'เมนูมือถือ' ] as $location => $name ) {
        $existing = wp_get_nav_menu_object( $name );
        $menu_id  = $existing ? $existing->term_id : wp_create_nav_menu( $name );

        if ( is_wp_error( $menu_id ) ) {
            continue;
        }

        if ( ! $existing ) {
            foreach ( $page_items as $item ) {
                $page = $item['slug'] ? get_page_by_path( $item['slug'] ) : null;
                wp_update_nav_menu_item( $menu_id, 0, $page ? [
                    'menu-item-title'     => $item['title'],
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ] : [
                    'menu-item-title'  => $item['title'],
                    'menu-item-url'    => home_url( '/' ),
                    'menu-item-type'   => 'custom',
                    'menu-item-status' => 'publish',
                ] );
            }
        }

        $locations[ $location ] = $menu_id;
    }

    set_theme_mod( 'nav_menu_locations', $locations );
    update_option( 'backup_menus_created', true );
}

/* ============================================================
   Nav Walker — Desktop
   Outputs <a> tags with Tailwind classes (no <li>/<ul> wrapper)
   ============================================================ */
class Backup_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $active = in_array( 'current-menu-item', $item->classes )
               || in_array( 'current-page-ancestor', $item->classes )
               || rtrim( $item->url, '/' ) === rtrim( home_url( $_SERVER['REQUEST_URI'] ), '/' );
        $class  = $active
            ? 'px-4 py-2 rounded-full text-white'
            : 'px-4 py-2 rounded-full text-gray-600 hover:bg-gray-100 transition-colors';
        $style  = $active ? ' style="background:#13357a;"' : '';
        $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $class ) . '"' . $style . '>';
        $output .= esc_html( $item->title );
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</a>';
    }
}

/* ============================================================
   Nav Walker — Mobile
   ============================================================ */
class Backup_Mobile_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $active = in_array( 'current-menu-item', $item->classes )
               || in_array( 'current-page-ancestor', $item->classes )
               || rtrim( $item->url, '/' ) === rtrim( home_url( $_SERVER['REQUEST_URI'] ), '/' );
        $class  = $active
            ? 'block px-4 py-2 rounded-full text-white text-center mb-1'
            : 'block px-4 py-2 rounded-full text-gray-600 hover:bg-gray-100 transition-colors';
        $style  = $active ? ' style="background:#13357a;"' : '';
        $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $class ) . '"' . $style . '>';
        $output .= esc_html( $item->title );
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</a>';
    }
}

/* ============================================================
   Admin Settings — ตั้งค่าสถิติหน้าหลัก (ดีล + มูลค่า)
   ============================================================ */
add_action( 'admin_menu', function () {
    add_options_page( 'ตั้งค่าสถิติ', 'สถิติเว็บ', 'manage_options', 'land-stats', 'backup_stats_settings_page' );
} );

function backup_stats_settings_page() {
    if ( isset( $_POST['land_stats_nonce'] ) && wp_verify_nonce( $_POST['land_stats_nonce'], 'land_stats' ) && current_user_can( 'manage_options' ) ) {
        update_option( 'land_stat_deals', (int) $_POST['deals'] );
        update_option( 'land_stat_value', sanitize_text_field( $_POST['value'] ) );
        echo '<div class="notice notice-success is-dismissible"><p>บันทึกเรียบร้อยแล้ว</p></div>';
    }
    $deals = get_option( 'land_stat_deals', 84 );
    $value = get_option( 'land_stat_value', '42.6' );
    ?>
    <div class="wrap">
      <h1>ตั้งค่าสถิติหน้าหลัก</h1>
      <p class="description">จำนวนสมาชิกและที่ดินคำนวณอัตโนมัติ — ตั้งค่าเฉพาะดีลและมูลค่าที่นี่</p>
      <form method="POST" style="max-width:400px;margin-top:20px;">
        <?php wp_nonce_field( 'land_stats', 'land_stats_nonce' ); ?>
        <table class="form-table">
          <tr>
            <th><label for="deals">จำนวนดีลที่ปิดแล้ว</label></th>
            <td><input type="number" id="deals" name="deals" value="<?php echo esc_attr( $deals ); ?>" class="regular-text"> ดีล</td>
          </tr>
          <tr>
            <th><label for="value">มูลค่าดีลรวม (ล้านบาท)</label></th>
            <td><input type="text" id="value" name="value" value="<?php echo esc_attr( $value ); ?>" class="regular-text"> ล้านบาท</td>
          </tr>
        </table>
        <?php submit_button( 'บันทึก' ); ?>
      </form>
    </div>
    <?php
}

/* ============================================================
   Hide WordPress — ซ่อน wp-login.php / wp-admin จากคนอื่น
   ============================================================ */

// ชี้ login/register URL ในระบบ WP ไปหน้าของเรา
add_filter( 'login_url',    fn( $url ) => home_url( '/login/' ),    10, 3 );
add_filter( 'register_url', fn()       => home_url( '/register/' )          );

// wp-login.php: ให้ 404 ยกเว้น logout / reset password
add_action( 'login_init', function () {
    $action  = $_REQUEST['action'] ?? 'login';
    $allowed = [ 'logout', 'rp', 'resetpass', 'postpass', 'lostpassword' ];
    if ( ! in_array( $action, $allowed, true ) ) {
        status_header( 404 );
        nocache_headers();
        exit;
    }
} );

// /wp-admin/ สำหรับคนที่ไม่ได้ login → 404 (ต้องใช้ init ไม่ใช่ admin_init เพราะ auth_redirect() ยิงก่อน)
add_action( 'init', function () {
    if ( is_admin() && ! wp_doing_ajax() && ! is_user_logged_in() ) {
        status_header( 404 );
        nocache_headers();
        exit;
    }
}, 1 );

