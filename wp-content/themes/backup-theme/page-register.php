<?php
/**
 * Template Name: สมัครสมาชิก
 * Template Post Type: page
 */

if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/my-listings/' ) );
    exit;
}

$error = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['land_register_nonce'] ) ) {
    if ( ! wp_verify_nonce( $_POST['land_register_nonce'], 'land_register' ) ) {
        $error = 'คำขอไม่ถูกต้อง กรุณาลองใหม่';
    } else {
        $display_name = sanitize_text_field( $_POST['display_name'] ?? '' );
        $email        = sanitize_email( $_POST['email'] ?? '' );
        $phone        = sanitize_text_field( $_POST['phone'] ?? '' );
        $password     = $_POST['password'] ?? '';
        $password2    = $_POST['password2'] ?? '';

        if ( ! $display_name || ! $email || ! $password ) {
            $error = 'กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน';
        } elseif ( ! is_email( $email ) ) {
            $error = 'รูปแบบอีเมลไม่ถูกต้อง';
        } elseif ( strlen( $password ) < 8 ) {
            $error = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร';
        } elseif ( $password !== $password2 ) {
            $error = 'รหัสผ่านไม่ตรงกัน';
        } elseif ( email_exists( $email ) ) {
            $error = 'อีเมลนี้ถูกใช้งานแล้ว';
        } else {
            $base     = sanitize_user( strtolower( explode( '@', $email )[0] ) );
            $username = $base . rand( 100, 999 );
            while ( username_exists( $username ) ) {
                $username = $base . rand( 100, 999 );
            }

            $user_id = wp_create_user( $username, $password, $email );

            if ( is_wp_error( $user_id ) ) {
                $error = $user_id->get_error_message();
            } else {
                wp_update_user( [
                    'ID'           => $user_id,
                    'display_name' => $display_name,
                    'role'         => 'subscriber',
                ] );
                update_user_meta( $user_id, 'phone', $phone );

                wp_set_current_user( $user_id );
                wp_set_auth_cookie( $user_id );
                wp_redirect( home_url( '/my-listings/' ) );
                exit;
            }
        }
    }
}

get_header();
?>

<div class="min-h-[calc(100vh-160px)] flex items-center justify-center py-12 px-4">
  <div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

      <div class="text-center mb-8">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-3">
          <span class="w-12 h-12 rounded-xl flex items-center justify-center text-white" style="background:#13357a;">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l10 10-10 10L2 12 12 2z"/></svg>
          </span>
          <span class="text-xl font-extrabold" style="color:#13357a;">ตลาดที่ดินไทย<span style="color:#1aa260;">.com</span></span>
        </a>
        <h1 class="mt-5 text-2xl font-extrabold text-gray-800">สมัครสมาชิกฟรี</h1>
        <p class="text-sm text-gray-500 mt-1">เริ่มลงประกาศขายที่ดินได้ทันที</p>
      </div>

      <?php if ( $error ) : ?>
        <div class="mb-5 px-4 py-3 rounded-xl text-sm font-medium text-red-700 bg-red-50 border border-red-100">
          <?php echo esc_html( $error ); ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <?php wp_nonce_field( 'land_register', 'land_register_nonce' ); ?>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
          <input type="text" name="display_name" required
                 value="<?php echo esc_attr( $_POST['display_name'] ?? '' ); ?>"
                 placeholder="ชื่อที่แสดงในประกาศ"
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">อีเมล <span class="text-red-500">*</span></label>
          <input type="email" name="email" required
                 value="<?php echo esc_attr( $_POST['email'] ?? '' ); ?>"
                 placeholder="example@email.com"
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">เบอร์โทรศัพท์</label>
          <input type="tel" name="phone"
                 value="<?php echo esc_attr( $_POST['phone'] ?? '' ); ?>"
                 placeholder="08x-xxx-xxxx"
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">รหัสผ่าน <span class="text-red-500">*</span></label>
          <input type="password" name="password" required minlength="8"
                 placeholder="อย่างน้อย 8 ตัวอักษร"
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">ยืนยันรหัสผ่าน <span class="text-red-500">*</span></label>
          <input type="password" name="password2" required minlength="8"
                 placeholder="กรอกรหัสผ่านอีกครั้ง"
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2">
        </div>

        <button type="submit"
                class="w-full py-3 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity mt-2"
                style="background:#1d4ed8;">
          สมัครสมาชิก
        </button>
      </form>

      <p class="mt-6 text-center text-sm text-gray-500">
        มีบัญชีแล้ว?
        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="font-semibold hover:underline" style="color:#1d4ed8;">เข้าสู่ระบบ</a>
      </p>

    </div>
  </div>
</div>

<?php get_footer(); ?>
