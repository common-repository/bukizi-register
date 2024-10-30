<?php
/**
 * Plugin Name: Bukizi Register
 * Plugin URI: https://stgsolution.com
 * Description: Cung cấp chức năng đăng ký khóa học trực tiếp cho học viên từ trang wordpress của bạn
 * Version: 1.0.3
 * Author: STG Solution
 */
namespace BukiziRegistration;

if ( ! defined( 'ABSPATH' ) ) exit;

define('BUKIZI_REGISTRATION_VERSION', '1.0.3');
define('BUKIZI_REGISTRATION_MINIMUM_WP_VERSION', '4.1.1');
define('BUKIZI_REGISTRATION_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BUKIZI_REGISTRATION_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once(BUKIZI_REGISTRATION_PLUGIN_DIR . 'includes/class.bukizi-register-setting.php');
require_once(BUKIZI_REGISTRATION_PLUGIN_DIR . 'includes/class.bukizi-register.php');
require_once(BUKIZI_REGISTRATION_PLUGIN_DIR . 'includes/class.bukizi-register-view.php');
require_once(BUKIZI_REGISTRATION_PLUGIN_DIR . 'includes/class.bukizi-rest-api.php');



$bukizi = new Bukizi_Register();