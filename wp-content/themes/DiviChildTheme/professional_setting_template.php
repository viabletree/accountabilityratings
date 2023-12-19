<?php
/* 
Template Name: Professional Setting Template 
*/
get_header();

$pro_id = get_current_user_id();
$pro_meta = get_user_meta($pro_id);
$pro_info = get_userdata($pro_id);

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
        <a href="<?php echo home_url('/professional-reviews-dashboard') ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237832.png') ?>" alt=""></a>
      </li>
      <li class="active">
        <a href="<?php echo home_url('/professional-settings'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2022/07/Group-237836.png') ?>" alt=""></a>
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
                <h1 class="main-heading">Profile Settings</h1>
                <div class="col-lg-12">
                    <div class="edit-profile-container">
                        <h2 class="mt-3 mb-4">Edit Your Profile</h2>
                        <form id="edit_professional_profile">
                            <div class="row">
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Type Here" value="<?php echo $pro_meta['full_name'][0]; ?>" />
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Type Here" value="<?php echo $pro_info->user_email; ?>" />
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="profession">Add Profession</label>
                                    <input type="text" id="profession" name="profession" placeholder="Type Here" value="<?php echo $pro_meta['user_profession'][0]; ?>" />
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="location">Location</label>
                                    <input type="text" id="autocomplete" onFocus="geolocate()" name="location" placeholder="Type Here" value="<?php echo $pro_meta['user_location'][0]; ?>" />

                                    <input type="hidden" name="city" id="locality" placeholder="Type Here">
                                    <input type="hidden" name="state" id="administrative_area_level_1" placeholder="Type Here">
                                    <input type="hidden" name="zip_code" id="postal_code" placeholder="Type Here">
                                    <input type="hidden" name="country" id="country" placeholder="Type Here">
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" id="phone" name="phone" placeholder="Type Here" value="<?php echo $pro_meta['user_phone'][0]; ?>" />
                                </div>
                                <div class="form-group btn-div mt-3">
                                    <button type="submit" class="btn btn-primary" id="edit_professional_profile_btn">Save</button>
                                </div>
                            </div>
                        </form>
                        <?php 
                            echo '<div id="wp_edit_pro_profile_error" class="mt-3"></div>';                                 
                        ?>
                    </div>
                </div>

                <div class="col-lg-12 mt-5">
                    <div class="change-password-container">
                        <h2 class="mt-3 mb-4">Change Your Password</h2>
                        <form id="change_professional_password">
                            <div class="row">
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="oldpassword">Old Password</label>
                                    <input type="password" id="oldpassword" name="oldpassword" placeholder="Type Here" />
                                    <span class="togglePasword">show</span>
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="newpassword">New Password</label>
                                    <input type="password" id="newpassword" name="newpassword" placeholder="Type Here" />
                                    <span class="togglePasword">show</span>
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="confirmpassword">Confirm Password</label>
                                    <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Type Here" />
                                    <span class="togglePasword">show</span>
                                </div>
                                <div class="form-group btn-div mt-3">
                                    <button type="submit" class="btn btn-primary" id="change_professional_password_btn">Save</button>
                                </div>
                            </div>
                        </form>
                        <?php 
                            echo '<div id="wp_edit_pro_password_error" class="mt-3"></div>';                                 
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
