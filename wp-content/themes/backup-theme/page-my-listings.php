<?php
/**
 * Template Name: ประกาศของฉัน
 * Template Post Type: page
 */

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login/' ) );
    exit;
}

// Handle delete
if ( isset( $_GET['delete'] ) && isset( $_GET['_wpnonce'] ) ) {
    $post_id = (int) $_GET['delete'];
    if ( wp_verify_nonce( $_GET['_wpnonce'], 'delete_listing_' . $post_id ) ) {
        $post = get_post( $post_id );
        if ( $post && $post->post_author == get_current_user_id() && $post->post_type === 'land_listing' ) {
            wp_delete_post( $post_id, true );
            wp_redirect( home_url( '/my-listings/?deleted=1' ) );
            exit;
        }
    }
}

$user_id  = get_current_user_id();
$statuses = [ 'publish', 'pending', 'draft' ];

$listings = get_posts( [
    'post_type'      => 'land_listing',
    'post_status'    => $statuses,
    'author'         => $user_id,
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

$status_labels = [
    'publish' => [ 'label' => 'เผยแพร่แล้ว', 'class' => 'bg-green-100 text-green-700' ],
    'pending' => [ 'label' => 'รอตรวจสอบ',   'class' => 'bg-yellow-100 text-yellow-700' ],
    'draft'   => [ 'label' => 'ฉบับร่าง',     'class' => 'bg-gray-100 text-gray-600' ],
];

get_header();
?>

<div class="w-full py-8" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-5xl mx-auto px-4 lg:px-8 flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-extrabold text-white">ประกาศของฉัน</h1>
      <p class="text-blue-200 text-sm mt-0.5">จัดการประกาศขายที่ดินทั้งหมดของคุณ</p>
    </div>
    <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>"
       class="px-5 py-2.5 rounded-xl font-bold text-sm text-white border-2 border-white/40 hover:bg-white/10 transition-colors">
      + ลงประกาศใหม่
    </a>
  </div>
</div>

<div class="max-w-5xl mx-auto px-4 lg:px-8 py-8 mb-10">

  <?php if ( isset( $_GET['deleted'] ) ) : ?>
    <div class="mb-5 px-4 py-3 rounded-xl text-sm font-medium text-green-700 bg-green-50 border border-green-200">
      ลบประกาศเรียบร้อยแล้ว
    </div>
  <?php endif; ?>

  <?php if ( empty( $listings ) ) : ?>
    <div class="text-center py-20">
      <div class="w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center bg-gray-100">
        <svg class="w-8 h-8 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
      </div>
      <h3 class="text-lg font-bold text-gray-700 mb-1">ยังไม่มีประกาศ</h3>
      <p class="text-sm text-gray-400 mb-5">เริ่มลงประกาศขายที่ดินแรกของคุณได้เลย</p>
      <a href="<?php echo esc_url( home_url( '/post-listing/' ) ); ?>"
         class="inline-block px-6 py-3 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity"
         style="background:#1d4ed8;">ลงประกาศเลย</a>
    </div>

  <?php else : ?>
    <!-- Stats bar -->
    <?php
    $counts = [ 'publish' => 0, 'pending' => 0, 'draft' => 0 ];
    foreach ( $listings as $l ) { $counts[ $l->post_status ] = ( $counts[ $l->post_status ] ?? 0 ) + 1; }
    ?>
    <div class="grid grid-cols-3 gap-4 mb-6">
      <?php foreach ( [ 'publish' => 'เผยแพร่', 'pending' => 'รอตรวจสอบ', 'draft' => 'ฉบับร่าง' ] as $s => $label ) : ?>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center">
          <p class="text-2xl font-extrabold text-gray-800"><?php echo $counts[ $s ]; ?></p>
          <p class="text-xs text-gray-500 mt-0.5"><?php echo esc_html( $label ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="space-y-3">
      <?php foreach ( $listings as $listing ) :
        $province = get_post_meta( $listing->ID, '_land_province', true );
        $type     = get_post_meta( $listing->ID, '_land_type',     true );
        $size     = get_post_meta( $listing->ID, '_land_size',     true );
        $price    = get_post_meta( $listing->ID, '_land_price',    true );
        $status   = $status_labels[ $listing->post_status ] ?? $status_labels['draft'];
        $thumb    = get_the_post_thumbnail_url( $listing->ID, 'thumbnail' );
        $delete_url = wp_nonce_url(
            home_url( '/my-listings/?delete=' . $listing->ID ),
            'delete_listing_' . $listing->ID
        );
      ?>
        <div class="bg-white rounded-2xl border border-gray-100 p-4 flex gap-4 items-start">
          <!-- Thumbnail -->
          <div class="shrink-0 w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center">
            <?php if ( $thumb ) : ?>
              <img src="<?php echo esc_url( $thumb ); ?>" alt="" class="w-full h-full object-cover">
            <?php else : ?>
              <svg class="w-7 h-7 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            <?php endif; ?>
          </div>

          <!-- Info -->
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-2">
              <h3 class="font-bold text-gray-800 text-sm leading-snug truncate"><?php echo esc_html( $listing->post_title ); ?></h3>
              <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded-full <?php echo esc_attr( $status['class'] ); ?>">
                <?php echo esc_html( $status['label'] ); ?>
              </span>
            </div>
            <div class="flex flex-wrap gap-x-3 gap-y-0.5 mt-1.5 text-xs text-gray-500">
              <?php if ( $province ) echo '<span>' . esc_html( $province ) . '</span>'; ?>
              <?php if ( $type )     echo '<span>' . esc_html( $type ) . '</span>'; ?>
              <?php if ( $size )     echo '<span>' . esc_html( $size ) . '</span>'; ?>
            </div>
            <?php if ( $price ) : ?>
              <p class="mt-1 text-sm font-bold" style="color:#1d4ed8;">฿<?php echo number_format( $price ); ?></p>
            <?php endif; ?>
            <p class="mt-1 text-xs text-gray-400">ลงเมื่อ <?php echo get_the_date( 'd M Y', $listing->ID ); ?></p>
          </div>

          <!-- Actions -->
          <div class="shrink-0 flex flex-col gap-2">
            <a href="<?php echo esc_url( home_url( '/post-listing/?edit=' . $listing->ID ) ); ?>"
               class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
              แก้ไข
            </a>
            <a href="<?php echo esc_url( $delete_url ); ?>"
               onclick="return confirm('ยืนยันลบประกาศนี้?')"
               class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-red-100 text-red-600 hover:bg-red-50 transition-colors">
              ลบ
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
