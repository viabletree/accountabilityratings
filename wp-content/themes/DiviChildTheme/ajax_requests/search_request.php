<?php

// fill home dropdown
add_action( 'wp_ajax_home_fill_dropdown_action', 'home_fill_dropdown_funt' );
add_action( 'wp_ajax_nopriv_home_fill_dropdown_action', 'home_fill_dropdown_funt' );
function home_fill_dropdown_funt(){
    $data_to_return = '<option value="">Select Location</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
    
    
    ';
    // global $wpdb;
    // $cities = $wpdb->get_col("SELECT DISTINCT(meta_value) FROM $wpdb->usermeta WHERE meta_key = 'user_location'" );
    // foreach($cities as $city){
    //     $data_to_return .= '<option value="'.$city.'">'.$city.'</option>';
    // }

    echo 'success|' . $data_to_return . "|" . home_url('/professional');
    die();
}




// search professional
add_action( 'wp_ajax_search_professional_action', 'search_professional_funt' );
add_action( 'wp_ajax_nopriv_search_professional_action', 'search_professional_funt' );
function search_professional_funt(){
    global $wpdb;
    $profession = $_POST['profession'] ? $_POST['profession'] : "";
    $city = $_POST['city'] ? $_POST['city'] : "";
    $data_to_return = '';
//     $professionals = get_users(
//                         array(
//                             'role' => 'subscriber',
//                             'meta_query' => array(
								
//                                 array(
//                                     'key' => 'user_profession',
//                                     'value' => $profession,
//                                     'compare' => 'LIKE'
//                                 ),
//                                 array(
//                                     'key' => 'user_location',
//                                     'value' => $city,
//                                     'compare' => 'LIKE'
//                                 )
//                             )
//                         )
//                     );
	$professionals = get_users(
                        array(							
							'meta_query' => array(
												array(
													'key' => 'user_type',
													'value' => 'professional',
													'compare' => 'LIKE'
												),
												array(
													'key' => 'user_location',
													'value' => $city,
													'compare' => 'LIKE'
												),			 
												array(
													'relation' => 'OR',

													array(
														'key' => 'user_profession',
														'value' => $profession,
														'compare' => 'LIKE'
													),
													array(
														'key' => 'full_name',
														'value' => $profession,
														'compare' => 'LIKE'
													),
											  )
						)
    				)
				);
    foreach($professionals as $professional){
        // print_r($professional->ID);
        $data_to_return .= '
            <div class="col-md-4">
                    <div class="card p-3 mb-4">
                        <div class="d-flex justify-content-between card-top">
                            <div class="d-flex flex-row align-items-center" style="column-gap: 12px;">
                            <div class="logo-pic">
                                '.substr(ucfirst($professional->display_name), 0, 1).'
                                <div class="happy-icon"style="background: url('.home_url('/wp-content/uploads/2022/06/crown-icon.png').')">
                                </div>
                            </div>
                            <div class="ms-2 c-details">
                                <h2 class="mb-0 pb-0">'.get_usermeta($professional->ID, 'full_name').'</h2> 
                            <span id=profession>'.get_usermeta($professional->ID, 'user_profession').'</span>
        ';
        $querystr = "SELECT COUNT(id) as total_reviews, AVG(stars) as avg_stars FROM `prof_ratings` WHERE `pro_id`=".$professional->ID." AND `visibility` = 'visible'";
        $query_results = $wpdb->get_results($querystr);
        if (!empty($query_results)) {
            foreach ($query_results as $results){
                $data_to_return .= '<span class="fa fa-star checked"><span class="rating-num"> '.round($results->avg_stars).'</span></span>';
            }
        }

        $data_to_return .= '
                    </div>
                        </div>
                            <div class="reviews"> 
                                <span><span id="c_reviews">'.$results->total_reviews.'</span> Reviews</span> 
                            </div>
                </div>
                <span class="divider"></span>
                <div class="pro-details">
                    <h3 class="heading">Location</h3>
                    <p>'.get_usermeta($professional->ID, "user_location").'</p>
                </div>
                <span class="divider"></span>
                <div>
                    <a href="/tracie/professional-details/?id='.$professional->ID.'" type="button" class="btn btn-primary view-profile">View Profile</a>
        ';
        if ( is_user_logged_in() ) {
            $user_ID = get_current_user_id();
            $user_type = get_usermeta($user_ID, 'user_type') ? get_usermeta($user_ID, 'user_type') : "admin";
            if($user_type == "evaluator"){
                $data_to_return .= '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating" pro-id="'.$professional->ID.'">Add Quick Review</a>';
            }
            elseif($user_type == "professional"){
                $data_to_return .= '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating professional" pro-id="0">Add Quick Review</a>';
            }
        }
        else{
            $data_to_return .= '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating disabled_btn" pro-id="0">Add Quick Review</a>';
        }

        $data_to_return .= '
                    </div>
                </div>
            </div>
			
        ';
    }

    echo "success" . "|" . $data_to_return . "|" . home_url('/professional/?profession='.$profession.'&location='.$city);

    die();
}







