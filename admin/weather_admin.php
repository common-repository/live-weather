<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('oc_admin_weather')) {

	class oc_admin_weather{
		protected static $weather;
			function weather_admin() {
			    register_widget( 'weather_widget' );
			}

			function init() {
		      add_action( 'widgets_init', array($this, 'weather_admin') );
		    }

		public static function weather() {

	    	if (!isset(self::$weather)) {
	        	self::$weather = new self();
	        	self::$weather->init();
	      	}
	      	return self::$weather;
	    }
	}

oc_admin_weather::weather();
}	






class weather_widget extends WP_Widget {

    public function __construct() {
    	$widget_ops = array( 
		'classname' => 'my_widget',
		'description' => 'A plugin for Kinsta blog readers',
		);
		parent::__construct( 'my_widget', 'weather', $widget_ops );
    }

    public function form( $instance ) {
    	$defaults = array(
		'City'    => '',
		'color'  => '',
		'text_color'=>'',
		'themes'=>'',
		);
	
	extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'City' ) ); ?>"><?php _e( 'City', 'city' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'City' ) ); ?>" type="text" value="<?php echo esc_attr( $City ); ?>" /><br/>

		<label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php _e( 'Background-color', 'background_color' ); ?></label>
		<input class="widefat" type="color" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>" value="<?php echo esc_attr( $color ); ?>"><br/>

		<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php _e( 'Text-color', 'text_color' ); ?></label>
		<input class="widefat" type="color" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" value="<?php echo esc_attr( $text_color ); ?>"><br/>

		<label for="<?php echo esc_attr( $this->get_field_id( 'themes' ) ); ?>"><?php _e( 'Themes', 'themes' ); ?></label>
		<select id="<?php echo $this->get_field_id('themes'); ?>" name="<?php echo $this->get_field_name('Themes'); ?>" class="widefat">
		    <option <?php selected( $instance['themes'], '1'); ?> value="1">Themes 1</option>
		    <option <?php selected( $instance['themes'], '2'); ?> value="2">Themes 2</option> 
		    <option <?php selected( $instance['themes'], '3'); ?> value="3">Themes 3</option>
		</select>
	</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['City']    = isset( $new_instance['City'] ) ? wp_strip_all_tags( $new_instance['City'] ) : '';
		$instance['color']   = isset( $new_instance['color']) ? wp_strip_all_tags( $new_instance['color'] ) : '';
		$instance['text_color']=isset( $new_instance['text_color'] )? wp_strip_all_tags( $new_instance['text_color'] ):'';
		$instance['themes']=isset( $new_instance['themes'] )? wp_strip_all_tags( $new_instance['themes'] ):'';
		return $instance;
	}

    public function widget( $args, $instance ) {
    	echo $args['before_widget'];

    	$themes = isset( $instance['themes'] ) ? $instance['themes'] : '';

    	switch ($themes) 
    	{
		    case "1":
		        include('weather_themes/themes1.php');
		        break;
		    case "2":
		        include('weather_themes/themes2.php');
		        break;
		    case "3":
		        include('weather_themes/themes3.php');
		        break;
		    default:
		        echo "no select themes";
		}
    	

		echo $args['after_widget'];
    }
}

?>