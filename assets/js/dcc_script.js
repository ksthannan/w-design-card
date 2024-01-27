(function($){
    $(document).ready(function(){
		
		localStorage.clear();

        var getCanvas; 
        var getBackCanvas;

            $("#btn_submit_front").on('click', function () {
                jQuery('.preloader_ajax').css("display", "block");
                
                // Front 
                html2canvas(document.querySelector("#html-card-holder"), {
                    scale: 10
                }).then(function(canvas) {
                    getCanvas = canvas;
                    var dccImageData = getCanvas.toDataURL("image/png");

                    localStorage.setItem("card_front", dccImageData);

                    $('#tab1 #card_input_content').css("display", "none");
                    $('#tab1 .c_right .c_notify_f').html('<p>Front side generated successfully</p><button class="re_edit_f">Edit again</button>');
					
					setTimeout(function(){
						jQuery('.preloader_ajax').css("display", "none");
					}, 300);

                });

            });

            $("#tab1 .c_right").on('click', '.re_edit_f', function () {
                $('#tab1 #card_input_content').css("display", "block");
            });
            $("#tab2 .c_right").on('click', '.re_edit_b', function () {
                $('#tab2 #card_content_back').css("display", "block");
            });

            $("#btn_submit_back").on('click', function () {
                jQuery('.preloader_ajax').css("display", "block");
                
                // Back 
                html2canvas(document.querySelector("#html-card-back"), {
                    scale: 10
                }).then(function(canvas) {
                    getBackCanvas = canvas;
                    var dccBgImageData = getBackCanvas.toDataURL("image/png");
                    
                    localStorage.setItem("card_back", dccBgImageData);
					
                    $('#tab2 #card_content_back').css("display", "none");
                    $('#tab2 .c_right .c_notify_b').html('<p>Back side generated successfully</p><button class="re_edit_b">Edit again</button>');
					
					setTimeout(function(){
						jQuery('.preloader_ajax').css("display", "none");
					}, 300);

                
                });

            });
			
			
            $('form.cart').prepend('<input type="hidden" name="card_back_part" class="card_back_part" value="">');
            $('form.cart').prepend('<input type="hidden" name="card_front_part" class="card_front_part" value="">');

            $("#btn_submit_final").on('click', function (e) {
                
                var card_front = localStorage.getItem("card_front");
                var card_back = localStorage.getItem("card_back");
                if(card_front == null || card_back == null){
                    e.preventDefault();
                    alert("Please save front and back side both");
                }else{

                    jQuery('.preloader_ajax').css("display", "block");
                    // setTimeout(function(){
                    //     jQuery('.preloader_ajax').css("display", "none");
                    // }, 1000);

                    $.ajax({    
                        type : "POST",
                        dataType : "json",
                        url : dcc_ajax_object.ajax_url,
                        data : {
                            action: "c_process_card",
                            'cardImg': card_front,
                            'cardImgBg': card_back,
                        },
                        success: function(response) {
                            setTimeout(function(){

                                var $body = $(document.body);
                                $body.css("overflow", "auto");
                                $body.width("auto");

								jQuery('.c_pre_pop').css({"display":"none"});
								jQuery('.preloader_ajax').css("display", "none");
								
							}, 1000);
                            // console.log(response[0].file_path + response[0].file_name);
                            // console.log(response[1].file_path + response[1].file_name);

                            $('.card_back_part').val(response[1].file_path + response[1].file_name);
                            $('.card_front_part').val(response[0].file_path + response[0].file_name);
							
							jQuery(".single_add_to_cart_button").prop('disabled', false);

                            localStorage.removeItem("card_front");
                            localStorage.removeItem("card_back");
							localStorage.removeItem("back_img_uploaded");
							localStorage.clear();
                            // console.log(dccBgImageData);

//                             $('.single_add_to_cart_button').click();
                            
                        },
                        error: function (xhr, status, error) {
                            console.log(error + ' ' + status);
                        },
                    });

                }

            }); 


            // $("#btn-Convert-Html2Image").on('click', function () {
            // var imgageData = getCanvas.toDataURL("image/png");
            // // Now browser starts downloading it instead of just showing it
            // var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");

            // // $("#btn-Convert-Html2Image").attr("download", "designedcard"+ Math.random() +".png").attr("href", newData);

            // });


            // Tab area scripts 
            $('#tabs-nav li:first-child').addClass('active');
            $('.tab-content').hide();
            $('.tab-content:first').show();

            // Click function
            $('#tabs-nav li').click(function(){
            $('#tabs-nav li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').hide();
            
            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn();
                return false;
            });

            // Form Scripts 

            var cfont_size = jQuery('.cfont_size').data('size');
            jQuery('.dcctitle').css({"font-size":cfont_size});
		
			var lblack = $('.dcc_logo').data('lblack');
			var lwhite = $('.dcc_logo').data('lwhite');
			var backblack = $('.dcc_logo_back').data('backblack');
			var backwhite = $('.dcc_logo_back').data('backwhite');


            jQuery('.c_color span').on('click', function(){
                var back_img_uploaded = localStorage.getItem("back_img_uploaded");
                var c_color = jQuery(this).data('ccolor');
				var c_qr_white = jQuery('.dcc_btm_qr').data('qrwhite');
				var c_qr_black = jQuery('.dcc_btm_qr').data('qrblack');
				
				var c_el_color = jQuery(this).data('elcolor');
                jQuery('#html-card-holder').css({"background-color":c_color, "color":"#fff"});
                jQuery('#html-card-back').css({"background": c_color});
				
				jQuery('#html-card-holder').css({"color":c_el_color});
				jQuery('#html-card-holder span.dcctitle').css({"color":c_el_color});
				jQuery('.dcc_card_wrap .dcc_btm_qr img').css({"border-color": c_el_color});
				jQuery('.dcc_top path').css({"fill": c_el_color});
				jQuery('.dcc_logo path').css({"fill": c_el_color});
				jQuery('.dcc_card_wrap.dcc_logo_back path').css({"fill": c_el_color});
				
                if(c_color == '#fff' || c_color == '#ffffff' || c_el_color == '#fff' || c_el_color == '#ffffff'){
					jQuery('.dcc_btm_qr img').attr('src', c_qr_black);
//                     jQuery('#html-card-holder').css({"color":"#000"});
//                     jQuery('#html-card-holder span.dcctitle').css({"color":"#000"});
//                     jQuery('.dcc_card_wrap .dcc_btm_qr img').css({"border-color": "#000"});
//                     jQuery('.dcc_top path').css({"fill": "#000"});
// 					jQuery('.dcc_logo path').css({"fill": "#000"});
// 					jQuery('.dcc_card_wrap.dcc_logo_back path').css({"fill": "#000"});
					
					if(!back_img_uploaded){
						jQuery('.dcc_card_wrap.dcc_logo_back').html('<img src="'+backblack+'">');
					}
					jQuery('.dcc_logo').html('<img src="'+lblack+'">');
// 					jQuery('.dcc_btm_qr').html('<img src="'+lblack+'">');
					
                }
				else{
					jQuery('.dcc_btm_qr img').attr('src', c_qr_white);
//                     jQuery('#html-card-holder').css({"color":"#fff"});
//                     jQuery('#html-card-holder span.dcctitle').css({"color":"#fff"});
//                     jQuery('.dcc_card_wrap .dcc_btm_qr img').css({"border-color": "#fff"});
//                     jQuery('.dcc_top path').css({"fill": "#fff"});
// 					jQuery('.dcc_logo path').css({"fill": "#fff"});
// 					jQuery('.dcc_card_wrap.dcc_logo_back path').css({"fill": "#fff"});
					
					if(!back_img_uploaded){
						jQuery('.dcc_card_wrap.dcc_logo_back').html('<img src="'+backwhite+'">');
					}
					jQuery('.dcc_logo').html('<img src="'+lwhite+'">');


                }
				
				if(c_el_color == '#000' || c_el_color == '#000000'){
						jQuery('.dcc_btm_qr img').attr('src', c_qr_black);
						 if(!back_img_uploaded){
							jQuery('.dcc_card_wrap.dcc_logo_back').html('<img src="'+backblack+'">');
						}
						jQuery('.dcc_logo').html('<img src="'+lblack+'">');
				}else{
					jQuery('.dcc_btm_qr img').attr('src', c_qr_white);
					if(!back_img_uploaded){
						jQuery('.dcc_card_wrap.dcc_logo_back').html('<img src="'+backwhite+'">');
					}
					jQuery('.dcc_logo').html('<img src="'+lwhite+'">');
				}

            });

            jQuery('.c_qr_color span').on('click', function(){
                var c_color = jQuery(this).data('ccolor');

                jQuery('.dcc_card_wrap .dcc_btm_qr img').css({"border-color":c_color});
                jQuery('.dcc_top path').css({"fill":c_color});
                

            });

            jQuery('input#c_input_t').on('change input copy paste', function(){
                var c_text = jQuery(this).val();
                jQuery('.dcctitle').html(c_text);
            });

            jQuery('.c_decrease').on('click', function(e){
                e.preventDefault();
                var c_df_size = jQuery('.cfont_size').data('size');
                if(c_df_size > 0){
                    jQuery('.dcctitle').css({"font-size":c_df_size - 2});
                    jQuery('.cfont_size').data("size", c_df_size - 2);
                }
            });
            jQuery('.c_increase').on('click', function(e){
                e.preventDefault();
                var c_if_size = jQuery('.cfont_size').data('size');
                if(c_if_size > 0){
                    jQuery('.dcctitle').css({"font-size":c_if_size + 2});
                    jQuery('.cfont_size').data("size", c_if_size + 2);
                }
            });
            jQuery('#c_design_card').on('click', function(){

                var $body = $(document.body);
                var oldWidth = $body.innerWidth();
                $body.css("overflow", "hidden");
                $body.width(oldWidth);

                // window.onbeforeunload = function() {
                //     return "Are you sure you want to leave?";
                // }

                jQuery('.c_pre_pop').css({"display":"block"});
                jQuery('.preloader_ajax').css("display", "block");
                setTimeout(function(){
                    jQuery('.preloader_ajax').css("display", "none");
                }, 1000);
            });
            jQuery('.c_pop_close').on('click', function(){

                var $body = $(document.body);
                $body.css("overflow", "auto");
                $body.width("auto");

                jQuery('.preloader_ajax').css("display", "block");
                setTimeout(function(){
                    jQuery('.preloader_ajax').css("display", "none");
                }, 1000);
                jQuery('.c_pre_pop').css({"display":"none"});
            });

            

            // Image upload 
            var fileTag = document.getElementById("c_upload_f"),
            preview = document.getElementById("c_img_preview");
            
            fileTag.addEventListener("change", function(ev) {
                jQuery('.preloader_ajax').css("display", "block");
                setTimeout(function(){
                    jQuery('.preloader_ajax').css("display", "none");
                }, 1000);
                changeImage(this);
            });

            function changeImage(input) {
                var reader;

                if (input.files && input.files[0]) {

                    reader = new FileReader();

                    reader.onload = function(e) {

//                     preview.setAttribute('src', e.target.result);
					$('.dcc_logo').html('<img src="'+e.target.result+'" id="c_img_preview">');

                    var image_f = document.querySelector('.c_pre_edi_f .image');
                    image_f.setAttribute('src', e.target.result);

                    // Crop image 
                    var minCroppedWidth = 30;
                    var minCroppedHeight = 10;
                    var maxCroppedWidth = 30000;
                    var maxCroppedHeight = 18000;
                    var cropper_f = new Cropper(image_f, {
                        viewMode: 0.5,
                        zoomable: true,
                        rotatable: true,
                        movable: true,

            
                        data: {
                            width: (minCroppedWidth + maxCroppedWidth) / 2,
                            height: (minCroppedHeight + maxCroppedHeight) / 2,
                        },
                
                        crop: function (event) {
                            var width = event.detail.width;
                            var height = event.detail.height;
                
                            if (
                            width < minCroppedWidth
                            || height < minCroppedHeight
                            || width > maxCroppedWidth
                            || height > maxCroppedHeight
                            ) {
                            cropper_f.setData({
                                width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                                height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                            });
                            }
                
                            // data.textContent = JSON.stringify(cropper.getData(true));
                        },

                    });
						
						setInterval(function(){
							var auto_canvasDataUrl = cropper_f.getCroppedCanvas();
                            var auto_logoImgUrl = auto_canvasDataUrl.toDataURL("image/png");
							jQuery('#c_img_preview').attr("src", auto_logoImgUrl);
						}, 500);

                        jQuery('.c_pre_edi_f .bg_crop_button').on('click', function(){
                            // result.innerHTML = '';
                            // result.appendChild(cropper.getCroppedCanvas());
                            var canvasDataUrl = cropper_f.getCroppedCanvas();
                            var backImgUrl = canvasDataUrl.toDataURL("image/png");

                            // back_preview.setAttribute('style', "background:url("+backImgUrl+") no-repeat scroll center center; background-size: cover;");
                            jQuery('#c_img_preview').attr("src", backImgUrl);

                            jQuery('.preloader_ajax').css("display", "block");
                            setTimeout(function(){
                                jQuery('.preloader_ajax').css("display", "none");
                            }, 1000);
                            // Front 
//                             html2canvas(document.querySelector("#html-card-holder"), {
//                                 scale: 2
//                             }).then(function(canvas) {
//                                 getCanvas = canvas;
//                                 var dccImageData = getCanvas.toDataURL("image/png");

//                                 localStorage.setItem("card_front", dccImageData);

//                             });



                        });
                        jQuery('.c_pre_edi_f .bg_rotate_left').on('click', function(){
                            cropper_f.rotate(-90);
                        });
                        jQuery('.c_pre_edi_f .bg_rotate_right').on('click', function(){
                            cropper_f.rotate(90);
                        });
                        jQuery('.c_pre_edi_f .bg_zoom_in').on('click', function(){
                            cropper_f.zoom(-0.1);
                        });
                        jQuery('.c_pre_edi_f .bg_zoom_out').on('click', function(){
                            cropper_f.zoom(0.1);
                        });
                        jQuery('.c_pre_edi_f .bg_delete').on('click', function(){
                            cropper_f.reset();
                        });

                        

                    }

                    reader.readAsDataURL(input.files[0]);
                    
                }
            }

            // Back side image 
            var b_fileTag = document.getElementById("c_upload_b"),
            back_edit = document.getElementById("image"),
            back_preview = document.getElementById("html-card-back");
            
            b_fileTag.addEventListener("change", function() {
                jQuery('.preloader_ajax').css("display", "block");
                setTimeout(function(){
                    jQuery('.preloader_ajax').css("display", "none");
                }, 1000);
                b_changeImage(this);
				
            });
		
            function b_changeImage(input) {
                var b_reader;

                if (input.files && input.files[0]) {
                    b_reader = new FileReader();

                    b_reader.onload = function(e) {
                        back_preview.setAttribute('style', "background:url("+e.target.result+") no-repeat scroll center center; ");
						localStorage.setItem("back_img_uploaded", "yes");
						
                        back_edit.setAttribute('src', e.target.result);
                        var image = document.querySelector('.c_pre_edi_b #image');
						
						$('.dcc_card_wrap.dcc_logo_back').html('');

                        // Crop image 
                        var data = document.querySelector('#data');
                        var button = document.getElementById('button');
                        var result = document.getElementById('result');
                        var minCroppedWidth = 300;
                        var minCroppedHeight = 180;
                        var maxCroppedWidth = 30000;
                        var maxCroppedHeight = 18000;
                        var cropper = new Cropper(image, {
                        viewMode: 0.5,
                        zoomable: true,
                        rotatable: true,
                        movable: true,

                
                        data: {
                            width: (minCroppedWidth + maxCroppedWidth) / 2,
                            height: (minCroppedHeight + maxCroppedHeight) / 2,
                        },
                
                        crop: function (event) {
                            var width = event.detail.width;
                            var height = event.detail.height;
                
                            if (
                            width < minCroppedWidth
                            || height < minCroppedHeight
                            || width > maxCroppedWidth
                            || height > maxCroppedHeight
                            ) {
                            cropper.setData({
                                width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                                height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                            });
                            }
                
                            // data.textContent = JSON.stringify(cropper.getData(true));
                        },
                        });
						
						
						setInterval(function(){
							var canvasDataUrl = cropper.getCroppedCanvas();
                            var backImgUrl = canvasDataUrl.toDataURL("image/png");
							back_preview.setAttribute('style', "background:url("+backImgUrl+") no-repeat scroll center center; ");
						}, 500);

                        jQuery('.c_pre_edi_b #bg_crop_button').on('click', function(){
							
                            // result.innerHTML = '';
                            // result.appendChild(cropper.getCroppedCanvas());
                            var canvasDataUrl = cropper.getCroppedCanvas();
                            var backImgUrl = canvasDataUrl.toDataURL("image/png");
                            
                            jQuery('.preloader_ajax').css("display", "block");
                            setTimeout(function(){
                                jQuery('.preloader_ajax').css("display", "none");
                            }, 1000);
							
							back_preview.setAttribute('style', "background:url("+backImgUrl+") no-repeat scroll center center; background-size: contain;");
                            // Back 
//                             html2canvas(document.querySelector("#html-card-back"), {
//                                 scale: 2
//                             }).then(function(canvas) {
//                                 getBackCanvas = canvas;
//                                 var dccBgImageData = getBackCanvas.toDataURL("image/png");
                                
//                                 localStorage.setItem("card_back", dccBgImageData);
                            
//                             });


                        });
                        jQuery('.c_pre_edi_b #bg_rotate_left').on('click', function(){
                            cropper.rotate(-90);
                        });
                        jQuery('.c_pre_edi_b #bg_rotate_right').on('click', function(){
                            cropper.rotate(90);
                        });
                        jQuery('.c_pre_edi_b #bg_zoom_in').on('click', function(){
                            cropper.zoom(-0.1);
                        });
                        jQuery('.c_pre_edi_b #bg_zoom_out').on('click', function(){
                            cropper.zoom(0.1);
                        });
                        jQuery('.c_pre_edi_b #bg_delete').on('click', function(){
                            cropper.reset();
                        });


            

                    }

                    b_reader.readAsDataURL(input.files[0]);
                }
            }
          

        
        });
})(jQuery);