// user search reviews
add_action( 'wp_ajax_search_review_user_action', 'search_review_user_funt' );
add_action( 'wp_ajax_nopriv_search_review_user_action', 'search_review_user_funt' );
function search_review_user_funt(){
    global $wpdb;
    $query = $_POST['query'] ? $_POST['query'] : "";
    $user_id = get_current_user_id();
    $data_to_return = '';
    $querystr = "SELECT * FROM `prof_ratings` WHERE (`comments` LIKE '%$query%' OR `title` LIKE '%$query%') AND (`user_id`=".$user_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible')";
    $query_results = $wpdb->get_results($querystr);
    if (!empty($query_results)) {
        foreach($query_results as $results){
            if($results->smiley == "happy"){
                $face_url = home_url('/wp-content/uploads/2022/06/happy.png');
            }else{
                $face_url = home_url('/wp-content/uploads/2022/06/sadfaceChecked.png');
            }
            $star_checked = "";
            $star_unchecked = "";
            $time=strtotime($results->review_date);
            $month=date("M",$time);
            $year=date("Y",$time);
            for($i=1 ; $i <= $results->stars ; $i++){
                $star_checked .= '<span class="fa fa-star fa-5x checked"></span>';
            }
            for($i=1 ; $i <= 5 - $results->stars ; $i++){
                $star_unchecked .= '<span class="fa fa-star fa-5x unchecked"></span>';
            }
            $pro_id = $results->pro_id;
            $pro_meta = get_user_meta($pro_id);
            $pro_info = get_userdata($pro_id);
            $data_to_return .= '
                <div class="col-md-12">
                    <div class="card p-3 mb-4">
                        <div class="d-flex justify-content-between card-top">
                            <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                                <div class="logo-pic">
                                    '.substr(ucfirst($pro_info->display_name), 0, 1).'
                                    <div class="happy-icon"style="background: url('.$face_url.')"></div>
                                </div>
                                <div class="ms-2 c-details">
                                    <h2 class="mb-2 pb-0">'.ucfirst($pro_info->display_name).'</h2> 
                                    <ul class="cmt-meta">
                                        <li>
                                            <div class="total-stars">
                                                '.$star_checked.'
                                                '.$star_unchecked.'
                                                <span class="cmt-num-rating"> &nbsp; '.$results->stars.'.0</span>
                                            </div>
                                        </li>
                                        <li>
                                            <h4>Review Date&nbsp;: <span>
                                            '.$month.' '.$year.'
                                        </span></h4>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="like-dislike-container like-dislike-container-dashboard">
                                <ul class="like-dislike">
                                    <li class="dislike">
                                        <a href="javascript:void(0)" class="view-review" r-id="'.$results->id.'"><img src="'.home_url('/wp-content/uploads/2022/06/cmt-view.png').'" alt="dislike"></a>
                                    </li>
                                    <li class="like">
                                        <a href="javascript:void(0)" class="edit-review" r-id="'.$results->id.'"><img src="'.home_url('/wp-content/uploads/2022/06/cmt-edit.png').'" alt="like"></a>
                                    </li>
                                    <li class="like">
                                        <a href="javascript:void(0)" class="delete-review" r-id="'.$results->id.'"><img src="'.home_url('/wp-content/uploads/2022/06/cmt-delete.png').'" alt="like"></a>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                        <div class="pro-details mt-3">
                            <h3 class="heading">'.$results->title.'</h3>
                            <p>'.$results->comments.'</p>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    $data_to_return .= '
    <style>
    ul.page-numbers{
        display: none!important;
    }
    </style>
    ';

    echo "success" . "|" . $data_to_return;

    die();
}




// professionals search reviews
add_action( 'wp_ajax_search_review_pro_action', 'search_review_pro_funt' );
add_action( 'wp_ajax_nopriv_search_review_pro_action', 'search_review_pro_funt' );
function search_review_pro_funt(){
    global $wpdb;
    $query = $_POST['query'] ? $_POST['query'] : "";
    $pro_id = get_current_user_id();
    $data_to_return = '';
    $querystr = "SELECT * FROM `prof_ratings` WHERE (`comments` LIKE '%$query%' OR `title` LIKE '%$query%') AND (`pro_id`=".$pro_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible')";
    $query_results = $wpdb->get_results($querystr);
    if (!empty($query_results)) {
        foreach ($query_results as $results){
            if($results->smiley == "happy"){
                $face_url = home_url('/wp-content/uploads/2022/06/happy.png');
            }else{
                $face_url = home_url('/wp-content/uploads/2022/06/sadfaceChecked.png');
            }
            $user_meta = get_user_meta($results->user_id);
            $user_info = get_userdata($results->user_id);
            $star_checked = "";
            $star_unchecked = "";
            $time=strtotime($results->review_date);
            $month=date("M",$time);
            $year=date("Y",$time);
            for($i=1 ; $i <= $results->stars ; $i++){
                $star_checked .= '<span class="fa fa-star fa-5x checked"></span>';
            }
            for($i=1 ; $i <= 5 - $results->stars ; $i++){
                $star_unchecked .= '<span class="fa fa-star fa-5x unchecked"></span>';
            }
            $like = 0;
            $dislike = 0;
            $reaction_like = "SELECT COUNT(id) AS c_like FROM `prof_ratings_reaction` WHERE `r_id`=".$results->id." AND `reaction` = 'like'";
            $query_results2 = $wpdb->get_results($reaction_like);
            if (!empty($query_results2)) {
                foreach ($query_results2 as $results2){
                    $like = $results2->c_like;
                }
            }else{
                $like = 0;
            }
            $reaction_dislike = "SELECT COUNT(id) AS c_dislike FROM `prof_ratings_reaction` WHERE `r_id`=".$results->id." AND `reaction` = 'dislike'";
            $query_results3 = $wpdb->get_results($reaction_dislike);
            if (!empty($query_results3)) {
                foreach ($query_results3 as $results3){
                    $dislike = $results3->c_dislike;
                }
            }else{
                $dislike = 0;
            }


            $data_to_return .= '
                <div class="col-md-12">
                    <div class="card p-3 mb-4">
                        <div class="d-flex justify-content-between card-top card-top-with-reply">
                            <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                                <div class="logo-pic">
                                    '.substr(ucfirst($user_info->display_name), 0, 1).'
                                    <div class="happy-icon"style="background: url('.$face_url.')"></div>
                                </div>
                                <div class="ms-2 c-details">
                                    <h2 class="mb-2 pb-0">'.ucfirst($user_info->display_name).'</h2> 
                                    <div class="meta-reply-container">
                                        <ul class="cmt-meta">
                                            <li>
                                                <div class="total-stars">
                                                '.$star_checked.''.$star_unchecked.'
                                                    <span class="cmt-num-rating"> &nbsp; '.$results->stars.'.0</span>
                                                </div>
                                            </li>
                                            <li>
                                                <h4>Review Date&nbsp;: <span> 
                                                '.$month.' '.$year.'
                                                </span></h4>
                                            </li>
                                        </ul>
                                        <div class="reply-btn-div">
                                            <a href="javascript:void(0)" type="button" 
                                                class="btn btn-primary reply-user-btn" r-id="'.$results->id.'">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="like-dislike-container like-dislike-container-dashboard">
                                <ul class="like-dislike">
                                    <li class="dislike">
                                        <img src="'.home_url('/wp-content/uploads/2022/06/cmt-view.png').'" alt="dislike">
                                    </li>

                                    <li class="dislike">
                                        <span>'.$like.'</span>
                                        <img src="'.home_url('/wp-content/uploads/2022/06/like-2.png').'" alt="dislike">
                                    </li>
                                    <li class="like">
                                        <span>'.$dislike.'</span>
                                        <img src="'.home_url('/wp-content/uploads/2022/06/like-1.png').'" class="mb-2" alt="like">
                                    </li>
                                </ul> 
                            </div>
                        </div>
                        <div class="pro-details mt-4">
                            <div class="user-cmt">
                            <h3 class="heading">'.$results->title.'</h3>
                                <p>'.$results->comments.'</p>
                            </div>
                            <div class="show-hide-cmt-div">
                                <a href="javascript:void(0)" type="button" class="btn btn-primary show-hide-cmt">Expand</a>
                            </div>
                        </div>
                        <div class="reply-container mt-4">
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Contracting Professional</h2>
                                <p class="reply-content">'.$results->contracting_professional.'</p>
                            </div>
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Federal Agency</h2>
                                <p class="reply-content">'.$results->federal_agency.'</p>
                            </div>
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Type of Contract</h2>
                                <p class="reply-content">'.$results->contract_type.'</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            ';
        }
    }
    $data_to_return .= '
    <style>
    ul.page-numbers{
        display: none!important;
    }
    </style>
    ';

    echo "success" . "|" . $data_to_return;

    die();
}

?>