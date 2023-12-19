jQuery(document).ready(function(){


    // user edit profile
    jQuery(document).on("submit", "#edit_profile", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','user_edit_profile_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    jQuery("#wp_edit_user_profile_error").html("");
                }
                else{
                    jQuery("#wp_edit_user_profile_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    // user edit password
    jQuery(document).on("submit", "#change_password", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','user_change_pass_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    jQuery("#wp_edit_user_password_error").html("");
                    window.location.href = split_msg[2];
                }
                else{
                    jQuery("#wp_edit_user_password_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });



    // pro edit profile
    jQuery(document).on("submit", "#edit_professional_profile", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','pro_edit_profile_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    jQuery("#wp_edit_pro_profile_error").html("");
                }
                else{
                    jQuery("#wp_edit_pro_profile_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    // pro edit password
    jQuery(document).on("submit", "#change_professional_password", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','user_change_pass_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    jQuery("#wp_edit_pro_password_error").html("");
                    window.location.href = split_msg[2];
                }
                else{
                    jQuery("#wp_edit_pro_password_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});