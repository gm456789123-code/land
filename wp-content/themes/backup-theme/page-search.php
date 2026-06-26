<?php
/**
 * Template Name: ค้นหาที่ดิน
 * Template Post Type: page
 */
get_header();

$provinces = [ 'กรุงเทพฯ', 'เชียงใหม่', 'ภูเก็ต', 'ชลบุรี', 'ระยอง', 'สมุทรปราการ', 'อยุธยา', 'นครราชสีมา', 'ขอนแก่น', 'สุราษฎร์ธานี', 'เชียงราย', 'นครปฐม' ];
$types     = [ 'ที่ดินเปล่า', 'ที่ดินพร้อมสิ่งปลูกสร้าง', 'ที่ดินอุตสาหกรรม', 'ที่ดินเกษตร', 'ที่ดินเชิงพาณิชย์' ];

$all_listings = [
  [ 'img' => 'photo-1560518883-ce09059eeffa', 'loc' => 'เชียงใหม่',     'title' => 'Townhome in Chiang Mai',        'size' => '2 ไร่',     'price' => 24000000,  'com' => 2400000,  'type' => 'ที่ดินพร้อมสิ่งปลูกสร้าง', 'doc' => 'โฉนด',    'hot' => true  ],
  [ 'img' => 'photo-1518780664697-55e3ad937233','loc' => 'กรุงเทพฯ',    'title' => 'Office Unit Silom',             'size' => '150 ตร.ว.', 'price' => 8500000,   'com' => 850000,   'type' => 'ที่ดินเชิงพาณิชย์',          'doc' => 'โฉนด',    'hot' => false ],
  [ 'img' => 'photo-1416879595882-3373a0480b5b','loc' => 'ภูเก็ต',      'title' => 'Pool Villa Phuket Seaview',     'size' => '5 ไร่',     'price' => 80000000,  'com' => 4000000,  'type' => 'ที่ดินพร้อมสิ่งปลูกสร้าง', 'doc' => 'โฉนด',    'hot' => true  ],
  [ 'img' => 'photo-1500382017468-9049fed747ef', 'loc' => 'ระยอง',      'title' => 'Industrial Land EEC Zone',      'size' => '80 ไร่',    'price' => 160000000, 'com' => 8000000,  'type' => 'ที่ดินอุตสาหกรรม',           'doc' => 'โฉนด',    'hot' => true  ],
  [ 'img' => 'photo-1464822759023-fed622ff2c3b', 'loc' => 'เชียงราย',   'title' => 'Agricultural Land North',       'size' => '30 ไร่',    'price' => 6000000,   'com' => 600000,   'type' => 'ที่ดินเกษตร',                 'doc' => 'น.ส.3 ก.','hot' => false ],
  [ 'img' => 'photo-1586348943529-beaae6c28db9', 'loc' => 'ชลบุรี',    'title' => 'Warehouse Land Laem Chabang',   'size' => '40 ไร่',    'price' => 64000000,  'com' => 3200000,  'type' => 'ที่ดินอุตสาหกรรม',           'doc' => 'โฉนด',    'hot' => false ],
  [ 'img' => 'photo-1505843513577-22bb7d21e455', 'loc' => 'สมุทรปราการ','title' => 'Data Center Site Bang Na',      'size' => '60 ไร่',    'price' => 120000000, 'com' => 6000000,  'type' => 'ที่ดินเชิงพาณิชย์',          'doc' => 'โฉนด',    'hot' => true  ],
  [ 'img' => 'photo-1558618666-fcd25c85cd64', 'loc' => 'นครราชสีมา',   'title' => 'Commercial Land Korat',         'size' => '10 ไร่',    'price' => 15000000,  'com' => 1500000,  'type' => 'ที่ดินเชิงพาณิชย์',          'doc' => 'โฉนด',    'hot' => false ],
  [ 'img' => 'photo-1441974231531-c6227db76b6e', 'loc' => 'ขอนแก่น',   'title' => 'Resort Land Khao Yai Area',     'size' => '25 ไร่',    'price' => 20000000,  'com' => 2000000,  'type' => 'ที่ดินเกษตร',                 'doc' => 'น.ส.3',   'hot' => false ],
  [ 'img' => 'photo-1500534314209-a25ddb2bd429', 'loc' => 'อยุธยา',    'title' => 'Factory Land Bang Pa-in',       'size' => '120 ไร่',   'price' => 240000000, 'com' => 12000000, 'type' => 'ที่ดินอุตสาหกรรม',           'doc' => 'โฉนด',    'hot' => true  ],
  [ 'img' => 'photo-1464938050520-ef2270bb8ce8', 'loc' => 'นครปฐม',    'title' => 'Orchard Land Nakhon Pathom',    'size' => '15 ไร่',    'price' => 7500000,   'com' => 750000,   'type' => 'ที่ดินเกษตร',                 'doc' => 'น.ส.3 ก.','hot' => false ],
  [ 'img' => 'photo-1569954262813-b6b4f33a5f55', 'loc' => 'สุราษฎร์ธานี','title' => 'Beachfront Land Samui',      'size' => '3 ไร่',     'price' => 45000000,  'com' => 4500000,  'type' => 'ที่ดินเปล่า',                 'doc' => 'โฉนด',    'hot' => true  ],
];

