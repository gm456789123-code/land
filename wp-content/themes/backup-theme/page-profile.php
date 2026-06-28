<?php
/**
 * Template Name: ข้อมูลส่วนตัว
 * Template Post Type: page
 */

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login/' ) );
    exit;
}

$user    = wp_get_current_user();
$error   = '';
$success = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['land_profile_nonce'] ) ) {
    if ( ! wp_verify_nonce( $_POST['land_profile_nonce'], 'land_profile' ) ) {
        $error = 'คำขอไม่ถูกต้อง กรุณาลองใหม่';
    } else {
        $action = $_POST['action'] ?? 'profile';

        if ( $action === 'profile' ) {
            $display_name = sanitize_text_field( $_POST['display_name'] ?? '' );
            $email        = sanitize_email( $_POST['email'] ?? '' );
            $phone        = sanitize_text_field( $_POST['phone'] ?? '' );

            if ( ! $display_name || ! $email ) {
                $error = 'กรุณากรอกชื่อและอีเมล';
            } elseif ( ! is_email( $email ) ) {
                $error = 'รูปแบบอีเมลไม่ถูกต้อง';
            } elseif ( $email !== $user->user_email && email_exists( $email ) ) {
                $error = 'อีเมลนี้ถูกใช้งานแล้ว';
            } else {
                wp_update_user( [
                    'ID'           => $user->ID,
                    'display_name' => $display_name,
                    'user_email'   => $email,
                ] );
                update_user_meta( $user->ID, 'phone', $phone );
                $user    = wp_get_current_user();
                $success = 'บันทึกข้อมูลเรียบร้อยแล้ว';
            }

        } elseif ( $action === 'password' ) {
            $current  = $_POST['current_password'] ?? '';
            $new_pass = $_POST['new_password'] ?? '';
            $confirm  = $_POST['confirm_password'] ?? '';

            if ( ! $current || ! $new_pass ) {
                $error = 'กรุณากรอกรหัสผ่านให้ครบ';
            } elseif ( ! wp_check_password( $current, $user->user_pass, $user->ID ) ) {
                $error = 'รหัสผ่านปัจจุบันไม่ถูกต้อง';
            } elseif ( strlen( $new_pass ) < 8 ) {
                $error = 'รหัสผ่านใหม่ต้องมีอย่างน้อย 8 ตัวอักษร';
            } elseif ( $new_pass !== $confirm ) {
                $error = 'รหัสผ่านใหม่ไม่ตรงกัน';
            } else {
                wp_set_password( $new_pass, $user->ID );
                // Re-login after password change
                wp_set_auth_cookie( $user->ID );
                $success = 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว';
            }
        }
    }
}

$phone = get_user_meta( $user->ID, 'phone', true );

get_header();
?>

<div class="w-full py-8" style="background:linear-gradient(90deg,#13357a,#1d4ed8);">
  <div class="max-w-3xl mx-auto px-4 lg:px-8">
    <h1 class="text-2xl font-extrabold text-white">ข้อมูลส่วนตัว</h1>
    <p class="text-blue-200 text-sm mt-0.5">แก้ไขข้อมูลบัญชีของคุณ</p>
  </div>
</div>

<div class="max-w-3xl mx-auto px-4 lg:px-8 py-8 mb-10 space-y-6">

  <?php if ( $success ) : ?>
    <div class="px-4 py-3 rounded-xl text-sm font-medium text-green-700 bg-green-50 border border-green-200">
      <?php echo esc_html( $success ); ?>
    </div>
  <?php endif; ?>
  <?php if ( $error ) : ?>
    <div class="px-4 py-3 rounded-xl text-sm font-medium text-red-700 bg-red-50 border border-red-100">
      <?php echo esc_html( $error ); ?>
    </div>
  <?php endif; ?>

  <!-- Profile info -->
  <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8">
    <h2 class="text-base font-extrabold text-gray-800 mb-5">ข้อมูลทั่วไป</h2>
    <form method="POST" class="space-y-4">
      <?php wp_nonce_field( 'land_profile', 'land_profile_nonce' ); ?>
      <input type="hidden" name="action" value="profile">

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
        <input type="text" name="display_name" required
               value="<?php echo esc_attr( $user->display_name ); ?>"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">อีเมล <span class="text-red-500">*</span></label>
        <input type="email" name="email" required
               value="<?php echo esc_attr( $user->user_email ); ?>"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">เบอร์โทรศัพท์</label>
        <input type="tel" name="phone"
               value="<?php echo esc_attr( $phone ); ?>"
               placeholder="08x-xxx-xxxx"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">ชื่อผู้ใช้ (เปลี่ยนไม่ได้)</label>
        <input type="text" disabled value="<?php echo esc_attr( $user->user_login ); ?>"
               class="w-full border border-gray-100 rounded-xl px-4 py-3 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
      </div>

      <button type="submit"
              class="px-6 py-2.5 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity"
              style="background:#1d4ed8;">
        บันทึกข้อมูล
      </button>
    </form>
  </div>

  <!-- Change password -->
  <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8">
    <h2 class="text-base font-extrabold text-gray-800 mb-5">เปลี่ยนรหัสผ่าน</h2>
    <form method="POST" class="space-y-4">
      <?php wp_nonce_field( 'land_profile', 'land_profile_nonce' ); ?>
      <input type="hidden" name="action" value="password">

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">รหัสผ่านปัจจุบัน</label>
        <input type="password" name="current_password" required
               placeholder="กรอกรหัสผ่านปัจจุบัน"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">รหัสผ่านใหม่</label>
        <input type="password" name="new_password" required minlength="8"
               placeholder="อย่างน้อย 8 ตัวอักษร"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">ยืนยันรหัสผ่านใหม่</label>
        <input type="password" name="confirm_password" required minlength="8"
               placeholder="กรอกรหัสผ่านใหม่อีกครั้ง"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
      </div>

      <button type="submit"
              class="px-6 py-2.5 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity"
              style="background:#13357a;">
        เปลี่ยนรหัสผ่าน
      </button>
    </form>
  </div>

  <!-- Danger zone -->
  <div class="bg-white rounded-2xl border border-red-100 p-6">
    <h2 class="text-base font-extrabold text-red-600 mb-1">ออกจากระบบ</h2>
    <p class="text-sm text-gray-500 mb-4">ออกจากระบบในอุปกรณ์นี้</p>
    <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>"
       class="inline-block px-5 py-2.5 rounded-xl border border-red-200 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">
      ออกจากระบบ
    </a>
  </div>

</div>

<?php get_footer(); ?>
