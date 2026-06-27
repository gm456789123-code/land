<?php
/**
 * Template Name: โพสต์ขายที่ดิน
 * Template Post Type: page
 */

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login/' ) );
    exit;
}

$provinces = [ 'กรุงเทพฯ', 'เชียงใหม่', 'ภูเก็ต', 'ชลบุรี', 'ระยอง', 'สมุทรปราการ', 'อยุธยา', 'นครราชสีมา', 'ขอนแก่น', 'สุราษฎร์ธานี', 'เชียงราย', 'นครปฐม', 'นนทบุรี', 'ปทุมธานี', 'สมุทรสาคร' ];
$types     = [ 'ที่ดินเปล่า', 'ที่ดินพร้อมสิ่งปลูกสร้าง', 'ที่ดินอุตสาหกรรม', 'ที่ดินเกษตร', 'ที่ดินเชิงพาณิชย์' ];
$docs      = [ 'โฉนด', 'น.ส.3 ก.', 'น.ส.3', 'ส.ป.ก.', 'อื่นๆ' ];

$error   = '';
$success = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['land_post_nonce'] ) ) {
    if ( ! wp_verify_nonce( $_POST['land_post_nonce'], 'land_post_listing' ) ) {
        $error = 'คำขอไม่ถูกต้อง กรุณาลองใหม่';
    } else {
        $title    = sanitize_text_field( $_POST['title'] ?? '' );
        $province = sanitize_text_field( $_POST['province'] ?? '' );
        $type     = sanitize_text_field( $_POST['type'] ?? '' );
        $size     = sanitize_text_field( $_POST['size'] ?? '' );
        $price    = (int) ( $_POST['price'] ?? 0 );
        $doc      = sanitize_text_field( $_POST['doc'] ?? '' );
        $detail   = sanitize_textarea_field( $_POST['detail'] ?? '' );
        $contact  = sanitize_text_field( $_POST['contact'] ?? '' );

        if ( ! $title || ! $province || ! $type || ! $size || ! $price ) {
            $error = 'กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน';
        } else {
            $post_id = wp_insert_post( [
                'post_title'   => $title,
                'post_content' => $detail,
                'post_status'  => 'pending',
                'post_type'    => 'land_listing',
                'post_author'  => get_current_user_id(),
                'meta_input'   => [
                    '_land_province' => $province,
                    '_land_type'     => $type,
                    '_land_size'     => $size,
                    '_land_price'    => $price,
                    '_land_doc'      => $doc,
                    '_land_contact'  => $contact,
                ],
            ] );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                // Upload image
                if ( ! empty( $_FILES['image']['name'] ) ) {
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    require_once ABSPATH . 'wp-admin/includes/file.php';
                    require_once ABSPATH . 'wp-admin/includes/media.php';
                    $attach_id = media_handle_upload( 'image', $post_id );
                    if ( ! is_wp_error( $attach_id ) ) {
                        set_post_thumbnail( $post_id, $attach_id );
                    }
                }
                $success = 'ส่งประกาศเรียบร้อยแล้ว! ทีมงานจะตรวจสอบและเผยแพร่ภายใน 24 ชั่วโมง';
            } else {
                $error = 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง';
            }
        }
    }
}

get_header();
?>

<!-- Hero -->
<div class="w-full py-10" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-3xl mx-auto px-4 lg:px-8">
    <h1 class="text-3xl font-extrabold text-white">ลงประกาศขายที่ดิน</h1>
    <p class="text-blue-200 mt-1 text-sm">กรอกรายละเอียดให้ครบถ้วน ทีมงานจะตรวจสอบก่อนเผยแพร่</p>
  </div>
</div>

