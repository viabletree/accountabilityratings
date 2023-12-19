<?php

add_action( 'wp_ajax_rating_reply_action', 'rating_reply_funt' );
add_action( 'wp_ajax_nopriv_rating_reply_action', 'rating_reply_funt' );
function rating_reply_funt(){

    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $replyError = "";
    $reply = $_POST['addreply'] ? $_POST['addreply'] : "";
    $r_id = $_POST['r_id'] ? $_POST['r_id'] : "";

    if(empty( $reply )){
        $reg_errors->add('field', 'Required form field is missing');
    }    

    if (is_wp_error( $reg_errors )){ 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $replyError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }

    if ( 1 > count( $reg_errors->get_error_messages() ) ){

        $data_return_from_query = $wpdb->insert("prof_ratings_reply", array(
			"r_id" => $r_id,
			"reply" => $reply
		));
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, Reply submitted.";
		}
		else{
            $replyError = '<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: Sorry for inconvinience! There seems to be a problem<br /></p>';
            echo "error" . "|" . $replyError;
		}

        
    }
    else{
        echo "error" . "|" . $replyError;
    }

    die();
}




// hit like
add_action( 'wp_ajax_hit_like_action', 'hit_like_funt' );
add_action( 'wp_ajax_nopriv_hit_like_action', 'hit_like_funt' );
function hit_like_funt(){

    global $wpdb;
    $r_id = $_POST['r_id'] ? $_POST['r_id'] : "";
    $user_id = get_current_user_id();

    $querystr = "SELECT * FROM `prof_ratings_reaction` WHERE `r_id`=".$r_id." AND `user_id` = ".$user_id." ";
    $query_results = $wpdb->get_results($querystr);
    if (!empty($query_results)) {
        foreach ($query_results as $results){
            $reaction = $results->reaction;
            if($reaction == "like"){
                // already like
            }else{
                $status = $wpdb->update('prof_ratings_reaction', array('reaction'=>'like'), array('id'=>$results->id));
                echo "success" . "|" . "Thank you, Reaction submitted.";
            }
        }
    }
    else{
        $data_return_from_query = $wpdb->insert("prof_ratings_reaction", array(
			"r_id" => $r_id,
            "user_id" => $user_id,
			"reaction" => "like"
		));
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, Reaction submitted.";
		}
    }

    die();
}




// hit dislike
add_action( 'wp_ajax_hit_dislike_action', 'hit_dislike_funt' );
add_action( 'wp_ajax_nopriv_hit_dislike_action', 'hit_dislike_funt' );
function hit_dislike_funt(){

    global $wpdb;
    $r_id = $_POST['r_id'] ? $_POST['r_id'] : "";
    $user_id = get_current_user_id();

    $querystr = "SELECT * FROM `prof_ratings_reaction` WHERE `r_id`=".$r_id." AND `user_id` = ".$user_id." ";
    $query_results = $wpdb->get_results($querystr);
    if (!empty($query_results)) {
        foreach ($query_results as $results){
            $reaction = $results->reaction;
            if($reaction == "like"){
                $status = $wpdb->update('prof_ratings_reaction', array('reaction'=>'dislike'), array('id'=>$results->id));
                echo "success" . "|" . "Thank you, Reaction submitted.";

            }else{
                // already disliked
            }
        }
    }
    else{
        $data_return_from_query = $wpdb->insert("prof_ratings_reaction", array(
			"r_id" => $r_id,
            "user_id" => $user_id,
			"reaction" => "dislike"
		));
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, Reaction submitted.";
		}
    }

    die();
}


?>