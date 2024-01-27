<?php
/*
Plugin Name: Design Custom Card
Description: Design custom product card in woocommerce for customizable.
Version: 1.0.0
Author: Tapcon
Author URI: https://tapcon.me/
License: GPLv2
Text Domain: dcc
 */

if (!defined('ABSPATH')) {
    exit;
}


define('DCC_VERSION', '1.0.0');
define('DCC_FILE', __FILE__);
define('DCC_PATH', __DIR__);
define('DCC_URL', plugins_url('', DCC_FILE));
define('DCC_ASSETS', DCC_URL . '/assets');

require_once('inc/frontend/productpage.php');

register_activation_hook(__FILE__, 'dcc_activation');
function dcc_activation(){

}

add_action('plugins_loaded', 'dcc_init_plugin');
function dcc_init_plugin(){
	load_plugin_textdomain('dcc', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}

add_action('init', 'dcc_run');
function dcc_run(){

}



add_action('admin_enqueue_scripts', 'dcc_admin_scripts');
function dcc_admin_scripts()
{
    wp_enqueue_style('dcc-admin-style', DCC_ASSETS . '/css/dcc_admin_style.css', array(), DCC_VERSION, 'all');
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_media();
    wp_enqueue_script('dcc-admin-script', DCC_ASSETS . '/js/dcc_admin_script.js', array('jquery', 'wp-color-picker' ), DCC_VERSION, true);

}

add_action('wp_enqueue_scripts', 'dcc_frontend_scripts');
function dcc_frontend_scripts()
{
    wp_enqueue_style('dcc-style', DCC_ASSETS . '/css/dcc_style.css', array(), DCC_VERSION, 'all');

    wp_enqueue_style('dcc-cropper', DCC_ASSETS . '/css/cropper.css', array(), DCC_VERSION, 'all');

    wp_enqueue_style('dcc-fontawesome', DCC_ASSETS . '/css/all.min.css', array(), DCC_VERSION, 'all');

    wp_enqueue_script('dcc-html2canvas', DCC_ASSETS . '/js/html2canvas.min.js', array('jquery'), DCC_VERSION, true);

    wp_enqueue_script('dcc-cropper', DCC_ASSETS . '/js/cropper.js', array('jquery'), DCC_VERSION, true);

    wp_enqueue_script('dcc-script', DCC_ASSETS . '/js/dcc_script.js', array('jquery'), DCC_VERSION, true);

    wp_localize_script( 'dcc-script', 'dcc_ajax_object', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' ), 
        
        ) );

}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' );



add_action('admin_menu', 'dcc_admin_menu');
function dcc_admin_menu(){
    $parent_slug = 'woocommerce';
    $capability = 'manage_options';
    add_submenu_page($parent_slug, __('Design Custom Card', 'dcc'), esc_html('Design Custom Card Woocommerce', 'dcc'), $capability, 'design-custom-card', 'plugin_seetings');
    
}

function plugin_seetings()
{
    require_once('inc/admin/adminpage.php');
}

