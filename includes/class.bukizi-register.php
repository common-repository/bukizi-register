<?php
namespace BukiziRegistration;

if ( ! defined( 'ABSPATH' ) ) exit;

class Bukizi_Register {
	public function __construct() {
		$bukizi_settings = new Bukizi_RegisterSetting();
		$bukizi_view = new Bukizi_RegisterView();
		$bukizi_rest_admin = Bukizi_RestApi::bukizi_get_instance();
	}

	public function bukizi_activation_hook() {
		
	}

	public function bukizi_deactivation_hook() {
	}
}