$sel_province = isset( $_GET['province'] ) ? sanitize_text_field( $_GET['province'] ) : '';
$sel_type     = isset( $_GET['type'] )     ? sanitize_text_field( $_GET['type'] )     : '';
$sel_min      = isset( $_GET['min'] )      ? (int) $_GET['min']                       : '';
$sel_max      = isset( $_GET['max'] )      ? (int) $_GET['max']                       : '';
$sel_sort     = isset( $_GET['sort'] )     ? sanitize_text_field( $_GET['sort'] )     : 'com_high';

// Filter
$listings = array_filter( $all_listings, function( $item ) use ( $sel_province, $sel_type, $sel_min, $sel_max ) {
  if ( $sel_province && $item['loc'] !== $sel_province ) return false;
  if ( $sel_type     && $item['type'] !== $sel_type )    return false;
  if ( $sel_min !== '' && $item['com'] < $sel_min )      return false;
  if ( $sel_max !== '' && $item['com'] > $sel_max )      return false;
  return true;
} );

// Sort
usort( $listings, function( $a, $b ) use ( $sel_sort ) {
  if ( $sel_sort === 'com_high' ) return $b['com'] - $a['com'];
  if ( $sel_sort === 'com_low'  ) return $a['com'] - $b['com'];
  if ( $sel_sort === 'price_high') return $b['price'] - $a['price'];
  if ( $sel_sort === 'hot' )      return (int) $b['hot'] - (int) $a['hot'];
  return 0;
} );

function fmt_com( $num ) {
  if ( $num >= 1000000 ) return number_format( $num / 1000000, 1 ) . ' ล้าน';
  return number_format( $num ) ;
}
?>

<!-- Page Hero -->
<div class="w-full py-10" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-7xl mx-auto px-4 lg:px-8">
    <h1 class="text-3xl font-extrabold text-white">ค้นหาที่ดิน</h1>
    <p class="text-blue-200 mt-1 text-sm">พบที่ดินกว่า <?php echo count( $all_listings ); ?> แปลงทั่วประเทศ พร้อมรับค่าคอมได้ทันที</p>
  </div>
</div>

