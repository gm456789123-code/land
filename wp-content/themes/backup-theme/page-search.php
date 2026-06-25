<?php
/**
 * Template Name: ค้นหาที่ดิน
 * Template Post Type: page
 */
get_header();

$provinces = [ 'กรุงเทพฯ', 'เชียงใหม่', 'ภูเก็ต', 'ชลบุรี', 'ระยอง', 'สมุทรปราการ', 'อยุธยา', 'นครราชสีมา', 'ขอนแก่น', 'สุราษฎร์ธานี' ];
$types     = [ 'ที่ดินเปล่า', 'ที่ดินพร้อมสิ่งปลูกสร้าง', 'ที่ดินอุตสาหกรรม', 'ที่ดินเกษตร', 'ที่ดินเชิงพาณิชย์' ];

/* ---- demo results ---- */
$listings = [
  [ 'img' => 'photo-1560518883-ce09059eeffa', 'loc' => 'เชียงใหม่', 'title' => 'Townhome in Chiang Mai',        'size' => '2 ไร่',   'com' => '2,400,000', 'type' => 'ที่ดินพร้อมสิ่งปลูกสร้าง' ],
  [ 'img' => 'photo-1518780664697-55e3ad937233','loc' => 'กรุงเทพฯ', 'title' => 'Office Unit for Rent',          'size' => '150 ตร.ว.','com' => '850,000',   'type' => 'ที่ดินเชิงพาณิชย์' ],
  [ 'img' => 'photo-1416879595882-3373a0480b5b','loc' => 'ภูเก็ต',  'title' => 'Pool Villa Phuket Seaview',     'size' => '5 ไร่',   'com' => '4,000,000', 'type' => 'ที่ดินพร้อมสิ่งปลูกสร้าง' ],
  [ 'img' => 'photo-1500382017468-9049fed747ef', 'loc' => 'ระยอง',   'title' => 'Industrial Land Near EEC',      'size' => '80 ไร่',  'com' => '8,000,000', 'type' => 'ที่ดินอุตสาหกรรม' ],
  [ 'img' => 'photo-1464822759023-fed622ff2c3b', 'loc' => 'เชียงราย','title' => 'Agricultural Land North',       'size' => '30 ไร่',  'com' => '600,000',   'type' => 'ที่ดินเกษตร' ],
  [ 'img' => 'photo-1586348943529-beaae6c28db9', 'loc' => 'ชลบุรี',  'title' => 'Warehouse Land Laem Chabang',   'size' => '40 ไร่',  'com' => '3,200,000', 'type' => 'ที่ดินอุตสาหกรรม' ],
];

$sel_province = isset( $_GET['province'] ) ? sanitize_text_field( $_GET['province'] ) : '';
$sel_type     = isset( $_GET['type'] )     ? sanitize_text_field( $_GET['type'] )     : '';
$sel_min      = isset( $_GET['min'] )      ? sanitize_text_field( $_GET['min'] )      : '';
$sel_max      = isset( $_GET['max'] )      ? sanitize_text_field( $_GET['max'] )      : '';
?>

<!-- Page Hero -->
<div class="w-full py-10" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-7xl mx-auto px-4 lg:px-8">
    <h1 class="text-3xl font-extrabold text-white">ค้นหาที่ดิน</h1>
    <p class="text-blue-200 mt-1 text-sm">พบที่ดินกว่า 1,290 แปลงทั่วประเทศ พร้อมรับค่าคอมได้ทันที</p>
  </div>
</div>

<!-- Filter Card -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-5 relative z-10 mb-8">
  <form method="GET" action="" class="bg-white rounded-2xl shadow-lg p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">จังหวัด</label>
      <select name="province" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2" style="--tw-ring-color:#1d4ed8;">
        <option value="">ทุกจังหวัด</option>
        <?php foreach ( $provinces as $p ) : ?>
          <option value="<?php echo esc_attr( $p ); ?>" <?php selected( $sel_province, $p ); ?>><?php echo esc_html( $p ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">ประเภทที่ดิน</label>
      <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        <option value="">ทุกประเภท</option>
        <?php foreach ( $types as $tp ) : ?>
          <option value="<?php echo esc_attr( $tp ); ?>" <?php selected( $sel_type, $tp ); ?>><?php echo esc_html( $tp ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">ค่าคอมขั้นต่ำ (บาท)</label>
      <input type="number" name="min" placeholder="เช่น 500000" value="<?php echo esc_attr( $sel_min ); ?>"
             class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
    </div>

    <div>
      <label class="block text-xs font-semibold text-gray-500 mb-1">ค่าคอมสูงสุด (บาท)</label>
      <input type="number" name="max" placeholder="เช่น 5000000" value="<?php echo esc_attr( $sel_max ); ?>"
             class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
    </div>

    <button type="submit" class="w-full py-2.5 rounded-lg font-bold text-white text-sm hover:opacity-90 transition-opacity" style="background:#1d4ed8;">
      ค้นหา
    </button>

  </form>
</div>

<!-- Results -->
<div class="max-w-7xl mx-auto px-4 lg:px-8 mb-16">
  <p class="text-sm text-gray-500 mb-4">แสดง <?php echo count( $listings ); ?> รายการ</p>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ( $listings as $item ) : ?>
      <article class="rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="relative h-48">
          <img src="https://images.unsplash.com/<?php echo esc_attr( $item['img'] ); ?>?w=600&h=400&fit=crop&auto=format"
               class="w-full h-full object-cover" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
          <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background:#1aa260;">
            <?php echo esc_html( $item['loc'] ); ?>
          </span>
          <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-medium text-gray-600 bg-white/90">
            <?php echo esc_html( $item['type'] ); ?>
          </span>
        </div>
        <div class="p-4">
          <p class="font-semibold"><?php echo esc_html( $item['title'] ); ?></p>
          <p class="text-xs text-gray-500 mt-1">ขนาด: <?php echo esc_html( $item['size'] ); ?></p>
          <div class="mt-3 flex items-end justify-between">
            <div>
              <p class="text-xs text-gray-400">ค่าคอมสูงสุด</p>
              <p class="text-xl font-extrabold" style="color:#1d4ed8;"><?php echo esc_html( $item['com'] ); ?> <span class="text-sm">บาท</span></p>
            </div>
            <a href="#" class="px-4 py-2 rounded-lg text-xs font-bold text-white hover:opacity-90 transition-opacity" style="background:#1aa260;">ดูรายละเอียด</a>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>

<?php get_footer(); ?>
