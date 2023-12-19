<?php
/* 
Template Name: Professional Reviews Template 
*/
get_header();
$pro_id = get_current_user_id();
$pro_meta = get_user_meta($pro_id);
$pro_info = get_userdata($pro_id);
$total_detailed_review = 0;

global $wp;
?>
<style>
    .sidebar-nav > li.active a::before {
    content: "";
    background-image: url(<?php echo home_url('/wp-content/uploads/2022/06/dashboard-nav-active.png') ?>);
  }
</style>

<div id="wrapper">

    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo home_url()?>"><img src="<?php echo home_url('/wp-content/uploads/2022/06/footer-logo.png') ?>" alt=""></a>
        </div>
        <ul class="sidebar-nav">
        <li class="active">
            <a href="<?php echo home_url('/professional-reviews-dashboard') ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237832.png') ?>" alt=""></a>
        </li>
        <li>
            <a href="<?php echo home_url('/professional-settings') ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237836.png') ?>" alt=""></a>
        </li>
        </ul>
    </aside>

    <div id="navbar-wrapper">
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
            </div>
            <div class="user-top-card-container">
                    <div class="row align-items-center flex-wrap">
                        <div class="col-md-1 avatar"><?php echo substr(ucfirst($pro_info->display_name), 0, 1) ?></div>
                        <div class="col-md-10">
                            <h3 class="user-name"><?php echo ucfirst($pro_info->display_name); ?></h3>
                            <p class="user-email"><?php echo $pro_info->user_email; ?></p>
                            <p class="user-email"><a href="<?php echo home_url('/wp-login.php?action=logout'); ?>">Logout</a></p>
                        </div>
                    </div>
                </div>
        </div>
        </nav>
    </div>

    
    <section id="content-wrapper">
        <div class="main-container">
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="user-statics">
                        <ul>
                        <?php
                            $totalReviews = "SELECT COUNT(id) AS total_rating FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `visibility` = 'visible'";
                            $query_results = $wpdb->get_results($totalReviews);
                            if (!empty($query_results)) {
                                foreach ($query_results as $results){
                                    echo '<li><p>Total Reviews: </p><span>'.$results->total_rating.'</span></li>';
                                }
                            }else{
                                echo '<li><p>Total Reviews: </p><span>0</span></li>';
                            }


                            $average_stars = "SELECT AVG(stars) AS average_stars FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `visibility` = 'visible'";
                            $query_results = $wpdb->get_results($average_stars);
                            if (!empty($query_results)) {
                                foreach ($query_results as $results){
                                    echo '<li><p>Average Stars: </p><span>'.round($results->average_stars).'</span></li>';
                                }
                            }else{
                                echo '<li><p>Average Stars: </p><span>0</span></li>';
                            }


                            $totalComments = "SELECT COUNT(id) AS total_comments FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible'";
                            $query_results = $wpdb->get_results($totalComments);
                            if (!empty($query_results)) {
                                $total_detailed_review = $results->total_comments;
                                foreach ($query_results as $results){
                                    echo '<li><p>Total Comments: </p><span>'.$results->total_comments.'</span></li>';
                                }
                            }else{
                                echo '<li><p>Total Comments: </p><span>0</span></li>';
                            }

                        ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row search-reviews-container mt-4">
                <div class="col-lg-12 search-reviews">
                    <div class="form-group">
                        <input type="text" name="searchreviews" id="searchreviews_pro" placeholder="Search Here">
                    </div>
                <!--<div class="dropdown">
                        <button class="btn dropdown-toggle searchreviews-btn searchreviews-btn-pro" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            All Reviews
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul> 
                    </div>-->
                </div>
            </div>

            <div class="row cmt-section user-cmt-section mt-5 pro-search-section">
            <?php
            // // how many rows to show per page
            // $rowsPerPage = 1;

            // // by default we show first page
            // $pageNum = 1;

            // // if $_GET['page'] defined, use it as page number
            // if(isset($_GET['pageno']))
            // {
            //     $pageNum = $_GET['pageno'];
            // }

            // // counting the offset
            // $offset = ($pageNum - 1) * $rowsPerPage;


            global $wpdb;

            $totalComments = "SELECT COUNT(id) AS total_comments FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible'";
            $query_results = $wpdb->get_results($totalComments);
            if (!empty($query_results)) {
                foreach ($query_results as $results){
                    $total = $results->total_comments;
                }
            }
            // $total = 2;
            // print_r($total);
            $post_per_page = 5;
            $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
            $offset = ( $page * $post_per_page ) - $post_per_page;


            $querystr = "SELECT * FROM `prof_ratings` WHERE `pro_id`=".$pro_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible'  ORDER BY `id` DESC LIMIT ".$post_per_page." OFFSET ".$offset." ";
            $query_results = $wpdb->get_results($querystr);
            if (!empty($query_results)) {
                foreach ($query_results as $results){
                    $user_meta = get_user_meta($results->user_id);
                    $user_info = get_userdata($results->user_id);
                    if($results->smiley == "happy"){
                        $face_url = home_url('/wp-content/uploads/2022/06/happy.png');
                    }else{
                        $face_url = home_url('/wp-content/uploads/2022/06/sadfaceChecked.png');
                    }
            ?>
                <div class="col-md-12">
                    <div class="card p-3 mb-4">
                        <div class="d-flex justify-content-between card-top card-top-with-reply">
                            <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                                <div class="logo-pic">
                                    <?php echo substr(ucfirst($user_info->display_name), 0, 1) ?>
                                    <div class="happy-icon"style="background: url(<?php echo $face_url; ?>)"></div>
                                </div>
                                <div class="ms-2 c-details">
                                    <h2 class="mb-2 pb-0"><?php echo ucfirst($user_info->display_name); ?></h2> 
                                    <div class="meta-reply-container">
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
                                        </ul>
                                        <div class="reply-btn-div">
                                            <a href="javascript:void(0)" type="button" 
                                                class="btn btn-primary reply-user-btn" r-id="<?php echo $results->id; ?>">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="like-dislike-container like-dislike-container-dashboard">
                                <ul class="like-dislike">
                                    <li class="dislike">
                                        <a href="<?php echo home_url('/professional-details/?id='.$pro_id.'#'.$results->id);?>"><img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-view.png') ?>" alt="dislike"></a>
                                    </li>

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
                                        ?>
                                        
                                        <!-- <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-2.png') ?>" alt="dislike"> -->
                                        <span><b>Like: </b></span>
                                        <span><?php echo $like; ?></span>
                                    </li>
                                    <li class="like">
                                        
                                        <!-- <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-1.png') ?>" class="mb-2" alt="like"> -->
                                        <span><b>Dislike: </b></span>
                                        <span><?php echo $dislike; ?></span>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                        <div class="pro-details mt-4">
                            <div class="user-cmt">
                            <h3 class="heading">Review Title: <?php echo $results->title; ?></h3>
                                <p>Comments: <?php echo $results->comments; ?></p>
                            </div>
                        <!--<div class="show-hide-cmt-div">
                                <a href="javascript:void(0)" type="button" class="btn btn-primary show-hide-cmt">Expand</a>
                            </div>-->
                        </div>
                        <div class="reply-container mt-4">
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Contracting Professional</h2>
                                <p class="reply-content"><?php echo $results->contracting_professional; ?></p>
                            </div>
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Federal Agency</h2>
                                <p class="reply-content"><?php echo $results->federal_agency; ?></p>
                            </div>
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Type of Contract</h2>
                                <p class="reply-content"><?php echo $results->contract_type; ?></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php
                }
            }
            else{
                echo '<p>No Reviews Yet.</p>';
            }
            ?>

                <!-- <div class="col-md-12">
                    <div class="card p-3 mb-4">
                        <div class="d-flex justify-content-between card-top card-top-with-reply">
                            <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                                <div class="logo-pic">
                                    J
                                    <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/happy.png') ?>)"></div>
                                </div>
                                <div class="ms-2 c-details">
                                    <h2 class="mb-2 pb-0">Jacquline</h2> 
                                    <div class="meta-reply-container">
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
                                        </ul>
                                        <div class="reply-btn-div">
                                            <a href="#" type="button" class="btn btn-primary reply-user-btn">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="like-dislike-container like-dislike-container-dashboard">
                                <ul class="like-dislike">
                                    <li class="dislike">
                                        <img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-view.png') ?>" alt="dislike">
                                    </li>
                                    <li class="dislike">
                                        <span>0</span>
                                        <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-2.png') ?>" alt="dislike">
                                    </li>
                                    <li class="like">
                                        <span>60</span>
                                        <img src="<?php echo home_url('/wp-content/uploads/2022/06/like-1.png') ?>" class="mb-2" alt="like">
                                    </li>
                                </ul> 
                            </div>
                        </div>
                        <div class="pro-details mt-4">
                            <div class="user-cmt">
                                <h3 class="heading">Best Plumber</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ornare ipsum ut neque aliquam fermentum. Aenean maximus ultricies consequat. In condimentum sem feugiat condimentum dignissim. Ut congue, nibh sit amet aliquet dictum, tellus enim volutpat tellus, a volutpat metus erat et purus. Integer eu rhoncus lacus,</p>
                            </div>
                            <div class="show-hide-cmt-div">
                                <a href="javascript:void(0)" type="button" class="btn btn-primary show-hide-cmt">Expand</a>
                            </div>
                        </div>
                        <div class="reply-container mt-4">
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Contracting Professional</h2>
                                <p class="reply-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, fugiat?</p>
                            </div>
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Federal Agency</h2>
                                <p class="reply-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, a sunt rerum fuga maxime voluptatem voluptates praesentium debitis eum provident!</p>
                            </div>
                            <div class="reply">
                                <span class="divider"></span>
                                <h2 class="reply-title">Type of Contract</h2>
                                <p class="reply-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, fugiat?</p>
                            </div>
                        </div>
                    </div>
                    
                </div> -->
            </div>
            <!-- <div class="c_pagination">
                <a href="#">&laquo;</a>
                <a href="http://localhost/tracie/professional-reviews-dashboard/?pageno=1">1</a>
                <a href="http://localhost/tracie/professional-reviews-dashboard/?pageno=2" class="active">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div> -->
            <?php
            
            echo '<div class="mt-5">';
            echo paginate_links( array(
            'base' => add_query_arg( 'cpage', '%#%' ),
            'format' => '',
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
            'total' => ceil($total / $post_per_page),
            'current' => $page,
            'type' => 'list'
            ));
            echo '</div>';
            ?>
        </div>
    </section>
</div>



<?php

get_footer();
?>
