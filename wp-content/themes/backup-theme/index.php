<?php get_header(); ?>

<!-- ===== HERO ===== -->
<section class="relative">
  <div class="relative h-[420px] md:h-[480px] overflow-hidden bg-gray-300">
    <img
      src="https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?w=1600&h=700&fit=crop&auto=format"
      alt="พื้นที่ที่ดินทั่วไทย"
      class="w-full h-full object-cover"
      loading="eager"
    >
    <div class="absolute inset-0 hero-gradient"></div>
    <div class="absolute inset-0 max-w-7xl mx-auto px-4 lg:px-8 flex items-center">
      <div class="max-w-xl text-white drop-shadow">
        <p class="text-2xl md:text-3xl font-bold">เปลี่ยนความรู้ เป็นรายได้</p>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mt-1">อาชีพเสริม</h1>
        <a href="#join" class="inline-block mt-5 px-6 py-3 rounded-lg font-bold text-white hover:opacity-90 transition-opacity" style="background:#1aa260;">
          สร้างรายได้ไปกับที่ดิน
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ===== FEATURE STRIP ===== -->
<section class="max-w-7xl mx-auto px-4 lg:px-8 -mt-8 relative z-10">
  <div class="bg-white rounded-2xl shadow-lg grid grid-cols-2 md:grid-cols-5 gap-4 p-5">
    <div class="flex items-center gap-3">
      <span class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background:#e8eefc; color:#1d4ed8;">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="8"/><line x1="9" y1="12" x2="15" y2="12"/></svg>
      </span>
      <div><p class="font-semibold text-sm leading-tight">ไม่ต้องลงทุน</p><p class="text-xs text-gray-500">ไม่ต้องสต็อก</p></div>
    </div>
    <div class="flex items-center gap-3">
      <span class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background:#e8eefc; color:#1d4ed8;">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="20" x2="5" y2="12"/><line x1="12" y1="20" x2="12" y2="6"/><line x1="19" y1="20" x2="19" y2="15"/></svg>
      </span>
      <div><p class="font-semibold text-sm leading-tight">มีระบบทีมงาน</p><p class="text-xs text-gray-500">สนับสนุน</p></div>
    </div>
    <div class="flex items-center gap-3">
      <span class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background:#e8eefc; color:#1d4ed8;">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="7" y="3" width="10" height="18" rx="2"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
      </span>
      <div><p class="font-semibold text-sm leading-tight">ใช้งานง่าย</p><p class="text-xs text-gray-500">ผ่านออนไลน์</p></div>
    </div>
    <div class="flex items-center gap-3">
      <span class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background:#e8eefc; color:#1d4ed8;">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3,17 9,11 13,15 21,7"/><polyline points="15,7 21,7 21,13"/></svg>
      </span>
      <div><p class="font-semibold text-sm leading-tight">รายได้ไม่จำกัด</p><p class="text-xs text-gray-500">ช่วยแนะนำ ยิ่งได้</p></div>
    </div>
    <div class="flex items-center gap-3 col-span-2 md:col-span-1">
      <span class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background:#e8eefc; color:#1d4ed8;">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/></svg>
      </span>
      <div><p class="font-semibold text-sm leading-tight">เหมาะสำหรับทุกคน</p><p class="text-xs text-gray-500">ที่อยากมีรายได้เพิ่ม</p></div>
    </div>
  </div>
</section>

