// const btn = document.querySelector(".submit-rating");
// const thanksmsg = document.querySelector(".thanks-msg");
// const starRating = document.querySelector(".star-input");
// // Success msg show/hide
// btn.onclick = () => {
//     starRating.style.display = "none";
//     thanksmsg.style.display = "table";
//     return false;
// };

// Very simple JS for updating the text when a radio button is clicked
// const INPUTS = document.querySelectorAll('#smileys input');
// const updateValue = e => document.querySelector('#result').innerHTML = e.target.value;

// INPUTS.forEach(el => el.addEventListener('click', e => updateValue(e)));



jQuery(document).ready(function(){

    
    
    let formdata = new FormData();
    formdata.append('action','check_user_loggedin_action');
    jQuery.ajax({
        type: "post",
        data : formdata,
        url: opt.ajaxUrl,
        success: function(msg){
            jQuery("#normal_visible .et_pb_column_4_tb_header #signup_btn").css("opacity", "1");
            jQuery("#normal_visible .et_pb_column_4_tb_header #signin_btn").css("opacity", "1");
            let split_msg = msg.split("|");
            if(split_msg[0] == "login"){
                jQuery("#normal_visible .et_pb_column_4_tb_header #signup_btn").attr('href',split_msg[1]);
                jQuery("#normal_visible .et_pb_column_4_tb_header #signup_btn").text("Dashboard");
                // mobile menu
                jQuery("#menu-mobile-menu li:nth-last-of-type(2)").find("a").attr('href',split_msg[1]);
                jQuery("#menu-mobile-menu li:nth-last-of-type(2)").find("a").text("Dashboard");
                jQuery("#responsive_visible #mobile_menu2 li:nth-last-of-type(2)").find("a").attr('href',split_msg[1]);
                jQuery("#responsive_visible #mobile_menu2 li:nth-last-of-type(2)").find("a").text("Dashboard");



                jQuery("#normal_visible .et_pb_column_4_tb_header #signin_btn").attr('href' ,split_msg[2]);
                jQuery("#normal_visible .et_pb_column_4_tb_header #signin_btn").text("Logout");
                // mobile menu
                jQuery("#menu-mobile-menu li:last-child").find("a").attr('href',split_msg[2]);
                jQuery("#menu-mobile-menu li:last-child").find("a").text("Logout");
                jQuery("#responsive_visible #mobile_menu2 li:last-child").find("a").attr('href',split_msg[2]);
                jQuery("#responsive_visible #mobile_menu2 li:last-child").find("a").text("Logout");
				
				
				
// 				Need to work here (only edit these lines)
				if(split_msg[3] == "evaluator"){
				   	jQuery("#normal_visible #menu-main-menu li:nth-of-type(3)").css('display','block !important');
					jQuery("#responsive_visible #menu-mobile-menu li:nth-of-type(3)").css('display','block !important');
					jQuery("#responsive_visible #mobile_menu2 li:nth-of-type(3)").css('display','block !important');
				}
// 				End
				
				
				
            }
            // alert(msg)
        },
        cache: false,
        contentType: false,
        processData: false
    });



    jQuery("#signup_btn").attr("href", "#");
    jQuery("body #page-container .et_pb_section .et_pb_button_0_tb_header.header_btns").attr("href", "#");


    var url_string = window.location.href; //window.location.href
    var url = new URL(url_string);
    var check_login_attemp = url.searchParams.get("login");

    // Modal Show/Hide

    // detail rating
    jQuery('.add-detail-rating').on('click',function(){
        if (jQuery(this).hasClass('disabled_btn')) {
            jQuery('.custom-alert-box .alert-primary').text("Sorry you have to login to add ratings");
            jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
        }
        else if(jQuery(this).hasClass('professional')){
            jQuery('.custom-alert-box .alert-primary').text("Sorry! Professionals can't rate another professional");
            jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
        }
        else {
            let pro_id = jQuery(this).attr('pro-id');
            jQuery('.detailed-rating-pro-id').val(pro_id);
            jQuery('.detailed-rating-container').css('display', "flex");
        }
    });
    jQuery('.detailed-rating-container .close_model').on('click',function(){
        jQuery('.detailed-rating-container').css('display', "none");
    });
    jQuery('.update-detailed-rating-container .close_model').on('click',function(){
        jQuery('.update-detailed-rating-container').css('display', "none");
    });


    // quick rating
    jQuery('.add-quick-rating').on('click',function(){
        if (jQuery(this).hasClass('disabled_btn')) {
            jQuery('.custom-alert-box .alert-primary').text("Sorry you have to login to add ratings");
            jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
        }
        else if(jQuery(this).hasClass('professional')){
            jQuery('.custom-alert-box .alert-primary').text("Sorry! Professionals can't rate another professional");
            jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
        }
        else {
            let pro_id = jQuery(this).attr('pro-id');
            jQuery('.quick-rating-pro-id').val(pro_id);
            jQuery('.quick-rating-container').css('display', "flex");
        }
    });
    jQuery('.quick-rating-container .close_model').on('click',function(){
        jQuery('.quick-rating-container').css('display', "none");
    });


    // suggest pro
    jQuery('.suggest_professionals').on('click',function(){
        if (jQuery(this).hasClass('disabled_btn')) {
            jQuery('.custom-alert-box .alert-primary').text("Sorry you have to login to suggest professional");
            jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
        }
        else if(jQuery(this).hasClass('professional')){
            jQuery('.custom-alert-box .alert-primary').text("Sorry! Professionals can't suggest another professional");
            jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
        }
        else {
            jQuery('.suggest-pro-container').css('display', "flex");
        }
    });
	jQuery("#normal_visible #menu-main-menu li:nth-of-type(3)").on('click',function(){
		jQuery('.suggest-pro-container').css('display', "flex");
	});
	jQuery("#responsive_visible #menu-mobile-menu li:nth-of-type(3)").on('click',function(){
		jQuery('.suggest-pro-container').css('display', "flex");
	});
	jQuery("#responsive_visible #mobile_menu2 li:nth-of-type(3)").on('click',function(){
		jQuery('.suggest-pro-container').css('display', "flex");
	});
    jQuery('.suggest-pro-container .close_model').on('click',function(){
        jQuery('.suggest-pro-container').css('display', "none");
    });


    // Donate open close
    jQuery('body #page-container .et_pb_section .et_pb_button_0_tb_header.header_btns').on('click',function(){
        jQuery('.donate-container').css('display', "flex");
    });
    jQuery('.donate-container .close_model').on('click',function(){
        jQuery('.donate-container').css('display', "none");
    });

    


    // claim account
    jQuery('.claim-account').on('click',function(){
        let claim_pro_id = jQuery(this).attr('pro-id');
        jQuery('#claim_pro_id').val(claim_pro_id);
        jQuery('.claim-pro-container').css('display', "flex");
    });
    jQuery('.claim-pro-container .close_model').on('click',function(){
        jQuery('.claim-pro-container').css('display', "none");
    });


    // reply
    jQuery(document).on('click', '.reply-user-btn',function(){
        let r_id = jQuery(this).attr('r-id');
        jQuery('.reply-rating-id').val(r_id);
        jQuery('.add-reply-container').css('display', "flex");
    });
    jQuery('.add-reply-container .close_model').on('click',function(){
        jQuery('.add-reply-container').css('display', "none");
    });


    // sign in
    jQuery('#signin_btn').on('click',function(){
        jQuery('.login-container').css('display', "flex");
    });
    jQuery('#menu-mobile-menu li:last-child').on('click',function(e){
        e.preventDefault();
        jQuery('.login-container').css('display', "flex");
    });
    jQuery(document).on('click', '#responsive_visible #mobile_menu2 li:last-child',function(e){
        e.preventDefault();
        jQuery('.login-container').css('display', "flex");
    });
    jQuery(document).on('click', '.signin-register',function(e){
        e.preventDefault();
        jQuery('.login-container').css('display', "none");
        jQuery('.register-container').css('display', "flex");
    });
    if(check_login_attemp == "failed" || check_login_attemp == "empty"){
        jQuery('.login-container').css('display', "flex");
    }
    jQuery('.login-container .close_model').on('click',function(){
        jQuery('.login-container').css('display', "none");
    });


    // signup
    jQuery('#signup_btn').on('click',function(){
        let href = jQuery(this).attr('href');
        if(href == "#"){
            jQuery('.register-container').css('display', "flex");
        }
        
    });
    jQuery(document).on('click', '#menu-mobile-menu li:nth-last-of-type(2)',function(){
        let href = jQuery(this).find('a').attr('href');
        if(href == "#"){
            jQuery('.register-container').css('display', "flex");
        }
        
    });
    jQuery(document).on('click', '#responsive_visible #mobile_menu2 li:nth-last-of-type(2)',function(){
        let href = jQuery(this).find('a').attr('href');
        if(href == "#"){
            jQuery('.register-container').css('display', "flex");
        }
        
    });
    jQuery(document).on('click', '.register-signin',function(){
            jQuery('.register-container').css('display', "none");
            jQuery('.login-container').css('display', "flex");
    });
    jQuery('.register-container .close_model').on('click',function(){
        jQuery('.register-container').css('display', "none");
    });




    //Show Password
    jQuery('.togglePasword').on('click',function(){
        var attrType = jQuery(this).closest('.form-group').find("input").attr("type") === "password" ? "text" : "password";
        jQuery(this).text() === "show" ? jQuery(this).text("hide") : jQuery(this).text("show");
        jQuery(this).closest('.form-group').find("input").attr("type" , attrType);
    });
});



// toggle replies

jQuery(document).on('click', '.show-hide-cmt',function(){
    jQuery(this).text() === "Expand" ? jQuery(this).text('Collapse') : jQuery(this).text('Expand');
    jQuery(this).closest('.card').find('.reply-container').slideToggle();
});

jQuery(document).on('click', '.show-hide-cmt-front',function(){
    jQuery(this).text() === "Show Replies" ? jQuery(this).text('Hide Replies') : jQuery(this).text('Show Replies');
    jQuery(this).closest('.card').find('.reply-container').slideToggle();
});
