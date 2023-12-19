jQuery(document).ready(function(){
    jQuery(document).on("submit", "#registerform", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','custom_user_regitration_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.register-container').css('display', "none");
                    jQuery('.login-container').css('display', "flex");
                    // window.location = split_msg[1];
                }
                else{
                    jQuery("#wp_register_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });
});