<?php
/**
 * Site Header
 */
$current_user = wp_get_current_user();
$member_name  = $current_user && $current_user->exists() ? $current_user->display_name : '';
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

<div class="h-1.5 w-full" style="background:linear-gradient(90deg,#facc15,#1d4ed8,#1aa260);"></div>

<header class="sticky top-0 z-50 bg-white shadow-sm">
  <div class="max-w-7xl mx-auto px-4 lg:px-8 h-20 flex items-center justify-between gap-4">
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

    <div class="flex items-center gap-2 lg:gap-3 shrink-0">
      <button class="hidden md:flex items-center gap-1 px-3 py-2 rounded-full border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
        TH <span class="text-xs">▾</span>
      </button>
      <?php if ( is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">ลงประกาศ</a>
        <div class="relative hidden sm:block" data-member-menu>
          <button type="button" id="member-menu-button" class="flex items-center gap-3 rounded-full border border-gray-200 bg-white pl-3 pr-2 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors" aria-expanded="false" aria-controls="member-menu-panel">
            <span class="flex h-9 w-9 items-center justify-center rounded-full text-white font-bold" style="background:#13357a;">
              <?php echo esc_html( strtoupper( function_exists( 'mb_substr' ) ? mb_substr( $member_name ?: $current_user->user_login, 0, 1 ) : substr( $member_name ?: $current_user->user_login, 0, 1 ) ) ); ?>
            </span>
            <span class="hidden md:block text-left leading-tight">
              <span class="block text-xs text-gray-400 font-medium">สมาชิก</span>
              <span class="block max-w-[120px] truncate"><?php echo esc_html( $member_name ?: $current_user->user_login ); ?></span>
            </span>
            <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </button>
          <div id="member-menu-panel" class="hidden absolute right-0 top-full mt-3 w-72 rounded-2xl border border-gray-100 bg-white p-3 shadow-xl">
            <div class="rounded-2xl px-4 py-3 text-white" style="background:linear-gradient(135deg,#13357a,#1d4ed8);">
              <p class="text-xs text-blue-100">เข้าสู่ระบบแล้ว</p>
              <p class="mt-1 font-bold text-base truncate"><?php echo esc_html( $member_name ?: $current_user->user_login ); ?></p>
              <p class="text-xs text-blue-100 truncate"><?php echo esc_html( $current_user->user_email ); ?></p>
            </div>
            <div class="mt-3 space-y-1 text-sm">
              <a href="<?php echo esc_url( home_url( '/my-listings/' ) ); ?>" class="flex items-center justify-between rounded-xl px-4 py-3 font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                <span>ประกาศของฉัน</span>
                <span class="text-xs text-gray-400">ดูย้อนหลัง</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/profile/' ) ); ?>" class="flex items-center justify-between rounded-xl px-4 py-3 font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                <span>ข้อมูลส่วนตัว</span>
                <span class="text-xs text-gray-400">แก้ไขบัญชี</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>" class="flex items-center justify-between rounded-xl px-4 py-3 font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                <span>ลงประกาศใหม่</span>
                <span class="text-xs text-gray-400">เริ่มโพสต์</span>
              </a>
            </div>
            <div class="mt-3 border-t border-gray-100 pt-3">
              <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="block rounded-xl px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">ออกจากระบบ</a>
            </div>
          </div>
        </div>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">เข้าสู่ระบบ</a>
        <a href="<?php echo esc_url( home_url( '/register/' ) ); ?>" class="px-4 py-2 rounded-full text-sm font-semibold text-white hover:opacity-90 transition-opacity" style="background:#1d4ed8;">สมัครสมาชิก</a>
      <?php endif; ?>
      <button id="hamburger-btn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors" aria-label="เปิดเมนู" aria-expanded="false" aria-controls="mobile-menu">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <line x1="3" y1="6"  x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>
    </div>
  </div>

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
    <?php if ( is_user_logged_in() ) : ?>
      <div class="mt-3 rounded-2xl border border-gray-100 bg-gray-50 p-3">
        <p class="text-xs text-gray-400">สมาชิก</p>
        <p class="font-bold text-gray-800 truncate"><?php echo esc_html( $member_name ?: $current_user->user_login ); ?></p>
        <div class="mt-3 grid grid-cols-1 gap-2">
          <a href="<?php echo esc_url( home_url( '/my-listings/' ) ); ?>" class="block rounded-xl bg-white px-4 py-3 text-gray-700">ประกาศของฉัน</a>
          <a href="<?php echo esc_url( home_url( '/profile/' ) ); ?>" class="block rounded-xl bg-white px-4 py-3 text-gray-700">ข้อมูลส่วนตัว</a>
          <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>" class="block rounded-xl bg-white px-4 py-3 text-gray-700">ลงประกาศใหม่</a>
          <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="block rounded-xl bg-red-50 px-4 py-3 text-red-600">ออกจากระบบ</a>
        </div>
      </div>
    <?php endif; ?>
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
