<?php
/**
 * Template Name: เปรียบเทียบ
 * Template Post Type: page
 */
get_header();

$plots = [
  [
    'title'    => 'Townhome Chiang Mai',
    'img'      => 'photo-1560518883-ce09059eeffa',
    'loc'      => 'เชียงใหม่',
    'type'     => 'ที่ดินพร้อมสิ่งปลูกสร้าง',
    'size'     => '2 ไร่',
    'price'    => '24,000,000',
    'com'      => '2,400,000',
    'doc'      => 'โฉนด',
    'road'     => 'ใช่',
    'utility'  => 'ใช่',
    'zoning'   => 'ที่อยู่อาศัย',
    'deal'     => '3–6 เดือน',
    'badge'    => 'แนะนำ',
  ],
  [
    'title'    => 'Industrial Land EEC',
    'img'      => 'photo-1500382017468-9049fed747ef',
    'loc'      => 'ระยอง',
    'type'     => 'ที่ดินอุตสาหกรรม',
    'size'     => '80 ไร่',
    'price'    => '160,000,000',
    'com'      => '8,000,000',
    'doc'      => 'โฉนด',
    'road'     => 'ใช่',
    'utility'  => 'ใช่',
    'zoning'   => 'อุตสาหกรรม',
    'deal'     => '6–12 เดือน',
    'badge'    => 'ค่าคอมสูง',
  ],
  [
    'title'    => 'Pool Villa Phuket',
    'img'      => 'photo-1416879595882-3373a0480b5b',
    'loc'      => 'ภูเก็ต',
    'type'     => 'ที่ดินพร้อมสิ่งปลูกสร้าง',
    'size'     => '5 ไร่',
    'price'    => '80,000,000',
    'com'      => '4,000,000',
    'doc'      => 'น.ส.3 ก.',
    'road'     => 'ใช่',
    'utility'  => 'ใช่',
    'zoning'   => 'ท่องเที่ยว',
    'deal'     => '3–9 เดือน',
    'badge'    => '',
  ],
];

$rows = [
  'loc'     => 'จังหวัด',
  'type'    => 'ประเภท',
  'size'    => 'ขนาด',
  'price'   => 'ราคา (บาท)',
  'com'     => 'ค่าคอมสูงสุด (บาท)',
  'doc'     => 'เอกสารสิทธิ์',
  'road'    => 'ถนนเข้าถึง',
  'utility' => 'สาธารณูปโภค',
  'zoning'  => 'โซนผังเมือง',
  'deal'    => 'ระยะเวลาปิดดีล',
];
?>

<!-- Page Hero -->
<div class="w-full py-10" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-7xl mx-auto px-4 lg:px-8">
    <h1 class="text-3xl font-extrabold text-white">เปรียบเทียบที่ดิน</h1>
    <p class="text-blue-200 mt-1 text-sm">เลือกดูรายละเอียดเคียงข้างกัน เพื่อตัดสินใจแนะนำที่ดินได้ถูกต้อง</p>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 lg:px-8 py-10">

  <!-- Card images row -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <?php foreach ( $plots as $p ) : ?>
      <div class="rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100 relative">
        <?php if ( $p['badge'] ) : ?>
          <span class="absolute top-3 right-3 z-10 px-2 py-1 rounded-full text-xs font-bold text-white" style="background:#1aa260;">
            <?php echo esc_html( $p['badge'] ); ?>
          </span>
        <?php endif; ?>
        <div class="h-44">
          <img src="https://images.unsplash.com/<?php echo esc_attr( $p['img'] ); ?>?w=600&h=400&fit=crop&auto=format"
               class="w-full h-full object-cover" alt="<?php echo esc_attr( $p['title'] ); ?>" loading="lazy">
        </div>
        <div class="p-4">
          <p class="font-extrabold" style="color:#13357a;"><?php echo esc_html( $p['title'] ); ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Comparison table -->
  <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
    <table class="w-full text-sm bg-white">
      <thead>
        <tr style="background:#13357a;" class="text-white">
          <th class="text-left px-5 py-3 font-semibold w-40">รายการ</th>
          <?php foreach ( $plots as $p ) : ?>
            <th class="text-left px-5 py-3 font-semibold"><?php echo esc_html( $p['title'] ); ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 0;
        foreach ( $rows as $key => $label ) :
          $bg = $i++ % 2 === 0 ? 'bg-gray-50' : 'bg-white';
        ?>
          <tr class="<?php echo $bg; ?> border-t border-gray-100">
            <td class="px-5 py-3 font-semibold text-gray-600"><?php echo esc_html( $label ); ?></td>
            <?php foreach ( $plots as $p ) : ?>
              <td class="px-5 py-3">
                <?php
                $val = $p[ $key ];
                if ( $val === 'ใช่' ) {
                  echo '<span class="inline-flex items-center gap-1 text-green-600 font-medium"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="4,12 9,17 20,6"/></svg>ใช่</span>';
                } elseif ( $val === 'ไม่ใช่' ) {
                  echo '<span class="text-red-400 font-medium">✕ ไม่ใช่</span>';
                } elseif ( $key === 'com' ) {
                  echo '<span class="font-extrabold" style="color:#1d4ed8;">' . esc_html( $val ) . '</span>';
                } else {
                  echo esc_html( $val );
                }
                ?>
              </td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
        <!-- CTA row -->
        <tr class="border-t border-gray-200">
          <td class="px-5 py-4 font-semibold text-gray-600">สนใจแนะนำ</td>
          <?php foreach ( $plots as $p ) : ?>
            <td class="px-5 py-4">
              <a href="<?php echo esc_url( home_url( '/search/' ) ); ?>"
                 class="inline-block px-4 py-2 rounded-lg text-xs font-bold text-white hover:opacity-90 transition-opacity"
                 style="background:#1aa260;">
                เลือกแปลงนี้
              </a>
            </td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tips -->
  <div class="mt-8 bg-blue-50 border border-blue-100 rounded-2xl p-5">
    <p class="font-extrabold mb-3" style="color:#13357a;">💡 เคล็ดลับการเลือกที่ดินแนะนำ</p>
    <ul class="text-sm text-gray-600 space-y-2 list-disc list-inside">
      <li>ดูค่าคอมสูงสุดประกอบกับโอกาสปิดดีล — ค่าคอมสูงแต่ปิดดีลยากอาจไม่คุ้ม</li>
      <li>ที่ดินพร้อมเอกสารสิทธิ์โฉนดมักปิดดีลได้เร็วกว่า</li>
      <li>พื้นที่ EEC (ระยอง/ชลบุรี) มี Demand จาก Buyer จริงจำนวนมาก</li>
      <li>สอบถามทีมงานก่อนแนะนำ Buyer เพื่อรับ Script การขายที่ถูกต้อง</li>
    </ul>
  </div>

</div>

<?php get_footer(); ?>
