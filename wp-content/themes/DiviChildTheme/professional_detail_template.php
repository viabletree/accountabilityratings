<?php
/* 
Template Name: Professional Detail Template 
*/

get_header();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $pro_id = $_GET['id'];
    $pro_meta = get_user_meta($pro_id);
    $pro_info = get_userdata($pro_id);
    
}
// else{
//     wp_redirect(home_url());
// }
?>

<div class="row">
    <div class="col-md-12 detail-hero-section" style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/cover1-1.png') ?>)"></div>

</div>

<div class="et_pb_row row-1">
    <div class="row">
        <div class="col-md-5">
            <div class="row profile-pic-details">
                <div class="col-md-4 profile-pic-container">
                    <div class="crown-icon" style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/crown-icon.png') ?>)"></div>
                    <div class="profile-pic"><?php echo substr(ucfirst($pro_info->display_name), 0, 1) ?></div>
                </div>
                <div class="col-md-7 profile-details-container">
                    <div>
                        <div class="profile-details">
                            <h4 class="display-name"><?php echo ucfirst($pro_meta['full_name'][0]); ?></h4>
                            <p class="display-profession"><?php echo $pro_meta['user_profession'][0]; ?></p>
                            <div class="star-rating">
                            <?php
                                $querystr = "SELECT COUNT(id) as total_reviews, AVG(stars) as avg_stars FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `visibility` = 'visible'";
                                $query_results = $wpdb->get_results($querystr);
                                if (!empty($query_results)) {
                                    foreach ($query_results as $results){
                                        if($results->total_reviews != 0){
                                            $avg_star = round($results->avg_stars);
                                            for($i=1 ; $i <= $avg_star ; $i++){
                                                echo '<span class="fa fa-star checked"></span>';
                                            }
                                            for($i=1 ; $i <= 5 - $avg_star ; $i++){
                                                echo '<span class="fa fa-star unchecked"></span>';
                                            }
                                            echo ' <span class="star-rating-num">'.$avg_star.'.0 ('.$results->total_reviews.' Reviews)</span>';
                            ?>
                            <?php
                                        }
                                        else{
                                            echo '<span class="fa fa-star unchecked"></span>';
                                            echo ' <span class="star-rating-num">0 (0 Reviews)</span>';
                                        }
                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <p class="claim-account-p"><a class="claim-account" href="javascript:void(0)" pro-id="<?php echo $pro_id; ?>">Are you this Professional? Claim your Account</a> <strong><a class="view-reviews" href="#"><?php echo $results->total_reviews; ?> Reviews</a></strong></p>
            <div class="pro-detail-btns">
            <?php
                if ( is_user_logged_in() ) {
                    $user_ID = get_current_user_id();
                    $user_type = get_usermeta($user_ID, 'user_type') ? get_usermeta($user_ID, 'user_type') : "admin";
                    if($user_type == "evaluator"){
                        echo '
                        <a href="javascript:void(0)" type="button" class="view-profile add-detail-rating" pro-id="'.$pro_id.'">Add Detail Rating</a>
                        <a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating" pro-id="'.$pro_id.'">Add Quick Review</a>
                        ';
                    }
                    elseif($user_type == "professional"){
                        echo '
                        <a href="javascript:void(0)" type="button" class="view-profile add-detail-rating" pro-id="0">Add Detail Rating</a>
                        <a href="javascript:void(0)" class="btn btn-outline-primary quick-review add-quick-rating professional" pro-id="0">Add Quick Review</a>
                        ';
                    }
                }
                else{
                    echo '
                    <a href="javascript:void(0)" type="button" class="view-profile add-detail-rating disabled_btn" pro-id="0">Add Detail Rating</a>
                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating disabled_btn" pro-id="0">Add Quick Review</a>
                    ';
                }
            ?>
                <!-- <button type="button" class="btn btn-primary view-profile add-detail-rating">Add Detail Rating</button>
                <button type="button" class="btn btn-outline-primary quick-review add-quick-rating">Add Quick Review</button> -->
            </div>
        </div>
    </div>
    <hr>
</div>
<?php
// echo '<pre>';
// print_r($pro_meta['user_type'][0]);
// echo '</pre>';
?>
<div class="et_pb_row row-1">
    <div class="row">
        <div class="location-details">
            <div class="location-details-icon">
                <img src="<?php echo home_url('/wp-content/uploads/2022/06/map-marker.png') ?>" alt="marker">
            </div>
            <div class="location-details-content">
                <h4>Location</h4>
                <p><?php echo $pro_meta['user_location'][0]; ?></p>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="et_pb_row row-1">
    <div class="row graph-section align-items-end">
        <div class="col-md-6">
            <!-- <h2 class="total-rating">4.9 <span class="out-of">/ 5</span> <span class="out-of-rating"><br>Overall Quality Based on 45 ratings</span></h2>
            <div class="total-stars"> -->
                <?php
                $querystr = "SELECT COUNT(id) as total_reviews, AVG(stars) as avg_stars FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        if($results->total_reviews != 0){
                            echo '
                            <h2 class="total-rating">'.round($results->avg_stars).' <span class="out-of">/ 5</span> <span class="out-of-rating"><br>Overall Quality Based on '.$results->total_reviews.' rating(s)</span></h2>
                            <div class="total-stars">
                            ';
                            $avg_star = round($results->avg_stars);
                            for($i=1 ; $i <= $avg_star ; $i++){
                                echo '<span class="fa fa-star fa-5x checked"></span>';
                            }
                            for($i=1 ; $i <= 5 - $avg_star ; $i++){
                                echo '<span class="fa fa-star fa-5x unchecked"></span>';
                            }
    
                            echo '</div>
                            <p class="total-rating-p">'.round($results->avg_stars).' <span>('.$results->total_reviews.' Reviews)</span></p>
                            ';
                        }
                        else{
                            echo '
                            <h2 class="total-rating">0 <span class="out-of">/ 5</span> <span class="out-of-rating"><br>Overall Quality Based on '.$results->total_reviews.' rating(s)</span></h2>
                            <div class="total-stars">
                            ';
                            echo '<span class="fa fa-star fa-5x unchecked"></span>';
                            echo '</div>
                            <p class="total-rating-p">0 <span>(0 Reviews)</span></p>
                            ';
                        }
                        
                    }
                }
                ?>
                <!-- <span class="fa fa-star fa-5x checked"></span>
                <span class="fa fa-star fa-5x checked"></span>
                <span class="fa fa-star fa-5x checked"></span>
                <span class="fa fa-star fa-5x checked"></span>
                <span class="fa fa-star fa-5x checked"></span> -->
            <!-- </div> -->
            <!-- <p class="total-rating-p">4.95 <span>(25 Reviews)</span></p> -->
            <div class="circle-rating-indi d-flex flex-wrap">

                <?php
                $querystr = "SELECT COUNT(id) as total_rating, SUM(rate_location) as rate_location, SUM(rate_facilities) as rate_facilities,
                SUM(rate_communication) as rate_communication, SUM(rate_value) as rate_value, SUM(rate_management) as rate_management FROM `prof_ratings`
                WHERE `pro_id`=".$pro_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        if($results->total_rating != 0){
                            $total_rating = $results->total_rating;
                            $total_rating_sum = $total_rating * 5;
                            $sum_rate_location = $results->rate_location;
                            $sum_rate_facilities = $results->rate_facilities;
                            $sum_rate_communication = $results->rate_communication;
                            $sum_rate_value = $results->rate_value;
                            $sum_rate_management = $results->rate_management;

                            $percent_location = ($sum_rate_location / $total_rating_sum) * 100;
                            $percent_facilities = ($sum_rate_facilities / $total_rating_sum) * 100;
                            $percent_communication = ($sum_rate_communication / $total_rating_sum) * 100;
                            $percent_value = ($sum_rate_value / $total_rating_sum) * 100;
                            $percent_management = ($sum_rate_management / $total_rating_sum) * 100;


                            if($percent_location < 50){
                                $view_location = '
                                <div class="rating-circle">
                                    <div class="progress-circle p'.$percent_location.'">
                                        <span>'.$percent_location.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Knowledge</p>
                                </div>
                                ';
                            }else{
                                $view_location = '
                                <div class="rating-circle">
                                    <div class="progress-circle over50 p'.$percent_location.'">
                                        <span>'.$percent_location.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Knowledge</p>
                                </div>
                                ';
                            }


                            if($percent_facilities < 50){
                                $view_facilities = '
                                <div class="rating-circle">
                                    <div class="progress-circle p'.$percent_facilities.'">
                                        <span>'.$percent_facilities.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Professionalism</p>
                                </div>
                                ';
                            }else{
                                $view_facilities = '
                                <div class="rating-circle">
                                    <div class="progress-circle over50 p'.$percent_facilities.'">
                                        <span>'.$percent_facilities.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Professionalism</p>
                                </div>
                                ';
                            }


                            if($percent_communication < 50){
                                $view_communication = '
                                <div class="rating-circle">
                                    <div class="progress-circle p'.$percent_communication.'">
                                        <span>'.$percent_communication.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Cooperation</p>
                                </div>
                                ';
                            }else{
                                $view_communication = '
                                <div class="rating-circle">
                                    <div class="progress-circle over50 p'.$percent_communication.'">
                                        <span>'.$percent_communication.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Cooperation</p>
                                </div>
                                ';
                            }

                            if($percent_value < 50){
                                $view_value = '
                                <div class="rating-circle">
                                    <div class="progress-circle p'.$percent_value.'">
                                        <span>'.$percent_value.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Communication</p>
                                </div>
                                ';
                            }else{
                                $view_value = '
                                <div class="rating-circle">
                                    <div class="progress-circle over50 p'.$percent_value.'">
                                        <span>'.$percent_value.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Communication</p>
                                </div>
                                ';
                            }

                            if($percent_management < 50){
                                $view_management = '
                                <div class="rating-circle">
                                    <div class="progress-circle p'.$percent_management.'">
                                        <span>'.$percent_management.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Review/Execution</p>
                                </div>
                                ';
                            }else{
                                $view_management = '
                                <div class="rating-circle">
                                    <div class="progress-circle over50 p'.$percent_management.'">
                                        <span>'.$percent_management.'%</span>
                                        <div class="left-half-clipper">
                                            <div class="first50-bar"></div>
                                            <div class="value-bar"></div>
                                        </div>
                                    </div>
                                    <p>Review/Execution</p>
                                </div>
                                ';
                            }


                            echo $view_location . $view_facilities . $view_communication . $view_value . $view_management;
                        }else{
                            echo "No Rating Yet";
                        }
                        
                    }
                }
                ?>


            </div>
        </div>
        <div class="col-md-6">

        <?php
        $querystr = "SELECT COUNT(id) as total_reviews FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `visibility` = 'visible'";
        $query_results = $wpdb->get_results($querystr);
        if (!empty($query_results)) {
            foreach ($query_results as $results){
                $total_reviews = $results->total_reviews;

                $querystr = "SELECT COUNT(id) as five_reviews FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `stars`=5 AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        $five_reviews = $results->five_reviews;
                        if($five_reviews != 0){
                            $percent_five = ($five_reviews / $total_reviews) * 100;
                            echo '
                                <div class="progress-line-bar-container">
                                    <span>Marvelous</span>
                                    <div class="progress" style="height: 26px; width:50%">
                                        <div class="progress-bar" role="progressbar" style="width: '.round($percent_five).'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>'.round($percent_five).'%</span>
                                </div>
                            ';
                        }else{
                            echo '
                                <div class="progress-line-bar-container">
                                    <span>Marvelous</span>
                                    <div class="progress" style="height: 26px; width:50%">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>0%</span>
                                </div>
                            ';
                        }
                        
                    }
                }

                $querystr = "SELECT COUNT(id) as four_reviews FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `stars`=4 AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        $four_reviews = $results->four_reviews;
                        if($four_reviews != 0){
                            $percent_four = ($four_reviews / $total_reviews) * 100;
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Good</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: '.round($percent_four).'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>'.round($percent_four).'%</span>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Good</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>0%</span>
                            </div>
                            ';
                        }
                    }
                }

                $querystr = "SELECT COUNT(id) as three_reviews FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `stars`=3 AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        $three_reviews = $results->three_reviews;
                        if($three_reviews != 0){
                            $percent_three = ($three_reviews / $total_reviews) * 100;
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Satisfactory</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: '.round($percent_three).'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>'.round($percent_three).'%</span>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Satisfactory</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>0%</span>
                            </div>
                            ';
                        }
                    }
                }

                $querystr = "SELECT COUNT(id) as two_reviews FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `stars`=2 AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        $two_reviews = $results->two_reviews;
                        if($two_reviews != 0){
                            $percent_two = ($two_reviews / $total_reviews) * 100;
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Need Imp</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: '.round($percent_two).'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>'.round($percent_two).'%</span>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Need Imp</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>0%</span>
                            </div>
                            ';
                        }
                    }
                }

                $querystr = "SELECT COUNT(id) as one_reviews FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `stars`=1 AND `visibility` = 'visible'";
                $query_results = $wpdb->get_results($querystr);
                if (!empty($query_results)) {
                    foreach ($query_results as $results){
                        $one_reviews = $results->total_reviews;
                        if($one_reviews != 0){
                            $percent_one = ($one_reviews / $total_reviews) * 100;
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Bad</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: '.round($percent_one).'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>'.round($percent_one).'%</span>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="progress-line-bar-container">
                                <span>Bad</span>
                                <div class="progress" style="height: 26px; width:50%">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>0%</span>
                            </div>
                            ';
                        }
                    }
                }
            }
        }
        
        ?>

        </div>
    </div>
    <hr>