/***  */
add_action( 'admin_init', 'dcc__settings_init' );
function dcc__settings_init(  ) { 

	register_setting( 'dcc_plugin_opt', 'dcc__settings' );

	add_settings_section(
		'dcc__dcc_plugin_opt_section', 
		__( 'Product Page Custom Card Design Settings', 'dcc' ), 
		'dcc__settings_section_callback', 
		'dcc_plugin_opt'
	);

	add_settings_field( 
		'show_on_product_page', 
		__( 'Show on single product page before add to cart button without inserting shortcode', 'dcc' ), 
		'show_on_product_page_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);

	add_settings_field( 
		'dcc__text_field_0', 
		__( 'Default name', 'dcc' ), 
		'dcc__text_field_0_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_one', 
		__( 'Card color 1', 'dcc' ), 
		'dcc__color_one_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__black_white_one', 
		__( 'Elements when active color one', 'dcc' ), 
		'dcc__black_white_one_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_two', 
		__( 'Card color 2', 'dcc' ), 
		'dcc__color_two_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__black_white_two', 
		__( 'Elements when active color two', 'dcc' ), 
		'dcc__black_white_two_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_three', 
		__( 'Card color 3', 'dcc' ), 
		'dcc__color_three_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__black_white_three', 
		__( 'Elements when active color three', 'dcc' ), 
		'dcc__black_white_three_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_four', 
		__( 'Card color 4', 'dcc' ), 
		'dcc__color_four_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__black_white_four', 
		__( 'Elements when active color four', 'dcc' ), 
		'dcc__black_white_four_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_five', 
		__( 'Card color 5', 'dcc' ), 
		'dcc__color_five_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__black_white_five', 
		__( 'Elements when active color five', 'dcc' ), 
		'dcc__black_white_five_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	
    // border and icon color 
	add_settings_field( 
		'dcc__qrcolor_one', 
		__( 'QR color 1', 'dcc' ), 
		'dcc__qrcolor_one_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_two', 
		__( 'QR color 2', 'dcc' ), 
		'dcc__qrcolor_two_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_three', 
		__( 'QR color 3', 'dcc' ), 
		'dcc__qrcolor_three_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_four', 
		__( 'QR color 4', 'dcc' ), 
		'dcc__qrcolor_four_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_five', 
		__( 'QR color 5', 'dcc' ), 
		'dcc__qrcolor_five_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_six', 
		__( 'QR color 6', 'dcc' ), 
		'dcc__qrcolor_six_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_seven', 
		__( 'QR color 7', 'dcc' ), 
		'dcc__qrcolor_seven_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);

	add_settings_field( 
		'dcc__color_qrborder', 
		__( 'QR Code Border Color', 'dcc' ), 
		'dcc__color_qrborder_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);

	add_settings_field( 
		'dcc__color_logo', 
		__( 'Card Logo Upload', 'dcc' ), 
		'dcc__color_logo_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_logo_white', 
		__( 'Card White Logo Upload', 'dcc' ), 
		'dcc__color_logo_white_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_qrlimg', 
		__( 'QR Image Upload', 'dcc' ), 
		'dcc__color_qrlimg_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_qrlimg_white', 
		__( 'QR White Image Upload', 'dcc' ), 
		'dcc__color_qrlimg_white_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__qrcolor_disable', 
		__( 'Enable QR code border color options', 'dcc' ), 
		'dcc__qrborderdis_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_nfc', 
		__( 'NFC Icon Upload (svg for color changing feature)', 'dcc' ), 
		'dcc__color_nfc_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
	add_settings_field( 
		'dcc__color_bgdefault', 
		__( 'Back side default Logo Upload', 'dcc' ), 
		'dcc__color_bgdefault_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);
		add_settings_field( 
		'dcc__color_bgdefault_white', 
		__( 'Back side default White Logo Upload', 'dcc' ), 
		'dcc__color_bgdefault_white_render', 
		'dcc_plugin_opt', 
		'dcc__dcc_plugin_opt_section' 
	);


}


function show_on_product_page_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input type='checkbox' name='dcc__settings[show_on_product_page]' <?php echo isset($options['show_on_product_page']) ? 'checked' : ''; ?>>
	<?php

}



function dcc__text_field_0_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input type='text' name='dcc__settings[dcc__text_field_0]' value='<?php echo $options['dcc__text_field_0']; ?>'>
	<?php

}

function dcc__color_one_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-one" type='text' name='dcc__settings[dcc__color_one]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__color_one']) ? $options['dcc__color_one'] : '#000'; ?>'>
	<?php
}
function dcc__black_white_one_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-one-control" type='text' name='dcc__settings[dcc__black_white_one]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__black_white_one']) ? $options['dcc__black_white_one'] : '#fff'; ?>'>
	<?php
}

function dcc__color_two_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-two" type='text' name='dcc__settings[dcc__color_two]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__color_two']) ? $options['dcc__color_two'] : '#81d742'; ?>'>
	<?php
}
function dcc__black_white_two_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-two-control" type='text' name='dcc__settings[dcc__black_white_two]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__black_white_two']) ? $options['dcc__black_white_two'] : '#fff'; ?>'>
	<?php
}

