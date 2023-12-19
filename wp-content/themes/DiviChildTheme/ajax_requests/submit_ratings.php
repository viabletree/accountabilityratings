<?php

// Quick rating
add_action( 'wp_ajax_user_quick_rating_action', 'user_quick_rating_funt' );
add_action( 'wp_ajax_nopriv_user_quick_rating_action', 'user_quick_rating_funt' );
function user_quick_rating_funt(){
    global $reg_errors, $wpdb;
    $reg_errors = new WP_Error;
    $quickRatingError = "";
    $user_id = get_current_user_id();
    $pro_id = $_POST['pro_id'] ? $_POST['pro_id'] : "";
    $title = $_POST['quicktitle'] ? $_POST['quicktitle'] : "";
    $stars = $_POST['stars'] ? $_POST['stars'] : "";
    $smiley = $_POST['smiley'] ? $_POST['smiley'] : "";

    if(empty( $title )){
        $reg_errors->add('field', 'Required title field is missing');
    }
    
    if (is_wp_error( $reg_errors ))
    { 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $quickRatingError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }

    if ( 1 > count( $reg_errors->get_error_messages() ) ){
        $data_return_from_query = $wpdb->insert("prof_ratings", array(
			"user_id" => $user_id,
			"pro_id" => $pro_id,
            "title" => $title,
			"stars" => $stars,
			"smiley" => $smiley,
			"review_type" => "quick review"
		));
		update_usermeta($pro_id, 'recent_review_date', time());
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, rating submitted.";
		}
		else{
            $signUpError = '<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: Sorry for inconvinience! There seems to be a problem<br /></p>';
            echo "error" . "|" . $quickRatingError;
		}
    }
    else{
        echo "error" . "|" . $quickRatingError;
    }


    die();
}





// Detailed rating
add_action( 'wp_ajax_user_detailed_rating_action', 'user_detailed_rating_funt' );
add_action( 'wp_ajax_nopriv_user_detailed_rating_action', 'user_detailed_rating_funt' );
function user_detailed_rating_funt(){
    global $reg_errors, $wpdb;
    $reg_errors = new WP_Error;
    $detailRatingError = "";

    $user_id = get_current_user_id();
    $pro_id = $_POST['pro_id'] ? $_POST['pro_id'] : "";
    $situation = $_POST['situation'] ? $_POST['situation'] : "";
    $opinion = $_POST['opinion'] ? $_POST['opinion'] : "";
    $business_effect = $_POST['business_effect'] ? $_POST['business_effect'] : "";
    $title = $_POST['title'] ? $_POST['title'] : "";
    $comments = $_POST['comments'] ? $_POST['comments'] : "";
    $contracting_professional = $_POST['contracting_professional'] ? $_POST['contracting_professional'] : "";
    $federal_agency = $_POST['federal_agency'] ? $_POST['federal_agency'] : "";
    $contract_type = $_POST['contract_type'] ? $_POST['contract_type'] : "";
    $rate_location = $_POST['rate_location'] != "0" ? $_POST['rate_location'] : null;
    $rate_facilities = $_POST['rate_facilities'] != "0" ? $_POST['rate_facilities'] : "";
    $rate_communication = $_POST['rate_communication'] != "0" ? $_POST['rate_communication'] : "";
    $rate_value = $_POST['rate_value'] != "0" ? $_POST['rate_value'] : "";
    $rate_management = $_POST['rate_management'] != "0" ? $_POST['rate_management'] : "";
    $stars = $_POST['stars'] ? $_POST['stars'] : "";
    $smiley = $_POST['smiley'] ? $_POST['smiley'] : "";

    // echo $rate_location;
    // die();

    if(empty( $situation ) && empty($opinion) && empty($business_effect) && empty($title) && empty($comments) && empty($contracting_professional)
     && empty($federal_agency) && empty($contract_type) && empty($rate_location) && empty($rate_facilities) && empty($rate_communication) 
     && empty($rate_value) && empty($rate_management)){
        $reg_errors->add('field', 'Required form field is missing');
    }


    if (is_wp_error( $reg_errors ))
    { 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $detailRatingError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }


    if ( 1 > count( $reg_errors->get_error_messages() ) ){
        $data_return_from_query = $wpdb->insert("prof_ratings", array(
			"user_id" => $user_id,
			"pro_id" => $pro_id,
            "situation" => $situation,
			"opinion" => $opinion,
			"business_effect" => $business_effect,
            "title" => $title,
			"comments" => $comments,
			"contracting_professional" => $contracting_professional,
            "federal_agency" => $federal_agency,
			"contract_type" => $contract_type,
			"rate_location" => $rate_location,
            "rate_facilities" => $rate_facilities,
			"rate_communication" => $rate_communication,
			"rate_value" => $rate_value,
            "rate_management" => $rate_management,
			"stars" => $stars,
			"smiley" => $smiley,
			"review_type" => "detailed review"
		));
		update_usermeta($pro_id, 'recent_review_date', time());
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, rating submitted.";
		}
		else{
            $detailRatingError = '<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: Sorry for inconvinience! There seems to be a problem<br /></p>';
            echo "error" . "|" . $detailRatingError;
		}
    }
    else{
        echo "error" . "|" . $detailRatingError;
    }

    die();
}