<!-- Filter Card -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-5 relative z-10 mb-6">
  <form method="GET" action="" class="bg-white rounded-2xl shadow-lg p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">จังหวัด</label>
      <select name="province" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">ทุกจังหวัด</option>
        <?php foreach ( $provinces as $p ) : ?>
          <option value="<?php echo esc_attr( $p ); ?>" <?php selected( $sel_province, $p ); ?>><?php echo esc_html( $p ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">ประเภทที่ดิน</label>
      <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">ทุกประเภท</option>
        <?php foreach ( $types as $tp ) : ?>
          <option value="<?php echo esc_attr( $tp ); ?>" <?php selected( $sel_type, $tp ); ?>><?php echo esc_html( $tp ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">ค่าคอมขั้นต่ำ (บาท)</label>
      <input type="number" name="min" placeholder="500,000" value="<?php echo esc_attr( $sel_min ?: '' ); ?>"
             class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">ค่าคอมสูงสุด (บาท)</label>
      <input type="number" name="max" placeholder="10,000,000" value="<?php echo esc_attr( $sel_max ?: '' ); ?>"
             class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="flex flex-col gap-2">
      <button type="submit" class="w-full py-2.5 rounded-lg font-bold text-white text-sm hover:opacity-90 transition-opacity" style="background:#1d4ed8;">
        ค้นหา
      </button>
      <?php if ( $sel_province || $sel_type || $sel_min || $sel_max ) : ?>
        <a href="<?php echo esc_url( home_url( '/search/' ) ); ?>" class="w-full py-2 rounded-lg font-semibold text-gray-500 text-sm text-center border border-gray-200 hover:bg-gray-50 transition-colors">
          ล้างตัวกรอง
        </a>
      <?php endif; ?>
    </div>

  </form>
</div>

<!-- Sort + Result count bar -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 mb-5 flex flex-wrap items-center justify-between gap-3">
  <p class="text-sm text-gray-500">
    <?php if ( count( $listings ) === count( $all_listings ) ) : ?>
      แสดง <span class="font-semibold text-gray-700"><?php echo count( $listings ); ?></span> รายการ
    <?php else : ?>
      พบ <span class="font-semibold text-gray-700"><?php echo count( $listings ); ?></span> รายการ จากทั้งหมด <?php echo count( $all_listings ); ?> รายการ
    <?php endif; ?>
  </p>
  <div class="flex items-center gap-2 text-xs font-semibold flex-wrap">
    <span class="text-gray-400">เรียงโดย:</span>
    <?php
    $sorts = [ 'com_high' => 'ค่าคอมสูงสุด', 'com_low' => 'ค่าคอมต่ำสุด', 'price_high' => 'ราคาสูงสุด', 'hot' => '🔥 ร้อนแรง' ];
    foreach ( $sorts as $val => $label ) :
      $active = $sel_sort === $val;
      $params = array_filter( [ 'province' => $sel_province, 'type' => $sel_type, 'min' => $sel_min ?: '', 'max' => $sel_max ?: '', 'sort' => $val ] );
      $url = esc_url( home_url( '/search/?' . http_build_query( $params ) ) );
    ?>
      <a href="<?php echo $url; ?>"
         class="px-3 py-1.5 rounded-full transition-colors <?php echo $active ? 'text-white' : 'text-gray-600 bg-gray-100 hover:bg-gray-200'; ?>"
         <?php if ( $active ) echo 'style="background:#13357a;"'; ?>>
        <?php echo esc_html( $label ); ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Results -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 mb-16">
  <?php if ( empty( $listings ) ) : ?>
    <div class="text-center py-20">
      <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="10.5" cy="10.5" r="6.5"/><line x1="15.5" y1="15.5" x2="21" y2="21"/></svg>
      <p class="font-semibold text-gray-500">ไม่พบที่ดินที่ตรงกับเงื่อนไข</p>
      <a href="<?php echo esc_url( home_url( '/search/' ) ); ?>" class="mt-4 inline-block text-sm font-semibold hover:underline" style="color:#1d4ed8;">ล้างตัวกรองแล้วลองใหม่</a>
    </div>
  <?php else : ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $listings as $item ) : ?>
        <article class="rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
          <div class="relative h-48 overflow-hidden">
            <img src="https://images.unsplash.com/<?php echo esc_attr( $item['img'] ); ?>?w=600&h=400&fit=crop&auto=format"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                 alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background:#1aa260;">
              <?php echo esc_html( $item['loc'] ); ?>
            </span>
            <?php if ( $item['hot'] ) : ?>
              <span class="absolute top-3 right-3 px-2 py-1 rounded-full text-xs font-bold text-white" style="background:#ef4444;">🔥 ร้อนแรง</span>
            <?php endif; ?>
            <span class="absolute bottom-3 right-3 px-2 py-1 rounded-full text-xs text-gray-600 bg-white/90 font-medium">
              <?php echo esc_html( $item['doc'] ); ?>
            </span>
          </div>
          <div class="p-4">
            <p class="text-xs font-medium text-gray-400 mb-1"><?php echo esc_html( $item['type'] ); ?></p>
            <p class="font-semibold leading-snug"><?php echo esc_html( $item['title'] ); ?></p>
            <p class="text-xs text-gray-400 mt-1">ขนาด: <?php echo esc_html( $item['size'] ); ?></p>
            <div class="mt-4 flex items-end justify-between">
              <div>
                <p class="text-xs text-gray-400">ค่าคอมสูงสุด</p>
                <p class="text-xl font-extrabold" style="color:#1d4ed8;">
                  <?php echo esc_html( fmt_com( $item['com'] ) ); ?> <span class="text-sm font-semibold">บาท</span>
                </p>
              </div>
              <a href="#"
                 class="px-4 py-2 rounded-lg text-xs font-bold text-white hover:opacity-90 transition-opacity"
                 style="background:#1aa260;">
                ดูรายละเอียด
              </a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
