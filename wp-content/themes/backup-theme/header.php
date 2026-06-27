<?php
/**
 * Site Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { sans: ['"Noto Sans Thai"', 'sans-serif'] },
        colors: {
          brand: { blue: '#13357a', blue2: '#1d4ed8', green: '#1aa260' },
        },
      },
    },
  };
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-gray-50 text-gray-800' ); ?>>
<?php wp_body_open(); ?>

<!-- top accent bar -->
<div class="h-1.5 w-full" style="background:linear-gradient(90deg,#facc15,#1d4ed8,#1aa260);"></div>

<!-- ===== HEADER ===== -->
<header class="sticky top-0 z-50 bg-white shadow-sm">
  <div class="max-w-7xl mx-auto px-4 lg:px-8 h-20 flex items-center justify-between gap-4">

    <!-- Logo -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 shrink-0">
      <span class="w-10 h-10 rounded-xl flex items-center justify-center text-white" style="background:#13357a;">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M12 2l10 10-10 10L2 12 12 2z"/>
        </svg>
      </span>
      <span>
        <span class="block text-lg font-extrabold leading-none" style="color:#13357a;">
          ตลาดที่ดินไทย<span style="color:#1aa260;">.com</span>
        </span>
        <span class="block text-xs text-gray-500 mt-0.5">แพลตฟอร์มประกาศที่ดินทั่วประเทศ</span>
      </span>
    </a>

    <!-- Desktop nav -->
    <nav class="hidden lg:flex items-center gap-1 text-sm font-semibold">
      <?php
      wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'walker'         => new Backup_Nav_Walker(),
        'fallback_cb'    => 'backup_nav_fallback',
      ] );
      ?>
    </nav>

    <!-- Actions -->
    <div class="flex items-center gap-2 lg:gap-3 shrink-0">
      <button class="hidden md:flex items-center gap-1 px-3 py-2 rounded-full border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
        TH <span class="text-xs">▾</span>
      </button>
      <?php if ( is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">ลงประกาศ</a>
        <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="px-4 py-2 rounded-full text-sm font-semibold text-white hover:opacity-90 transition-opacity" style="background:#1d4ed8;">ออกจากระบบ</a>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">เข้าสู่ระบบ</a>
        <a href="<?php echo esc_url( home_url( '/register/' ) ); ?>" class="px-4 py-2 rounded-full text-sm font-semibold text-white hover:opacity-90 transition-opacity" style="background:#1d4ed8;">สมัครสมาชิก</a>
      <?php endif; ?>
      <!-- Hamburger (mobile) -->
      <button id="hamburger-btn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors" aria-label="เปิดเมนู" aria-expanded="false" aria-controls="mobile-menu">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <line x1="3" y1="6"  x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden flex-col border-t border-gray-100 bg-white px-4 pb-4 pt-2 text-sm font-semibold gap-1">
    <?php
    wp_nav_menu( [
      'theme_location' => 'mobile',
      'container'      => false,
      'items_wrap'     => '%3$s',
      'walker'         => new Backup_Mobile_Walker(),
      'fallback_cb'    => 'backup_mobile_nav_fallback',
    ] );
    ?>
  </div>
</header>
<?php

function backup_nav_fallback() {
    $items = [
        [ 'url' => home_url( '/' ),        'label' => 'หน้าหลัก',     'active' => is_front_page() ],
        [ 'url' => home_url( '/search/' ),  'label' => 'ค้นหาที่ดิน', 'active' => is_page( 'search' ) ],
        [ 'url' => home_url( '/compare/' ), 'label' => 'เปรียบเทียบ', 'active' => is_page( 'compare' ) ],
        [ 'url' => home_url( '/latest/' ),  'label' => 'ดูล่าสุด',    'active' => is_page( 'latest' ) ],
    ];
    foreach ( $items as $item ) {
        $class = $item['active']
            ? 'px-4 py-2 rounded-full text-white'
            : 'px-4 py-2 rounded-full text-gray-600 hover:bg-gray-100 transition-colors';
        $style = $item['active'] ? ' style="background:#13357a;"' : '';
        echo '<a href="' . esc_url( $item['url'] ) . '" class="' . $class . '"' . $style . '>' . esc_html( $item['label'] ) . '</a>';
    }
}

function backup_mobile_nav_fallback() {
    $items = [
        [ 'url' => home_url( '/' ),        'label' => 'หน้าหลัก',     'active' => is_front_page() ],
        [ 'url' => home_url( '/search/' ),  'label' => 'ค้นหาที่ดิน', 'active' => is_page( 'search' ) ],
        [ 'url' => home_url( '/compare/' ), 'label' => 'เปรียบเทียบ', 'active' => is_page( 'compare' ) ],
        [ 'url' => home_url( '/latest/' ),  'label' => 'ดูล่าสุด',    'active' => is_page( 'latest' ) ],
    ];
    foreach ( $items as $item ) {
        $class = $item['active']
            ? 'block px-4 py-2 rounded-full text-white text-center mb-1'
            : 'block px-4 py-2 rounded-full text-gray-600 hover:bg-gray-100 transition-colors';
        $style = $item['active'] ? ' style="background:#13357a;"' : '';
        echo '<a href="' . esc_url( $item['url'] ) . '" class="' . $class . '"' . $style . '>' . esc_html( $item['label'] ) . '</a>';
    }
}
