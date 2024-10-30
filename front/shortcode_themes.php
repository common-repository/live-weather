<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('oc_weather_shortcode')) {

  	class oc_weather_shortcode {

    	protected static $weather;

    	function weather_themes($atts, $content = null) {
    		extract(shortcode_atts(array(
				'city'=>'surat',
				'text_color'=>'#fff',
				'background_color'=>'#222',
				'template'=>'1',
			)
			,$atts));
     
      		ob_start();
     
      		switch ($template) {
			    case "1":
			        include('weather_shortcode/weather_shortcode_themes1.php');
			        break;
				case "2":
					include('weather_shortcode/weather_shortcode_themes2.php');
					break;
				case "3":
					include('weather_shortcode/weather_shortcode_themes3.php');
					break;
			    default:
			        echo "not select themes";
			}

      		return $code = ob_get_clean();

    	}

	    function init() {
	      	add_shortcode( 'oc_weather', array($this,'weather_themes'));
	    }

	    public static function weather() {
		    if (!isset(self::$weather)) {
		        self::$weather = new self();
		        self::$weather->init();
		    }
	      	return self::$weather;
	    }

  	}

oc_weather_shortcode::weather();
}