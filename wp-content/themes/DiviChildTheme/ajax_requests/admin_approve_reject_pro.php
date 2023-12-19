<?php


// Approve Pro
add_action( 'wp_ajax_admin_approve_pro_action', 'admin_approve_pro_funt' );
add_action( 'wp_ajax_nopriv_admin_approve_pro_action', 'admin_approve_pro_funt' );
function admin_approve_pro_funt(){
    global $wpdb;
    $id = $_POST['suggestID'];
    $querystr = "SELECT * FROM `prof_suggest` WHERE `id`=".$id."";
    $query_results = $wpdb->get_results($querystr);
    if (!empty($query_results)) {
        foreach ($query_results as $results){
            $user_id = $results->user_id;
            $user_info = get_userdata($user_id);
            $user_email = $user_info->user_email;
            $suggeted_pro_email = $results->email;

            $fullname = $results->name;
            $profession = $results->profession;
            $location = $results->location;
            $phone = $results->phone;
			
			$timestamp = strtotime('2022-08-01');

            if($user_email == $suggeted_pro_email){
                update_usermeta($new_user_id, 'user_type', 'professional');
                update_usermeta($new_user_id, 'user_profession', $profession);
                update_usermeta($new_user_id, 'user_location', $location);
                update_usermeta($new_user_id, 'user_phone', $phone);
				update_usermeta($new_user_id, 'recent_review_date', $timestamp);
                echo "Approved and updated account to professional successfully";
            }
            else{
                $status = $wpdb->update('prof_suggest', array('status'=>'approved'), array('id'=>$id));
                $username = str_replace(" ", "", strtolower($fullname));
                $useremail = $results->email;
                $password = "12345678";
                $new_user_id = wp_create_user($username, $password, $useremail);
                update_usermeta($new_user_id, 'full_name', $fullname);
                update_usermeta($new_user_id, 'user_type', 'professional');
                update_usermeta($new_user_id, 'user_profession', $profession);
                update_usermeta($new_user_id, 'user_location', $location);
                update_usermeta($new_user_id, 'user_phone', $phone);
				update_usermeta($new_user_id, 'recent_review_date', $timestamp);
                echo "Professional approved and created account successfully";
                // email user
                $mailfrom = "ACCOUNTABILITY RATINGS <support@accountabilityratings.org>";
                $subject ="Welcome to ACCOUNTABILITY RATINGS";

                $Msg_User = "Dear " . $fullname . ", <br /> <br />
                Your account has been aprroved. <br /><br />
                Following are the details of your account: <br /> <br />
                <p><b>Username: </b>" . $username . "</p><br />
                <p><b>Email: </b>" . $useremail . "</p><br />
                <p><b>Password: </b> Please click on this link to set your password, <a href='".home_url('/set-password?id='.$new_user_id)."'>Set New Password</a></p><br />

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

                // echo $body;
                $mail_return = wp_mail($useremail,$subject,$body,$headers);
//                 echo $mail_return;
            }
        }
    }

    die();
}





// Reject Pro
add_action( 'wp_ajax_admin_reject_pro_action', 'admin_reject_pro_funt' );
add_action( 'wp_ajax_nopriv_admin_reject_pro_action', 'admin_reject_pro_funt' );
function admin_reject_pro_funt(){
    global $wpdb;
    $id = $_POST['suggestID'];

    $status = $wpdb->update('prof_suggest', array('status'=>'rejected'), array('id'=>$id));

    if($status == 1){
        echo "Professional Rejected";
    }
    else{
        echo "Sorry! There seems to be a problem, Please try again";
    }

    die();
}


// admin delete user
add_action( 'wp_ajax_admin_delete_user_action', 'admin_delete_user_funt' );
add_action( 'wp_ajax_nopriv_admin_delete_user_action', 'admin_delete_user_funt' );
function admin_delete_user_funt(){
    $user_id = $_POST['userID'];
// 	echo "dfdfgsfg";
// 	die();
    if( wp_delete_user( $user_id ) ){
        echo "User Deleted Successfully";
    } else {
        echo "There is a problem while deleting the user.";
    }

    die();
}


// delete rating by admin
add_action( 'wp_ajax_admin_delete_rating_action', 'admin_delete_rating_funt' );
add_action( 'wp_ajax_nopriv_admin_delete_rating_action', 'admin_delete_rating_funt' );
function admin_delete_rating_funt(){
    global $wpdb;
    $r_id = $_POST['r_id'] ? $_POST['r_id'] : "";
    $status = $wpdb->update('prof_ratings', array('visibility'=>'hidden'), array('id'=>$r_id));
    if($status == 1){
        echo "success|Review Deleted Successfully";
    }
    else{
        echo "error|Sorry! There seems to be a problem, Please try again";
    }

    die();
}

?>