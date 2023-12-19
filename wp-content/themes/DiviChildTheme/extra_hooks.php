<?php

/**
 * Function Name: front_end_login_fail.
 * Description: This redirects the failed login to the custom login page instead of default login page with a modified url
**/
add_action( 'wp_login_failed', 'front_end_login_fail' );
function front_end_login_fail( $username ) {

    // Getting URL of the login page
    $referrer = $_SERVER['HTTP_REFERER'];    
    // if there's a valid referrer, and it's not the default log-in screen
    if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {
        wp_redirect( get_permalink( 111 ) . "?login=failed" ); 
        exit;
    }

}








// Logout redirection and no confimation


// add_action( 'wp_logout', 'auto_redirect_external_after_logout');
// function auto_redirect_external_after_logout(){
//   wp_redirect( home_url() );
//   exit();
// }
add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
function logout_without_confirm($action, $result){
    /**
     * Allow logout without confirmation
     */
    if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : home_url();
        $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
        header("Location: $location");
        die;
    }
}
?>