<div class="max-w-3xl mx-auto px-4 lg:px-8 py-10 mb-10">

  <?php if ( $success ) : ?>
    <div class="mb-6 px-5 py-4 rounded-2xl text-sm font-medium text-green-700 bg-green-50 border border-green-200 flex items-start gap-3">
      <svg class="w-5 h-5 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="4,12 9,17 20,6"/></svg>
      <?php echo esc_html( $success ); ?>
    </div>
  <?php endif; ?>

  <?php if ( $error ) : ?>
    <div class="mb-6 px-5 py-4 rounded-2xl text-sm font-medium text-red-700 bg-red-50 border border-red-100">
      <?php echo esc_html( $error ); ?>
    </div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-8 space-y-6">
    <?php wp_nonce_field( 'land_post_listing', 'land_post_nonce' ); ?>

    <!-- ชื่อประกาศ -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">ชื่อประกาศ <span class="text-red-500">*</span></label>
      <input type="text" name="title" required
             value="<?php echo esc_attr( $_POST['title'] ?? '' ); ?>"
             placeholder="เช่น ที่ดินเปล่า ติดถนน ใกล้นิคมอุตสาหกรรม ระยอง"
             class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2" style="--tw-ring-color:#1d4ed8;">
    </div>

    <!-- จังหวัด + ประเภท -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">จังหวัด <span class="text-red-500">*</span></label>
        <select name="province" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
          <option value="">เลือกจังหวัด</option>
          <?php foreach ( $provinces as $p ) : ?>
            <option value="<?php echo esc_attr( $p ); ?>" <?php selected( $_POST['province'] ?? '', $p ); ?>><?php echo esc_html( $p ); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">ประเภทที่ดิน <span class="text-red-500">*</span></label>
        <select name="type" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
          <option value="">เลือกประเภท</option>
          <?php foreach ( $types as $tp ) : ?>
            <option value="<?php echo esc_attr( $tp ); ?>" <?php selected( $_POST['type'] ?? '', $tp ); ?>><?php echo esc_html( $tp ); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- ขนาด + ราคา -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">ขนาด <span class="text-red-500">*</span></label>
        <input type="text" name="size" required
               value="<?php echo esc_attr( $_POST['size'] ?? '' ); ?>"
               placeholder="เช่น 5 ไร่ หรือ 200 ตร.ว."
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">ราคาขาย (บาท) <span class="text-red-500">*</span></label>
        <input type="number" name="price" required min="1"
               value="<?php echo esc_attr( $_POST['price'] ?? '' ); ?>"
               placeholder="เช่น 5000000"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>
    </div>

    <!-- เอกสารสิทธิ์ + ช่องทางติดต่อ -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">เอกสารสิทธิ์</label>
        <select name="doc" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
          <option value="">เลือกเอกสาร</option>
          <?php foreach ( $docs as $d ) : ?>
            <option value="<?php echo esc_attr( $d ); ?>" <?php selected( $_POST['doc'] ?? '', $d ); ?>><?php echo esc_html( $d ); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">เบอร์โทร / LINE ID</label>
        <input type="text" name="contact"
               value="<?php echo esc_attr( $_POST['contact'] ?? '' ); ?>"
               placeholder="เบอร์โทรหรือ LINE สำหรับติดต่อ"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>
    </div>

    <!-- รายละเอียด -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">รายละเอียดเพิ่มเติม</label>
      <textarea name="detail" rows="5"
                placeholder="อธิบายรายละเอียดที่ดิน ทำเล สิ่งอำนวยความสะดวก ฯลฯ"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 resize-none"><?php echo esc_textarea( $_POST['detail'] ?? '' ); ?></textarea>
    </div>

    <!-- รูปภาพ -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">รูปภาพที่ดิน</label>
      <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-300 transition-colors cursor-pointer" onclick="document.getElementById('image-input').click()">
        <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
        <p class="text-sm text-gray-500">คลิกเพื่ออัปโหลดรูปภาพ</p>
        <p class="text-xs text-gray-400 mt-1">JPG, PNG ขนาดไม่เกิน 5MB</p>
        <input type="file" id="image-input" name="image" accept="image/*" class="hidden"
               onchange="document.getElementById('file-name').textContent = this.files[0]?.name || ''">
      </div>
      <p id="file-name" class="text-xs text-gray-500 mt-2"></p>
    </div>

    <!-- Submit -->
    <div class="flex items-center gap-4 pt-2">
      <button type="submit"
              class="px-8 py-3 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity"
              style="background:#1d4ed8;">
        ส่งประกาศ
      </button>
      <p class="text-xs text-gray-400">ทีมงานจะตรวจสอบก่อนเผยแพร่ภายใน 24 ชั่วโมง</p>
    </div>

  </form>
</div>

<?php get_footer(); ?>
