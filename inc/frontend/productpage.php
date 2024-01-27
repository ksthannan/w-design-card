<?php 
add_action('woocommerce_before_add_to_cart_form', 'dcc_design_area', 99);
function dcc_design_area(){
    $dcc_options_shortcode = get_option( 'dcc__settings' );

    $shortcode_use = isset($dcc_options_shortcode['show_on_product_page']) ? $dcc_options_shortcode['show_on_product_page'] : 'off';
    // var_dump($shortcode_use);
    if($shortcode_use == 'on'){
        echo do_shortcode('[dcc_product_card]');
    }

}

add_shortcode('dcc_product_card', 'dcc_product_design_shortcode');
function dcc_product_design_shortcode($atts, $content = null){

    $a = shortcode_atts( array(
		'show_card' => true
	), $atts );

    $dcc_options = get_option( 'dcc__settings' );
//    Card color 
    $client_name = isset($dcc_options['dcc__text_field_0']) ? $dcc_options['dcc__text_field_0'] : 'Your Name';
	
	$dcc__black_white_one = isset($dcc_options['dcc__black_white_one']) ? $dcc_options['dcc__black_white_one'] : '#000';
	$dcc__black_white_two = isset($dcc_options['dcc__black_white_two']) ? $dcc_options['dcc__black_white_two'] : '#fff';
	$dcc__black_white_three = isset($dcc_options['dcc__black_white_three']) ? $dcc_options['dcc__black_white_three'] : '#fff';
	$dcc__black_white_four = isset($dcc_options['dcc__black_white_four']) ? $dcc_options['dcc__black_white_four'] : '#fff';
	$dcc__black_white_five = isset($dcc_options['dcc__black_white_five']) ? $dcc_options['dcc__black_white_five'] : '#fff';

    $dcc__color_one = isset($dcc_options['dcc__color_one']) ? $dcc_options['dcc__color_one'] : '#fff';
    $dcc__color_two = isset($dcc_options['dcc__color_two']) ? $dcc_options['dcc__color_two'] : '#fff';
    $dcc__color_three = isset($dcc_options['dcc__color_three']) ? $dcc_options['dcc__color_three'] : '#fff';
    $dcc__color_four = isset($dcc_options['dcc__color_four']) ? $dcc_options['dcc__color_four'] : '#fff';
    $dcc__color_five = isset($dcc_options['dcc__color_five']) ? $dcc_options['dcc__color_five'] : '#fff';
    $dcc__color_qrborder = isset($dcc_options['dcc__color_qrborder']) ? $dcc_options['dcc__color_qrborder'] : '#fff';

// QR border color 
    $dcc_qrcolor_one = isset($dcc_options['dcc__qrcolor_one']) ? $dcc_options['dcc__qrcolor_one'] : '#000000';
    $dcc_qrcolor_two = isset($dcc_options['dcc__qrcolor_two']) ? $dcc_options['dcc__qrcolor_two'] : '#4423BD';
    $dcc_qrcolor_three = isset($dcc_options['dcc__qrcolor_three']) ? $dcc_options['dcc__qrcolor_three'] : '#00BFFF';
    $dcc_qrcolor_four = isset($dcc_options['dcc__qrcolor_four']) ? $dcc_options['dcc__qrcolor_four'] : '#F0009C';
    $dcc_qrcolor_five = isset($dcc_options['dcc__qrcolor_five']) ? $dcc_options['dcc__qrcolor_five'] : '#FF0101';
    $dcc_qrcolor_six = isset($dcc_options['dcc__qrcolor_six']) ? $dcc_options['dcc__qrcolor_six'] : '#FF6E00';
    $dcc_qrcolor_seven = isset($dcc_options['dcc__qrcolor_seven']) ? $dcc_options['dcc__qrcolor_seven'] : '#46C000';

    $card_logo = isset($dcc_options['dcc__color_logo']) ? $dcc_options['dcc__color_logo'] : DCC_ASSETS . '/img/tapcon_logo_black.png';
	$card_logo_white = isset($dcc_options['dcc__color_logo_white']) ? $dcc_options['dcc__color_logo_white'] : DCC_ASSETS . '/img/tapcon_logo_white.png';
	
    $card_qr = isset($dcc_options['dcc__color_qrlimg']) ? $dcc_options['dcc__color_qrlimg'] : DCC_ASSETS . '/img/tapcon_qr.png';
	$card_qr_white = isset($dcc_options['dcc__color_qrlimg_white']) ? $dcc_options['dcc__color_qrlimg_white'] : DCC_ASSETS . '/img/tapcon_qr_white.png';
	
    $card_nfc = isset($dcc_options['dcc__color_nfc']) ? $dcc_options['dcc__color_nfc'] : DCC_ASSETS . '/img/tapcon_nfc_icon.png';
    $card_back = isset($dcc_options['dcc__color_bgdefault']) ? $dcc_options['dcc__color_bgdefault'] : DCC_ASSETS . '/img/logo.png';
	$card_back_white = isset($dcc_options['dcc__color_bgdefault_white']) ? $dcc_options['dcc__color_bgdefault_white'] : DCC_ASSETS . '/img/logo_white.png';
	

    $dcc__qrcolor_disable = isset($dcc_options['dcc__qrcolor_disable']) ? $dcc_options['dcc__qrcolor_disable'] : 'off';
    if($dcc__qrcolor_disable == 'on'){
        $qrimgborder = 'border: 3px solid #000';
        $dcc_qr_color_options = '<div class="card_color">
                                    <div class="c_qr_color">
                                        <h3>QR border color</h3>
                                        <span class="dcc_qrcolor_one" style="background:'. $dcc_qrcolor_one .'" data-ccolor="'. $dcc_qrcolor_one .'"></span>
                                        <span class="dcc_qrcolor_two" style="background:'. $dcc_qrcolor_two .'" data-ccolor="'. $dcc_qrcolor_two .'"></span>
                                        <span class="dcc_qrcolor_three" style="background:'. $dcc_qrcolor_three .'" data-ccolor="'.$dcc_qrcolor_three .'"></span>
                                        <span class="dcc_qrcolor_four" style="background:'. $dcc_qrcolor_four .'" data-ccolor="'. $dcc_qrcolor_four .'"></span>
                                        <span class="dcc_qrcolor_five" style="background:'. $dcc_qrcolor_five .'" data-ccolor="'. $dcc_qrcolor_five .'"></span>
                                        <span class="dcc_qrcolor_six" style="background:'. $dcc_qrcolor_six .'" data-ccolor="'. $dcc_qrcolor_six .'"></span>
                                        <span class="dcc_qrcolor_seven" style="background:'. $dcc_qrcolor_seven .'" data-ccolor="'. $dcc_qrcolor_seven .'"></span>
                                    </div>
                                </div>';
    }else{
        $dcc_qr_color_options = '';
        $qrimgborder = '';
    }
	
    $logoName = basename($card_logo);
    $logoext = pathinfo($logoName, PATHINFO_EXTENSION);
    $logoHtml = $logoext == 'svg' ? file_get_contents($card_logo) : '<img src="'.$card_logo.'" id="c_img_preview">';
	
	$backlogo = basename($card_back);
    $l_ext = pathinfo($backlogo, PATHINFO_EXTENSION);
    $cardbacklogo = $l_ext == 'svg' ? file_get_contents($card_back) : '<img src="'.$card_back.'">';

    $fileName = basename($card_nfc);
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $nfcHtml = $ext == 'svg' ? file_get_contents($card_nfc) : '<img src="'.$card_nfc.'">';

    ob_start();
    $dcc_card = '<div id="dcc_card" class="dcc_custom_card">';
    $dcc_card .= '';
    $dcc_card .= '
    <button id="c_design_card">'.__("Design your card", "dcc").'</button>
    <div class="c_pre_pop">
    <div class="preloader_ajax"><img src="'.DCC_ASSETS . '/img/ajax_loading.gif" class="ajax_loading"></div>
        <div class="c_pop_wrapper">
            <div class="c_pop_content">
                <div class="c_pop_head">
                    <span class="c_pop_close">X</span>
                </div>
                <div class="tabs">
                    <ul id="tabs-nav">
                        <li><a href="#tab1">'.__("Front side", "dcc").'</a></li>
                        <li><a href="#tab2">'.__("Back side", "dcc").'</a></li>
                    </ul> <!-- END tabs-nav -->
                    <div id="tabs-content">
                        <div id="tab1" class="tab-content">
                            <div class="c_left">
                                <div id="html-card-holder">
                                    <div class="dcc_card_wrap">
                                        <div class="dcc_top">
                                            <div class="dcc_logo" data-lblack="'.$card_logo.'" data-lwhite="'.$card_logo_white.'">'. $logoHtml .'</div>
                                            <div class="dcc_right_icon">'.$nfcHtml.'</div>
                                        </div>
                                        <div class="dcc_btm">
                                            <div class="dcc_title"><span class="dcctitle">'.$client_name.'</span></div>
                                            <div class="dcc_btm_qr" data-qrwhite="'.$card_qr_white.'"  data-qrblack="'.$card_qr.'"><img style="'.$qrimgborder.'" src="'.$card_qr.'"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c_right">
                                <div class="c_notify_f"></div>
                                <form id="card_input_content" action="">
                                    <div class="dcc_message">
                                        <p>'.__("The QR code will lead to your TapCon Profile. Upload a logo with a transparent background ( .png or .svg ). If not added, the TapCon logo will remain on the card.", "dcc").'</p>
                                    </div>
                                    <div class="card_color">
                                        <div class="c_color">
                                            <h3>'.__("Choose your card color", "dcc").'</h3>
                                            <span class="c_color_white" style="background:'. $dcc__color_one .'" data-ccolor="'. $dcc__color_one .'" data-elcolor="'.$dcc__black_white_one.'"></span>
                                            <span class="c_color_red" style="background:'. $dcc__color_two .'" data-ccolor="'. $dcc__color_two .'" data-elcolor="'.$dcc__black_white_two.'"></span>
                                            <span class="c_color_green" style="background:'. $dcc__color_three .'" data-ccolor="'.$dcc__color_three .'" data-elcolor="'.$dcc__black_white_three.'"></span>
                                            <span class="c_color_blue" style="background:'. $dcc__color_four .'" data-ccolor="'. $dcc__color_four .'" data-elcolor="'.$dcc__black_white_four.'"></span>
                                            <span class="c_color_five" style="background:'. $dcc__color_five .'" data-ccolor="'. $dcc__color_five .'" data-elcolor="'.$dcc__black_white_five.'"></span>
                                        </div>
                                    </div>
                                    <div class="card_text">
                                        <h3>'.__("Enter your name", "dcc").'</h3>
                                        <input type="text" name="c_input_t" id="c_input_t">
                                        <div class="cfont_size" data-size="18">
                                            <button class="c_decrease">-</button>
                                            <button class="c_increase">+</button>
                                        </div>
                                    </div>
                                    <div class="card_image">
                                        <h3>'.__("Upload image", "dcc").'</h3>
                                        <input type="file" name="c_upload_f" id="c_upload_f" accept="image/*">
                                    </div>
                                    <div class="card_preview_edit">
                                        <div class="c_pre_edi_f">
                                            <div id="dcc_cropper">
                                                <img class="image" src="' . DCC_ASSETS . '/img/back.png">
                                                <div class="button_group">
                                                    <button type="button" class="bg_crop_button"><span class="fa fa-check"></span></button>
                                                    <button type="button" class="bg_rotate_left"><span class="fa fa-undo-alt"></span></button>
                                                    <button type="button" class="bg_rotate_right"><span class="fa fa-redo-alt"></span></button>
                                                    <button type="button" class="bg_zoom_in"><span class="fa fa-search-minus"></span></button>
                                                    <button type="button" class="bg_zoom_out"><span class="fa fa-search-plus"></span></button>
                                                    <button type="button" class="bg_delete"><span class="fa fa-sync-alt"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    '.$dcc_qr_color_options.'
                                    <div class="button_row">
                                        <input id="btn_submit_front" type="button" value="'.__("Save", "dcc").'"/>
                                    </div>
                                </form>
                            </div>
                            
                            
            
                        </div>
                        <div id="tab2" class="tab-content">
                            <div class="c_left">
                                <div id="html-card-back" style="background:#fff; background-size: cover;">
                                    <div class="dcc_card_wrap dcc_logo_back" data-backblack="'.$card_back.'" data-backwhite="'.$card_back_white.'">
										'.$cardbacklogo.'
                                    </div>
                                </div>
                            </div>
                            <div class="c_right">
                                <div class="c_notify_b"></div>   
                                <form id="card_content_back" action="">
                                    <div class="dcc_message">
                                        <p>'.__("Upload your design here. If not added, the TapCon logo will remain on
                                        the card", "dcc").'</p>
                                    </div>
                                    <div class="card_image">
                                        <h3>'.__("Upload image", "dcc").'</h3>
                                        <input type="file" name="c_upload_b" id="c_upload_b" accept="image/*">
                                    </div>
                                    <div class="card_preview_edit">
                                        <div class="c_pre_edi_b">
                                            <div id="dcc_cropper">
                                                <img id="image" src="' . DCC_ASSETS . '/img/back.png">

                                                <div class="button_group">
                                                    <button type="button" id="bg_crop_button"><span class="fa fa-check"></span></button>
                                                    <button type="button" id="bg_rotate_left"><span class="fa fa-undo-alt"></span></button>
                                                    <button type="button" id="bg_rotate_right"><span class="fa fa-redo-alt"></span></button>
                                                    <button type="button" id="bg_zoom_in"><span class="fa fa-search-minus"></span></button>
                                                    <button type="button" id="bg_zoom_out"><span class="fa fa-search-plus"></span></button>
                                                    <button type="button" id="bg_delete"><span class="fa fa-sync-alt"></span></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="button_row">
                                    <input id="btn_submit_back" type="button" value="'.__("Save", "dcc").'"/>
                                    </div>
                                </form>
                            </div>
                            
                            
            
                        </div>
                    </div> <!-- END tabs-content -->
                </div> <!-- END tabs -->
                <div class="final_submit">
                    <button id="btn_submit_final">'.__("Submit", "dcc").'</button>
                </div>
				<script>
				setTimeout(function(){
					var c_card_front = localStorage.getItem("card_front");
					var c_card_back = localStorage.getItem("card_back");
					if(!c_card_front || !c_card_back){
						jQuery(".single_add_to_cart_button").prop("disabled", true);
					}
				}, 1000);
				</script>
            </div>
        </div>
    </div>
    ';
    $dcc_card .= '</div>';

    echo $dcc_card;
    $contents = ob_get_clean();
    return $contents;
}

add_action('init', 'dcc_upload');
function dcc_upload(){
 
}