<?php

add_action( 'wp_ajax_suggest_pro_action', 'suggest_pro_funt' );
add_action( 'wp_ajax_nopriv_suggest_pro_action', 'suggest_pro_funt' );
function suggest_pro_funt(){

    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $signUpError = "";
    $user_ID = get_current_user_id();
    $fullname = $_POST['name'] ? $_POST['name'] : "";
    $useremail = $_POST['email'] ? $_POST['email'] : "";
    $profession = $_POST['profession'] ? $_POST['profession'] : "";
    $location = $_POST['location'] ? $_POST['location'] : "";
    $phone = $_POST['phone'] ? $_POST['phone'] : "";

    if(empty( $fullname ) || empty( $useremail ) || empty($profession) || empty($location) || empty($phone)){
        $reg_errors->add('field', 'Required form field is missing');
    }    
    if ( 6 > strlen( $fullname ) ){
        $reg_errors->add('username_length', 'Username too short. At least 6 characters is required' );
    }
    if ( !is_email( $useremail ) ){
        $reg_errors->add( 'email_invalid', 'Email id is not valid!' );
    }

    if (is_wp_error( $reg_errors )){ 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $signUpError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }

    if ( 1 > count( $reg_errors->get_error_messages() ) ){

        $data_return_from_query = $wpdb->insert("prof_suggest", array(
			"user_id" => $user_ID,
			"name" => $fullname,
			"email" => $useremail,
			"profession" => $profession,
			"phone" => $phone,
			"location" => $location
		));
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, Professional request submitted.";
			// email admin
			$mailfrom = "ACCOUNTABILITY RATINGS <support@accountabilityratings.org>";
			$subject ="Professional Suggestion on ACCOUNTABILITY RATINGS";

			$Msg_User = "Dear Admin, <br /> <br />
                There is a new suggestion of professional at ACCOUNTABILITY RATINGS. <br /><br />
                Following are the details of the professional: <br /> <br />
                <p><b>Name: </b>" . $fullname . "</p><br />
                <p><b>Email: </b>" . $useremail . "</p><br />
				<p><b>Profession: </b>" . $profession . "</p><br />
				<p><b>Phone: </b>" . $phone . "</p><br />
				<p><b>Location: </b>" . $location . "</p><br />

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
		}
		else{
            $signUpError = '<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: Sorry for inconvinience! There seems to be a problem<br /></p>';
            echo "error" . "|" . $signUpError;
		}

        
    }
    else{
        echo "error" . "|" . $signUpError;
    }

    die();
}


?>