jQuery(document).ready(function(){

    jQuery(document).on("submit", "#add_reply", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','rating_reply_action');
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
                    jQuery('#add_reply').trigger("reset");
                    jQuery("#wp_reply_error").html("");
                    jQuery(".add-reply-container").css("display", "none");
                }
                else{
                    jQuery("#wp_reply_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });



    // hit like
    jQuery(document).on("click", ".hit-like", function(e){
        e.preventDefault();
        let formdata = new FormData();
        let r_id = jQuery(this).attr('r-id');
        let user_id = jQuery(this).attr('u-id');
        formdata.append('action','hit_like_action');
        formdata.append('r_id',r_id);
        formdata.append('user_id',user_id);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // alert(msg)
                // let split_msg = msg.split("|");
                // if(split_msg[0] == "success"){
                //     jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                //     jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                //     jQuery('#add_reply').trigger("reset");
                //     jQuery("#wp_reply_error").html("");
                // }
                // else{
                //     jQuery("#wp_reply_error").html(split_msg[1]);
                // }
                location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });


    // hit dislike
    jQuery(document).on("click", ".hit-dislike", function(e){
        e.preventDefault();
        let formdata = new FormData();
        let r_id = jQuery(this).attr('r-id');
        let user_id = jQuery(this).attr('u-id');
        formdata.append('action','hit_dislike_action');
        formdata.append('r_id',r_id);
        formdata.append('user_id',user_id);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // alert(msg)
                // let split_msg = msg.split("|");
                // if(split_msg[0] == "success"){
                //     jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                //     jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                //     jQuery('#add_reply').trigger("reset");
                //     jQuery("#wp_reply_error").html("");
                // }
                // else{
                //     jQuery("#wp_reply_error").html(split_msg[1]);
                // }
                location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });
});