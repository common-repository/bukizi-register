<?php
namespace BukiziRegistration;

if ( ! defined( 'ABSPATH' ) ) exit;

class Bukizi_RegisterSetting {
	protected $option;
	protected $option_group = 'bukizi_register_group';

	public function __construct() {
		$this->plugin_slug = 'bukizi-register';
		$this->option = get_option('bukizi_register_setting');
		//Add Menu
		add_action('admin_menu', function() {
			add_submenu_page(
				'options-general.php',
				'Bukizi Register Settings',
				'Thiết lập đăng ký Bukizi',
				'manage_options',
				'bukizi_register',
				[$this, 'bukizi_create_page']
			);
    });		
        
    add_action('admin_enqueue_scripts', function() {
			wp_enqueue_script( 'bukizi-react-script', BUKIZI_REGISTRATION_PLUGIN_URL . '/dist/bundle.js', '', '1.0.1' );

			wp_localize_script( 'bukizi-react-script', 'wpr_object', array(
				'api_nonce'   => wp_create_nonce( 'wp_rest' ),
				'api_url'	  => rest_url( $this->plugin_slug . '/v1/' ),
				)
			);
		});
  }

	public function bukizi_create_page() {
		?>
			<div id="bukizi-root"></div>
		<?php
	}
}
