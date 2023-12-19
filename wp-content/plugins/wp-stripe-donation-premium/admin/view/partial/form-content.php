
<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

//print_r( $wpsdContentSettings );
foreach ( $wpsdContentSettings as $option_name => $option_value ) {    
    if ( isset( $wpsdContentSettings[$option_name] ) ) {
        ${"" . $option_name}  = $option_value;
    }
}
?>
<form name="wpsd-temp-settings-form" role="form" class="form-horizontal" method="post" action="" id="wpsd-temp-settings-form-id">
    <table class="wpsd-form-content-settings">
        <tr>
            <th scope="row">
                <label><?php _e('Template Color', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <div class="wpsd-template-selector">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                    <div class="wpsd-template-item">
                        <input type="radio" name="wpsd_select_template" id="<?php printf('wpsd_select_template_%d', $i); ?>" value="<?php printf('%d', $i); ?>"
                            <?php if ( $wpsd_select_template == $i ) echo 'checked'; ?>>
                        <label for="<?php printf('wpsd_select_template_%d', $i); ?>" class="wpsd-template-<?php printf('%d', $i); ?>"></label>
                    </div>
                    <?php endfor; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_display_banner"><?php _e('Display Banner', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="checkbox" name="wpsd_display_banner" class="wpsd_display_banner" id="wpsd_display_banner" value="1" <?php echo $wpsd_display_banner ? 'checked' : ''; ?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php _e('Banner', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="hidden" name="wpsd_form_banner" id="wpsd_form_banner" value="<?php esc_attr_e( $wpsd_form_banner ); ?>" class="regular-text" />
                <input type='button' class="button-primary" value="<?php esc_attr_e('Select a banner', WPSD_TXT_DOMAIN); ?>" id="wpsd_media_manager" data-image-type="full" />
                <?php
                $wpsdFormBannerImage = '';
                if ( intval( $wpsd_form_banner ) > 0 ) {
                    $wpsdFormBannerImage = wp_get_attachment_image( $wpsd_form_banner, 'full', false, array('id' => 'wpsd-form-banner-preview-image') );
                }
                ?>
                <div id="wpsd-form-banner-preview-image">
                    <?php echo $wpsdFormBannerImage; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_hide_label"><?php _e('Hide All Form Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="checkbox" name="wpsd_hide_label" id="wpsd_hide_label" value="1" <?php echo $wpsd_hide_label ? 'checked' : ''; ?> >
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_hide_donation_for"><?php _e('Hide Donation For', WPSD_TXT_DOMAIN); ?></label>
                <br>
                <small><?php _e('If you hide this, please make sure you must have only one donation for available in general settings.', WPSD_TXT_DOMAIN); ?></small>
            </th>
            <td>
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('basic') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Please Upgrade Now!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('basic') ) {
                    ?>
                    <input type="checkbox" name="wpsd_hide_donation_for" class="wpsd_hide_donation_for" id="wpsd_hide_donation_for" value="1" 
                        <?php echo $wpsd_hide_donation_for ? 'checked' : ''; ?> >
                    <?php
                }
                ?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php _e('Donate/Payment For Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="wpsd_donation_for_label" class="medium-text" placeholder="<?php esc_attr_e('Donation/Payment For', WPSD_TXT_DOMAIN); ?>"
                    value="<?php esc_attr_e( $wpsd_donation_for_label ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Name Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wpsd_donator_name_label" class="medium-text" placeholder="<?php esc_attr_e('Full Name', WPSD_TXT_DOMAIN); ?>"
                    value="<?php esc_attr_e( $wpsd_donator_name_label ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Email Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wpsd_donator_email_label" class="medium-text" placeholder="<?php esc_attr_e('Email', WPSD_TXT_DOMAIN); ?>"
                    value="<?php esc_attr_e( $wpsd_donator_email_label ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_display_address"><?php _e('Display Address', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="checkbox" name="wpsd_display_address" id="wpsd_display_address" value="1" <?php echo $wpsd_display_address ? 'checked' : ''; ?> >
                    <?php
                }
                ?>
            </td>
            <th scope="row" style="text-align: right;">
                <label for="wpsd_show_captcha"><?php _e('Address Street Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_address_street_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_address_street_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_address_street_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_captcha"><?php _e('Address Line-2 Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_address_line2_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_address_line2_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_address_line2_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_captcha"><?php _e('Address City Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_address_city_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_address_city_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_address_city_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_captcha"><?php _e('Address State Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_address_state_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_address_state_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_address_state_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_captcha"><?php _e('Postal Code Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_address_postal_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_address_postal_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_address_postal_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_captcha"><?php _e('Country Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_address_country_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_address_country_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_address_country_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_comments"><?php _e('Show Comments', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="checkbox" name="wpsd_show_comments" id="wpsd_show_comments" value="1" <?php echo $wpsd_show_comments ? 'checked' : ''; ?> >
                    <?php
                }
                ?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php _e('Comments Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_comments_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_comments_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_comments_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_show_captcha"><?php _e('Show Captcha', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="checkbox" name="wpsd_show_captcha" id="wpsd_show_captcha" value="1" <?php echo $wpsd_show_captcha ? 'checked' : ''; ?> >
                    <?php
                }
                ?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php _e('Captcha Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="text" name="wpsd_captcha_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_captcha_label ); ?>"
                        value="<?php esc_attr_e( $wpsd_captcha_label ); ?>">
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Amount Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wpsd_donate_amount_label" class="medium-text" placeholder="<?php esc_attr_e('Amount', WPSD_TXT_DOMAIN); ?>"
                    value="<?php esc_attr_e( $wpsd_donate_amount_label ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Other Amount Text', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wpsd_other_amount_text" class="medium-text" placeholder="<?php esc_attr_e('Other Amount', WPSD_TXT_DOMAIN); ?>"
                    value="<?php esc_attr_e( $wpsd_other_amount_text ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Card Element Label', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wpsd_card_element_label" class="medium-text" placeholder="<?php esc_attr_e( $wpsd_card_element_label ); ?>"
                    value="<?php esc_attr_e( $wpsd_card_element_label ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_form_width"><?php _e('Form Width', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="number" min="1" max="1000" step="1" name="wpsd_form_width" value="<?php esc_attr_e( $wpsd_form_width ); ?>">
                    <select name="wpsd_form_width_type" class="medium-text">
                        <option value="px" <?php echo ( 'ps' === $wpsd_form_width_type ) ? 'selected' : ''; ?> ><?php echo 'px'; ?></option>
                        <option value="%" <?php echo ( '%' === $wpsd_form_width_type ) ? 'selected' : ''; ?> ><?php echo '%'; ?></option>
                    </select>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_form_header_type"><?php _e('Form Header Type', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <select name="wpsd_form_header_type" class="medium-text">
                        <option value="<?php _e('tdb', WPSD_TXT_DOMAIN); ?>" <?php echo ( 'tdb' === $wpsd_form_header_type ) ? 'selected' : ''; ?> ><?php _e('Title-Description-Banner', WPSD_TXT_DOMAIN); ?></option>
                        <option value="<?php _e('btd', WPSD_TXT_DOMAIN); ?>" <?php echo ( 'btd' === $wpsd_form_header_type ) ? 'selected' : ''; ?> ><?php _e('Banner-Title-Description', WPSD_TXT_DOMAIN); ?></option>
                        <option value="<?php _e('tbd', WPSD_TXT_DOMAIN); ?>" <?php echo ( 'tbd' === $wpsd_form_header_type ) ? 'selected' : ''; ?> ><?php _e('Title-Banner-Description', WPSD_TXT_DOMAIN); ?></option>
                    </select>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_form_button_width"><?php _e('Form Button Width', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="number" min="1" max="1000" step="1" name="wpsd_form_button_width" value="<?php esc_attr_e( $wpsd_form_button_width ); ?>">
                    <select name="wpsd_form_button_width_type" class="medium-text">
                        <option value="px" <?php echo ( 'ps' === $wpsd_form_button_width_type ) ? 'selected' : ''; ?> ><?php echo 'px'; ?></option>
                        <option value="%" <?php echo ( '%' === $wpsd_form_button_width_type ) ? 'selected' : ''; ?> ><?php echo '%'; ?></option>
                    </select>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_display_total_donation"><?php _e('Display Total Donation Today', WPSD_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <?php
                if ( ! wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <span><?php echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __('Upgrade to Professional!', WPSD_TXT_DOMAIN) . '</a>'; ?></span>
                    <?php
                }

                if ( wsd_fs()->is_plan__premium_only('pro') ) {
                    ?>
                    <input type="checkbox" name="wpsd_display_total_donation" id="wpsd_display_total_donation" value="1" <?php echo $wpsd_display_total_donation ? 'checked' : ''; ?> >
                    <?php
                }
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateContent" name="updateContent" class="button button-primary wpsd-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', WPSD_TXT_DOMAIN); ?>
        </button>
    </p>
</form>