function dcc__color_three_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-three" type='text' name='dcc__settings[dcc__color_three]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__color_three']) ? $options['dcc__color_three'] : '#1e73be'; ?>'>
	<?php
}
function dcc__black_white_three_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-three-control" type='text' name='dcc__settings[dcc__black_white_three]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__black_white_three']) ? $options['dcc__black_white_three'] : '#fff'; ?>'>
	<?php
}

function dcc__color_four_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-four" type='text' name='dcc__settings[dcc__color_four]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__color_four']) ? $options['dcc__color_four'] : '#dd9933'; ?>'>
	<?php
}
function dcc__black_white_four_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-four-control" type='text' name='dcc__settings[dcc__black_white_four]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__black_white_four']) ? $options['dcc__black_white_four'] : '#fff'; ?>'>
	<?php
}

function dcc__color_five_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-five" type='text' name='dcc__settings[dcc__color_five]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__color_five']) ? $options['dcc__color_five'] : '#FF0101'; ?>'>
	<?php
}
function dcc__black_white_five_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-five-control" type='text' name='dcc__settings[dcc__black_white_five]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__black_white_five']) ? $options['dcc__black_white_five'] : '#fff'; ?>'>
	<?php
}

function dcc__color_qrborder_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-qrborder" type='text' name='dcc__settings[dcc__color_qrborder]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__color_qrborder']) ? $options['dcc__color_qrborder'] : '#333'; ?>'>
	<?php

}

function dcc__color_logo_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-logo" type='text' name='dcc__settings[dcc__color_logo]'  value='<?php echo isset($options['dcc__color_logo']) ? $options['dcc__color_logo'] : DCC_ASSETS . '/img/tapcon_logo_black.png'; ?>'>
    <img class="dcc_logo_preview" width="" height="100" src="<?php echo isset($options['dcc__color_logo']) ? $options['dcc__color_logo'] : DCC_ASSETS . '/img/tapcon_logo_black.png'; ?>" alt="">
	<?php

}

function dcc__color_logo_white_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-logo-white" type='text' name='dcc__settings[dcc__color_logo_white]'  value='<?php echo isset($options['dcc__color_logo_white']) ? $options['dcc__color_logo_white'] : DCC_ASSETS . '/img/tapcon_logo_white.png'; ?>'>
    <img class="dcc_logo_preview" width="" height="100" src="<?php echo isset($options['dcc__color_logo_white']) ? $options['dcc__color_logo_white'] : DCC_ASSETS . '/img/tapcon_logo_white.png'; ?>" alt="">
	<?php

}
function dcc__color_qrlimg_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-qrlimg" type='text' name='dcc__settings[dcc__color_qrlimg]'  value='<?php echo isset($options['dcc__color_qrlimg']) ? $options['dcc__color_qrlimg'] : DCC_ASSETS . '/img/tapcon_qr.png'; ?>'>
    <img class="dcc_qrlimg_preview" width="" height="100" src="<?php echo isset($options['dcc__color_qrlimg']) ? $options['dcc__color_qrlimg'] : DCC_ASSETS . '/img/tapcon_qr.png'; ?>" alt="">
	<?php
}
function dcc__color_qrlimg_white_render(  ) { 
	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-qrlimg-white" type='text' name='dcc__settings[dcc__color_qrlimg_white]'  value='<?php echo isset($options['dcc__color_qrlimg_white']) ? $options['dcc__color_qrlimg_white'] : DCC_ASSETS . '/img/tapcon_qr_white.png'; ?>'>
    <img class="dcc_qrlimg_preview_white" width="" height="100" src="<?php echo isset($options['dcc__color_qrlimg']) ? $options['dcc__color_qrlimg'] : DCC_ASSETS . '/img/tapcon_qr_white.png'; ?>" alt="">
	<?php
}

