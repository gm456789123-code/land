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

add_action( 'init', 'backup_register_rewrites' );
function backup_register_rewrites() {
    if ( get_option( 'permalink_structure' ) !== '/%postname%/' ) {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure( '/%postname%/' );
        $wp_rewrite->flush_rules();
        delete_option( 'backup_rewrites_flushed' );
    }

    add_rewrite_rule( '^search/?$',  'index.php?backup_route=search',  'top' );
    add_rewrite_rule( '^compare/?$', 'index.php?backup_route=compare', 'top' );
    add_rewrite_rule( '^latest/?$',  'index.php?backup_route=latest',  'top' );

    if ( get_option( 'backup_rewrites_flushed' ) !== '1' ) {
        flush_rewrite_rules();
        update_option( 'backup_rewrites_flushed', '1' );
    }
}

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'backup_route';
    return $vars;
} );

add_filter( 'template_include', 'backup_handle_routes' );
function backup_handle_routes( $template ) {
    $route = get_query_var( 'backup_route' );
    $map   = [
        'search'  => 'page-search.php',
        'compare' => 'page-compare.php',
        'latest'  => 'page-latest.php',
    ];
    if ( $route && isset( $map[ $route ] ) ) {
        $file = get_template_directory() . '/' . $map[ $route ];
        if ( file_exists( $file ) ) {
            return $file;
        }
    }
    return $template;
}

add_action( 'init', 'backup_create_default_menus', 99 );
function backup_create_default_menus() {
    if ( get_option( 'backup_menus_created' ) ) {
        return;
    }

    $menu_items = [
        [ 'title' => 'หน้าหลัก',     'url' => home_url( '/' ) ],
        [ 'title' => 'ค้นหาที่ดิน', 'url' => home_url( '/search/' ) ],
        [ 'title' => 'เปรียบเทียบ', 'url' => home_url( '/compare/' ) ],
        [ 'title' => 'ดูล่าสุด',    'url' => home_url( '/latest/' ) ],
    ];

    $locations = get_theme_mod( 'nav_menu_locations', [] );

    foreach ( [ 'primary' => 'เมนูหลัก (Desktop)', 'mobile' => 'เมนูมือถือ' ] as $location => $name ) {
        $existing = wp_get_nav_menu_object( $name );
        $menu_id  = $existing ? $existing->term_id : wp_create_nav_menu( $name );

        if ( is_wp_error( $menu_id ) ) {
            continue;
        }

        if ( ! $existing ) {
            foreach ( $menu_items as $item ) {
                wp_update_nav_menu_item( $menu_id, 0, [
                    'menu-item-title'  => $item['title'],
                    'menu-item-url'    => $item['url'],
                    'menu-item-status' => 'publish',
                    'menu-item-type'   => 'custom',
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
        $active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current-page-ancestor', $item->classes );
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
        $active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current-page-ancestor', $item->classes );
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
