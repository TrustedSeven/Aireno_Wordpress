<?php
/**
 * Template Name: Account Billing Page
 *
 * @package WordPress
 * @subpackage Aireno
 * @since Aireno 1.0
 */
if (!is_user_logged_in()) {
    wp_safe_redirect(aireno_get_page_link_by_name('login'));
}
$user_id = get_current_user_id();
if (is_client($user_id)) {
    wp_safe_redirect(aireno_get_page_link_by_name('account-settings'));
}
get_header();

$user_data  = get_userdata($user_id);
$display_name = $user_data->data->display_name;
$user_email = $user_data->data->user_email;

$address = get_field('_address', 'user_'.$user_id);
$phone = get_field('_phone', 'user_'.$user_id);

$avatar = get_field('_avatar', 'user_'.$user_id);
if ($avatar) {
    $avatar_url = $avatar['url'];
    $avatar_id = $avatar['ID'];
}
else {
    $avatar_url = get_avatar_url($user_id);
    $avatar_id = '';
}

if (is_business($user_id)) {
    $business_logo = $avatar = get_field('_business_logo', 'user_'.$user_id);
    if ($business_logo) {
        $business_logo_url = $business_logo['url'];
        $business_logo_id = $business_logo['ID'];
    }
    else {
        if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            $business_logo_url = $logo[0];
        } else {
            $business_logo_url = get_theme_file_uri('assets/images/logo.png');
        }
        $business_logo_id = '';
    }
    $company_name = get_field('_company_name', 'user_'.$user_id);
    $company_abn = get_field('_company_abn', 'user_'.$user_id);
}
?>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">

                        <?php
                        get_template_part('template-parts/profile/account', 'header');
                        ?>

                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 "
                                   href="<?= aireno_get_page_link_by_name('account-settings') ?>">Settings</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                   href="<?= aireno_get_page_link_by_name('account-billing') ?>">Membership</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?= get_author_posts_url($user_id) ?>">Profile</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?= get_post_type_archive_link(AIRENO_CPT_PROJECT) ?>">Projects</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                   href="<?= aireno_get_page_link_by_name('account-overview') ?>">Contacts</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->

                <div class="card mb-5">
                    <div class="card-body pt-0 pb-0">
                        <style>
                            #pmpro_account .pmpro_box {
                                border-top: none;
                            }
                        </style>
                        <?php
                        global $wpdb, $pmpro_msg, $pmpro_msgt, $pmpro_levels, $current_user, $levels;

                        $atts = "";
                        extract(shortcode_atts(array(
                            'section' => 'membership, invoices',
                            'sections' => 'membership, profile, invoices, links'
                        ), $atts));

                        //did they use 'section' instead of 'sections'?
                        if(!empty($section))
                            $sections = $section;

                        //Extract the user-defined sections for the shortcode
                        $sections = array_map('trim', explode(",", $sections));
                        ob_start();

                        //if a member is logged in, show them some info here (1. past invoices. 2. billing information with button to update.)
                        $order = new MemberOrder();
                        $order->getLastMemberOrder();
                        $mylevels = pmpro_getMembershipLevelsForUser();
                        $pmpro_levels = pmpro_getAllLevels(false, true); // just to be sure - include only the ones that allow signups
                        $invoices = $wpdb->get_results("SELECT *, UNIX_TIMESTAMP(CONVERT_TZ(timestamp, '+00:00', @@global.time_zone)) as timestamp FROM $wpdb->pmpro_membership_orders WHERE user_id = '$current_user->ID' AND status NOT IN('review', 'token', 'error') ORDER BY timestamp DESC LIMIT 6");
                        ?>
                        <div id="pmpro_account">
                            <?php if(in_array('membership', $sections) || in_array('memberships', $sections)) { ?>
                                <div id="pmpro_account-membership" class="<?php echo pmpro_get_element_class( 'pmpro_box', 'pmpro_account-membership' ); ?>">
                                    <h3 class="mb-5 fs-2 fw-bolder text-dark"><?php esc_html_e("My Memberships", 'paid-memberships-pro' );?></h3>
                                    <table class="<?php echo pmpro_get_element_class( 'pmpro_table' ); ?> mb-5" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <?php if ( !empty( $mylevels ) ) { ?>
                                            <thead>
                                                <tr>
                                                    <th class="py-3"><?php esc_html_e("Level", 'paid-memberships-pro' );?></th>
                                                    <th class="py-3"><?php esc_html_e("Billing", 'paid-memberships-pro' ); ?></th>
                                                    <th class="py-3"><?php esc_html_e("Expiration", 'paid-memberships-pro' ); ?></th>
                                                </tr>
                                            </thead>
                                        <?php } ?>
                                        <tbody>
                                        <?php if ( empty( $mylevels ) ) { ?>
                                            <tr>
                                                <td colspan="3" class="py-3">
                                                    <?php
                                                    // Check to see if the user has a cancelled order
                                                    $order = new MemberOrder();
                                                    $order->getLastMemberOrder( $current_user->ID, array( 'cancelled', 'expired', 'admin_cancelled' ) );

                                                    if ( isset( $order->membership_id ) && ! empty( $order->membership_id ) && empty( $level->id ) ) {
                                                        $level = pmpro_getLevel( $order->membership_id );
                                                    }

                                                    // If no level check for a default level.
                                                    if ( empty( $level ) || ! $level->allow_signups ) {
                                                        $default_level_id = apply_filters( 'pmpro_default_level', 0 );
                                                    }

                                                    // Show the correct checkout link.
                                                    if ( ! empty( $level ) && ! empty( $level->allow_signups ) ) {
                                                        $url = pmpro_url( 'checkout', '?level=' . $level->id );
                                                        printf( __( "Your membership is not active. <a href='%s' class='text-danger fw-boldest'>Renew now.</a>", 'paid-memberships-pro' ), $url );
                                                    } elseif ( ! empty( $default_level_id ) ) {
                                                        $url = pmpro_url( 'checkout', '?level=' . $default_level_id );
                                                        printf( __( "You do not have an active membership. <a href='%s' class='text-danger fw-boldest'>Register here.</a>", 'paid-memberships-pro' ), $url );
                                                    } else {
//                                                    $url = pmpro_url( 'levels' );
                                                        $url = get_site_url().'/#pricing';
                                                        printf( __( "You do not have an active membership. <a href='%s' class='text-danger fw-boldest'>Choose a membership level.</a>", 'paid-memberships-pro' ), $url );
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php
                                            foreach($mylevels as $level) {
                                                ?>
                                                <tr>
                                                    <td class="<?php echo pmpro_get_element_class( 'pmpro_account-membership-levelname' ); ?> py-3">
                                                        <?php echo $level->name?>
                                                        <div class="<?php echo pmpro_get_element_class( 'pmpro_actionlinks' ); ?>">
                                                            <?php do_action("pmpro_member_action_links_before"); ?>

                                                            <?php
                                                            // Build the links to return.
                                                            $pmpro_member_action_links = array();

                                                            if( array_key_exists($level->id, $pmpro_levels) && pmpro_isLevelExpiringSoon( $level ) ) {
                                                                $pmpro_member_action_links['renew'] = sprintf( '<a id="pmpro_actionlink-renew" href="%s">%s</a>', esc_url( add_query_arg( 'level', $level->id, pmpro_url( 'checkout', '', 'https' ) ) ), esc_html__( 'Renew', 'paid-memberships-pro' ) );
                                                            }

                                                            $pmpro_member_action_links['cancel'] = sprintf( '<a id="pmpro_actionlink-cancel" href="%s">%s</a>', esc_url( add_query_arg( 'levelstocancel', $level->id, pmpro_url( 'cancel' ) ) ), esc_html__( 'Cancel', 'paid-memberships-pro' ) );

                                                            /**
                                                             * Filter the member action links.
                                                             *
                                                             * @param array $pmpro_member_action_links Member action links.
                                                             * @param int   $level->id The ID of the membership level.
                                                             * @return array $pmpro_member_action_links Member action links.
                                                             */
                                                            $pmpro_member_action_links = apply_filters( 'pmpro_member_action_links', $pmpro_member_action_links, $level->id );

                                                            $allowed_html = array(
                                                                'a' => array (
                                                                    'class' => array(),
                                                                    'href' => array(),
                                                                    'id' => array(),
                                                                    'target' => array(),
                                                                    'title' => array(),
                                                                ),
                                                            );
                                                            echo wp_kses( implode( pmpro_actions_nav_separator(), $pmpro_member_action_links ), $allowed_html );
                                                            ?>

                                                            <?php do_action("pmpro_member_action_links_after"); ?>
                                                        </div> <!-- end pmpro_actionlinks -->
                                                    </td>
                                                    <td class="py-3 <?php echo pmpro_get_element_class( 'pmpro_account-membership-levelfee' ); ?>">
                                                        <p><?php echo pmpro_getLevelCost($level, true, true);?></p>
                                                    </td>
                                                    <td class="py-3 <?php echo pmpro_get_element_class( 'pmpro_account-membership-expiration' ); ?>">
                                                        <?php
                                                        $expiration_text = '<p>';
                                                        if ( $level->enddate ) {
                                                            $expiration_text .= date_i18n( get_option( 'date_format' ), $level->enddate );
                                                            /**
                                                             * Filter to include the expiration time with expiration date
                                                             *
                                                             * @param bool $pmpro_show_time_on_expiration_date Show the expiration time with expiration date (default: false).
                                                             *
                                                             * @return bool $pmpro_show_time_on_expiration_date Whether to show the expiration time with expiration date.
                                                             *
                                                             */
                                                            if ( apply_filters( 'pmpro_show_time_on_expiration_date', false ) ) {
                                                                $expiration_text .= ' ' . date_i18n( get_option( 'time_format', __( 'g:i a' ) ), $level->enddate );
                                                            }
                                                        } else {
                                                            $expiration_text .= esc_html_x( '&#8212;', 'A dash is shown when there is no expiration date.', 'paid-memberships-pro' );
                                                        }
                                                        $expiration_text .= '</p>';
                                                        echo apply_filters( 'pmpro_account_membership_expiration_text', $expiration_text, $level );
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php //Todo: If there are multiple levels defined that aren't all in the same group defined as upgrades/downgrades ?>
                                    <div class="<?php echo pmpro_get_element_class( 'pmpro_actionlinks' ); ?>">
                                        <a id="pmpro_actionlink-levels" href="<?php echo home_url()."#pricing" ?>" class="text-danger fw-boldest"><?php esc_html_e("View all Membership Options", 'paid-memberships-pro' );?></a>
                                    </div>

                                </div> <!-- end pmpro_account-membership -->
                            <?php } ?>


                            <?php if(in_array('invoices', $sections) && !empty($invoices)) { ?>
                                <div id="pmpro_account-invoices" class="<?php echo pmpro_get_element_class( 'pmpro_box', 'pmpro_account-invoices' ); ?>">
                                    <h3><?php esc_html_e("Invoices", 'paid-memberships-pro' );?></h3>
                                    <table class="<?php echo pmpro_get_element_class( 'pmpro_table' ); ?>" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <thead>
                                        <tr>
                                            <th class="py-3"><?php esc_html_e("Date", 'paid-memberships-pro' ); ?></th>
                                            <th class="py-3"><?php esc_html_e("Level", 'paid-memberships-pro' ); ?></th>
                                            <th class="py-3"><?php esc_html_e("Amount", 'paid-memberships-pro' ); ?></th>
                                            <th class="py-3"><?php esc_html_e("Status", 'paid-memberships-pro'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 0;
                                        foreach($invoices as $invoice)
                                        {
                                            if($count++ > 4)
                                                break;

                                            //get an member order object
                                            $invoice_id = $invoice->id;
                                            $invoice = new MemberOrder;
                                            $invoice->getMemberOrderByID($invoice_id);
                                            $invoice->getMembershipLevel();

                                            if ( in_array( $invoice->status, array( '', 'success', 'cancelled' ) ) ) {
                                                $display_status = __( 'Paid', 'paid-memberships-pro' );
                                            } elseif ( $invoice->status == 'pending' ) {
                                                // Some Add Ons set status to pending.
                                                $display_status = __( 'Pending', 'paid-memberships-pro' );
                                            } elseif ( $invoice->status == 'refunded' ) {
                                                $display_status = __( 'Refunded', 'paid-memberships-pro' );
                                            }
                                            ?>
                                            <tr id="pmpro_account-invoice-<?php echo $invoice->code; ?>">
                                                <td class="py-3"><a href="<?php echo esc_url( pmpro_url( "invoice", "?invoice=" . $invoice->code ) ) ?>"><?php echo date_i18n(get_option("date_format"), $invoice->getTimestamp())?></a></td>
                                                <td class="py-3"><?php if(!empty($invoice->membership_level)) echo $invoice->membership_level->name; else echo __("N/A", 'paid-memberships-pro' );?></td>
                                                <td class="py-3"><?php echo pmpro_escape_price( pmpro_formatPrice($invoice->total) ); ?></td>
                                                <td class="py-3"><?php echo $display_status; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php if($count == 6) { ?>
                                        <div class="<?php echo pmpro_get_element_class( 'pmpro_actionlinks' ); ?>"><a id="pmpro_actionlink-invoices" href="<?php echo esc_url( pmpro_url( "invoice" ) ); ?>"><?php esc_html_e("View All Invoices", 'paid-memberships-pro' );?></a></div>
                                    <?php } ?>
                                </div> <!-- end pmpro_account-invoices -->
                            <?php } ?>

                        </div> <!-- end pmpro_account -->
                        <?php
                        ?>
                    </div>
                </div>
                <!--begin::Billing Summary-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
<?php
get_footer();
