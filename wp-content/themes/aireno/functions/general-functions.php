<?php
function aireno_get_userdata($user_id)
{
    $object = new stdClass();
    $user_data = get_userdata($user_id);

    // getting basic user data: First name, Last name, Email, Phone, User Type
    if ($user_data != false) {
        $object->id = $user_id;
        $object->login = $user_data->user_login;

        $object->email = $user_data->user_email;

        $object->display_name = $user_data->display_name;
        $object->phone = get_field('_phone', 'user_' . $user_id);
        $object->address = get_field('_address', 'user_' . $user_id);
        $object->user_type = get_field('user_type', 'user_' . $user_id);

        $avatar = get_field('_avatar', 'user_' . $user_id);
        if ($avatar) {
            $avatar_url = $avatar['url'];
        } else {
            $avatar_url = get_avatar_url($user_id);
        }
        $object->avatar = $avatar_url;
        $object->profile = get_author_posts_url($user_id);

        if (is_business($user_id)) {
            $business_logo = get_field('_business_logo', 'user_' . $user_id);
            if ($business_logo) {
                $business_logo_url = $business_logo['url'];
            } else {
                if (has_custom_logo()) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    $business_logo_url = $logo[0];
                } else {
                    $business_logo_url = get_theme_file_uri('assets/images/logo.png');
                }
            }
            $company_name = get_field('_company_name', 'user_' . $user_id);
            $company_abn = get_field('_company_abn', 'user_' . $user_id);

            $object->business_logo = $business_logo_url;
            $object->company_name = $company_name;
            $object->company_abn = $company_abn;
            $object->payment_instructions = get_field('_payment_instructions', 'user_' . $user_id);
            $object->payment_details = get_field('_payment_details', 'user_' . $user_id);
        }

        // getting user Admin or not
        if (user_can($user_id, 'manage_options')) {
            $object->administrator = true;
            if (!$object->user_type) $object->user_type = 'Head';
        } else {
            $object->administrator = false;
        }
    } else {
        $object = false;
    }

    return $object;
}

