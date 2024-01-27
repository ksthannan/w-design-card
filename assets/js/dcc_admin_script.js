(function($){
jQuery(document).ready(function($){

    $('.dcc_color-one').wpColorPicker();
	$('.dcc_color-one-control').wpColorPicker();
	
    $('.dcc_color-two').wpColorPicker();
	$('.dcc_color-two-control').wpColorPicker();
	
    $('.dcc_color-three').wpColorPicker();
	$('.dcc_color-three-control').wpColorPicker();
	
    $('.dcc_color-four').wpColorPicker();
	$('.dcc_color-four-control').wpColorPicker();
	
    $('.dcc_color-five').wpColorPicker();
	$('.dcc_color-five-control').wpColorPicker();

    $('.dcc_qrcolor-one').wpColorPicker();
    $('.dcc_qrcolor-two').wpColorPicker();
    $('.dcc_qrcolor-three').wpColorPicker();
    $('.dcc_qrcolor-four').wpColorPicker();
    $('.dcc_qrcolor-five').wpColorPicker();
    $('.dcc_qrcolor-six').wpColorPicker();
    $('.dcc_qrcolor-seven').wpColorPicker();

    $('.dcc_color-qrborder').wpColorPicker();

// 	logo black 
    logoImageUploader();
    function logoImageUploader(){
        // Logo element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-logo'),
        logo_upload = document.querySelector(".dcc_color-logo");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-logo').val(attachment.url);
                jQuery('.dcc_logo_preview').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        }); 
    }  
// logo white 
    logoWhiteImageUploader();
    function logoWhiteImageUploader(){
        // Logo element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-logo-white'),
        logo_upload = document.querySelector(".dcc_color-logo-white");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-logo-white').val(attachment.url);
                jQuery('.dcc_logo_white_preview').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        }); 
    } 
	qrImageUploader();
    function qrImageUploader(){
        // QR image element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-qrlimg'),
        logo_upload = document.querySelector(".dcc_color-qrlimg");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-qrlimg').val(attachment.url);
                jQuery('.dcc_qrlimg_preview').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        });  
    } 

    nfcImageUploader();
    function nfcImageUploader(){
        // NFC Icon element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-nfc'),
        logo_upload = document.querySelector(".dcc_color-nfc");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-nfc').val(attachment.url);
                jQuery('.dcc_nfc_preview').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        });   
    }

// 	Back black logo 
    backSideUploader();
    function backSideUploader(){
        // NFC Icon element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-bgdefault'),
        logo_upload = document.querySelector(".dcc_color-bgdefault");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-bgdefault').val(attachment.url);
                jQuery('.dcc_bgdefault_preview').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        });   
    }
// Back white logo 
    backWhitekSideUploader();
    function backWhitekSideUploader(){
        // NFC Icon element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-bgdefault-white'),
        logo_upload = document.querySelector(".dcc_color-bgdefault-white");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-bgdefault-white').val(attachment.url);
                jQuery('.dcc_bgdefault_preview_white').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        });   
    }
	
	// QR white logo 
    qrWhitekSideUploader();
    function qrWhitekSideUploader(){
        // NFC Icon element uplaoder 
        var custom_uploader
        , target = jQuery('.dcc_color-qrlimg-white'),
        logo_upload = document.querySelector(".dcc_color-qrlimg-white");
        logo_upload.addEventListener("click", function(e) {

            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();

                // target.val(attachment.url);
                // console.log(attachment.url);
                jQuery('.dcc_color-qrlimg-white').val(attachment.url);
                jQuery('.dcc_qrlimg_preview_white').attr("src", attachment.url);

            });
            //Open the uploader dialog
            custom_uploader.open();

        });   
    }
	
});
})(jQuery);