<?php

// change password user/pro
add_action( 'wp_ajax_set_new_password_action', 'set_new_password_funt' );
add_action( 'wp_ajax_nopriv_set_new_password_action', 'set_new_password_funt' );
function set_new_password_funt(){
    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $editProfileError = "";
    $user_ID = $_POST['user_id'];
    $newpass = $_POST['newpassword'] ? $_POST['newpassword'] : "";

    
    if(empty( $newpass )){
        $reg_errors->add('field', 'Required form field is missing');
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




// claim pro
add_action( 'wp_ajax_claim_pro_action', 'claim_pro_funt' );
add_action( 'wp_ajax_nopriv_claim_pro_action', 'claim_pro_funt' );
function claim_pro_funt(){
    $entered_email = $_POST['email'];
    $pro_id = $_POST['pro_id'];
    $pro_meta = get_user_meta($pro_id);
    $pro_info = get_userdata($pro_id);

    if($entered_email == $pro_info->user_email){
        // email user
        $mailfrom = "ACCOUNTABILITY RATINGS <support@accountabilityratings.org>";
        $subject ="Welcome to ACCOUNTABILITY RATINGS";

        $Msg_User = "Dear " . $pro_meta['full_name'][0] . ", <br /> <br />
        You account has been aprroved. <br /><br />
        Following are the details of your account: <br /> <br />
        <p><b>Username: </b>" . $pro_info->user_login . "</p><br />
        <p><b>Email: </b>" . $pro_info->user_email . "</p><br />
        <p><b>Password: </b> Please click on this link to set your password, <a href='".home_url('/set-password?id='.$pro_id)."'>Set New Password</a></p><br />

        <br /> <br />
        Best Regards,<br />
        Customer Services,<br />
        Tracie <br />
        " ;

        $mail_body= $Msg_User;

        $mail_body = str_replace("\\","",$mail_body);

        $body = wordwrap($mail_body,70);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= "From: " . $mailfrom ."\r\n";

        wp_mail($useremail,$subject,$mail_body,$headers);
        echo "success|An email has been sent to ".$entered_email;
		
		
		// email admin
		$mailfrom = "ACCOUNTABILITY RATINGS <support@accountabilityratings.org>";
		$subject ="Account Claimed on ACCOUNTABILITY RATINGS";

		$Msg_User = "Dear Admin, <br /> <br />
                An account has been claimed at ACCOUNTABILITY RATINGS. <br /><br />
                Following are the details of the account: <br /> <br />
                <p><b>Name: </b>" . ucfirst($pro_meta['full_name'][0]) . "</p><br />
                <p><b>Email: </b>" . $pro_info->user_email . "</p><br />

                <br /> <br />
                Best Regards,<br />
                Customer Services,<br />
                ACCOUNTABILITY RATINGS <br />
                " ;

		$mail_body= $Msg_User;

		$mail_body = str_replace("\\","",$mail_body);

		$body = wordwrap($mail_body,70);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= "From: " . $mailfrom ."\r\n";

		// echo $body;
		$mail_return = wp_mail("tracieg@gmail.com",$subject,$body,$headers);
		//                 echo $mail_return;
    }else{
        echo "error|Sorry! Entered email does not match to this account";
    }
    die();
}
?>