function dcc__qrborderdis_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input type='checkbox' name='dcc__settings[dcc__qrcolor_disable]' <?php echo isset($options['dcc__qrcolor_disable']) ? 'checked' : ''; ?>>
	<?php

}

function dcc__color_nfc_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-nfc" type='text' name='dcc__settings[dcc__color_nfc]'  value='<?php echo isset($options['dcc__color_nfc']) ? $options['dcc__color_nfc'] : DCC_ASSETS . '/img/tapcon_nfc_icon.png'; ?>'>
    <img class="dcc_nfc_preview" width="" height="100" src="<?php echo isset($options['dcc__color_nfc']) ? $options['dcc__color_nfc'] : DCC_ASSETS . '/img/tapcon_nfc_icon.png'; ?>" alt="">
	<?php

}
function dcc__color_bgdefault_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-bgdefault" type='text' name='dcc__settings[dcc__color_bgdefault]'  value='<?php echo isset($options['dcc__color_bgdefault']) ? $options['dcc__color_bgdefault'] : DCC_ASSETS . '/img/back.png'; ?>'>
    <img class="dcc_bgdefault_preview" width="" height="100" src="<?php echo isset($options['dcc__color_bgdefault']) ? $options['dcc__color_bgdefault'] : DCC_ASSETS . '/img/back.png'; ?>" alt="">
	<?php

}
function dcc__color_bgdefault_white_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_color-bgdefault-white" type='text' name='dcc__settings[dcc__color_bgdefault_white]'  value='<?php echo isset($options['dcc__color_bgdefault_white']) ? $options['dcc__color_bgdefault_white'] : DCC_ASSETS . '/img/back_white.png'; ?>'>
    <img class="dcc_bgdefault_white_preview" width="" height="100" src="<?php echo isset($options['dcc__color_bgdefault_white']) ? $options['dcc__color_bgdefault_white'] : DCC_ASSETS . '/img/back_white.png'; ?>" alt="">
	<?php

}

// qr code color 
function dcc__qrcolor_one_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-one" type='text' name='dcc__settings[dcc__qrcolor_one]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_one']) ? $options['dcc__qrcolor_one'] : '#000000'; ?>'>
	<?php
}
function dcc__qrcolor_two_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-two" type='text' name='dcc__settings[dcc__qrcolor_two]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_two']) ? $options['dcc__qrcolor_two'] : '#4423BD'; ?>'>
	<?php
}
function dcc__qrcolor_three_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-three" type='text' name='dcc__settings[dcc__qrcolor_three]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_three']) ? $options['dcc__qrcolor_three'] : '#00BFFF'; ?>'>
	<?php
}
function dcc__qrcolor_four_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-four" type='text' name='dcc__settings[dcc__qrcolor_four]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_four']) ? $options['dcc__qrcolor_four'] : '#F0009C'; ?>'>
	<?php
}
function dcc__qrcolor_five_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-five" type='text' name='dcc__settings[dcc__qrcolor_five]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_five']) ? $options['dcc__qrcolor_five'] : '#FF0101'; ?>'>
	<?php
}
function dcc__qrcolor_six_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-six" type='text' name='dcc__settings[dcc__qrcolor_six]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_six']) ? $options['dcc__qrcolor_six'] : '#FF6E00'; ?>'>
	<?php
}
function dcc__qrcolor_seven_render(  ) { 

	$options = get_option( 'dcc__settings' );
	?>
	<input class="dcc_qrcolor-seven" type='text' name='dcc__settings[dcc__qrcolor_seven]'  data-default-color="#effeff"  value='<?php echo isset($options['dcc__qrcolor_seven']) ? $options['dcc__qrcolor_seven'] : '#46C000'; ?>'>
	<?php
}


function dcc__settings_section_callback(  ) { 

	echo __( 'Shortcode: <b>[dcc_product_card]</b>', 'dcc' );

}
/*** */


