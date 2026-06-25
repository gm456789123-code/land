<?php
/**
 * Template Name: ดูล่าสุด
 * Template Post Type: page
 */
get_header();

$listings = [
  [ 'img' => 'photo-1560518883-ce09059eeffa', 'loc' => 'เชียงใหม่', 'title' => 'Townhome in Chiang Mai',        'size' => '2 ไร่',    'com' => '2,400,000', 'ago' => '10 นาที',  'hot' => true  ],
  [ 'img' => 'photo-1518780664697-55e3ad937233','loc' => 'กรุงเทพฯ', 'title' => 'Office Unit Silom',             'size' => '150 ตร.ว.','com' => '850,000',   'ago' => '32 นาที',  'hot' => false ],
  [ 'img' => 'photo-1416879595882-3373a0480b5b','loc' => 'ภูเก็ต',  'title' => 'Pool Villa Phuket Seaview',     'size' => '5 ไร่',    'com' => '4,000,000', 'ago' => '1 ชั่วโมง','hot' => true  ],
  [ 'img' => 'photo-1500382017468-9049fed747ef', 'loc' => 'ระยอง',   'title' => 'Industrial Land EEC Zone',      'size' => '80 ไร่',   'com' => '8,000,000', 'ago' => '2 ชั่วโมง','hot' => true  ],
  [ 'img' => 'photo-1464822759023-fed622ff2c3b', 'loc' => 'เชียงราย','title' => 'Agricultural Land North',       'size' => '30 ไร่',   'com' => '600,000',   'ago' => '3 ชั่วโมง','hot' => false ],
  [ 'img' => 'photo-1586348943529-beaae6c28db9', 'loc' => 'ชลบุรี',  'title' => 'Warehouse Land Laem Chabang',   'size' => '40 ไร่',   'com' => '3,200,000', 'ago' => '5 ชั่วโมง','hot' => false ],
  [ 'img' => 'photo-1505843513577-22bb7d21e455', 'loc' => 'สมุทรปราการ','title' => 'Data Center Site Bang Na',  'size' => '60 ไร่',   'com' => '6,000,000', 'ago' => '7 ชั่วโมง','hot' => true  ],
  [ 'img' => 'photo-1558618666-fcd25c85cd64', 'loc' => 'นครราชสีมา','title' => 'Commercial Land Korat',          'size' => '10 ไร่',   'com' => '1,500,000', 'ago' => '1 วัน',    'hot' => false ],
  [ 'img' => 'photo-1441974231531-c6227db76b6e', 'loc' => 'ขอนแก่น', 'title' => 'Resort Land Khao Yai Area',    'size' => '25 ไร่',   'com' => '2,000,000', 'ago' => '1 วัน',    'hot' => false ],
];
?>

<!-- Page Hero -->
<div class="w-full py-10" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-7xl mx-auto px-4 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-3xl font-extrabold text-white">ที่ดินล่าสุด</h1>
      <p class="text-blue-200 mt-1 text-sm">อัปเดตทุกวัน — รีบเป็นคนแรกที่แนะนำ Buyer</p>
    </div>
    <div class="flex items-center gap-2 text-sm">
      <span class="px-3 py-1 rounded-full bg-white/20 text-white font-medium">ทั้งหมด <?php echo count( $listings ); ?> รายการ</span>
      <span class="px-3 py-1 rounded-full font-bold text-white" style="background:#1aa260;">
        🔥 ร้อนแรง <?php echo count( array_filter( $listings, fn( $l ) => $l['hot'] ) ); ?> รายการ
      </span>
    </div>
  </div>
</div>

<!-- Sort bar -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 mt-6 flex items-center gap-3 flex-wrap">
  <span class="text-xs font-semibold text-gray-500">เรียงโดย:</span>
  <a href="?sort=newest" class="px-3 py-1.5 rounded-full text-xs font-semibold text-white" style="background:#13357a;">ล่าสุด</a>
  <a href="?sort=com_high" class="px-3 py-1.5 rounded-full text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">ค่าคอมสูงสุด</a>
  <a href="?sort=size_big" class="px-3 py-1.5 rounded-full text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">ขนาดใหญ่สุด</a>
  <a href="?sort=hot" class="px-3 py-1.5 rounded-full text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">🔥 ร้อนแรง</a>
</div>

<!-- Listings grid -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 mt-5 mb-16">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ( $listings as $item ) : ?>
      <article class="rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/<?php echo esc_attr( $item['img'] ); ?>?w=600&h=400&fit=crop&auto=format"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
               alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
          <!-- badges -->
          <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background:#1aa260;">
            <?php echo esc_html( $item['loc'] ); ?>
          </span>
          <?php if ( $item['hot'] ) : ?>
            <span class="absolute top-3 right-3 px-2 py-1 rounded-full text-xs font-bold text-white" style="background:#ef4444;">🔥 ร้อนแรง</span>
          <?php endif; ?>
          <!-- time badge -->
          <span class="absolute bottom-3 right-3 px-2 py-1 rounded-full text-xs text-gray-600 bg-white/90 font-medium">
            <?php echo esc_html( $item['ago'] ); ?>ที่แล้ว
          </span>
        </div>
        <div class="p-4">
          <p class="font-semibold leading-snug"><?php echo esc_html( $item['title'] ); ?></p>
          <p class="text-xs text-gray-400 mt-1">ขนาด: <?php echo esc_html( $item['size'] ); ?></p>
          <div class="mt-3 flex items-end justify-between">
            <div>
              <p class="text-xs text-gray-400">ค่าคอมสูงสุด</p>
              <p class="text-xl font-extrabold" style="color:#1d4ed8;">
                <?php echo esc_html( $item['com'] ); ?> <span class="text-sm font-semibold">บาท</span>
              </p>
            </div>
            <a href="<?php echo esc_url( home_url( '/search/' ) ); ?>"
               class="px-4 py-2 rounded-lg text-xs font-bold text-white hover:opacity-90 transition-opacity"
               style="background:#1aa260;">
              แนะนำเลย
            </a>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <!-- Load more -->
  <div class="mt-10 text-center">
    <button class="px-8 py-3 rounded-full border-2 font-bold text-sm hover:text-white hover:border-blue-700 transition-colors" style="border-color:#1d4ed8; color:#1d4ed8;"
            onclick="this.textContent='กำลังโหลด…'; this.disabled=true;">
      โหลดเพิ่มเติม
    </button>
  </div>
</div>

<?php get_footer(); ?>
