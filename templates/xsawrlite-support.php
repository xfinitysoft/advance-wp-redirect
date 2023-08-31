<?php
// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/*
* Template of Wordpress Hide Post
*
*/
function xsawrlite_support() {
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'report';
    ?>
    <div class="warp">
        <div id="icon-options-general" class="icon32"></div>
        <h1>
            <?php esc_html_e('Advance WP Redirect' , 'xsawrlite-domain') ?>
            <a class="xsawrlite-pro-link" href="https://codecanyon.net/item/advanced-wp-redirect/24178351" target="_blank">
                <div class="xsawrlite-button-main">
                    <?php submit_button(esc_html__("Pro Version" , 'xsawrlite-domain' ), 'secondary' , "xsawrlite-button"); ?>
                </div>
            </a>
        </h1>
       <nav class="nav-tab-wrapper wp-clearfix" aria-label="Secondary menu">
            <a class="nav-tab <?php  if($tab =='report' ){ echo 'nav-tab-active'; } ?>" href="?page=xsawrlite_support&tab=report" class="nav-tab">
                    <?php esc_html_e( 'Report a bug' , 'xsawrlite-domain' ); ?>
            </a>
            <a class="nav-tab <?php  if($tab =='request' ){ echo 'nav-tab-active'; } ?>" href="?page=xsawrlite_support&tab=request" class="nav-tab">
                    <?php esc_html_e( 'Request a Feature' , 'xsawrlite-domain' ); ?>
            </a>
            <a class="nav-tab <?php  if($tab =='hire' ){ echo 'nav-tab-active'; } ?>" href="?page=xsawrlite_support&tab=hire" class="nav-tab">
                    <?php esc_html_e( 'Hire US' , 'xsawrlite-domain' ); ?>
            </a>
            <a class="nav-tab <?php  if($tab =='review' ){ echo 'nav-tab-active'; } ?>" href="?page=xsawrlite_support&tab=review" class="nav-tab">
                    <?php esc_html_e( 'Review' , 'xsawrlite-domain' ); ?>
            </a>

        </nav>
        <div class="tab-content">
            <?php switch ($tab) {
                case 'report':
                    ?>
                    <div class="xs-send-email-notice xs-top-margin">
                        <p></p>
                        <button type="button" class="notice-dismiss xs-notice-dismiss"><span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','xsawrlite-domain');?></span></button>
                    </div>
                    <form method="post" class="xsawrlite_support_form">
                        <input type="hidden" name="type" value="report">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th>
                                        <label for='xsawrlite_name'><?php esc_html_e('Your Name:', 'xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" id="xsawrlite_name" name="xsawrlite_name" required="required">
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        <label for="xsawrlite_email"><?php esc_html_e('Your Email:','xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <input type="email" id="xsawrlite_email" name="xsawrlite_email" required="required">
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        <label for="xsawrlite_message"><?php esc_html_e('Message:','xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <textarea id="xsawrlite_message" name="xsawrlite_message" rows="12", cols="47" required="required"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="input-group">
                            <?php submit_button(__( 'Send', 'xsawrlite-domain' ), 'primary xsawrlite-send-mail'); ?>
                            <span class="spinner xs-mail-spinner"></span> 
                        </div>
                    </form>
                    
                    <?php
                    break;
                case 'request':
                    ?>
                    <div class="xs-send-email-notice xs-top-margin">
                        <p></p>
                        <button type="button" class="notice-dismiss xs-notice-dismiss"><span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','xsawrlite-domain');?></span></button>
                    </div>
                    <form method="post" class="xsawrlite_support_form">
                        <input type="hidden" name="type" value="request">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th>
                                        <label for='xsawrlite_name'><?php esc_html_e('Your Name:', 'xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" id="xsawrlite_name" name="xsawrlite_name" required>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        <label for="xsawrlite_email"><?php esc_html_e('Your Email:','xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <input type="email" id="xsawrlite_email" name="xsawrlite_email" required>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        <label for="xsawrlite_message"><?php esc_html_e('Message:','xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <textarea id="xsawrlite_message" name="xsawrlite_message" rows="12", cols="47" required></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="input-group">
                            <?php submit_button(__( 'Send', 'xsawrlite-domain' ), 'primary xsawrlite-send-mail'); ?>
                            <span class="spinner xs-mail-spinner"></span> 
                        </div>
                        
                    </form>
                    <?php
                    break;
                case 'hire':
                    ?>
                    <h2 class="xs-top-margin"><?php esc_html_e("Hire us to customize/develope Plugin/Theme or WordPress projects" , 'xsawrlite-domain') ?></h2>
                    <div class="xs-send-email-notice ">
                        <p></p>
                        <button type="button" class="notice-dismiss xs-notice-dismiss"><span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.','xsawrlite-domain');?></span></button>
                    </div>
                    <form method="post" class="xsawrlite_support_form">
                        <input type="hidden" name="type" value="hire">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th>
                                        <label for='xsawrlite_name'><?php esc_html_e('Your Name:', 'xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" id="xsawrlite_name" name="xsawrlite_name" required="required">
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        <label for="xsawrlite_email"><?php esc_html_e('Your Email:','xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <input type="email" id="xsawrlite_email" name="xsawrlite_email" required="required">
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        <label for="xsawrlite_message"><?php esc_html_e('Message:','xsawrlite-domain'); ?></label>
                                    </th>
                                    <td>
                                        <textarea id="xsawrlite_message" name="xsawrlite_message" rows="12", cols="47" required="required"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="input-group">
                            <?php submit_button(__( 'Send', 'xsawrlite-domain' ), 'primary xsawrlite-send-mail'); ?>
                            <span class="spinner xs-mail-spinner"></span> 
                        </div>
                    </form>
                    <?php
                    break;
                case 'review':
                ?>
                    <p class="about-description xs-top-margin"><?php esc_html_e("If you like our plugin and support than kindly share your  " , 'xsawrlite-domain') ?> <a href="https://wordpress.org/plugins/advance-wp-redirect/#reviews" target="_blank"> <?php esc_html_e("feedback" , 'xsawrlite-domain') ?> </a><?php esc_html_e("Your feedback is valuable." , 'xsawrlite-domain') ?> </p>
                <?php
                    break;
                default:
                    break;
            }
                ?>
        </div>
    </div>
    <?php
}