<!-- ===== STATS BAR ===== -->
<?php
$stat_members  = count_users()['total_users'];
$stat_listings = wp_count_posts( 'land_listing' )->publish ?? 0;
$stat_deals    = (int) get_option( 'land_stat_deals', 84 );
$stat_value    = get_option( 'land_stat_value', '42.6' );
?>
<section class="max-w-7xl mx-auto px-4 lg:px-8 mt-6">
  <div class="stat-gradient rounded-2xl text-white grid grid-cols-2 md:grid-cols-4 divide-x divide-white/20 overflow-hidden">
    <div class="p-6">
      <p class="text-3xl font-extrabold"><?php echo number_format( $stat_members ); ?>+ <span class="text-base font-semibold">คน</span></p>
      <p class="text-sm text-white/80 mt-1">สมาชิกในเครือข่าย เติบโตต่อเนื่อง</p>
    </div>
    <div class="p-6">
      <p class="text-3xl font-extrabold"><?php echo number_format( $stat_listings ); ?>+ <span class="text-base font-semibold">แปลง</span></p>
      <p class="text-sm text-white/80 mt-1">ที่ดินในระบบ อัปเดตทุกวัน</p>
    </div>
    <div class="p-6">
      <p class="text-3xl font-extrabold"><?php echo number_format( $stat_deals ); ?>+ <span class="text-base font-semibold">ดีล</span></p>
      <p class="text-sm text-white/80 mt-1">ดีลที่จับคู่แล้ว จ่ายจริงต่อเนื่อง</p>
    </div>
    <div class="p-6">
      <p class="text-3xl font-extrabold"><?php echo esc_html( $stat_value ); ?> <span class="text-base font-semibold">ล้านบาท</span></p>
      <p class="text-sm text-white/80 mt-1">มูลค่าดีลรวมของผู้แนะนำ</p>
    </div>
  </div>
</section>

