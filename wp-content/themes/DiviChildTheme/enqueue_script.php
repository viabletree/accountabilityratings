<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function bh_enqueue_scripts() {
		$theme_info = wp_get_theme();
        
		// wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap4', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
		wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        // wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');
        wp_enqueue_style( 'progress_bar', get_stylesheet_directory_uri().'/assets/css/progressbar.css', array(), $theme_info->get( 'Version' ), false );
        wp_enqueue_style( 'modal_css', get_stylesheet_directory_uri().'/assets/css/modal_styles.css', array(), $theme_info->get( 'Version' ), false );
        wp_enqueue_style( 'dashboard_sidebar_css', get_stylesheet_directory_uri().'/assets/css/dashboard-sidebar.css', array(), $theme_info->get( 'Version' ), false );

        wp_enqueue_style( 'user_dashboard_css', get_stylesheet_directory_uri().'/assets/css/user_dashboard.css', array(), $theme_info->get( 'Version' ), false );
        wp_enqueue_style( 'user_setting_dashboard_css', get_stylesheet_directory_uri().'/assets/css/user_setting_dashboard.css', array(), $theme_info->get( 'Version' ), false );

        wp_enqueue_style( 'professional_dashboard_css', get_stylesheet_directory_uri().'/assets/css/professional-dashboard.css', array(), $theme_info->get( 'Version' ), false );
        wp_enqueue_style( 'professional_setting_css', get_stylesheet_directory_uri().'/assets/css/professional-setting.css', array(), $theme_info->get( 'Version' ), false );

        
		//**register script**//		
		// wp_enqueue_script('bootstrap-script', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
        wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
		
        wp_enqueue_script('custom-script', get_stylesheet_directory_uri().'/assets/js/custom-script.js', array('jquery'), $theme_info->get( 'Version' ), true);
        wp_localize_script(
			'custom-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);

        wp_enqueue_script('sidenav-script', get_stylesheet_directory_uri().'/assets/js/sidenav-script.js', array('jquery'), $theme_info->get( 'Version' ), true);


        wp_enqueue_script('register-script', get_stylesheet_directory_uri().'/assets/js/register-script.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'register-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);

        wp_enqueue_script('suggest-pro-script', get_stylesheet_directory_uri().'/assets/js/suggest-pro.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'suggest-pro-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);

        wp_enqueue_script('submit-rating-script', get_stylesheet_directory_uri().'/assets/js/submit-ratings.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'submit-rating-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);


        wp_enqueue_script('edit-profile-script', get_stylesheet_directory_uri().'/assets/js/edit-profile.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'edit-profile-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);

        wp_enqueue_script('reply-script', get_stylesheet_directory_uri().'/assets/js/reply.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'reply-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);

        wp_enqueue_script('change-password-email-script', get_stylesheet_directory_uri().'/assets/js/change-password-email.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'change-password-email-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);

        wp_enqueue_script('search-request-script', get_stylesheet_directory_uri().'/assets/js/search-request.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_localize_script(
			'search-request-script',
			'opt',
			array('ajaxUrl' => admin_url('admin-ajax.php'),
			'noResults' => esc_html__('No data found', 'textdomain'),
				 )
		);
}
add_action('wp_enqueue_scripts', 'bh_enqueue_scripts');




// admin scripts
function load_custom_wp_admin_style($hook) {
    $theme_info = wp_get_theme();
    // Load only on ?page=mypluginname
//     echo $hook;
    if( $hook != 'admin_page_add-professionals' && $hook != 'toplevel_page_approve-professionals' && $hook != 'admin_page_list-users' && $hook != 'admin_page_list-professionals' && $hook != 'admin_page_list-comments') {
            return;
    }
    wp_enqueue_style( 'admin_styles_css', get_stylesheet_directory_uri().'/assets/css/admin_styles.css', array(), $theme_info->get( 'Version' ), false );
    wp_enqueue_style('bootstrap4', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
    wp_enqueue_script('admin-script', get_stylesheet_directory_uri().'/assets/js/admin-script.js', array('jquery'), $theme_info->get( 'Version' ), true);
    wp_localize_script(
        'admin-script',
        'opt',
        array('ajaxUrl' => admin_url('admin-ajax.php'),
        'noResults' => esc_html__('No data found', 'textdomain'),
                )
    );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );




// styles in head

add_action ( 'wp_head', 'styles_in_head' );

function styles_in_head(){
    ?>
    <style>
        div#responsive_visible ul#menu-mobile-menu li.current-menu-item a::after, div#navbaar .et_pb_menu_0_tb_header.et_pb_menu ul li.current-menu-item a::after{
            background: url(<?php echo home_url('/wp-content/uploads/2022/06/Vector-1.png') ?>) no-repeat;
        }
        div#newsletter-row a.et_pb_newsletter_button.et_pb_button .et_pb_newsletter_button_text::after{
            background: url(<?php echo home_url('/wp-content/uploads/2022/06/Send-Icon.png') ?>);
        }
        div#smileys input[type=radio].happy{
            background: url("https://res.cloudinary.com/turdlife/image/upload/v1492864443/happy_ampvnc.svg") center;
        }
        div#smileys input[type=radio].sad{
            background: url("https://res.cloudinary.com/turdlife/image/upload/v1492864443/sad_bj1tuj.svg") center;
        }
        a.suggest_professionals::after{
            background: url(<?php echo home_url('/wp-content/uploads/2022/06/info-1.png') ?>);
        }

		.search-container .form-group span:first-of-type::after{
			background: url(<?php echo home_url('/wp-content/uploads/2022/06/mode-portrait-1-1.png'); ?>);
		}
		.search-container .form-group span:first-of-type::before{
			background: url(<?php echo home_url('/wp-content/uploads/2022/06/search-form-seperator.png'); ?>);
		}
		.search-container .form-group span:last-of-type::after{
			background: url(<?php echo home_url('/wp-content/uploads/2022/06/pin-1-1.png'); ?>);
		}
		.search-container .form-group span:last-of-type::before{
			background: url(<?php echo home_url('/wp-content/uploads/2022/06/arrow-down-sign-to-navigate-1.png'); ?>);
		}
    </style>
    <?php
}

?>