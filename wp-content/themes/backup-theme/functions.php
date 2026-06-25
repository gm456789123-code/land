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
