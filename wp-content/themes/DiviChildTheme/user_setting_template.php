<?php
/* 
Template Name: User Setting Template 
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
      <li>
        <a href="<?php echo home_url('/user-rating-dashboard'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237834.png') ?>" alt=""></a>
      </li>
      <li class="active">
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
                        <p class="user-email"><?php echo ucfirst($user_info->user_email); ?></p>
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
                <h1 class="main-heading">Profile Settings</h1>
                <div class="col-lg-12">
                    <div class="edit-profile-container">
                        <h2 class="mt-3 mb-4">Edit Profile</h2>
                        <form id="edit_profile">
                            <div class="row">
                                <div class="form-group col-lg-6 mb-2">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Type Here" value="<?php echo $user_meta['full_name'][0]; ?>" />
                                </div>
                                <div class="form-group col-lg-6 mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Type Here" value="<?php echo $user_info->user_email; ?>" />
                                </div>
                                <div class="form-group btn-div mt-3">
                                    <button type="submit" class="btn btn-primary" id="edit_profile_btn">Save</button>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </form>
                        <?php 
                            echo '<div id="wp_edit_user_profile_error" class="mt-3"></div>';                                 
                        ?>
                    </div>
                </div>

                <div class="col-lg-12 mt-5">
                    <div class="change-password-container">
                        <h2 class="mt-3 mb-4">Change Password</h2>
                        <form id="change_password">
                            <div class="row">
                                <div class="form-group col-lg-6 mb-2">
                                    <label for="oldpassword">Old Password</label>
                                    <input type="password" id="oldpassword" name="oldpassword" placeholder="Type Here" />
                                    <span class="togglePasword">show</span>
                                </div>
                                <div class="form-group col-lg-6 mb-2">
                                    <label for="newpassword">New Password</label>
                                    <input type="password" id="newpassword" name="newpassword" placeholder="Type Here" />
                                    <span class="togglePasword">show</span>
                                </div>
                                <div class="form-group col-lg-6 mb-2">
                                    <label for="confirmpassword">Confirm Password</label>
                                    <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Type Here" />
                                    <span class="togglePasword">show</span>
                                </div>
                                <div class="form-group btn-div mt-3">
                                    <button type="submit" class="btn btn-primary" id="change_password_btn">Save</button>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </form>
                        <?php 
                            echo '<div id="wp_edit_user_password_error" class="mt-3"></div>';                                 
                        ?>
                    </div>
                </div>
            </div>
        </div>
  </section>

</div>



<?php

get_footer();
?>
