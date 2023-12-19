<?php
/* 
Template Name: Set Password Template 
*/

get_header();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $user_id = $_GET['id'];
    $user_meta = get_user_meta($pro_id);
    $user_info = get_userdata($pro_id);
    
}

?>
<style>
    body.page-id-416 header{
        display: none;
    }
    body.page-id-416 footer{
        display: none;
    }
</style>

<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="change-password-container">
            <h2 class="mt-3 mb-4 text-center">Change Password</h2>
            <form id="set_new_password">
                <div class="row justify-content-center">
                    <div class="form-group col-lg-6 mb-2">
                        <label for="newpassword">Type New Password</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Type Here" required />
                        <span class="togglePasword">show</span>
                    </div>
                    <div class="form-group btn-div mt-3 text-center">
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


<?php

get_footer();
?>