<!-- ===== FEATURED PROPERTIES ===== -->
<?php
$featured = get_posts( [
    'post_type'      => 'land_listing',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
?>
<section class="max-w-7xl mx-auto px-4 lg:px-8 mt-12">
  <div class="flex items-center justify-between mb-5">
    <h2 class="text-2xl font-extrabold" style="color:#13357a;">ที่ดินแนะนำ อัปเดตทุกวัน</h2>
    <a href="<?php echo esc_url( home_url( '/latest/' ) ); ?>" class="text-sm font-semibold hover:underline" style="color:#1d4ed8;">ดูทั้งหมด →</a>
  </div>

  <?php if ( $featured ) : ?>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php foreach ( $featured as $p ) :
      $province = get_post_meta( $p->ID, '_land_province', true );
      $price    = get_post_meta( $p->ID, '_land_price',    true );
      $type     = get_post_meta( $p->ID, '_land_type',     true );
      $size     = get_post_meta( $p->ID, '_land_size',     true );
      $thumb    = get_the_post_thumbnail_url( $p->ID, 'large' );
      $url      = get_permalink( $p->ID );
    ?>
    <article class="rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
      <a href="<?php echo esc_url( $url ); ?>" class="block">
        <div class="relative h-44 bg-gray-100">
          <?php if ( $thumb ) : ?>
            <img src="<?php echo esc_url( $thumb ); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr( $p->post_title ); ?>" loading="lazy">
          <?php else : ?>
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-10 h-10 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            </div>
          <?php endif; ?>
          <?php if ( $province ) : ?>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background:#1aa260;"><?php echo esc_html( $province ); ?></span>
          <?php endif; ?>
        </div>
        <div class="p-4">
          <?php if ( $price ) : ?>
            <p class="text-xs text-gray-400">ราคาขาย</p>
            <p class="text-2xl font-extrabold" style="color:#1d4ed8;">฿<?php echo number_format( $price ); ?></p>
          <?php endif; ?>
          <p class="font-semibold mt-2 text-gray-800 line-clamp-1"><?php echo esc_html( $p->post_title ); ?></p>
          <div class="flex flex-wrap gap-2 mt-2">
            <?php if ( $type ) echo '<span class="text-xs px-2 py-0.5 rounded-full bg-blue-50 text-blue-700">' . esc_html( $type ) . '</span>'; ?>
            <?php if ( $size ) echo '<span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">' . esc_html( $size ) . '</span>'; ?>
          </div>
        </div>
      </a>
    </article>
    <?php endforeach; ?>
  </div>

  <?php else : ?>
  <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-200">
    <p class="text-gray-400 text-sm">ยังไม่มีประกาศที่ดิน</p>
    <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>"
       class="inline-block mt-3 px-5 py-2.5 rounded-xl text-sm font-bold text-white hover:opacity-90 transition-opacity"
       style="background:#1d4ed8;">เป็นคนแรกที่ลงประกาศ</a>
  </div>
  <?php endif; ?>
</section>

<!-- ===== STEPS + WHO ===== -->
<section class="max-w-7xl mx-auto px-4 lg:px-8 mt-12 grid grid-cols-1 lg:grid-cols-2 gap-6">
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="font-extrabold text-lg mb-5" style="color:#13357a;">3 ขั้นตอนง่ายๆ เริ่มต้นสร้างรายได้</h3>
    <div class="grid grid-cols-3 gap-3 text-center">
      <div><span class="w-12 h-12 mx-auto rounded-full flex items-center justify-center font-bold text-white mb-2" style="background:#1d4ed8;">1</span><p class="font-semibold text-sm">สมัคร</p><p class="text-xs text-gray-500">เข้าร่วมฟรี</p></div>
      <div><span class="w-12 h-12 mx-auto rounded-full flex items-center justify-center font-bold text-white mb-2" style="background:#1d4ed8;">2</span><p class="font-semibold text-sm">แนะนำที่ดิน</p><p class="text-xs text-gray-500">จากแพลตฟอร์ม</p></div>
      <div><span class="w-12 h-12 mx-auto rounded-full flex items-center justify-center font-bold text-white mb-2" style="background:#1d4ed8;">3</span><p class="font-semibold text-sm">จับดีล</p><p class="text-xs text-gray-500">รับค่าคอมทันที</p></div>
    </div>
  </div>
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="font-extrabold text-lg mb-5" style="color:#13357a;">ใครๆ ก็สามารถสร้างรายได้จากที่ดิน</h3>
    <div class="grid grid-cols-3 sm:grid-cols-6 gap-4 text-center">
      <div><svg class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.5"/><path d="M5 20c0-3.5 3-6 7-6s7 2.5 7 6"/></svg><p class="text-xs mt-1 font-medium">คนรู้จักเจ้าของที่</p></div>
      <div><svg class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s-7-7.2-7-12a7 7 0 0114 0c0 4.8-7 12-7 12z"/><circle cx="12" cy="9" r="2.3"/></svg><p class="text-xs mt-1 font-medium">คนในพื้นที่รู้จักที่ดิน</p></div>
      <div><svg class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="1.8" aria-hidden="true"><circle cx="9" cy="12" r="4"/><circle cx="15" cy="12" r="4"/></svg><p class="text-xs mt-1 font-medium">ผู้รับเหมา/วิศวกร</p></div>
      <div><svg class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3,17 9,11 13,15 21,7"/><polyline points="15,7 21,7 21,13"/></svg><p class="text-xs mt-1 font-medium">นักลงทุน</p></div>
      <div><svg class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="8" width="18" height="11" rx="2"/><path d="M8 8V6a2 2 0 012-2h4a2 2 0 012 2v2"/></svg><p class="text-xs mt-1 font-medium">พนักงานบริษัท</p></div>
      <div><svg class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11l8-7 8 7"/><path d="M6 10v9a1 1 0 001 1h10a1 1 0 001-1v-9"/></svg><p class="text-xs mt-1 font-medium">ฟรีแลนซ์/แม่บ้าน</p></div>
    </div>
  </div>
</section>

<!-- ===== BUYER DEMAND ===== -->
<section class="max-w-7xl mx-auto px-4 lg:px-8 mt-12">
  <div class="flex items-center justify-between mb-5">
    <h2 class="text-2xl font-extrabold" style="color:#13357a;">ความต้องการที่ดิน (Buyer กำลังหา)</h2>
    <a href="<?php echo esc_url( home_url( '/search/' ) ); ?>" class="text-sm font-semibold hover:underline" style="color:#1d4ed8;">ดูทั้งหมด →</a>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4"><p class="text-xs font-semibold mb-2" style="color:#1d4ed8;">● ระยอง</p><p class="text-sm">ต้องการที่ดิน 50-100 ไร่ ใกล้นิคมอุตสาหกรรมสำหรับโรงงานผลิต</p><p class="text-xs text-gray-400 mt-3">อัปเดต 2 ชม. ที่แล้ว</p></div>
    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4"><p class="text-xs font-semibold mb-2" style="color:#1d4ed8;">● ชลบุรี</p><p class="text-sm">ต้องการที่ดิน 20-50 ไร่ ใกล้ท่าเรือแหลมฉบังสำหรับคลังสินค้า</p><p class="text-xs text-gray-400 mt-3">อัปเดต 4 ชม. ที่แล้ว</p></div>
    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4"><p class="text-xs font-semibold mb-2" style="color:#1d4ed8;">● สมุทรปราการ</p><p class="text-sm">ต้องการที่ดิน 30-80 ไร่ บางนา-เทพารักษ์ สำหรับ Data Center</p><p class="text-xs text-gray-400 mt-3">อัปเดต 1 วัน ที่แล้ว</p></div>
    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4"><p class="text-xs font-semibold mb-2" style="color:#1d4ed8;">● อยุธยา</p><p class="text-sm">ต้องการที่ดิน 100+ ไร่ ใกล้นิคมบางปะอินสำหรับโรงงาน</p><p class="text-xs text-gray-400 mt-3">อัปเดต 1 วัน ที่แล้ว</p></div>
    <div class="rounded-xl p-5 text-white flex flex-col justify-between" style="background:#13357a;">
      <div><p class="font-extrabold text-lg leading-snug">ส่งที่ดินของคุณ</p><p class="text-xs text-blue-100 mt-2">ให้ตรงกับความต้องการ เพื่อโอกาสปิดดีลไว</p></div>
      <a href="<?php echo esc_url( is_user_logged_in() ? home_url( '/post-listing/' ) : home_url( '/register/' ) ); ?>" class="mt-4 block w-full py-2 rounded-lg font-semibold text-sm text-center text-white hover:opacity-90 transition-opacity" style="background:#1aa260;">ส่งข้อมูลที่ดินเลย</a>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="max-w-7xl mx-auto px-4 lg:px-8 mt-12">
  <div class="flex items-center justify-between mb-5">
    <h2 class="text-2xl font-extrabold" style="color:#13357a;">เสียงจากผู้แนะนำที่ดินของเรา (ได้รับค่าตอบแทนจริง)</h2>
  </div>
  <div class="flex gap-5 overflow-x-auto scrollbar-none pb-2">
    <?php
    $testimonials = [
      [ 'img' => '12', 'name' => 'คุณสมชาย ว.',    'amount' => '2,400,000', 'text' => 'แนะนำที่ดินผืนแรก ได้รับค่าตอบแทนจริง 2.4 ล้านบาท' ],
      [ 'img' => '47', 'name' => 'คุณสุวรรณา ก.',   'amount' => '850,000',   'text' => 'ส่งข้อมูลที่ดินเพียงไม่กี่แปลง ก็ได้รับค่าตอบแทนทันที' ],
      [ 'img' => '33', 'name' => 'คุณวฤพล อ.',     'amount' => '4,000,000', 'text' => 'ได้ค่าตอบแทนจากดีลใหญ่ 4 ล้านบาท ภายในไม่กี่เดือน' ],
      [ 'img' => '53', 'name' => 'คุณชาติชัย ร.',   'amount' => '1,200,000', 'text' => 'รายได้เสริมที่ทำหลังเลิกงาน และรับจริงอย่างต่อเนื่อง' ],
    ];
    foreach ( $testimonials as $t ) : ?>
      <article class="min-w-[260px] rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 shrink-0">
        <div class="relative h-48">
          <img src="https://i.pravatar.cc/300?img=<?php echo esc_attr( $t['img'] ); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr( $t['name'] ); ?>" loading="lazy">
          <div class="absolute bottom-0 left-0 right-0 bg-white/95 p-2 m-2 rounded-lg">
            <p class="text-[11px] text-gray-500">ตลาดที่ดินไทย.com ขอบคุณให้คุณ</p>
            <p class="text-sm font-bold" style="color:#13357a;"><?php echo esc_html( $t['name'] ); ?></p>
            <p class="text-xs" style="color:#1aa260;">ได้รับค่าตอบแทน <?php echo esc_html( $t['amount'] ); ?> บาท</p>
          </div>
        </div>
        <div class="p-4">
          <p class="text-sm text-gray-600"><?php echo esc_html( $t['text'] ); ?></p>
          <p class="font-extrabold mt-2" style="color:#1d4ed8;"><?php echo esc_html( $t['amount'] ); ?> บาท</p>
          <span class="inline-flex items-center gap-1 text-xs text-green-600 mt-1">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="4,12 9,17 20,6"/></svg>
            ได้รับค่าตอบแทนแล้ว
          </span>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section id="join" class="max-w-7xl mx-auto px-4 lg:px-8 mt-12">
  <div class="rounded-2xl text-white p-6 flex flex-col md:flex-row items-center justify-between gap-6" style="background:#13357a;">
    <div>
      <p class="text-lg md:text-xl font-extrabold">รู้จักที่ดินดี อย่าปล่อย Connection ให้เสียเปล่า</p>
      <p class="text-sm text-blue-100 mt-1">มาร่วมสร้างรายได้ไปกับตลาดที่ดินไทย.com</p>
    </div>
    <div class="flex items-center gap-5 shrink-0">
      <?php if ( is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>" class="px-6 py-3 rounded-lg font-bold text-white text-center hover:opacity-90 transition-opacity" style="background:#1aa260;">
          ลงประกาศเลย<br><span class="text-xs font-normal">ฟรีไม่มีค่าใช้จ่าย</span>
        </a>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/register/' ) ); ?>" class="px-6 py-3 rounded-lg font-bold text-white text-center hover:opacity-90 transition-opacity" style="background:#1aa260;">
          เข้าร่วมฟรีทันที<br><span class="text-xs font-normal">ไม่มีค่าใช้จ่าย</span>
        </a>
      <?php endif; ?>
      <div class="hidden sm:flex items-center gap-3">
        <div class="bg-white rounded-lg p-2 w-16 h-16 flex items-center justify-center">
          <svg viewBox="0 0 21 21" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="QR Code LINE">
            <rect x="1" y="1" width="7" height="7" fill="#000"/><rect x="2" y="2" width="5" height="5" fill="#fff"/><rect x="3" y="3" width="3" height="3" fill="#000"/>
            <rect x="13" y="1" width="7" height="7" fill="#000"/><rect x="14" y="2" width="5" height="5" fill="#fff"/><rect x="15" y="3" width="3" height="3" fill="#000"/>
            <rect x="1" y="13" width="7" height="7" fill="#000"/><rect x="2" y="14" width="5" height="5" fill="#fff"/><rect x="3" y="15" width="3" height="3" fill="#000"/>
            <rect x="9" y="1" width="1" height="1" fill="#000"/><rect x="11" y="1" width="1" height="1" fill="#000"/><rect x="9" y="3" width="1" height="1" fill="#000"/><rect x="11" y="3" width="1" height="1" fill="#000"/><rect x="9" y="5" width="1" height="1" fill="#000"/>
            <rect x="1" y="9" width="1" height="1" fill="#000"/><rect x="3" y="9" width="1" height="1" fill="#000"/><rect x="5" y="9" width="1" height="1" fill="#000"/><rect x="7" y="9" width="1" height="1" fill="#000"/><rect x="9" y="9" width="1" height="1" fill="#000"/><rect x="11" y="9" width="1" height="1" fill="#000"/><rect x="13" y="9" width="1" height="1" fill="#000"/><rect x="15" y="9" width="1" height="1" fill="#000"/><rect x="17" y="9" width="1" height="1" fill="#000"/><rect x="19" y="9" width="1" height="1" fill="#000"/>
            <rect x="9" y="11" width="1" height="1" fill="#000"/><rect x="11" y="11" width="1" height="1" fill="#000"/><rect x="13" y="11" width="1" height="1" fill="#000"/>
            <rect x="9" y="13" width="1" height="1" fill="#000"/><rect x="11" y="13" width="1" height="1" fill="#000"/><rect x="13" y="13" width="1" height="1" fill="#000"/>
            <rect x="9" y="15" width="1" height="1" fill="#000"/><rect x="11" y="15" width="1" height="1" fill="#000"/><rect x="9" y="17" width="1" height="1" fill="#000"/><rect x="13" y="17" width="1" height="1" fill="#000"/><rect x="9" y="19" width="1" height="1" fill="#000"/><rect x="11" y="19" width="1" height="1" fill="#000"/>
            <rect x="15" y="11" width="1" height="1" fill="#000"/><rect x="17" y="11" width="1" height="1" fill="#000"/><rect x="19" y="11" width="1" height="1" fill="#000"/><rect x="15" y="13" width="1" height="1" fill="#000"/><rect x="19" y="13" width="1" height="1" fill="#000"/><rect x="17" y="15" width="1" height="1" fill="#000"/><rect x="15" y="17" width="1" height="1" fill="#000"/><rect x="19" y="17" width="1" height="1" fill="#000"/><rect x="15" y="19" width="1" height="1" fill="#000"/><rect x="17" y="19" width="1" height="1" fill="#000"/><rect x="19" y="19" width="1" height="1" fill="#000"/>
          </svg>
        </div>
        <span class="text-xs text-blue-100 max-w-[80px]">สแกนเพิ่มเพื่อนใน LINE Official</span>
      </div>
    </div>
  </div>
</section>

<!-- ===== TRUST BADGES ===== -->
<section class="max-w-7xl mx-auto px-4 lg:px-8 mt-10">
  <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center text-sm">
    <div class="flex flex-col items-center gap-2"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="#1aa260" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l7 3v6c0 4.5-3 8-7 9-4-1-7-4.5-7-9V6l7-3z"/></svg><p class="font-semibold">ปลอดภัย เชื่อถือได้</p></div>
    <div class="flex flex-col items-center gap-2"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="#1aa260" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5"/><line x1="15.5" y1="15.5" x2="21" y2="21"/></svg><p class="font-semibold">ตรวจสอบข้อมูลก่อนเผยแพร่</p></div>
    <div class="flex flex-col items-center gap-2"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="#1aa260" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="8" width="18" height="11" rx="2"/><path d="M8 8V6a2 2 0 012-2h4a2 2 0 012 2v2"/></svg><p class="font-semibold">มีทีมงานมืออาชีพช่วยปิดดีล</p></div>
    <div class="flex flex-col items-center gap-2"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="#1aa260" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 16v-5a6 6 0 10-12 0v5l-2 3h16l-2-3z"/><path d="M9.5 21a2.5 2.5 0 005 0"/></svg><p class="font-semibold">ข้อมูลอัปเดตทุกวัน</p></div>
    <div class="flex flex-col items-center gap-2 col-span-2 md:col-span-1"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="#1aa260" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13,2 4,14 11,14 10,22 20,9 13,9"/></svg><p class="font-semibold">ปิดดีลไว ตรวจสอบได้ 100%</p></div>
  </div>
</section>

<?php get_footer(); ?>
