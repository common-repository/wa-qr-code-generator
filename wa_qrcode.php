<?php
/*
Plugin Name: Wa Qrcode
Plugin URI:
Description: A plugin to QR code to Page, Post, or widget aea
Version: 1.0
Author: vivek kumar tripathi
Author URI: http://webassistance24x7@gmail.com
*/
class wa_qrcode_shortcode{
	/**
	 * $shortcode_tag 
	 * holds the name of the shortcode tag
	 * @var string
	 */
	public $shortcode_tag = 'wa_qrcode';

	/**
	 * __construct 
	 * class constructor will set the needed filter and action hooks
	 * 
	 * @param array $args 
	 */
	function __construct($args = array()){
		//add shortcode
		add_shortcode( $this->shortcode_tag, array( $this, 'shortcode_handler' ) );
		
		if ( is_admin() ){
			add_action('admin_head', array( $this, 'admin_head') );
			add_action( 'admin_enqueue_scripts', array($this , 'admin_enqueue_scripts' ) );
                         add_action( 'admin_menu', array( $this, 'qrcode_wa_add_to_menu' ));
		}
	}

function qrcode_wa_add_to_menu() 
{
	if (is_admin()) 
	{
                add_menu_page( __('QRCode WA', 'emi-calculator'),	__('QRCode WA', 'QRCodeGenerator'), 'manage_options', 'qrcode_option', array($this , 'calc_admin' ) ,'data:image/png;base64,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' );
	}
}
function calc_admin()
{
	global $wpdb;
	include('qrcodexi-help.php');
}
	/**
	 * shortcode_handler
	 * @param  array  $atts shortcode attributes
	 * @param  string $content shortcode content
	 * @return string
	 */
	function shortcode_handler($atts , $content = null){
		// Attributes
		extract( shortcode_atts(
			array(
				'alt' => 'no',
				'size' => 'no',
				'shadow' => 'no',
			), $atts )
		);
          
		 $current_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '';
                 
		//make sure the panel type is a valid styled type if not revert to default
		$panel_types = array('yes','no');
		$type = in_array($type, $panel_types)? $type: 'no';

                if (empty($content) && $content !== 0) {
        $content = urlencode($current_uri);
    } else {
        $content = urlencode(strip_tags(trim($content)));
    }
	
            if (empty($alt) && $alt !==0) {
	  $alt="Scan the QR Code";
	} else {
	  $alt = strip_tags(trim($alt));
        }
        
        if (empty($size) && $size !==0) {
	  $size = "75";
	} else {
	  $size = strip_tags(trim($size));
	}
        
         if (empty($align) && $align !==0) {
	  $align = "";
	} else {
	  $align = strip_tags(trim($align));
	}
       
         if (empty($class) && $class !==0) {
	  $class = "";
	} else {
	  $class = strip_tags(trim($class));
	}
        
	  $credit_footer = "</div>";

	
        if (!empty($shadow) && $shadow =! false or $shadow == 'yes') {
	  $preoutput = '<div class="qrshadow" style="text-align:center;width:' . $size . 'px;float:left">';
	} else {
	  $preoutput = '<div style="text-align:center;width:' . $size . 'px;float:left">';
	}
        
    $output = "";
    $image = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|1&chl=' . $content;
    if ($align == "right") {
        $align = ' align="right"';
    }
    if ($align == "left") {
        $align = ' align="left"';
    }
    if ($class != "") {
        $class = ' class="' . $class . '"';
    }

    $output = $preoutput . '<img id="qrcode_xi" src="' . $image . '" alt="' . $alt . '" width="' . $size . '" height="' . $size . '"' . $align . $class . ' />';
    
	
   return  $output . $credit_footer;
		
	}

	/**
	 * admin_head
	 * calls your functions into the correct filters
	 * @return void
	 */
	function admin_head() {
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		
		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', array( $this ,'mce_external_plugins' ) );
			add_filter( 'mce_buttons', array($this, 'mce_buttons' ) );
		}
	}

	/**
	 * mce_external_plugins 
	 * Adds our tinymce plugin
	 * @param  array $plugin_array 
	 * @return array
	 */
	function mce_external_plugins( $plugin_array ) {
		$plugin_array[$this->shortcode_tag] = plugins_url( 'js/mce-button.js' , __FILE__ );
		return $plugin_array;
	}

	/**
	 * mce_buttons 
	 * Adds our tinymce button
	 * @param  array $buttons 
	 * @return array
	 */
	function mce_buttons( $buttons ) {
		array_push( $buttons, $this->shortcode_tag );
		return $buttons;
	}

	/**
	 * admin_enqueue_scripts 
	 * Used to enqueue custom styles
	 * @return void
	 */
	function admin_enqueue_scripts(){
		 wp_enqueue_style('bs3_panel_shortcode', plugins_url( 'css/mce-button.css' , __FILE__ ) );
	}
}//end class

new wa_qrcode_shortcode();