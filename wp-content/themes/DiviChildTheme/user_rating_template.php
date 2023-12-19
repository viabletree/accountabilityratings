<?php
/* 
Template Name: User Rating Template 
*/
get_header();

$user_id = get_current_user_id();
$user_meta = get_user_meta($user_id);
$user_info = get_userdata($user_id);

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
        <a href="<?php echo home_url('/user-rating-dashboard'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237834.png') ?>" alt=""></a>
      </li>
      <li>
        <a href="<?php echo home_url('/user-setting'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237836.png') ?>" alt=""></a>
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
                    <div class="col-md-1 avatar"><?php echo substr(ucfirst($user_info->display_name), 0, 1) ?></div>
                    <div class="col-md-10">
                        <h3 class="user-name"><?php echo ucfirst($user_info->display_name); ?></h3>
                        <p class="user-email"><?php echo $user_info->user_email; ?></p>
                        <p class="user-email"><a href="<?php echo home_url('/wp-login.php?action=logout'); ?>">Logout</a></p>
                    </div>
                </div>
            </div>
      </div>
    </nav>
  </div>

  <section id="content-wrapper">
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="user-statics">
                <ul>
                    <?php

                    $totalReviews = "SELECT COUNT(id) AS total_rating FROM `prof_ratings` WHERE `user_id`=".$user_id." AND `visibility` = 'visible'";
                    $query_results = $wpdb->get_results($totalReviews);
                    if (!empty($query_results)) {
                        foreach ($query_results as $results){
                            echo '<li><p>Total Reviews: </p><span>'.$results->total_rating.'</span></li>';
                        }
                    }else{
                        echo '<li><p>Total Reviews: </p><span>0</span></li>';
                    }


                    $deletedReviews = "SELECT COUNT(id) AS deleted_rating FROM `prof_ratings` WHERE `user_id`=".$user_id." AND `visibility` = 'hidden'";
                    $query_results = $wpdb->get_results($deletedReviews);
                    if (!empty($query_results)) {
                        foreach ($query_results as $results){
                            echo '<li><p>Delete Reviews: </p><span>'.$results->deleted_rating.'</span></li>';
                        }
                    }else{
                        echo '<li><p>Delete Reviews: </p><span>0</span></li>';
                    }


                    $totalComments = "SELECT COUNT(id) AS total_comments FROM `prof_ratings` WHERE `user_id`=".$user_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible'";
                    $query_results = $wpdb->get_results($totalComments);
                    if (!empty($query_results)) {
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
                        <input type="text" name="searchreviews" id="searchreviews" placeholder="Search Here">
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle searchreviews-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            All Reviews
                        </button>
                        <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>

    <div class="row cmt-section user-cmt-section mt-5 user-search-section">

        <?php

            global $wpdb;
            // $total = 0;
            $totalComments = "SELECT COUNT(id) AS total_comments FROM `prof_ratings` WHERE `user_id`=".$user_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible'";
            $query_results = $wpdb->get_results($totalComments);
            if (!empty($query_results)) {
                foreach ($query_results as $results){
                    $total = $results->total_comments;
                }
            }
            $total = $results->total_comments;
            // $total = 2;
            // print_r($total);
            $post_per_page = 5;
            $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
            $offset = ( $page * $post_per_page ) - $post_per_page;
        
        $querystr = "SELECT * FROM `prof_ratings` WHERE `user_id`=".$user_id." AND `review_type` = 'detailed review' AND `visibility` = 'visible' ORDER BY `id` DESC LIMIT ".$post_per_page." OFFSET ".$offset." ";
        $query_results = $wpdb->get_results($querystr);
        if (!empty($query_results)) {
            foreach ($query_results as $results){
                $pro_meta = get_user_meta($results->pro_id);
                $pro_info = get_userdata($results->pro_id);
        ?>
        <div class="col-md-12">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between card-top">
                    <div class="d-flex flex-row align-items-center" style="column-gap: 10px;">
                        <div class="logo-pic">
                            <?php echo substr(ucfirst($pro_info->display_name), 0, 1) ?>
                            <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/happy.png') ?>)"></div>
                        </div>
                        <div class="ms-2 c-details">
                            <h2 class="mb-2 pb-0"><?php echo ucfirst($pro_info->display_name); ?></h2> 
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
                        </div>
                    </div>
                    <div class="like-dislike-container like-dislike-container-dashboard">
                        <ul class="like-dislike">
                            <li class="dislike">
                                <a href="<?php echo home_url('/professional-details/?id='.$results->pro_id.'#'.$results->id);?>" class="view-review" r-id="<?php echo $results->id; ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-view.png') ?>" alt="dislike"></a>
                            </li>
                            <li class="like">
                                <a href="javascript:void(0)" class="edit-review" r-id="<?php echo $results->id; ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-edit.png') ?>" alt="like"></a>
                            </li>
                            <li class="like">
                                <a href="javascript:void(0)" class="delete-review" r-id="<?php echo $results->id; ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-delete.png') ?>" alt="like"></a>
                            </li>
                        </ul> 
                    </div>
                </div>
                <div class="pro-details mt-3">
                    <h3 class="heading">Review Title:<?php echo $results->title; ?></h3>
                    <p>Comments<?php echo $results->comments; ?></p>
                </div>
            </div>
        </div>

        <?php
            }
        }else{
            echo "No reviews yet";
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
                            </ul>
                        </div>
                    </div>
                    <div class="like-dislike-container  like-dislike-container-dashboard">
                        <ul class="like-dislike">
                            <li class="dislike">
                                <img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-view.png') ?>" alt="dislike">
                            </li>
                            <li class="like">
                                <img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-edit.png') ?>" alt="like">
                            </li>
                            <li class="like">
                                <img src="<?php echo home_url('/wp-content/uploads/2022/06/cmt-delete.png') ?>" alt="like">
                            </li>
                        </ul> 
                    </div>
                </div>
                <div class="pro-details mt-3">
                    <h3 class="heading">Best Plumber</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ornare ipsum ut neque aliquam fermentum. Aenean maximus ultricies consequat. In condimentum sem feugiat condimentum dignissim. Ut congue, nibh sit amet aliquet dictum, tellus enim volutpat tellus, a volutpat metus erat et purus. Integer eu rhoncus lacus,</p>
                </div>
            </div>
        </div> -->
        

    </div>
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