function aireno_send_email($subject, $title, $content, $user, $email = null, $attachments = array())
{
    $aireno_unsubscribed = get_option('aireno_unsubscribed');
    if (!in_array($user, $aireno_unsubscribed)) {
        if ($user) {
            $user_data = aireno_get_userdata($user);
        } else {
            $user_data = null;
        }

        $email = $user_data ? $user_data->email : $email;

        $mail = '<!DOCTYPE html>
            <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
        <title></title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
        <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
        <!--<![endif]-->
        <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:670px) {
                    .social_block.desktop_hide .social-table {
                        display: inline-block !important;
                    }
        
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
    </head>
    <body style="background-color: #000000; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
        <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;" width="100%">
            <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
                                            <tbody>
                                                <tr>
                                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                            <tr>
                                                                <td class="pad" style="padding-bottom:15px;padding-top:15px;width:100%;padding-right:0px;padding-left:0px;">
                                                                    <div align="center" class="alignment" style="line-height:10px">
                                                                        <a href="'.get_site_url().'">
                                                                            <img alt="your logo" src="'.get_parent_theme_file_uri("assets/images/aireno.png").'" href="www.aireno.com.au" style="display: block; height: auto; border: 0; width: 163px; max-width: 100%;" title="your logo" width="163"/>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; background-size: auto;" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-size: auto; background-color: #ffffff; color: #000000; width: 650px;" width="650">
                                            <tbody>
                                                <tr>
                                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; color: #000000; text-align: left; vertical-align: top; padding-top: 10px; padding-bottom: 10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                            <tr>
                                                                <td class="pad" style="padding-top:35px;text-align:center;width:100%;">
                                                                    <h1 style="margin: 0; color: #5d4965; direction: ltr; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 20px; font-weight: 400; letter-spacing: normal; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>'.$title.'</strong></h1>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                            <tr>
                                                                <td class="pad" style="padding-left:45px;padding-right:45px;padding-top:10px;">
                                                                    <div style="font-family: Arial, sans-serif">
                                                                        <div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #000000; line-height: 1.5; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                            <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 27px;"><span style="font-size:18px;">'.$content.'</span></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                            <tr>
                                                                <td class="pad" style="padding-bottom:10px;padding-left:45px;padding-right:45px;padding-top:10px;">
                                                                    <div style="font-family: Arial, sans-serif">
                                                                        <div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #393d47; line-height: 1.5; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                            <p style="margin: 0; font-size: 12px; mso-line-height-alt: 18px;"> </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="10" cellspacing="0" class="button_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                            <tr>
                                                                <td class="pad">
                                                                    <div align="center" class="alignment">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
                                            <tbody>
                                                <tr>
                                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                        <table border="0" cellpadding="5" cellspacing="0" class="divider_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                            <tr>
                                                                <td class="pad">
                                                                    <div align="center" class="alignment">
                                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                                            <tr>
                                                                                <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;"><span> </span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                            <tr>
                                                                <td class="pad">
                                                                    <div style="font-family: sans-serif">
                                                                        <div class="" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #191616; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                            <p style="margin: 0; text-align: center; mso-line-height-alt: 14.399999999999999px;">Renovate Smart</p>
                                                                            <p style="margin: 0; text-align: center; mso-line-height-alt: 14.399999999999999px;">hi@aireno.com.au</p>
                                                                            <p style="margin: 0; text-align: center; mso-line-height-alt: 14.399999999999999px;"> </p>
                                                                            <p style="margin: 0; text-align: center; mso-line-height-alt: 14.399999999999999px;">
                                                                                <a href="'.aireno_get_page_link_by_name('account-settings').'">Unsubscribe</a>
                                                                            </p>
                                                                            <p style="margin: 0; mso-line-height-alt: 14.399999999999999px;"> </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="10" cellspacing="0" class="social_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                            <tr>
                                                                <td class="pad">
                                                                    <div align="center" class="alignment">
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="72px">
                                                                            <tr>
                                                                                <td style="padding:0 2px 0 2px;"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="'.get_parent_theme_file_uri("assets/images/facebook.png").'" style="display: block; height: auto; border: 0;" title="facebook" width="32"/></a></td>
                                                                                <td style="padding:0 2px 0 2px;"><a href="https://instagram.com/" target="_blank"><img alt="Instagram" height="32" src="'.get_parent_theme_file_uri("assets/images/instagram.png").'" style="display: block; height: auto; border: 0;" title="Instagram" width="32"/></a></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>';
        add_filter('wp_mail_content_type', function () {
            return "text/html";
        });
        // $m = wp_mail($user_data->email, $subject, $mail);
        $m = wp_mail($email, $subject, $mail, array(), $attachments);
        return $m;
    }
}

function is_client($user_id)
{
    $user_type = get_field('user_type', 'user_' . $user_id);
    return $user_type == 'Client';
}

function is_business($user_id)
{
    $user_type = get_field('user_type', 'user_' . $user_id);
    return $user_type == 'Business';
}

function is_head($user_id)
{
    $user_type = get_field('user_type', 'user_' . $user_id);
    if ($user_type == 'Head') return true;
    else if (user_can($user_id, 'manage_options')) return true;
    else return false;
}

function get_profile_completion_percent($user_id)
{
    $user_type = get_field('user_type', 'user_' . $user_id);
    if ($user_type == 'Business') {
        $fields = array(
            '_avatar',
            '_address',
            '_phone',
            '_business_logo',
            '_company_name',
            '_company_abn',
        );
    } else {
        $fields = array(
            '_avatar',
            '_address',
            '_phone',
        );
    }

    $to_fill_fields = array();
    foreach ($fields as $field) {
        if (get_field($field, 'user_' . $user_id) == '') $to_fill_fields[] = $field;
    }

    $completion_percent = intval((1 + count($fields) - count($to_fill_fields)) / (1 + count($fields)) * 100);
    return $completion_percent;
}

