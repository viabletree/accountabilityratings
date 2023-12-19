jQuery(document).ready(function(){

    var home_url = "";

    let formdata2 = new FormData();
    formdata2.append('action','home_fill_dropdown_action');
    jQuery.ajax({
        type: "post",
        data : formdata2,
        url: opt.ajaxUrl,
        success: function(msg){
            // console.log(msg)
            let split_msg = msg.split("|");
            if(split_msg[0] == "success"){
                jQuery('.search-location-home').html(split_msg[1]);
                home_url = split_msg[2];
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });


    jQuery(document).on('click', '.search-professionals-home', function(e){
        e.preventDefault();
        let profession = jQuery(".search_profession_home").val();
        let city = jQuery(".search-location-home").val();
        window.location.href = home_url + "?profession="+profession+"&location="+city;
    });



    var url_string = window.location.href; //window.location.href
    var url = new URL(url_string);
    var check_search_pro = url.searchParams.get("profession");
    var check_search_location = url.searchParams.get("location");

    if(check_search_pro || check_search_location){
        let formdata = new FormData();
        formdata.append('action','search_professional_action');
        formdata.append('profession',check_search_pro);
        formdata.append('city',check_search_location);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // console.log(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    // window.location.href = split_msg[2];
                    // jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    // jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    // jQuery("#wp_edit_user_password_error").html("");
                    jQuery('.search_professional_results').html(split_msg[1]);
                }
                else{
                    // jQuery("#wp_edit_user_password_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }


    // search professional
    jQuery(document).on("click", ".search-professionals", function(e){
        e.preventDefault();
        let profession = jQuery("#search_profession").val();
        let city = jQuery("#search_location").val();
        let formdata = new FormData();
        formdata.append('action','search_professional_action');
        formdata.append('profession',profession);
        formdata.append('city',city);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // console.log(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    // window.location.href = split_msg[2];
                    // jQuery('.custom-alert-box .alert-primary').text(split_msg[1]);
                    // jQuery('.custom-alert-box').css('display', "flex").delay(5000).fadeOut();
                    // jQuery("#wp_edit_user_password_error").html("");
                    jQuery('.search_professional_results').html(split_msg[1]);
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




    // user end

    jQuery(document).on('click', '.searchreviews-btn', function(e){
        e.preventDefault();
        let query = jQuery("#searchreviews").val();
        let formdata = new FormData();
        formdata.append('action','search_review_user_action');
        formdata.append('query',query);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // console.log(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.user-search-section').html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    // user end

    jQuery(document).on('click', '.searchreviews-btn-pro', function(e){
        e.preventDefault();
        let query = jQuery("#searchreviews_pro").val();
        let formdata = new FormData();
        formdata.append('action','search_review_pro_action');
        formdata.append('query',query);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // console.log(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    jQuery('.pro-search-section').html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});