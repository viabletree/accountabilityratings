
<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

//print_r( $wpsdSyleSettings );
foreach ( $wpsdSyleSettings as $option_name => $option_value ) {
    
    if ( isset( $wpsdSyleSettings[$option_name] ) ) {

        ${"" . $option_name}  = $option_value;
    
    }
}
?>
<form name="wpsd-form-style-settings" role="form" class="form-horizontal" method="post" action="" id="wpsd-form-style-settings-id">
    <table class="wpsd-form-style-settings">
        <tr>
            <th scope="row" colspan="2">
                <hr><?php _e('Form Container', WPSD_TXT_DOMAIN); ?><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Width', WPSD_TXT_DOMAIN); ?></label>
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
                    <input type="number" min="0" max='10' step="1" name="wpsd_form_border_width" value="<?php esc_attr_e( $wpsd_form_border_width );?>" >
                    <code><?php _e('px', WPSD_TXT_DOMAIN); ?></code>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Color', WPSD_TXT_DOMAIN); ?></label>
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
                    <input class="wbg-wp-color" type="text" name="wpsd_form_border_color" id="wpsd_form_border_color" value="<?php esc_attr_e( $wpsd_form_border_color ); ?>">
                    <div id="colorpicker"></div>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Radius', WPSD_TXT_DOMAIN); ?></label>
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
                    <input type="number" min="0" max='50' step="1" name="wpsd_form_radius" value="<?php esc_attr_e( $wpsd_form_radius );?>" >
                    <code><?php _e('px', WPSD_TXT_DOMAIN); ?></code>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Padding', WPSD_TXT_DOMAIN); ?></label>
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
                    <input type="number" min="0" max='50' step="1" name="wpsd_form_padding_top" value="<?php esc_attr_e( $wpsd_form_padding_top );?>" style="width:60px;" >
                    <code><?php _e('top', WPSD_TXT_DOMAIN); ?></code>
                    <input type="number" min="0" max='30' step="1" name="wpsd_form_padding_right" value="<?php esc_attr_e( $wpsd_form_padding_right );?>" style="width:60px;" >
                    <code><?php _e('right', WPSD_TXT_DOMAIN); ?></code>
                    <input type="number" min="0" max='50' step="1" name="wpsd_form_padding_bottom" value="<?php esc_attr_e( $wpsd_form_padding_bottom );?>" style="width:60px;" >
                    <code><?php _e('bottom', WPSD_TXT_DOMAIN); ?></code>
                    <input type="number" min="0" max='30' step="1" name="wpsd_form_padding_left" value="<?php esc_attr_e( $wpsd_form_padding_left );?>" style="width:60px;" >
                    <code><?php _e('left', WPSD_TXT_DOMAIN); ?></code>
                    <code>( <?php _e('px', WPSD_TXT_DOMAIN); ?> )</code>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Background Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_form_bg_color" id="wpsd_form_bg_color" value="<?php esc_attr_e( $wpsd_form_bg_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_form_font_color" id="wpsd_form_font_color" value="<?php esc_attr_e( $wpsd_form_font_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">
                <hr><?php _e('Input Fields', WPSD_TXT_DOMAIN); ?><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Width', WPSD_TXT_DOMAIN); ?></label>
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
                    <input type="number" min="1" max='10' step="1" name="wpsd_form_input_border_width" value="<?php esc_attr_e( $wpsd_form_input_border_width );?>" >
                    <code><?php _e('px', WPSD_TXT_DOMAIN); ?></code>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_form_input_border_color" id="wpsd_form_input_border_color" value="<?php esc_attr_e( $wpsd_form_input_border_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Radius', WPSD_TXT_DOMAIN); ?></label>
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
                        <input type="number" min="0" max='50' step="1" name="wpsd_form_input_border_radius" value="<?php esc_attr_e( $wpsd_form_input_border_radius );?>" >
                        <code><?php _e('px', WPSD_TXT_DOMAIN); ?></code>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Padding', WPSD_TXT_DOMAIN); ?></label>
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
                    <input type="number" min="0" max='30' step="1" name="wpsd_form_input_padding_top" value="<?php esc_attr_e( $wpsd_form_input_padding_top );?>" style="width:60px;" >
                    <code><?php _e('top', WPSD_TXT_DOMAIN); ?></code>
                    <input type="number" min="0" max='30' step="1" name="wpsd_form_input_padding_right" value="<?php esc_attr_e( $wpsd_form_input_padding_right );?>" style="width:60px;" >
                    <code><?php _e('right', WPSD_TXT_DOMAIN); ?></code>
                    <input type="number" min="0" max='30' step="1" name="wpsd_form_input_padding_bottom" value="<?php esc_attr_e( $wpsd_form_input_padding_bottom );?>" style="width:60px;" >
                    <code><?php _e('bottom', WPSD_TXT_DOMAIN); ?></code>
                    <input type="number" min="0" max='30' step="1" name="wpsd_form_input_padding_left" value="<?php esc_attr_e( $wpsd_form_input_padding_left );?>" style="width:60px;" >
                    <code><?php _e('left', WPSD_TXT_DOMAIN); ?></code>
                    <code>( <?php _e('px', WPSD_TXT_DOMAIN); ?> )</code>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Background Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_form_input_bg_color" id="wpsd_form_input_bg_color" value="<?php esc_attr_e( $wpsd_form_input_bg_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_form_input_font_color" id="wpsd_form_input_font_color" value="<?php esc_attr_e( $wpsd_form_input_font_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Size', WPSD_TXT_DOMAIN); ?></label>
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
                        <input type="number" min="0" max='50' step="1" name="wpsd_form_input_font_size" value="<?php esc_attr_e( $wpsd_form_input_font_size );?>" >
                        <code><?php _e('px', WPSD_TXT_DOMAIN); ?></code>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">
                <hr><?php _e('Button', WPSD_TXT_DOMAIN); ?><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Background Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_button_bg_color" id="wpsd_button_bg_color" value="<?php esc_attr_e( $wpsd_button_bg_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', WPSD_TXT_DOMAIN); ?></label>
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
                        <input class="wbg-wp-color" type="text" name="wpsd_button_font_color" id="wpsd_button_font_color" value="<?php esc_attr_e( $wpsd_button_font_color ); ?>">
                        <div id="colorpicker"></div>
                        <?php
                    }
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateStyle" name="updateStyle" class="button button-primary wpsd-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', WPSD_TXT_DOMAIN); ?>
        </button>
    </p>
</form>