function aireno_get_user_fields_by_role($user_id)
{
    $user_data = aireno_get_userdata($user_id);
    $user_fields = array();
    switch ($user_data->user_type) {
        case 'Client':
            $user_fields = array('client', 'partner');
            break;
        case 'Business':
            $user_fields = array('client', 'partner', 'contractor', 'supplier');
            break;
        case 'Head':
            $user_fields = array('client', 'partner', 'contractor', 'business', 'supplier', 'head');
            break;
        case 'Contractor':
        case 'Supplier':
        default:
            break;
    }
    return $user_fields;
}

function aireno_project_status($project_id)
{
    $object = new stdClass();
    $status = get_field('status', $project_id);
    if ($status == 'quote') {
        $object->status = 'quote';
        $object->label = 'Estimate';
        $object->class = 'default';
    } elseif ($status == 'active') {
        $object->status = 'active';
        $object->label = 'Reviewing';
        $object->class = 'primary';
    } elseif ($status == 'updated') {
        $object->status = 'updated';
        $object->label = 'Updated Estimated';
        $object->class = 'primary';
    } elseif ($status == 'booked') {
        $object->status = 'booked';
        $object->label = 'Site Visit';
        $object->class = 'primary';
    } elseif ($status == 'pending') {
        $object->status = 'pending';
        $object->label = 'Final Quote';
        $object->class = 'warning';
    } elseif ($status == 'live') {
        $object->status = 'live';
        $object->label = 'Working';
        $object->class = 'info';
    } elseif ($status == 'completed') {
        $object->status = 'completed';
        $object->label = 'Completed';
        $object->class = 'success';
    } elseif ($status == 'cancelled') {
        $object->status = 'cancelled';
        $object->label = 'Closed';
        $object->class = 'dark';
    }

    return $object;
}

function aireno_add_activity($project_id, $type, $content, $datetime, $user)
{
    add_row('activities', array('type' => $type, 'datetime' => $datetime, 'content' => $content, 'user' => $user), $project_id);
}

function aireno_add_notification($title, $content, $assigned_users){
    $args = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => AIRENO_CPT_NOTIFICATION,
    );
    $notification_id = wp_insert_post($args);
    if ($notification_id) {
        update_field('assigned_users', $assigned_users, $notification_id);
        update_field('unread_users', $assigned_users, $notification_id);
        update_field('datetime', date_i18n('Y-m-d H:i:s'), $notification_id);
    }
}

function aireno_get_unread_notifications($user_id) {
    $notifications = array();
    $args = array(
        'post_type' => AIRENO_CPT_NOTIFICATION,
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array (
                'key' => 'assigned_users',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'unread_users',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
        ),
    );
    $result = new WP_Query($args);
    if ($result->have_posts()) {
        while ($result->have_posts()) {
            $result->the_post();
            $notifications[] = get_the_ID();
        }
    }
    wp_reset_query();
    return $notifications;
}

function aireno_get_unread_notifications_count($user_id) {
    return count(aireno_get_unread_notifications($user_id));
}

function aireno_get_unread_messages($user_id) {
    $messages = array();
    $args = array(
        'post_type' => AIRENO_CPT_MESSAGE,
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'meta_key' => 'unread_users',
        'meta_value' => '"'.$user_id.'"',
        'meta_compare' => 'LIKE',
    );
    $result = new WP_Query($args);
    if ($result->have_posts()) {
        while ($result->have_posts()) {
            $result->the_post();
            $messages[] = get_the_ID();
        }
    }
    wp_reset_query();
    return $messages;
}

function aireno_get_unread_messages_count($user_id) {
    return count(aireno_get_unread_messages($user_id));
}

function aireno_encode_content($content) {
    return base64_encode(json_encode($content));
}

function aireno_decode_content($content) {
    return json_decode(base64_decode($content));
}