// Ajax action 
function c_process_card(){
    // $imgData = $_POST['newData'];
    //     $files = '';
    //     $post_id = '';
    //     $caption = '';
    //     require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    //     require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    //     require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    
    //       $attachment_id = media_handle_upload($files, $post_id);
    
    //    $attachment_url = wp_get_attachment_url($attachment_id);
    //     add_post_meta($post_id, '_file_paths', $attachment_url);
    
    //       $attachment_data = array(
    //       'ID' => $attachment_id,
    //       'post_excerpt' => $caption
    //     );
    
    //     wp_update_post($attachment_data);



    $img = $_POST['cardImg'];
    $imgBg = $_POST['cardImgBg'];
    $upload_dir = wp_upload_dir();

    // img1
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $f_name = "/dcc_card_" . strtotime('now') .".png";
    $f_path = $upload_dir['path'] . $f_name;
    $fp = fopen($f_path,"wb");
    $fw = fwrite($fp,$data);
    fclose($fp);

    // img2
    $imgBg = str_replace('data:image/png;base64,', '', $imgBg);
    $imgBg = str_replace(' ', '+', $imgBg);
    $dataBg = base64_decode($imgBg);
    $f_name_bg = "/dcc_card_bg_" . strtotime('now') .".png";
    $f_path_bg = $upload_dir['path'] . $f_name_bg;
    $fp_bg = fopen($f_path_bg,"wb");
    $fw_bg = fwrite($fp_bg,$dataBg);
    fclose($fp_bg);


    $json_result = json_encode(array(
        array(
            "card"=> "front",
            "file_uploaded"=> "success",
            "file_path"=> $upload_dir['url'],
            "file_name"=> $f_name,
        ),
        array(
            "card"=> "back",
            "file_uploaded"=> "success",
            "file_path"=> $upload_dir['url'],
            "file_name"=> $f_name_bg,
        )
    ));
    echo $json_result;
    wp_die();
}
add_action( 'wp_ajax_nopriv_c_process_card', 'c_process_card' );
add_action( 'wp_ajax_c_process_card', 'c_process_card' );

 /**
 * Add data to cart item
 */
add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_data', 25, 2 );
function add_cart_item_data( $cart_item_meta, $product_id ) {

    if ( isset( $_POST ['card_back_part'] ) && isset( $_POST ['card_front_part'] ) ) {
        $custom_data  = array() ;
        $custom_data [ 'card_front_part' ] = isset( $_POST ['card_front_part'] ) ?  sanitize_text_field ( $_POST ['card_front_part'] ) : "" ;
        $custom_data [ 'card_back_part' ] = isset( $_POST ['card_back_part'] ) ? sanitize_text_field ( $_POST ['card_back_part'] ): "" ;
        $cart_item_meta ['custom_data']     = $custom_data ;
    }

    return $cart_item_meta;
}

/**
 * Display custom data on cart and checkout page.
 */
add_filter( 'woocommerce_get_item_data', 'get_item_data' , 25, 2 );
function get_item_data ( $other_data, $cart_item ) {
    if ( isset( $cart_item [ 'custom_data' ] ) ) {
        $custom_data  = $cart_item [ 'custom_data' ];

        $other_data[] = array( 'name' => 'Front Part', 'display'  => '<img width="80" height="" src="' . $custom_data['card_front_part'] . '">' );
        $other_data[] = array( 'name' => 'Back Part', 'display'  => '<img width="80" height="" src="' . $custom_data['card_back_part'] . '">' );
    }

    return $other_data;
}

/**
 * Add order item meta.
 */
add_action( 'woocommerce_add_order_item_meta', 'add_order_item_meta' , 10, 2);
function add_order_item_meta ( $item_id, $values ) {
    if ( isset( $values [ 'custom_data' ] ) ) {
        $custom_data  = $values [ 'custom_data' ];
        wc_add_order_item_meta( $item_id, 'Front Part', '<a target="_blank" href="'.$custom_data['card_front_part'].'"><img width="80" height="" src="' . $custom_data['card_front_part'] . '"></a>' );
        wc_add_order_item_meta( $item_id, 'Back Part', '<a target="_blank" href="'.$custom_data['card_back_part'].'"><img width="80" height="" src="' . $custom_data['card_back_part'] . '"></a>' );
    }
}