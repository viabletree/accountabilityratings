<?php

// edit profile user
add_action( 'wp_ajax_user_edit_profile_action', 'user_edit_profile_funt' );
add_action( 'wp_ajax_nopriv_user_edit_profile_action', 'user_edit_profile_funt' );
function user_edit_profile_funt(){
    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $editProfileError = "";
    $user_ID = get_current_user_id();
    $fullname = $_POST['fullname'] ? $_POST['fullname'] : "";
    $useremail = $_POST['email'] ? $_POST['email'] : "";
    if(empty( $fullname ) || empty( $useremail )){
        $reg_errors->add('field', 'Required form field is missing');
    }  
    if ( email_exists( $useremail ) ){
        $reg_errors->add( 'email', 'Email Already exist!' );
    }  

    if (is_wp_error( $reg_errors )){ 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $editProfileError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }


    if ( 1 > count( $reg_errors->get_error_messages() ) ){
        $args = array(
            'ID'         => $user_ID,
            'user_email' => esc_attr( $useremail )
        );
        wp_update_user( $args );
        update_usermeta($user_ID, 'full_name', $fullname);

        echo "success" . "|" . "Profile Updated Succesfully.";
    }
    else{
        echo "error" . "|" . $editProfileError;
    }

    die();
}



// change password user/pro
add_action( 'wp_ajax_user_change_pass_action', 'user_change_pass_funt' );
add_action( 'wp_ajax_nopriv_user_change_pass_action', 'user_change_pass_funt' );
function user_change_pass_funt(){
    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $editProfileError = "";
    $user_ID = get_current_user_id();
    $user = wp_get_current_user();
    $oldpass = $_POST['oldpassword'] ? $_POST['oldpassword'] : "";
    $newpass = $_POST['newpassword'] ? $_POST['newpassword'] : "";
    $newpassrepeat = $_POST['confirmpassword'] ? $_POST['confirmpassword'] : "";

    
    if(empty( $oldpass ) || empty( $newpass ) || empty($newpassrepeat)){
        $reg_errors->add('field', 'Required form field is missing');
    } 
    if($newpass != $newpassrepeat){
        $reg_errors->add('field', 'Passwords not matched');
    } 
    if(!wp_check_password( $oldpass, $user->user_pass, $user_ID )){
        $reg_errors->add('field', 'You have entered wrong password');
    } 
    if ( 5 > strlen( $newpass ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5!' );
    }

    if (is_wp_error( $reg_errors )){ 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $editProfileError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }


    if ( 1 > count( $reg_errors->get_error_messages() ) ){

        wp_set_password( $newpass, $user_ID );

        echo "success" . "|" . "Password Updated Succesfully." . "|" . home_url();
    }
    else{
        echo "error" . "|" . $editProfileError;
    }

    die();
}





// edit profile pro
add_action( 'wp_ajax_pro_edit_profile_action', 'pro_edit_profile_funt' );
add_action( 'wp_ajax_nopriv_pro_edit_profile_action', 'pro_edit_profile_funt' );
function pro_edit_profile_funt(){
    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $editProfileError = "";
    $user_ID = get_current_user_id();
    $fullname = $_POST['fullname'] ? $_POST['fullname'] : "";
    $useremail = $_POST['email'] ? $_POST['email'] : "";
    $profession = $_POST['profession'] ? $_POST['profession'] : "";
    $location = $_POST['location'] ? $_POST['location'] : "";
    $phone = $_POST['phone'] ? $_POST['phone'] : "";
    if(empty( $fullname ) || empty( $useremail )){
        $reg_errors->add('field', 'Required form field is missing');
    }  
    if ( email_exists( $useremail ) ){
        $reg_errors->add( 'email', 'Email Already exist!' );
    }  

    if (is_wp_error( $reg_errors )){ 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $editProfileError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }


    if ( 1 > count( $reg_errors->get_error_messages() ) ){
        $args = array(
            'ID'         => $user_ID,
            'user_email' => esc_attr( $useremail )
        );
        wp_update_user( $args );
        update_usermeta($user_ID, 'full_name', $fullname);
        update_usermeta($user_ID, 'user_profession', $profession);
        update_usermeta($user_ID, 'user_location', $location);
        update_usermeta($user_ID, 'user_phone', $phone);

        echo "success" . "|" . "Profile Updated Succesfully.";
    }
    else{
        echo "error" . "|" . $editProfileError;
    }

    die();
}


?>