<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdEmailSettings );
foreach ( $wpsdEmailSettings as $option_name => $option_value ) {
    if ( isset( $wpsdEmailSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wpsd-email-settings-form" role="form" class="form-horizontal" method="post" action="" id="wpsd-settings-form-id">
    <table class="form-table">
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Subject', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input type="text" name="wpsd_re_email_subject" class="regular-text" value="<?php 
esc_attr_e( $wpsd_re_email_subject );
?>" />
                <br>
                <code><?php 
_e( 'We received your payment', WPSD_TXT_DOMAIN );
?>!</code>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Heading', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input type="text" name="wpsd_re_email_heading" class="regular-text" value="<?php 
esc_attr_e( $wpsd_re_email_heading );
?>" />
                <br>
                <code><?php 
_e( 'Receipt from Your Orginazation Name', WPSD_TXT_DOMAIN );
?></code>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Greeting Message', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <?php 
?>
                    <textarea class="regular-text" readonly><?php 
esc_html_e( $wpsd_re_email_greeting );
?></textarea>
                    <br>
                    <span><?php 
echo  '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Upgrade to professional!', WPSD_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
                <br>
                <code><?php 
_e( 'The message you want to say after donor name. e.g. Thank you for your payment.', WPSD_TXT_DOMAIN );
?></code>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Footnote', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <textarea name="wpsd_re_email_footnote" class="regular-text"><?php 
esc_html_e( $wpsd_re_email_footnote );
?></textarea>
                <br>
                <code><?php 
_e( 'If you have any question, please reply this email.', WPSD_TXT_DOMAIN );
?></code>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_disable_receipt_email"><?php 
_e( 'Disable Plugin Receipt Email', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <?php 
?>
                    <input type="checkbox">
                    <span><?php 
echo  '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WPSD_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wpsd_disable_stripe_receipt_email"><?php 
_e( 'Disable Stripe Receipt Email', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <?php 
?>
                    <input type="checkbox">
                    <span><?php 
echo  '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WPSD_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'From Name', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <?php 
?>
                    <input type="text" class="regular-text" value="<?php 
esc_attr_e( $wpsd_re_from_name );
?>" readonly>
                    <span><?php 
echo  '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WPSD_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'From Email', WPSD_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <?php 
?>
                    <input type="text" class="regular-text" value="<?php 
esc_attr_e( $wpsd_re_from_email );
?>" readonly>
                    <span><?php 
echo  '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WPSD_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateEmailSettings" name="updateEmailSettings" class="button button-primary wpsd-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WPSD_TXT_DOMAIN );
?>
        </button>
    </p>
</form>