function aireno_get_project_users($project_id, $user_id = '', $including_head = true) {
    $users = array();
    if ($user_id == '') $user_id = get_current_user_id();

    $client = get_field('client', $project_id);
    if ($client) {
        $users[] = $client;
    }

    $businesses = get_field('business', $project_id);
    if (!$businesses)
        $businesses = array();
    foreach ($businesses as $business) {
        $users[] = $business;
    }

    $partners = get_field('partner', $project_id);
    if (!$partners)
        $partners = array();
    foreach ($partners as $partner) {
        $users[] = $partner;
    }

    $contractors = get_field('contractor', $project_id);
    if (!$contractors)
        $contractors = array();
    foreach ($contractors as $contractor) {
        $users[] = $contractor;
    }

    $suppliers = get_field('supplier', $project_id);
    if (!$suppliers)
        $suppliers = array();
    foreach ($suppliers as $supplier) {
        $users[] = $supplier;
    }

    $planners = get_field('planner', $project_id);
    if (!$planners)
        $planners = array();
    foreach ($planners as $planner) {
        $users[] = $planner;
    }

    $designers = get_field('designer', $project_id);
    if (!$designers)
        $designers = array();
    foreach ($designers as $designer) {
        $users[] = $designer;
    }

    if ($including_head) {
        $heads = get_field('head', $project_id);
        if (!$heads)
            $heads = array();
        foreach ($heads as $head) {
            $users[] = $head;
        }
    }

    $users = array_unique($users);
    if (in_array($user_id, $users))
        unset($users[array_search($user_id, $users)]);
    return $users;
}

function aireno_get_contacts($user_id) {
    $contacts = get_field('contacts', 'user_' . $user_id);
    if (!$contacts) $contacts = array();
    else if (!is_array($contacts)) $contacts = array($contacts);
    return $contacts;
}

function aireno_search_from_contacts($user_id, $search) {
    $contacts = aireno_get_contacts($user_id);
    $users1 = new WP_User_Query(
        array(
            'search' => $search,
            'search_columns' => array('user_login', 'user_email', 'display_name'),
            'include' => $contacts,
        )
    );
    $users2 = new WP_User_Query(
        array(
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_phone',
                    'value' => $search,
                    'compare' => 'LIKE',
                ),
            ),
            'include' => $contacts,
        )
    );
    $users = array_merge($users1->get_results(), $users2->get_results());
    $results = array();
    foreach ($users as $user) {
        $results[] = aireno_get_userdata($user->ID);
    }
    return $results;
}

function aireno_add_to_contacts($user_id, $contact_id){
    $contacts = aireno_get_contacts($user_id);
    $contacts[] = $contact_id;
    $contacts = array_unique($contacts);
    update_field('contacts', $contacts, 'user_' . $user_id);
}

function aireno_get_user_projects($user_id){
    $projects = array();
    $args = array(
        'post_type' => AIRENO_CPT_PROJECT,
        'status' => array('publish'),
        'posts_per_page' => -1,
    );

    if (is_business($user_id) || is_client($user_id)) {
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => 'client',
                'value' => $user_id,
                'compare' => '=',
            ),
            array(
                'key' => 'business',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'contractor',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'supplier',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'planner',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'designer',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
            array(
                'key' => 'partner',
                'value' => '"'.$user_id.'"',
                'compare' => 'LIKE',
            ),
        );
    }

    $result = new WP_Query($args);
    if ($result->have_posts()) {
        while ($result->have_posts()) {
            $result->the_post();
            $projects[] = get_the_ID();
        }
    }
    wp_reset_query();
    return $projects;
}

function aireno_get_user_projects_count($user_id){
    $projects = aireno_get_user_projects($user_id);
    return count($projects);
}

function aireno_get_contacts_count($user_id) {
    return count(aireno_get_contacts($user_id));
}

function aireno_get_custom_logo_url()
{
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    return $image[0];
}

function aireno_get_user_review_count($user_id){
    $reviews = get_field('reviews', 'user_' . $user_id);
    if (!$reviews) $reviews = array();
    return count($reviews);
}

function aireno_esc_nicename( $nicename = '' ) {
    return esc_textarea( urldecode( $nicename ) );
}