</div>


<div class="et_pb_row row1">
    <div class="row cmt-section">
        <?php
            $loggedin_user_id = get_current_user_id();
            $querystr = "SELECT * FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible' ORDER BY `id` DESC";
            $query_results = $wpdb->get_results($querystr);
            if (!empty($query_results)) {
                foreach ($query_results as $results){
                    $face_url = "";
                    $user_meta = get_user_meta($results->user_id);
                    $user_info = get_userdata($results->user_id);
                    if($results->smiley == "happy"){
                        $face_url = home_url('/wp-content/uploads/2022/06/happy.png');
                    }else{
                        $face_url = home_url('/wp-content/uploads/2022/06/sadfaceChecked.png');
                    }
        ?>
        <div class="col-md-12" id="<?php echo $results->id; ?>">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between card-top">
                    <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                        <div class="logo-pic">
                            <?php echo substr(ucfirst($user_info->display_name), 0, 1) ?>
                            <div class="happy-icon"style="background: url(<?php echo $face_url; ?>)"></div>
                        </div>
                        <div class="ms-2 c-details">
                            <h2 class="mb-2 pb-0"><?php echo ucfirst($user_info->display_name); ?></h2> 
                            <ul class="cmt-meta">
                                <li>
                                    <div class="total-stars">
                                        <?php
                                            for($i=1 ; $i <= $results->stars ; $i++){
                                                echo '<span class="fa fa-star fa-5x checked"></span>';
                                            }
                                            for($i=1 ; $i <= 5 - $results->stars ; $i++){
                                                echo '<span class="fa fa-star fa-5x unchecked"></span>';
                                            }
                                        ?>
                                        <span class="cmt-num-rating"> &nbsp; <?php echo $results->stars ?>.0</span>
                                    </div>
                                </li>
                                <li>
                                    <h4>Review Date&nbsp;: <span> 
                                        <?php 
                                            $time=strtotime($results->review_date);
                                            $month=date("M",$time);
                                            $year=date("Y",$time);
                                            echo $month ." ".$year; 
                                        ?>
                                    </span></h4>
                                </li>
                                <!-- <li>
                                    <h4>28 Reviews</h4>
                                </li> -->
                                <li>
                                <a href="javascript:void(0)" type="button" class="btn btn-primary show-hide-cmt-front">Show Replies</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="like-dislike-container">
                        <ul class="like-dislike">
                            <li class="dislike">
                            <?php
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


                                $like_url = home_url('/wp-content/uploads/2022/06/like-1.png');
                                $dislike_url = home_url('/wp-content/uploads/2022/06/like-2.png');
                                $reaction_check = "SELECT * FROM `prof_ratings_reaction` WHERE `r_id`=".$results->id." AND `user_id` = ".$loggedin_user_id." ";
                                $query_reaction_check_results = $wpdb->get_results($reaction_check);
                                if (!empty($query_reaction_check_results)) {
                                    foreach ($query_reaction_check_results as $reaction_check_result){
                                        if($reaction_check_result->reaction == "like"){
                                            $like_url = home_url('/wp-content/uploads/2022/06/lkedChecked.png');
                                        }
                                        else{
                                            $dislike_url = home_url('/wp-content/uploads/2022/06/dislikedChecked.png');
                                        }
                                    }
                                }
                            ?>
                                <span><?php echo $like; ?></span>
                                <?php
                                    if(is_user_logged_in()){
                                        ?>
                                        <a href="javascript:void(0)" r-id="<?php echo $results->id; ?>" u-id="<?php echo $results->user_id; ?>" class="hit-like"><img src="<?php echo $like_url; ?>" alt="dislike"></a>
                                        <?php
                                    }else{
                                        ?>
                                        <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-2.png') ?>" alt="dislike">
                                        <?php
                                    }
                                ?>
                                
                            </li>
                            <li class="like">
                                <span><?php echo $dislike; ?></span>
                                <?php
                                if(is_user_logged_in()){
                                    ?>
                                    <a href="javascript:void(0)" r-id="<?php echo $results->id; ?>" u-id="<?php echo $results->user_id; ?>" class="hit-dislike"><img src="<?php echo $dislike_url; ?>" alt="like"></a>
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-1.png') ?>" alt="like">
                                    <?php
                                }
                                ?>
                                
                            </li>
                        </ul> 
                    </div>
                </div>
                <span class="divider"></span>
                <div class="pro-details">
                    <h3 class="heading">Review Title: <?php echo $results->title; ?></h3>
					<p><b>Situation:</b> <?php echo $results->situation; ?></p>
					<p><b>CO's Performance:</b> <?php echo $results->opinion; ?></p>
					<p><b>Business Affects:</b> <?php echo $results->business_effect; ?></p>
					<p><b>Comments:</b> <?php echo $results->comments; ?></p>
                </div>
                <div class="reply-container mt-4" style="display: none;">
                    <h3 class="mb-3">Replies:</h3>
                    <?php
                    $reaction_reply = "SELECT *  FROM `prof_ratings_reply` WHERE `r_id`=".$results->id."";
                    $query_results_replies = $wpdb->get_results($reaction_reply);
                    if (!empty($query_results_replies)) {
                        foreach ($query_results_replies as $results_reply){
                            ?>
                                <div class="col-md-11">
                                    <div class="card p-3 mb-4">
                                        <div class="d-flex justify-content-between card-top">
                                            <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                                                <!-- <div class="logo-pic">
                                                    <?php echo substr(ucfirst($pro_info->display_name), 0, 1) ?>
                                                    <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/happy.png') ?>)"></div>
                                                </div> -->
                                                <div class="ms-2 c-details">
                                                    <h2 class="mb-2 pb-0"><?php echo ucfirst($pro_info->display_name); ?></h2> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pro-details">
                                            <p><?php echo $results_reply->reply; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <?php
                // $reaction_reply = "SELECT *  FROM `prof_ratings_reply` WHERE `r_id`=".$results->id."";
                // $query_results_replies = $wpdb->get_results($reaction_reply);
                // if (!empty($query_results_replies)) {
                //     foreach ($query_results_replies as $results_reply){
                        ?>
                            <!-- <div class="col-md-11">
                                <div class="card p-3 mb-4">
                                    <div class="d-flex justify-content-between card-top">
                                        <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                                            <div class="logo-pic">
                                                <?php echo substr(ucfirst($user_info->display_name), 0, 1) ?>
                                                <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/happy.png') ?>)"></div>
                                            </div>
                                            <div class="ms-2 c-details">
                                                <h2 class="mb-2 pb-0"><?php echo ucfirst($user_info->display_name); ?></h2> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-details">
                                        <p><?php echo $results->comments; ?></p>
                                    </div>
                                </div>
                            </div> -->
                        <?php
                //     }
                // }else{
                // }
                ?>
            </div>
        </div>
        <?php
                }
            }
            else{
                echo "No Comments Yet";
            }
        ?>

        <!-- <div class="col-md-12">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between card-top">
                    <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                        <div class="logo-pic">
                            J
                            <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/happy.png') ?>)"></div>
                        </div>
                        <div class="ms-2 c-details">
                            <h2 class="mb-2 pb-0">Jacquline</h2> 
                            <ul class="cmt-meta">
                                <li>
                                    <div class="total-stars">
                                        <span class="fa fa-star fa-5x checked"></span>
                                        <span class="fa fa-star fa-5x checked"></span>
                                        <span class="fa fa-star fa-5x checked"></span>
                                        <span class="fa fa-star fa-5x checked"></span>
                                        <span class="fa fa-star fa-5x checked"></span>
                                        <span class="cmt-num-rating"> &nbsp; 5.0</span>
                                    </div>
                                </li>
                                <li>
                                    <h4>Review Date&nbsp;: <span> Dec 2022</span></h4>
                                </li>
                                <li>
                                    <h4>28 Reviews</h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="like-dislike-container">
                        <ul class="like-dislike">
                            <li class="dislike">
                                <span>0</span>
                                <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-2.png') ?>" alt="dislike">
                            </li>
                            <li class="like">
                                <span>60</span>
                                <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-1.png') ?>" alt="like">
                            </li>
                        </ul> 
                    </div>
                </div>
                <span class="divider"></span>
                <div class="pro-details">
                    <h3 class="heading">Best Plumber</h3>
                    <p>CLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ornare ipsum ut neque aliquam fermentum. Aenean maximus ultricies consequat. In condim feugiat condimentum dignissim. Ut congue,</p>
                </div>
            </div>
        </div> -->

    </div>

    <hr>
</div>


<div class="et_pb_row row1">
    <div class="row">
        <div class="col-md-12 similar-head mb-3">
            <h2>Similar</h2>
        </div>
    </div>
    <div class="row short-rating-card">
        <?php
            $professionals = get_users(
                array(
                    'meta_key' => 'user_profession',
                    'meta_value' => $pro_meta['user_profession'][0],
                    'exclude' => $pro_id,
                    'number'  => 3
                )
            );
            if($professionals){
                foreach($professionals as $professional){
					$similar_pro = get_user_meta($professional->ID);
                   
                
            ?>
        <div class="col-md-4">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between card-top">
                    <div class="d-flex flex-row align-items-center" style="column-gap: 12px;">
                    <div class="logo-pic">
                            <?php echo substr(ucfirst($professional->display_name), 0, 1) ?>
                        <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/crown-icon.png'); ?>)">
                            </div>
                    </div>
                        <div class="ms-2 c-details">
                            <h2 class="mb-0 pb-0"><?php echo ucfirst($similar_pro['full_name'][0]); ?></h2> 
                        <span id=profession><?php echo get_usermeta($professional->ID, 'user_profession'); ?></span>
                        <?php
                        $querystr = "SELECT COUNT(id) as total_reviews, AVG(stars) as avg_stars FROM `prof_ratings` WHERE `pro_id`=".$professional->ID." AND `visibility` = 'visible'";
                        $query_results = $wpdb->get_results($querystr);
                        if (!empty($query_results)) {
                            foreach ($query_results as $results){
                        ?>
                        <span class="fa fa-star checked"><span class="rating-num"> <?php echo round($results->avg_stars); ?></span></span>
                        <?php
                            }
                        }
                        else{
                            echo '<span class="fa fa-star checked"><span class="rating-num"> 0</span></span>';
                        }
                        ?>
                        </div>
                    </div>
                    <div class="reviews"> 
                        <span><span id="c_reviews"><?php echo $results->total_reviews; ?></span> Reviews</span> 
                    </div>
                </div>
                <span class="divider"></span>
                <div class="pro-details">
                    <h3 class="heading">Location</h3>
                    <p><?php echo get_usermeta($professional->ID, 'user_location'); ?></p>
                </div>
                <span class="divider"></span>
                <div>
                    <a href="/tracie/professional-details/?id=<?php echo $professional->ID; ?>" type="button" class="btn btn-primary view-profile">View Profile</a>
                    <?php
                        if ( is_user_logged_in() ) {
                            $user_ID = get_current_user_id();
                            $user_type = get_usermeta($user_ID, 'user_type') ? get_usermeta($user_ID, 'user_type') : "admin";
                            if($user_type == "evaluator"){
                                echo '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating" pro-id="'.$professional->ID.'">Add Quick Review</a>';
                            }
                            elseif($user_type == "professional"){
                                echo '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating professional" pro-id="0">Add Quick Review</a>';
                            }
                        }
                        else{
                            echo '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating disabled_btn" pro-id="0">Add Quick Review</a>';
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php
                }
            }
            else{
                echo '<p>No similar professional found at the moment!</p>';
            }
        ?>

        <!-- <div class="col-md-4">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between card-top">
                    <div class="d-flex flex-row align-items-center logo-meta-container" style="column-gap: 12px;">
                       
                      <div class="logo-pic">
                            J
                          <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/crown-icon.png') ?>)">
                        	</div>
                      </div>
                        <div class="ms-2 c-details">
                            <h2 class="mb-0 pb-0">Jacquline</h2> 
                          <span id=profession>Plumber</span>
                          <span class="fa fa-star checked"><span class="rating-num"> 3.5</span></span>
                        </div>
                    </div>
                  <div class="reviews"> 
                    <span><span id="c_reviews">23</span> Reviews</span> 
                  </div>
                </div>
              <span class="divider"></span>
                <div class="pro-details">
                    <h3 class="heading">Location</h3>
                    <p>California University of Pennsylvania,5075 Cameron St. Ste. D Las Vegas , NV 89118</p>
                </div>
              <span class="divider"></span>
              <div>
              <a href="/tracie/professional-details/" type="button" class="btn btn-primary view-profile">View Profile</a>
                <button type="button" class="btn btn-outline-primary quick-review add-quick-rating">Add Quick Review</button>
              </div>
            </div>
        </div> -->
    </div>
</div>
















<?php get_footer(); ?>