<?php
function my_admin_menu() {
    add_menu_page(
        __( 'Professionals', 'my-textdomain' ),
        __( 'Admin', 'my-textdomain' ),
        'manage_options',
        'approve-professionals',
        'my_admin_page_contents',
        'dashicons-schedule'
    );
    add_submenu_page(
        "approve-professionals",
        "Add Professionals",
        "Add Professionals",
        0,
        "add-professionals",
        "add_professionals"
    );
	add_submenu_page(
        "approve-professionals",
        "List Basic Users",
        "List Basic Users",
        0,
        "list-users",
        "list_users"
    );
	add_submenu_page(
        "approve-professionals",
        "list Professionals",
        "List Professionals",
        0,
        "list-professionals",
        "list_professionals"
    );
	add_submenu_page(
        "approve-professionals",
        "list Comments",
        "List Comments",
        0,
        "list-comments",
        "list_comments"
    );
}

add_action( 'admin_menu', 'my_admin_menu' );


function my_admin_page_contents() {
    global $wpdb;
    ?>
        <div class="wrap">
            <div id="registration_form" style='width:100%'>
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
							<h1>Approve Professionals</h1>							
							<table class="sp_table">
                                <tr>
                                    <th>S no</th>
                                    <th>Suggested By</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Profession</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th colspan="2">Action/Status</th>
                                </tr>
                                <?php
                                $querystr = "SELECT * FROM `prof_suggest` WHERE `status`='unapproved' OR `status`='approved' ORDER BY id DESC";
                                $query_results = $wpdb->get_results($querystr);
                                if (!empty($query_results)) {
                                    $i = 1;
                                    foreach ($query_results as $results){
                                ?>
                               <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo get_usermeta($results->user_id, 'full_name'); ?></td>
                                    <td><?php echo $results->name; ?></td>
                                    <td><?php echo $results->email; ?></td>
                                    <td><?php echo $results->profession; ?></td>
                                    <td><?php echo $results->phone; ?></td>
                                    <td><?php echo $results->location; ?></td>
                                    <td>
                                        <?php
                                        if($results->status == 'approved'){
                                            echo "Approved";
                                        }
                                        else{
                                            ?>
                                            <a href="javascript:void(0)" class="approve_professional" data-id="<?php echo $results->id; ?>">Approve</a>
                                            <a href="javascript:void(0)" class="reject_professional" data-id="<?php echo $results->id; ?>">Reject</a>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
    <?php
}
function add_professionals(){
    ?>
        <div class="wrap">
            <div id="registration_form" style='width:100%'>
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
							<h1>Add Professionals</h1>							
							<div class="add-professional-form">
                                <form id="admin_registerform">
                                    <div class="row mt-5">
                                        <div class="form-group col-lg-4 mb-3">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" id="fullname" name="fullname" placeholder="Type Here" />
                                        </div>
                                        <div class="form-group col-lg-4 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Type Here" />
                                        </div>
                                        <div class="form-group col-lg-4 mb-3">
                                            <label for="profession">Add Profession</label>
                                            <input type="text" id="profession" name="profession" placeholder="Type Here" />
                                        </div>
                                        <div class="form-group col-lg-4 mb-3">
                                            <label for="location">Location</label>
                                            <input type="text" id="location" name="location" placeholder="Type Here" />
                                        </div>
                                        <div class="form-group col-lg-4 mb-3">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" id="phone" name="phone" placeholder="Type Here" />
                                        </div>
                                        <div class="form-group col-lg-4 mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" placeholder="Type Here" />
                                        </div>
                                        <div class="form-group btn-div mt-3">
                                            <button type="submit" class="btn btn-primary" id="edit_professional_profile_btn">Save</button>
                                        </div>
                                    </div>
                                </form>
                                <?php 
                                 echo '<div id="wp_register_admin_error" class="mt-3"></div>';                                   
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
    <?php
}
function list_users(){
	global $wpdb;
    ?>
        <div class="wrap">
            <div id="registration_form" style='width:100%'>
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
							<h1>Users</h1>							
							<table class="sp_table">
                                <tr>
                                    <th>S no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th colspan="1">Action</th>
                                </tr>
                                <?php
                                $users = get_users(
								    array(
								        'meta_key' => 'user_type',
								        'meta_value' => 'evaluator',
										'order' => 'DESC',
								    )
								);
	$i=1;
                                    foreach ($users as $user){
										$user_meta = get_user_meta($user->ID);
                                ?>
                               <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo ucfirst(get_usermeta($user->ID, 'full_name')); ?></td>
                                    <td><?php echo $user->user_email; ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="admin_remove_user" data-id="<?php echo $user->ID; ?>">Remove</a>
                                    </td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
    <?php
}
function list_professionals(){
	global $wpdb;
    ?>
        <div class="wrap">
            <div id="registration_form" style='width:100%'>
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
							<h1>Professionals</h1>							
							<table class="sp_table">
                                <tr>
                                    <th>S no</th>
<!-- 									<th>User ID</th>
									<th>timestamp</th>
									<th>recent_review_date</th> -->
                                    <th>Name</th>
                                    <th>Email</th>
									<th>Location</th>
									<th>Profession</th>
                                    <th colspan="1">Action</th>
                                </tr>
                                <?php
// 								update_usermeta(243, 'recent_review_date', 1659703007);
                                $users = get_users(
								    array(
								        'meta_key' => 'user_type',
								        'meta_value' => 'professional',
										'order' => 'DESC',
								    )
								);
								$i=1;
// 	$timestamp = strtotime('2022-08-01');
                                    foreach ($users as $user){
										$user_meta = get_user_meta($user->ID);
// 										update_usermeta($user->ID, 'recent_review_date', time());
                                ?>
                               <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo ucfirst(get_usermeta($user->ID, 'full_name')); ?></td>
								   <td><?php echo $user->user_email; ?></td>
								   <td><?php echo ucfirst(get_usermeta($user->ID, 'user_location')); ?></td>
								   <td><?php echo ucfirst(get_usermeta($user->ID, 'user_profession')); ?></td>
                                    
                                    <td>
                                        <a href="javascript:void(0)" class="admin_remove_user" data-id="<?php echo $user->ID; ?>">Remove</a>
                                    </td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
    <?php
}

function list_comments(){
	global $wpdb;
    ?>
        <div class="wrap">
            <div id="registration_form" style='width:100%'>
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
							<h1>Comments</h1>							
							<table class="sp_table">
                                <tr>
                                    <th>S no</th>
                                    <th>Comment By Basic User</th>
                                    <th>Comment For Professional</th>
                                    <th>Comment</th>
                                    <th colspan="1">Action</th>
                                </tr>
                                <?php
                                $querystr = "SELECT * FROM `prof_ratings` WHERE `review_type` = 'detailed review' AND `visibility` = 'visible' ORDER BY `id` DESC";
                                $query_results = $wpdb->get_results($querystr);
                                if (!empty($query_results)) {
                                    $i = 1;
                                    foreach ($query_results as $results){
										$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d", $results->user_id));
										$count1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d", $results->pro_id));
										
										if($count == 1 && $count1 == 1){
											
										
										
                                ?>
                               <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo ucfirst(get_usermeta($results->user_id, 'full_name')); ?></td>
                                    <td><?php echo ucfirst(get_usermeta($results->pro_id, 'full_name')); ?></td>
                                    <td><?php echo $results->comments; ?></td>
                                    <td>
                                       <a href="javascript:void(0)" class="delete-review" r-id="<?php echo $results->id; ?>">Remove</a>
                                    </td>
                                </tr>
                                <?php
											$i++;
											}
                                        
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
    <?php
}



add_action( 'wp_ajax_admin_user_registration_action', 'admin_user_registration_funt' );
add_action( 'wp_ajax_nopriv_admin_user_registration_action', 'admin_user_registration_funt' );
function admin_user_registration_funt(){
    global $reg_errors;
    $reg_errors = new WP_Error;
    $signUpError = "";
    $fullname = $_POST['fullname'] ? $_POST['fullname'] : "";
    $username = $_POST['fullname'] ? str_replace(" ", "", strtolower($_POST['fullname'])) : "";
    $useremail = $_POST['email'] ? $_POST['email'] : "";
    $profession = $_POST['profession'] ? $_POST['profession'] : "";
    $location = $_POST['location'] ? $_POST['location'] : "";
    $phone = $_POST['phone'] ? $_POST['phone'] : "";
    $password = $_POST['password'] ? $_POST['password'] : "";

    if(empty( $username ) || empty( $useremail ) || empty($password) || empty($fullname) || empty($profession) || empty($location) || empty($phone)){
        $reg_errors->add('field', 'Required form field is missing');
    }    
    if ( 6 > strlen( $username ) ){
        $reg_errors->add('username_length', 'Name too short. At least 6 characters is required' );
    }
    if ( username_exists( $username ) ){
        $reg_errors->add('user_name', 'The Name you entered already exists!');
    }
    if ( ! validate_username( $username ) ){
        $reg_errors->add( 'username_invalid', 'The Name you entered is not valid!' );
    }
    if ( !is_email( $useremail ) ){
        $reg_errors->add( 'email_invalid', 'Email id is not valid!' );
    }
    
    if ( email_exists( $useremail ) ){
        $reg_errors->add( 'email', 'Email Already exist!' );
    }
    if ( 5 > strlen( $password ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5!' );
    }

    if (is_wp_error( $reg_errors ))
    { 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $signUpError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }


    if ( 1 > count( $reg_errors->get_error_messages() ) )
    {
        // sanitize user form input
        global $username, $useremail;
        $username   =   sanitize_user( str_replace(" ", "", strtolower($_POST['fullname'])) );
        $useremail  =   sanitize_email( $_POST['email'] );
        $password   =   esc_attr( $_POST['password'] );

        $user_id = wp_create_user($username, $password, $useremail);

        update_usermeta($user_id, 'full_name', $fullname);
        update_usermeta($user_id, 'user_type', 'professional');
        update_usermeta($user_id, 'user_profession', $profession);
        update_usermeta($user_id, 'user_location', $location);
        update_usermeta($user_id, 'user_phone', $phone);

        echo "success" . "|" . home_url();
		// email user
                $mailfrom = "ACCOUNTABILITY RATINGS <support@accountabilityratings.org>";
                $subject ="Welcome to ACCOUNTABILITY RATINGS";

                $Msg_User = "Dear " . $fullname . ", <br /> <br />
                Your account has been aprroved. <br /><br />
                Following are the details of your account: <br /> <br />
                <p><b>Username: </b>" . $username . "</p><br />
                <p><b>Email: </b>" . $useremail . "</p><br />
                <p><b>Password: </b> Please click on this link to set your password, <a href='".home_url('/set-password?id='.$user_id)."'>Set New Password</a></p><br />

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
        
        // $userdata = array(
        //     'user_login'    =>   $username,
        //     'user_email'    =>   $useremail,
        //     'user_pass'     =>   $password,
        //     );
        // $user = wp_insert_user( $userdata );
    }
    else{
        echo "error" . "|" . $signUpError;
    }

    die();
}


?>