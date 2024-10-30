<?php
/**
*Plugin Name: Live Weather
*Description: This plugin allows show live weather data
* Version: 1.0
* Author: Ocean Infotech
* Author URI: https://www.xeeshop.com
* Copyright: 2019 
*/

if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('OCINSTA_PLUGIN_NAME')) {
    define('OCINSTA_PLUGIN_NAME', 'Live Weather');
}
if (!defined('OCINSTA_PLUGIN_VERSION')) {
    define('OCINSTA_PLUGIN_VERSION', '1.0.0');
}
if (!defined('OCINSTA_PLUGIN_FILE')) {
    define('OCINSTA_PLUGIN_FILE', __FILE__);
}
if (!defined('OCINSTA_PLUGIN_DIR')) {
    define('OCINSTA_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCINSTA_BASE_NAME')) {
    define('OCINSTA_BASE_NAME', plugin_basename(OCINSTA_PLUGIN_FILE));
}

if (!defined('OCINSTA_DOMAIN')) {
    define('OCINSTA_DOMAIN', 'ocinsta');
}


if (!class_exists('oc_weather')) {

    class oc_weather {

    	protected static $weather;

    	 function includes() {
            include('admin/weather_admin.php');
			include('front/shortcode_themes.php');
        }

        function init() {
            add_action( 'wp_enqueue_scripts', array($this, 'register_my_style'));
        }

        function register_my_style(){
			wp_enqueue_style( 'themes1', OCINSTA_PLUGIN_DIR . '/css/themes.css', false, '1.0.0' );
            wp_enqueue_script( 'script','https://kit.fontawesome.com/a076d05399.js', false, '1.0.0' );
		}

		public static function do_activation() {
            set_transient('ocinsta-first-rating', true, MONTH_IN_SECONDS);
        }

        public static function weather() {
            if (!isset(self::$weather)) 
            {
                self::$weather = new self();
                self::$weather->init();
                self::$weather->includes();
            }
            return self::$weather;
        }
      
    }
    add_action('plugins_loaded', array('oc_weather', 'weather'));
    register_activation_hook(OCINSTA_PLUGIN_FILE, array('oc_weather', 'do_activation'));
}

?>
