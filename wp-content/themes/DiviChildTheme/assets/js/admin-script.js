jQuery(document).ready(function(){


    // admin create professional
    jQuery(document).on("submit", "#admin_registerform", function(e){
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('action','admin_user_registration_action');
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // alert(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    alert("New Professional has been created");
                    jQuery('#admin_registerform').trigger("reset");
                }
                else{
                    jQuery("#wp_register_admin_error").html(split_msg[1]);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // alert("submitted");
    });


    // admin approve professional
    jQuery(document).on("click", ".approve_professional", function(e){
        e.preventDefault();
        suggestID = jQuery(this).attr('data-id');
        let formdata = new FormData();
        formdata.append('action','admin_approve_pro_action');
        formdata.append('suggestID', suggestID);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                alert(msg);
//                 console.log(msg)
                location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    // admin reject professional
    jQuery(document).on("click", ".reject_professional", function(e){
        e.preventDefault();
        let suggestID = jQuery(this).attr('data-id');
        let formdata = new FormData();
        formdata.append('action','admin_reject_pro_action');
        formdata.append('suggestID', suggestID);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                alert(msg);
                location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

	
	// admin delete user
    jQuery(document).on("click", ".admin_remove_user", function(e){
        e.preventDefault();
// 		alert('sssdf')
// 		return
        let userID = jQuery(this).attr('data-id');
        let formdata = new FormData();
        formdata.append('action','admin_delete_user_action');
        formdata.append('userID', userID);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                alert(msg);
                location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	
	
	// delete rating by admin
    jQuery(document).on("click", ".delete-review", function(e){
        e.preventDefault();
        let r_id = jQuery(this).attr('r-id');
        let formdata = new FormData();
        formdata.append('action','admin_delete_rating_action');
        formdata.append('r_id',r_id);
        jQuery.ajax({
            type: "post",
            data : formdata,
            url: opt.ajaxUrl,
            success: function(msg){
                // alert(msg)
                let split_msg = msg.split("|");
                if(split_msg[0] == "success"){
                    alert(split_msg[1]);
                    location.reload();
                }else{
					alert(split_msg[1]);
                    location.reload();
				}
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});