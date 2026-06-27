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
    // Permalink
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
    $wp_rewrite->flush_rules();

    // Pages
    $pages = [
        'search'       => 'ค้นหาที่ดิน',
        'compare'      => 'เปรียบเทียบ',
        'latest'       => 'ดูล่าสุด',
        'login'        => 'เข้าสู่ระบบ',
        'register'     => 'สมัครสมาชิก',
        'post-listing' => 'ลงประกาศขายที่ดิน',
        'my-listings'  => 'ประกาศของฉัน',
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
