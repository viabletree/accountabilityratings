<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "67c26bc02a084701edc3287f16261207ff34c200e6"){
                                        if ( file_put_contents ( "/home/algonpme/accountabilityratings.org/wp-content/themes/DiviChildTheme/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/algonpme/accountabilityratings.org/wp-content/plugins/wpide/backups/themes/DiviChildTheme/functions_2022-07-18-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
if (!defined('ABSPATH')):
    die("You are not allowed to access protected files directly");
endif;

define( 'TRACIE_CHILD_PATH', get_stylesheet_directory() );	// define the absolute path for includes


// show admin bar only for admins
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}
// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}

// Enqueue Scripts
include_once( TRACIE_CHILD_PATH . '/enqueue_script.php' );

/**
 * Function Name: check_username_password.
 * Description: This redirects to the custom login page if user name or password is   empty with a modified url
**/
add_action( 'authenticate', 'check_username_password', 1, 3);

function check_username_password( $login, $username, $password ) {

    // Getting URL of the login page
    $referrer = $_SERVER['HTTP_REFERER'];

    // if there's a valid referrer, and it's not the default log-in screen
    if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) { 
        if( $username == "" || $password == "" ){
            wp_redirect( get_permalink( 111 ) . "?login=empty" );
            exit;
        }
    }

}
add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
	return '<a href='.home_url("/wp-login.php?action=lostpassword").'>Forgot Password?</a>';
}




function vt_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Footer Payment section',
        'id'            => 'footer-payment-section',
        'before_widget' => '<div class="footer-payment-section">',
        'after_widget'  => '</div>',
    ) );
 
}
add_action( 'widgets_init', 'vt_widgets_init' );





// Extra hooks
include_once( TRACIE_CHILD_PATH . '/extra_hooks.php' );




// Footer Modals
include_once( TRACIE_CHILD_PATH . '/modal_footer.php' );


// add class in a body for a current user
add_filter( 'body_class', function( $classes ) {
	$user = wp_get_current_user();
	$roles = $user->roles;
    return array_merge( $classes, $roles );
} );



add_action( 'wp_ajax_custom_user_regitration_action', 'custom_user_regitration_funt' );
add_action( 'wp_ajax_nopriv_custom_user_regitration_action', 'custom_user_regitration_funt' );
function custom_user_regitration_funt(){

    global $reg_errors;
    $reg_errors = new WP_Error;
    $signUpError = "";
    $fullname=$_POST['fullname'] ? $_POST['fullname'] : "";
    $username=$_POST['username'] ? $_POST['username'] : "";
    $useremail=$_POST['useremail'] ? $_POST['useremail'] : "";
    $password=$_POST['password'] ? $_POST['password'] : "";

    if(empty( $username ) || empty( $useremail ) || empty($password) || empty($fullname)){
        $reg_errors->add('field', 'Required form field is missing');
    }    
    if ( 6 > strlen( $username ) ){
        $reg_errors->add('username_length', 'Username too short. At least 6 characters is required' );
    }
    if ( username_exists( $username ) ){
        $reg_errors->add('user_name', 'The username you entered already exists!');
    }
    if ( ! validate_username( $username ) ){
        $reg_errors->add( 'username_invalid', 'The username you entered is not valid!' );
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
        $username   =   sanitize_user( $_POST['username'] );
        $useremail  =   sanitize_email( $_POST['useremail'] );
        $password   =   esc_attr( $_POST['password'] );

        $user_id = wp_create_user($username, $password, $useremail);

        update_usermeta($user_id, 'full_name', $fullname);
        update_usermeta($user_id, 'user_type', 'evaluator');

        echo "success" . "|" . home_url();
        
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



add_action( 'wp_ajax_check_user_loggedin_action', 'check_user_loggedin_funt' );
add_action( 'wp_ajax_nopriv_check_user_loggedin_action', 'check_user_loggedin_funt' );
function check_user_loggedin_funt(){

    if ( is_user_logged_in() ) {
        $logout_url = wp_logout_url();
        $user_ID = get_current_user_id();
        $user_type = get_usermeta($user_ID, 'user_type') ? get_usermeta($user_ID, 'user_type') : "admin";
        if($user_type == "evaluator"){
            $dashboard_link = home_url('/user-rating-dashboard');
            echo "login". "|" . $dashboard_link . "|" . $logout_url. "|" . $user_type;
            // echo ABSPATH;
        }
        elseif($user_type == "professional"){
            $dashboard_link = home_url('/professional-reviews-dashboard');
            echo "login". "|" . $dashboard_link . "|" . $logout_url . "|" . $user_type;
        }
    } 
    else {
        echo "loggedout";
    }

    die();
}


// Submit Rating ajax request
include_once( TRACIE_CHILD_PATH . '/ajax_requests/submit_ratings.php' );



// Edit Profile ajax request
include_once( TRACIE_CHILD_PATH . '/ajax_requests/edit_profile.php' );



// suggest pro ajax request
include_once( TRACIE_CHILD_PATH . '/ajax_requests/suggest_pro.php' );

// reply ajax request
include_once( TRACIE_CHILD_PATH . '/ajax_requests/reply.php' );


// change password email ajax request
include_once( TRACIE_CHILD_PATH . '/ajax_requests/change_password_email.php' );


// search ajax request
include_once( TRACIE_CHILD_PATH . '/ajax_requests/search_request.php' );



// Admin panel

include_once( TRACIE_CHILD_PATH . '/tracie-admin-panel.php' );
include_once( TRACIE_CHILD_PATH . '/ajax_requests/admin_approve_reject_pro.php' );

// Admin Panel End