// delete rating by user
add_action( 'wp_ajax_user_delete_rating_action', 'user_delete_rating_funt' );
add_action( 'wp_ajax_nopriv_user_delete_rating_action', 'user_delete_rating_funt' );
function user_delete_rating_funt(){
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



// get rating data for update by user
add_action( 'wp_ajax_user_get_data_rating_action', 'user_get_data_rating_funt' );
add_action( 'wp_ajax_nopriv_user_get_data_rating_action', 'user_get_data_rating_funt' );
function user_get_data_rating_funt(){
    global $wpdb;
    $data_to_return = "";
    $r_id = $_POST['r_id'] ? $_POST['r_id'] : "";
    $querystr = "SELECT * FROM `prof_ratings` WHERE `id` = ".$r_id." ";
    $query_results = $wpdb->get_results($querystr);
    if (!empty($query_results)) {
        foreach ($query_results as $results){
            $data_to_return .= '
            <div class="form-group">
                <input type="text" id="situation" name="situation" placeholder="Describe your situation" value="'.$results->situation.'" />
            </div>
            <div class="form-group">
                <input type="text" id="opinion" name="opinion" placeholder="What&lsquo;s your opinion about your CO&rsquo;s performance" value="'.$results->opinion.'" />
            </div>
            <div class="form-group">
                <input type="text" id="business_effect" name="business_effect" placeholder="How did this affect your business?" value="'.$results->business_effect.'" />
            </div>
            <div class="form-group">
                <input type="text" id="title" name="title" placeholder="Title" value="'.$results->title.'" />
            </div>
            <div class="form-group">
                <input type="text" id="comments" name="comments" placeholder="Comments" value="'.$results->comments.'" />
            </div>
            <div class="form-group">
                <input type="text" id="contracting_professional" name="contracting_professional" placeholder="Your Contracting Pofessional" value="'.$results->contracting_professional.'" />
            </div>
            <div class="form-group">
                <input type="text" id="federal_agency" name="federal_agency" placeholder="Federal Agency" value="'.$results->federal_agency.'" />
            </div>
            <div class="form-group">
                <input type="text" id="contract_type" name="contract_type" placeholder="Type of Contract" value="'.$results->contract_type.'" />
            </div>
            <div class="form-group">
                <select id="rate_location" name="rate_location">
                    <option value="1">Rate Location</option>
                    <option value="1" '.($results->rate_location == 1 ? "selected" : "").'>1</option>
                    <option value="2" '.($results->rate_location == 2 ? "selected" : "").'>2</option>
                    <option value="3" '.($results->rate_location == 3 ? "selected" : "").'>3</option>
                    <option value="4" '.($results->rate_location == 4 ? "selected" : "").'>4</option>
                    <option value="5" '.($results->rate_location == 5 ? "selected" : "").'>5</option>
                </select>
            </div>
            <div class="form-group">
                <select id="rate_facilities" name="rate_facilities">
                    <option value="1">Rate Facilities</option>
                    <option value="1" '.($results->rate_facilities == 1 ? "selected" : "").'>1</option>
                    <option value="2" '.($results->rate_facilities == 2 ? "selected" : "").'>2</option>
                    <option value="3" '.($results->rate_facilities == 3 ? "selected" : "").'>3</option>
                    <option value="4" '.($results->rate_facilities == 4 ? "selected" : "").'>4</option>
                    <option value="5" '.($results->rate_facilities == 5 ? "selected" : "").'>5</option>
                </select>
            </div>
            <div class="form-group">
                <select id="rate_communication" name="rate_communication">
                    <option value="1">Rate Communication</option>
                    <option value="1" '.($results->rate_communication == 1 ? "selected" : "").'>1</option>
                    <option value="2" '.($results->rate_communication == 2 ? "selected" : "").'>2</option>
                    <option value="3" '.($results->rate_communication == 3 ? "selected" : "").'>3</option>
                    <option value="4" '.($results->rate_communication == 4 ? "selected" : "").'>4</option>
                    <option value="5" '.($results->rate_communication == 5 ? "selected" : "").'>5</option>
                </select>
            </div>
            <div class="form-group">
                <select id="rate_value" name="rate_value">
                    <option value="1">Rate Value</option>
                    <option value="1" '.($results->rate_value == 1 ? "selected" : "").'>1</option>
                    <option value="2" '.($results->rate_value == 2 ? "selected" : "").'>2</option>
                    <option value="3" '.($results->rate_value == 3 ? "selected" : "").'>3</option>
                    <option value="4" '.($results->rate_value == 4 ? "selected" : "").'>4</option>
                    <option value="5" '.($results->rate_value == 5 ? "selected" : "").'>5</option>
                </select>
            </div>
            <div class="form-group">
                <select id="rate_management" name="rate_management">
                    <option value="1">Rate Management</option>
                    <option value="1" '.($results->rate_management == 1 ? "selected" : "").'>1</option>
                    <option value="2" '.($results->rate_management == 2 ? "selected" : "").'>2</option>
                    <option value="3" '.($results->rate_management == 3 ? "selected" : "").'>3</option>
                    <option value="4" '.($results->rate_management == 4 ? "selected" : "").'>4</option>
                    <option value="5" '.($results->rate_management == 5 ? "selected" : "").'>5</option>
                </select>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="stars">Stars</label>
                    <div class="star-rating-form">
                        <div class="star-input">
                            <input type="radio" name="stars" value="5" '.($results->stars == 5 ? "checked" : "").'/>
                            <input type="radio" name="stars" value="4" '.($results->stars == 4 ? "checked" : "").'/>
                            <input type="radio" name="stars" value="3" '.($results->stars == 3 ? "checked" : "").'/>
                            <input type="radio" name="stars" value="2" '.($results->stars == 2 ? "checked" : "").'/>
                            <input type="radio" name="stars" value="1" '.($results->stars == 1 ? "checked" : "").'/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="stars">Icon</label>
                    <div id="smileys">
                        <input type="radio" name="smiley" value="sad" class="sad" '.($results->smiley == "sad" ? "checked" : "").'>
                        <input type="radio" name="smiley" value="happy" class="happy" '.($results->smiley == "happy" ? "checked" : "").'>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <button type="submit" class="btn btn-primary" id="quicksubmit_btn">Update Rating</button>
                <input type="hidden" name="r_id" value="'.$results->id.'">
            </div>
            
            ';
        }
    }
    echo $data_to_return;
    die();
}



// update rating data by user
add_action( 'wp_ajax_update_rating_data_action', 'update_rating_data_funt' );
add_action( 'wp_ajax_nopriv_update_rating_data_action', 'update_rating_data_funt' );
function update_rating_data_funt(){
    global $reg_errors2, $wpdb;
    $reg_errors2 = new WP_Error;
    $updatedetailRatingError = "";

    $r_id = $_POST['r_id'] ? $_POST['r_id'] : "";
    $situation = $_POST['situation'];
    $opinion = $_POST['opinion'] ? $_POST['opinion'] : "";
    $business_effect = $_POST['business_effect'] ? $_POST['business_effect'] : "";
    $title = $_POST['title'] ? $_POST['title'] : "";
    $comments = $_POST['comments'] ? $_POST['comments'] : "";
    $contracting_professional = $_POST['contracting_professional'] ? $_POST['contracting_professional'] : "";
    $federal_agency = $_POST['federal_agency'] ? $_POST['federal_agency'] : "";
    $contract_type = $_POST['contract_type'] ? $_POST['contract_type'] : "";
    $rate_location = $_POST['rate_location'] != "0" ? $_POST['rate_location'] : null;
    $rate_facilities = $_POST['rate_facilities'] != "0" ? $_POST['rate_facilities'] : "";
    $rate_communication = $_POST['rate_communication'] != "0" ? $_POST['rate_communication'] : "";
    $rate_value = $_POST['rate_value'] != "0" ? $_POST['rate_value'] : "";
    $rate_management = $_POST['rate_management'] != "0" ? $_POST['rate_management'] : "";
    $stars = $_POST['stars'] ? $_POST['stars'] : "";
    $smiley = $_POST['smiley'] ? $_POST['smiley'] : "";

    if(empty( $situation ) && empty($opinion) && empty($business_effect) && empty($title) && empty($comments) && empty($contracting_professional)
     && empty($federal_agency) && empty($contract_type) && empty($rate_location) && empty($rate_facilities) && empty($rate_communication) 
     && empty($rate_value) && empty($rate_management)){
        $reg_errors2->add('field', 'Required form field is missing');
    }


    if (is_wp_error( $reg_errors2 ))
    { 
        foreach ( $reg_errors2->get_error_messages() as $error )
        {
             $updatedetailRatingError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }


    if ( 1 > count( $reg_errors2->get_error_messages() ) ){
        $data_return_from_query = $wpdb->update('prof_ratings', array(
            "situation" => $situation,
			"opinion" => $opinion,
			"business_effect" => $business_effect,
            "title" => $title,
			"comments" => $comments,
			"contracting_professional" => $contracting_professional,
            "federal_agency" => $federal_agency,
			"contract_type" => $contract_type,
			"rate_location" => $rate_location,
            "rate_facilities" => $rate_facilities,
			"rate_communication" => $rate_communication,
			"rate_value" => $rate_value,
            "rate_management" => $rate_management,
			"stars" => $stars,
			"smiley" => $smiley,
        ), array('id'=>$r_id));
        
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, rating updated.";
		}
		else{
            $updatedetailRatingError = '<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: Sorry for inconvinience! There seems to be a problem<br /></p>';
            echo "error" . "|" . $updatedetailRatingError;
		}
    }
    else{
        echo "error" . "|" . $updatedetailRatingError;
    }


    die();
}
?>