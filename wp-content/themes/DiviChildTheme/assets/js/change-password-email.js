jQuery(document).ready(function(){

    // change password email
    jQuery(document).on("submit", "#set_new_password", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','set_new_password_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    // jQuery("#wp_edit_user_password_error").html("");
                    window.location.href = split_msg[2];
                }
                else{
                    // jQuery("#wp_edit_user_password_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });



    // claim pro
    jQuery(document).on("submit", "#claim_pro", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','claim_pro_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // alert(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    jQuery('#claim_pro').trigger("reset");
                }
                else{
                    jQuery("#wp_claim_pro_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });
});