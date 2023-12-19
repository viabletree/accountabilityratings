<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

foreach ( $wpsdGeneralSettings as $gs_name => $gs_value ) { 
    if ( isset( $wpsdGeneralSettings[$gs_name] ) ) {
        ${"" . $gs_name}  = $gs_value;
    }
}

$wpsd_donation_values  = ( $wpsd_donation_values != '' ) ? explode( ',', $wpsd_donation_values ) : [];

// ========================
// Form Settings
// ========================
foreach ( $wpsdFormSettings as $form_name => $form_value ) {
    if ( isset( $wpsdFormSettings[$form_name] ) ) {
        ${"" . $form_name} = $form_value;
    }
}

foreach ( $wpsdFormSyleSettings as $fs_name => $fs_value ) {
    if ( isset( $wpsdFormSyleSettings[$fs_name] ) ) {
        ${"" . $fs_name}  = $fs_value;
    }
}

if ( wsd_fs()->is_plan__premium_only('pro') ) {
    // Load Styling
    include WPSD_PATH . 'assets/css/wpsd-front.php';
}

if ( wsd_fs()->is_plan__premium_only('basic') ) {

    // Search Items
    $wpsd_donation_options  =  isset( $_GET['wgb_product'] ) ? sanitize_text_field( $_GET['wgb_product'] ) : $wpsd_donation_options;
}

if ( 'tdb' === $wpsd_form_header_type ) {
    $form_header_type = ['title', 'description', 'banner'];
} else if ( 'btd' === $wpsd_form_header_type ) {
    $form_header_type = ['banner', 'title', 'description'];
} else {
    $form_header_type = ['title', 'banner', 'description'];
}

