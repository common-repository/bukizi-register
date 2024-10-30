<?php
namespace BukiziRegistration;

if ( ! defined( 'ABSPATH' ) ) exit;

class Bukizi_RegisterView {
	public function __construct() {		
		if(!function_exists('add_shortcode')) {
			return;
		}

		add_shortcode( 'register' , [$this, 'bukizi_shortcode_fn'] );

		add_action('wp_enqueue_scripts', function() {
			wp_enqueue_script( 'react-script', BUKIZI_REGISTRATION_PLUGIN_URL . 'dist/bundle.js', array(
				'jquery',
				'wp-element'
			), '1.0.1' );
		});
	}

	function bukizi_register_course($atts = array(), $content = null) {
		extract(shortcode_atts(array('course' => null, 'type' => 'personal', 'title' => null, 'color' => null), $atts));
		if ($course) {
			switch ($type) {
				case "personal": {
					?>
						<div
							class="register-personal"
							data-id="<?php echo $course ?>"
							data-type="<?php echo $type ?>"
							data-title="<?php echo $title ?>"
							data-color="<?php echo $color ?>"
						></div>
					<?php
					break;
				}
				case "group": {
					?>
						<div
							class="register-group"
							data-id="<?php echo $course ?>"
							data-type="<?php echo $type ?>"
							data-title="<?php echo $title ?>"
							data-color="<?php echo $color ?>"
						></div>
					<?php
					break;
				}
				default: break;
			}
		} else {
			?>
				<div>
					<p class="no-course">Không tìm thấy khóa học bạn yêu cầu!</p>
				</div>
			<?php
		}
  }

	function bukizi_shortcode_fn($atts = array(), $content = null) {
		ob_start();
		$this->bukizi_register_course($atts, $content);
		$register = ob_get_clean(); 
		return $register;
	}
}
