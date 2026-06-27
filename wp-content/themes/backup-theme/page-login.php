<?php
/**
 * Template Name: เข้าสู่ระบบ
 * Template Post Type: page
 */

if ( is_user_logged_in() ) {
    wp_redirect( current_user_can( 'manage_options' ) ? admin_url() : home_url( '/my-listings/' ) );
    exit;
}

$error   = '';
$success = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['land_login_nonce'] ) ) {
    if ( ! wp_verify_nonce( $_POST['land_login_nonce'], 'land_login' ) ) {
        $error = 'คำขอไม่ถูกต้อง กรุณาลองใหม่';
    } else {
        $creds = [
            'user_login'    => sanitize_text_field( $_POST['username'] ?? '' ),
            'user_password' => $_POST['password'] ?? '',
            'remember'      => isset( $_POST['remember'] ),
        ];
        $user = wp_signon( $creds, false );
        if ( is_wp_error( $user ) ) {
            $error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
        } else {
            $redirect = user_can( $user, 'manage_options' ) ? admin_url() : home_url( '/my-listings/' );
            wp_redirect( $redirect );
            exit;
        }
    }
}

get_header();
?>

<div class="min-h-[calc(100vh-160px)] flex items-center justify-center py-12 px-4">
  <div class="w-full max-w-md">

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

      <!-- Logo -->
      <div class="text-center mb-8">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-3">
          <span class="w-12 h-12 rounded-xl flex items-center justify-center text-white" style="background:#13357a;">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l10 10-10 10L2 12 12 2z"/></svg>
          </span>
          <span class="text-xl font-extrabold" style="color:#13357a;">ตลาดที่ดินไทย<span style="color:#1aa260;">.com</span></span>
        </a>
        <h1 class="mt-5 text-2xl font-extrabold text-gray-800">เข้าสู่ระบบ</h1>
        <p class="text-sm text-gray-500 mt-1">เข้าสู่ระบบเพื่อจัดการประกาศของคุณ</p>
      </div>

      <?php if ( $error ) : ?>
        <div class="mb-5 px-4 py-3 rounded-xl text-sm font-medium text-red-700 bg-red-50 border border-red-100">
          <?php echo esc_html( $error ); ?>
        </div>
      <?php endif; ?>

      <div class="mb-6 space-y-3">
        <button type="button"
                disabled
                aria-disabled="true"
                class="w-full flex items-center justify-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-700 opacity-80 cursor-not-allowed">
          <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#EA4335" d="M12 10.2v3.9h5.4c-.2 1.3-1.7 3.9-5.4 3.9-3.2 0-5.9-2.7-5.9-6s2.7-6 5.9-6c1.8 0 3 .8 3.7 1.5l2.5-2.4C16.6 3.6 14.5 2.8 12 2.8 6.9 2.8 2.8 6.9 2.8 12S6.9 21.2 12 21.2c6.9 0 8.6-4.8 8.6-7.3 0-.5-.1-.9-.1-1.3H12z"/>
            <path fill="#34A853" d="M3.9 7l3.2 2.3C8 7.4 9.8 6 12 6c1.8 0 3 .8 3.7 1.5l2.5-2.4C16.6 3.6 14.5 2.8 12 2.8 8.5 2.8 5.5 4.8 3.9 7z"/>
            <path fill="#FBBC05" d="M12 21.2c2.4 0 4.5-.8 6-2.3l-2.8-2.3c-.8.6-1.8 1.1-3.2 1.1-3.6 0-5.2-2.4-5.4-3.7l-3.3 2.5c1.6 3.1 4.8 4.7 8.7 4.7z"/>
            <path fill="#4285F4" d="M3.3 16.5l3.3-2.5c-.2-.5-.3-1.1-.3-2s.1-1.5.3-2L3.3 7.5C2.9 8.5 2.8 9.7 2.8 12s.1 3.5.5 4.5z"/>
          </svg>
          เข้าสู่ระบบด้วย Google
        </button>
        <p class="text-center text-xs text-gray-400">ฟีเจอร์นี้ต้องการการตั้งค่า Google OAuth ก่อน</p>
        <div class="relative">
          <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-gray-100"></span></div>
          <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-3 text-gray-400">หรือเข้าสู่ระบบด้วยอีเมล</span></div>
        </div>
      </div>

      <form method="POST" class="space-y-5">
        <?php wp_nonce_field( 'land_login', 'land_login_nonce' ); ?>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">ชื่อผู้ใช้ หรือ อีเมล</label>
          <input type="text" name="username" required
                 value="<?php echo esc_attr( $_POST['username'] ?? '' ); ?>"
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:border-transparent"
                 style="--tw-ring-color:#1d4ed8;"
                 placeholder="กรอกชื่อผู้ใช้หรืออีเมล">
        </div>

        <div>
          <div class="flex items-center justify-between mb-1.5">
            <label class="text-sm font-semibold text-gray-700">รหัสผ่าน</label>
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-xs font-medium hover:underline" style="color:#1d4ed8;">ลืมรหัสผ่าน?</a>
          </div>
          <input type="password" name="password" required
                 class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:border-transparent"
                 style="--tw-ring-color:#1d4ed8;"
                 placeholder="กรอกรหัสผ่าน">
        </div>

        <div class="flex items-center gap-2">
          <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded" style="accent-color:#1d4ed8;">
          <label for="remember" class="text-sm text-gray-600">จดจำฉันไว้</label>
        </div>

        <button type="submit"
                class="w-full py-3 rounded-xl font-bold text-white text-sm hover:opacity-90 transition-opacity"
                style="background:#1d4ed8;">
          เข้าสู่ระบบ
        </button>
      </form>

      <p class="mt-6 text-center text-sm text-gray-500">
        ยังไม่มีบัญชี?
        <a href="<?php echo esc_url( home_url( '/register/' ) ); ?>" class="font-semibold hover:underline" style="color:#1d4ed8;">สมัครสมาชิกฟรี</a>
      </p>

    </div>
  </div>
</div>

<?php get_footer(); ?>

