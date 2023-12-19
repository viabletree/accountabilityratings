jQuery(document).ready(function(){


    // quick ratings
    jQuery(document).on("submit", "#quick_rating", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','user_quick_rating_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    jQuery('#quick_rating').trigger("reset");
                    jQuery("#wp_quick_rating_error").html("");
                    jQuery('.quick-rating-container').css('display', "none");
                }
                else{
                    jQuery("#wp_quick_rating_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    // Detailed ratings
    jQuery(document).on("submit", "#detailed_rating", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','user_detailed_rating_action');
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
                    jQuery('#detailed_rating').trigger("reset");
                    jQuery("#wp_detailed_rating_error").html("");
                    jQuery('.detailed-rating-container').css('display', "none");
                }
                else{
                    jQuery("#wp_detailed_rating_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });



    // delete rating by user
    jQuery(document).on("click", ".delete-review", function(e){
        e.preventDefault();
        let r_id = jQuery(this).attr('r-id');
        let formdata = new FormData();
        formdata.append('action','user_delete_rating_action');
        formdata.append('r_id',r_id);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // alert(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    // jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    // jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    location.reload();
                }
                else{
                    jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    
    // get rating data for update by user
    jQuery(document).on("click", ".edit-review", function(e){
        e.preventDefault();
        let r_id = jQuery(this).attr('r-id');
        let formdata = new FormData();
        formdata.append('action','user_get_data_rating_action');
        formdata.append('r_id',r_id);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                jQuery("#update_detailed_rating").html(msg);
                jQuery(".update-detailed-rating-container").css('display', 'flex');
                // console.log(msg)
                // let split_msg = msg.split("|");
                // if(split_msg[0] == "success"){
                //     jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                //     jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                //     location.reload();
                // }
                // else{
                //     jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                //     jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                // }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });



    // Detailed ratings
    jQuery(document).on("submit", "#update_detailed_rating", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','update_rating_data_action');
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
                    jQuery('#update_detailed_rating').trigger("reset");
                    jQuery("#wp_update_detailed_rating_error").html("");
                    jQuery('.update-detailed-rating-container').css('display', "none");
                }
                else{
                    jQuery("#wp_update_detailed_rating_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
