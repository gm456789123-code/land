<?php
/**
 * Single listing page — หน้ารายละเอียดประกาศที่ดิน
 */

if ( ! have_posts() ) {
    wp_redirect( home_url( '/latest/' ) );
    exit;
}

the_post();

$province = get_post_meta( get_the_ID(), '_land_province', true );
$type     = get_post_meta( get_the_ID(), '_land_type',     true );
$size     = get_post_meta( get_the_ID(), '_land_size',     true );
$price    = get_post_meta( get_the_ID(), '_land_price',    true );
$doc      = get_post_meta( get_the_ID(), '_land_doc',      true );
$contact  = get_post_meta( get_the_ID(), '_land_contact',  true );
$thumb    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
$author   = get_userdata( get_the_author_meta( 'ID' ) );

get_header();
?>

<div class="max-w-5xl mx-auto px-4 lg:px-8 py-8 mb-12">

  <!-- Breadcrumb -->
  <nav class="text-xs text-gray-400 mb-5 flex items-center gap-2">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:underline">หน้าหลัก</a>
    <span>/</span>
    <a href="<?php echo esc_url( home_url( '/latest/' ) ); ?>" class="hover:underline">ประกาศที่ดิน</a>
    <span>/</span>
    <span class="text-gray-600 truncate max-w-[200px]"><?php the_title(); ?></span>
  </nav>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Left: Image + Detail -->
    <div class="lg:col-span-2 space-y-5">

      <!-- Image -->
      <div class="rounded-2xl overflow-hidden bg-gray-100 aspect-video flex items-center justify-center">
        <?php if ( $thumb ) : ?>
          <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
        <?php else : ?>
          <svg class="w-16 h-16 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
        <?php endif; ?>
      </div>

      <!-- Title + Badges -->
      <div>
        <div class="flex flex-wrap gap-2 mb-3">
          <?php if ( $province ) echo '<span class="px-3 py-1 rounded-full text-xs font-bold text-white" style="background:#1aa260;">' . esc_html( $province ) . '</span>'; ?>
          <?php if ( $type )     echo '<span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">' . esc_html( $type ) . '</span>'; ?>
          <?php if ( $doc )      echo '<span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">' . esc_html( $doc ) . '</span>'; ?>
        </div>
        <h1 class="text-2xl font-extrabold text-gray-800"><?php the_title(); ?></h1>
        <p class="text-xs text-gray-400 mt-1">ลงประกาศเมื่อ <?php echo get_the_date( 'd M Y' ); ?></p>
      </div>

      <!-- Description -->
      <?php if ( get_the_content() ) : ?>
      <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="font-extrabold text-gray-800 mb-3">รายละเอียด</h2>
        <div class="text-sm text-gray-600 leading-relaxed prose max-w-none">
          <?php the_content(); ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Specs -->
      <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="font-extrabold text-gray-800 mb-4">ข้อมูลที่ดิน</h2>
        <dl class="grid grid-cols-2 gap-x-8 gap-y-3 text-sm">
          <?php if ( $province ) : ?>
            <div><dt class="text-gray-400">จังหวัด</dt><dd class="font-semibold text-gray-800 mt-0.5"><?php echo esc_html( $province ); ?></dd></div>
          <?php endif; ?>
          <?php if ( $type ) : ?>
            <div><dt class="text-gray-400">ประเภท</dt><dd class="font-semibold text-gray-800 mt-0.5"><?php echo esc_html( $type ); ?></dd></div>
          <?php endif; ?>
          <?php if ( $size ) : ?>
            <div><dt class="text-gray-400">ขนาด</dt><dd class="font-semibold text-gray-800 mt-0.5"><?php echo esc_html( $size ); ?></dd></div>
          <?php endif; ?>
          <?php if ( $doc ) : ?>
            <div><dt class="text-gray-400">เอกสารสิทธิ์</dt><dd class="font-semibold text-gray-800 mt-0.5"><?php echo esc_html( $doc ); ?></dd></div>
          <?php endif; ?>
          <?php if ( $price ) : ?>
            <div class="col-span-2"><dt class="text-gray-400">ราคาขาย</dt><dd class="text-xl font-extrabold mt-0.5" style="color:#1d4ed8;">฿<?php echo number_format( $price ); ?></dd></div>
          <?php endif; ?>
        </dl>
      </div>

    </div>

    <!-- Right: Contact card -->
    <div class="space-y-4">

      <!-- Price highlight -->
      <?php if ( $price ) : ?>
      <div class="rounded-2xl p-5 text-white" style="background:linear-gradient(135deg,#13357a,#1d4ed8);">
        <p class="text-sm text-blue-100">ราคาขาย</p>
        <p class="text-3xl font-extrabold mt-1">฿<?php echo number_format( $price ); ?></p>
        <?php if ( $size ) echo '<p class="text-xs text-blue-200 mt-1">' . esc_html( $size ) . '</p>'; ?>
      </div>
      <?php endif; ?>

      <!-- Contact -->
      <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <h2 class="font-extrabold text-gray-800 mb-4">ติดต่อผู้ขาย</h2>

        <?php if ( $author ) : ?>
        <div class="flex items-center gap-3 mb-4">
          <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shrink-0" style="background:#13357a;">
            <?php echo esc_html( mb_substr( $author->display_name ?: $author->user_login, 0, 1 ) ); ?>
          </div>
          <div>
            <p class="font-semibold text-sm text-gray-800"><?php echo esc_html( $author->display_name ?: $author->user_login ); ?></p>
            <p class="text-xs text-gray-400">ผู้ลงประกาศ</p>
          </div>
        </div>
        <?php endif; ?>

        <?php if ( $contact ) : ?>
          <div class="space-y-2">
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact ) ); ?>"
               class="flex items-center gap-3 w-full px-4 py-3 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity"
               style="background:#1aa260;">
              <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1A19.5 19.5 0 0 1 5.6 13a19.8 19.8 0 0 1-3-8.5A2 2 0 0 1 4.7 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2L8.9 9.5a16 16 0 0 0 5.6 5.6l1-1a2 2 0 0 1 2-.5c.9.3 1.8.6 2.8.7A2 2 0 0 1 22 16.9z"/></svg>
              โทร <?php echo esc_html( $contact ); ?>
            </a>
            <a href="https://line.me/ti/p/~<?php echo esc_attr( $contact ); ?>"
               target="_blank" rel="noopener"
               class="flex items-center gap-3 w-full px-4 py-3 rounded-xl font-bold text-sm border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">
              <svg class="w-4 h-4 shrink-0 text-green-500" viewBox="0 0 24 24" fill="currentColor"><path d="M19.952 12.165C19.952 8.073 15.899 5 11 5S2.048 8.073 2.048 12.165c0 3.674 3.257 6.753 7.657 7.337.298.064.704.197.807.452.093.232.061.596.03.831l-.131.784c-.04.232-.185.908.795.495 1-.414 5.397-3.179 7.363-5.445 1.359-1.49 2.01-3.004 2.01-4.454h-.627z"/></svg>
              LINE: <?php echo esc_html( $contact ); ?>
            </a>
          </div>
        <?php else : ?>
          <p class="text-sm text-gray-400">ผู้ขายไม่ได้ระบุช่องทางติดต่อ</p>
        <?php endif; ?>
      </div>

      <!-- Share / Back -->
      <div class="flex gap-2">
        <a href="<?php echo esc_url( home_url( '/latest/' ) ); ?>"
           class="flex-1 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 text-center hover:bg-gray-50 transition-colors">
          ← ย้อนกลับ
        </a>
        <button onclick="navigator.share ? navigator.share({title:document.title,url:location.href}) : navigator.clipboard.writeText(location.href).then(()=>alert('คัดลอก URL แล้ว'))"
                class="flex-1 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
          แชร์
        </button>
      </div>

    </div>
  </div>
</div>

<?php get_footer(); ?>