$wpsdCaptchaItem1 =  rand(1, 20);
$wpsdCaptchaItem2 =  rand(1, 20);
?>
<div class="wpsd-master-wrapper wpsd-template-<?php printf('%d', $wpsd_select_template); ?>" id="wpsd-wrap-all">

    <div id="wpsd-pageloader">
        <img src="<?php echo esc_attr( WPSD_ASSETS . 'img/loader.gif' ); ?>" alt="<?php _e('Processing', WPSD_TXT_DOMAIN); ?>" />
    </div>
    
    <?php
    $fht = 0;
    foreach ( $form_header_type as $type ) {
        
        if ( 'title' ===  $type ) {
            if ( '' !== $wpsd_payment_title ) {
                ?>
                <h3 class="wpsd-form-title"><?php esc_html_e( $wpsd_payment_title ); ?></h3>
                <!-- Title Border -->
                <div class="wpsd-form-title-border"></div>
                <?php
            }
        }

        if ( 'description' === $type ) {
            if ( '' !== $wpsd_form_description ) {
                ?>
                <p class="wpsd-form-description"><?php esc_html_e( $wpsd_form_description ); ?></p>
                <?php
            }
        }

        if ( 'banner' === $type ) {
            if ( $wpsd_display_banner ) {
                if ( intval( $wpsd_form_banner ) > 0 ) {
                    echo wp_get_attachment_image( $wpsd_form_banner, 'full', false, array('class' => 'wpsd-form-banner') );
                }
            }
        }

        $fht++;
    }
    ?>

    <!-- Main Form -->
    <div class="wpsd-wrapper-content">

        <form action="" method="POST" id="wpsd-donation-form-id" autocomplete="off">
            
            <ul id="wpsd_donate_amount">
                <?php
                if ( count( $wpsd_donation_values ) > 0 ) {
                    foreach( $wpsd_donation_values as $amount ) {
                        //if( '' !== $amount ) {
                            ?>
                            <li class="amount" data-amount="<?php esc_attr_e( trim( $amount ) ); ?>">
                                <div class="form-group">
                                    <label for="amount_<?php esc_attr_e( trim( $amount ) ); ?>"><?php esc_html_e( number_format( $amount ) ); ?></label>
                                </div>
                            </li>
                            <?php
                        //} 
                    }
                }

                if ( '' !== $wpsd_other_amount_text ) {
                    ?>
                    <li>
                        <div class="form-group"><?php esc_html_e( $wpsd_other_amount_text ); ?></div>
                    </li>
                    <?php 
                } 
                ?>
                <li class="wpsd_donate_amount_other_li">
                    <div class="form-group">
                        <input id="wpsd_donate_other_amount" type="text" class="wpsd_donate_other_amount"
                            name="wpsd_donate_other_amount" placeholder="<?php esc_attr_e( $wpsd_donate_amount_label ); ?>"> <?php esc_html_e( $wpsd_donate_currency ); ?>
                    </div>
                </li>
            </ul>

            <?php
            // Donation/Payment For
            if ( ! $wpsd_hide_donation_for ) {
                
                if ( ! $wpsd_hide_label ) {
                    ?>
                    <label for="wpsd_donation_for" class="wpsd-donation-form-label"><?php esc_html_e( $wpsd_donation_for_label ); ?></label>
                    <?php
                }
                ?>
                <select name="wpsd_donation_for" id="wpsd_donation_for" class="wpsd-text-field">
                    <?php
                    $wpsd_donation_options  = ( $wpsd_donation_options != '' ) ? explode(',', $wpsd_donation_options) : [];
                    if ( count( $wpsd_donation_options ) > 0 ) {
                        foreach ( $wpsd_donation_options as $item ) {
                        ?>
                        <option value="<?php esc_attr_e( trim( $item ) ); ?>"><?php esc_html_e( trim( $item ) ); ?></option>
                        <?php 
                        }
                    } 
                    ?>
                </select>
            <?php
            } else {
                ?>
                <input type="hidden" name="wpsd_donation_for" id="wpsd_donation_for" value="<?php esc_attr_e( $wpsd_donation_options ); ?>" >
                <?php
            }

            // Full Name
            if ( ! $wpsd_hide_label ) {
                ?>
                <label for="wpsd_donator_name" class="wpsd-donation-form-label"><?php esc_html_e( $wpsd_donator_name_label ); ?></label>
                <?php
            }
            ?>
            <input type="text" name="wpsd_donator_name" id="wpsd_donator_name" class="wpsd-text-field" placeholder="<?php esc_attr_e( $wpsd_donator_name_label ); ?>">
            
            <!-- Email -->
            <?php
            if ( ! $wpsd_hide_label ) {
                ?>
                <label for="wpsd_donator_email" class="wpsd-donation-form-label"><?php esc_html_e( $wpsd_donator_email_label ); ?></label>
                <?php
            }
            ?>
            <input type="email" name="wpsd_donator_email" id="wpsd_donator_email" class="wpsd-text-field" placeholder="<?php esc_attr_e( $wpsd_donator_email_label ); ?>">
            
            <?php
            // Phone
            if ( $wpsd_display_phone ) { ?>
                <label for="wpsd_donator_phone" class="wpsd-donation-form-label"><?php esc_html_e( $wpsd_donator_phone_label ); ?></label>
                <input type="text" name="wpsd_donator_phone" id="wpsd_donator_phone" class="wpsd-text-field" placeholder="<?php esc_attr_e( $wpsd_donator_phone_label ); ?>">
                <?php 
            } 
            
            if ( wsd_fs()->is_plan__premium_only('pro') ) {
                // Address
                if ( $wpsd_display_address ) {
                    ?>
                    <!-- Street -->
                    <div style="clear: both;">
                        <div class="wpsd-form-item-half-left">
                            <?php
                            if ( ! $wpsd_hide_label ) {
                                ?>
                                <label class="wpsd-donation-form-label wpsd-address-street"><?php esc_html_e( $wpsd_address_street_label ); ?></label>
                                <?php
                            }
                            ?>
                            <input type="text" name="wpsd_address_street" id="wpsd_address_street" class="wpsd-text-field wpsd-address-street" placeholder="<?php esc_attr_e( $wpsd_address_street_label ); ?>">
                        </div>
                        <div class="wpsd-form-item-half-right">
                            <?php
                            if ( ! $wpsd_hide_label ) {
                                ?>
                                <label class="wpsd-donation-form-label wpsd-address-street"><?php esc_html_e( $wpsd_address_line2_label ); ?></label>
                                <?php
                            }
                            ?>
                            <input type="text" name="wpsd_address_line2" id="wpsd_address_line2" class="wpsd-text-field wpsd-address-street" placeholder="<?php esc_attr_e( $wpsd_address_line2_label ); ?>">
                        </div>
                    </div>
                    <!-- City / State -->
                    <div style="clear: both;">
                        <div class="wpsd-form-item-half-left">
                            <?php
                            if ( ! $wpsd_hide_label ) {
                                ?>
                                <label class="wpsd-donation-form-label wpsd-address-city"><?php esc_html_e( $wpsd_address_city_label ); ?></label>
                                <?php
                            }
                            ?>
                            <input type="text" name="wpsd_address_city" id="wpsd_address_city" class="wpsd-text-field wpsd-address-city" placeholder="<?php esc_attr_e( $wpsd_address_city_label ); ?>">
                        </div>
                        <div class="wpsd-form-item-half-right">
                            <?php
                            if ( ! $wpsd_hide_label ) {
                                ?>
                                <label class="wpsd-donation-form-label wpsd-address-state"><?php esc_html_e( $wpsd_address_state_label ); ?></label>
                                <?php
                            }
                            ?>
                            <input type="text" name="wpsd_address_state" id="wpsd_address_state" class="wpsd-text-field wpsd-address-state" placeholder="<?php esc_attr_e( $wpsd_address_state_label ); ?>">
                        </div>
                    </div>
                    <!-- Postal code / Country -->
                    <div style="clear: both;">
                        <div class="wpsd-form-item-half-left">
                            <?php
                            if ( ! $wpsd_hide_label ) {
                                ?>
                                <label class="wpsd-donation-form-label wpsd-address-postal-code"><?php esc_html_e( $wpsd_address_postal_label ); ?></label>
                                <?php
                            }
                            ?>
                            <input type="text" name="wpsd_address_postal" id="wpsd_address_postal" class="wpsd-text-field wpsd-address-postal" placeholder="<?php esc_attr_e( $wpsd_address_postal_label ); ?>">
                        </div>
                        <div class="wpsd-form-item-half-right">
                            <?php
                            if ( ! $wpsd_hide_label ) {
                                ?>
                                <label class="wpsd-donation-form-label wpsd-address-country"><?php esc_html_e( $wpsd_address_country_label ); ?></label>
                                <?php
                            }
                            ?>
                            <select name="wpsd_address_country" id="wpsd_address_country" class="wpsd-address-country">
                                <option value=""><?php esc_html_e( $wpsd_address_country_label ); ?></option>
                                <?php
                                $wpsd_countries  = $this->hm_get_all_country();
                                if ( count( $wpsd_countries ) > 0 ) {
                                    foreach ( $wpsd_countries as $country ) {
                                    ?>
                                    <option value="<?php esc_attr_e( trim( $country ) ); ?>"><?php esc_html_e( trim( $country ) ); ?></option>
                                    <?php 
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <?php
                }
            }
            ?>
            
            <?php
            if ( wsd_fs()->is_plan__premium_only('pro') ) {
                if ( $wpsd_show_comments ) {
                    
                    if ( ! $wpsd_hide_label ) {
                        ?>
                        <label for="wpsd_comments" class="wpsd-donation-form-label"><?php esc_html_e( $wpsd_comments_label ); ?></label>
                        <?php
                    }
                    ?>
                    <textarea name="wpsd_comments" id="wpsd-comments" class="wpsd-text-field" placeholder="<?php esc_attr_e( $wpsd_comments_label ); ?>"></textarea>
                    <?php
                }
            }
            ?>

            <!-- Card --->
            <?php
            if ( ! $wpsd_hide_label ) {
                ?>
                <label class="wpsd-donation-form-label"><?php esc_html_e( $wpsd_card_element_label ); ?></label>
                <?php
            }
            ?>
            <div id="card-element"></div>
            <!---card end-->

            <?php
            if ( wsd_fs()->is_plan__premium_only('pro') ) {
                if ( $wpsd_show_captcha ) {
                    if ( ! $wpsd_hide_label ) {
                        ?>
                        <label class="wpsd-donation-form-label wpsd-captcha-label"><?php esc_html_e( $wpsd_captcha_label ); ?></label>
                        <?php
                    }
                    ?>
                    <label class="wpsd-donation-form-label"><?php echo __('What is', WPSD_TXT_DOMAIN) . '&nbsp;' . esc_html( $wpsdCaptchaItem1 ) . '&nbsp;+&nbsp;' . esc_html( $wpsdCaptchaItem2 );  ?>&nbsp;?</label>
                    <input type="hidden" value="<?php printf('%d', $wpsdCaptchaItem1+$wpsdCaptchaItem2); ?>" name="wpsd_captcha_content_check" id="wpsd_captcha_content_check">
                    <input type="number" min="2" max="40" name="wpsd_captcha_content" id="wpsd_captcha_content" class="wpsd-text-field">
                    <?php
                }
            } 
            ?>
            <div id="card-errors" class="wpsd-alert" role="alert"></div>
            <input type="submit" name="wpsd-donate-button" class="wpsd-donate-button" value="<?php esc_attr_e( $wpsd_donate_button_text ); ?>">
        </form>
        
        <?php
        if ( wsd_fs()->is_plan__premium_only('pro') ) {
            if ( $wpsd_display_total_donation ) {
                ?>
                <p class="wpsd-total-donation-today">
                    <?php echo esc_html('Total', WPSD_TXT_DOMAIN) . '&nbsp;<span id="wpsd-total-donation-number">' . esc_html( $wpsd_donation_today ) . '&nbsp;' . esc_html( $wpsd_donate_currency ) . '</span>&nbsp;' . esc_html('Donation Today', WPSD_TXT_DOMAIN); ?>
                </p>
                <?php
            }
        }
        ?>
    </div>
</div>