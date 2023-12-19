jQuery(document).ready(function(){

    jQuery(document).on("submit", "#suggest_pro", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','suggest_pro_action');
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
                    jQuery('#suggest_pro').trigger("reset");
                    jQuery("#wp_suggest_pro_error").html("");
                }
                else{
                    jQuery("#wp_suggest_pro_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });
});