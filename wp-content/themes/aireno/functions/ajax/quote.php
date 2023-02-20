<?php
add_action('wp_ajax_aireno_calculate_quote', 'aireno_calculate_quote');
function aireno_calculate_quote()
{
    $template_id = $_POST['templateId'];
    $projectData = $_POST;
    $total = 0;

    $quote_fields = get_field('quote_fields', $template_id);
    foreach ($quote_fields as $quote_field) {
        $quote_slug = $quote_field['slug'];
        $quote_in_price = $quote_field['in_price'];
        if ($quote_in_price) {
            if (array_key_exists($quote_slug, $projectData)) {
                $quote_sub_fields = $quote_field['fields'];
                foreach ($quote_sub_fields as $quote_sub_field) {
                    $quote_sub_field_title = $quote_sub_field['title'];

                    $quote_sub_field_slug = $quote_sub_field['slug'];
                    if (in_array($quote_sub_field_title, $projectData[$quote_slug]) || $quote_sub_field_title == $projectData[$quote_slug]) {

                        $sub_field_count = intval($projectData[$quote_sub_field_slug . '_count']);
                        $sub_field_multiple = intval($projectData[$quote_sub_field_slug . '_multiple']);
                        for ($i = 0; $i < $sub_field_count; $i++) {
                            $included = $projectData['default_' . $quote_sub_field_slug . '_' . $i];
                            if ($included == 'true') {
                                $price = $projectData['price_' . $quote_sub_field_slug . '_' . $i];
                                $price = str_replace('$', '', $price);
                                $quantity = $projectData['quantity_' . $quote_sub_field_slug . '_' . $i];
                                $margin = $projectData['margin_' . $quote_sub_field_slug . '_' . $i];
                                $margin = str_replace('%', '', $margin);
                                $total += $price * $quantity * (1 + $margin / 100) * $sub_field_multiple;
                            }
                        }
                    }
                }
            }
        }
    }
    $total = number_format($total, 2, '.', '');

    if (!empty($_POST['customQuoteFieldTotalPrice'])) {
        foreach ($_POST['customQuoteFieldTotalPrice'] as $price) {
            $total += floatval($price);
        }
    }
    $response = array(
        'total' => $total,
        'projectData' => $projectData,
    );

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_finish_quote', 'aireno_finish_quote');
function aireno_finish_quote()
{
    $template_id = $_POST['templateId'];
    $projectName = $_POST['projectName'];
    $project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : '';

    $projectAddress = $_POST['zipcode'];
    $projectDateStart = $_POST['date_start'];
    $projectStage = $_POST['stage'];

    $projectData = $_POST;
    $total = 0;

    $quote_fields = get_field('quote_fields', $template_id);
    foreach ($quote_fields as $quote_field) {
        $quote_slug = $quote_field['slug'];
        $quote_in_price = $quote_field['in_price'];
        if ($quote_in_price) {
            if (array_key_exists($quote_slug, $projectData)) {
                $quote_sub_fields = $quote_field['fields'];
                foreach ($quote_sub_fields as $quote_sub_field) {
                    $quote_sub_field_title = $quote_sub_field['title'];

                    $quote_sub_field_slug = $quote_sub_field['slug'];
                    if (in_array($quote_sub_field_title, $projectData[$quote_slug]) || $quote_sub_field_title == $projectData[$quote_slug]) {
                        $sub_field_multiple = intval($projectData[$quote_sub_field_slug . '_multiple']);
                        $sub_field_count = intval($projectData[$quote_sub_field_slug . '_count']);
                        for ($i = 0; $i < $sub_field_count; $i++) {
                            $included = $projectData['default_' . $quote_sub_field_slug . '_' . $i];
                            if ($included == 'true') {
                                $price = $projectData['price_' . $quote_sub_field_slug . '_' . $i];
                                $price = str_replace('$', '', $price);
                                $quantity = $projectData['quantity_' . $quote_sub_field_slug . '_' . $i];
                                $margin = $projectData['margin_' . $quote_sub_field_slug . '_' . $i];
                                $margin = str_replace('%', '', $margin);
                                $total += $price * $quantity * (1 + $margin / 100) * $sub_field_multiple;
                            }
                        }
                    }
                }
            }
        }
    }
    $total_price = number_format($total, 2, '.', '');

    $user_id = get_current_user_id();

    if (!$project_id) {
        $newProject = true;
    } else {
        $newProject = false;
    }

    if ($newProject && is_business($user_id) && !pmpro_hasMembershipLevel(null, $user_id)) {
        $response = array(
            "message" => 'You do not have active membership. View our membership options!',
            "redirect" => site_url() . '/#pricing',
        );
    }
    else {
        // function for newScope
        $scope_title = $projectName;
        $rand = rand(111111111, 999999999);
        $scope_slug = 'quote-' . $rand;
        $args = array(
            'post_title' => $scope_title,
            'post_content' => base64_encode(json_encode($_POST)),
            'post_name' => $scope_slug,
            'post_author' => $user_id,
            'post_type' => AIRENO_CPT_SCOPE,
            'post_status' => 'publish'
        );
        $scopetId = wp_insert_post($args);

        update_field('scope_template', $template_id, $scopetId);
        update_field('scope_price', $total_price, $scopetId);
        update_field('template_icon', get_field('template_icon', $template_id), $scopetId);

        if ($newProject) {
            // projectCreation
            $project_slug = 'project-' . $rand;
            $postInformation = array(
                'post_title' => $projectName,
                'post_content' => '',
                'post_name' => $project_slug,
                'post_author' => $user_id,
                'post_type' => AIRENO_CPT_PROJECT,
                'post_status' => 'publish'
            );
            $project_id = wp_insert_post($postInformation);

            $projectBusiness = is_business($user_id) ? $user_id : null;
            $projectHead = is_head($user_id) ? $user_id : null;
            $projectClient = is_client($user_id) ? $user_id : $_POST['client'];

            if ((pmpro_hasMembershipLevel(null, $user_id) && is_business($user_id)) || is_head($user_id)) {
                aireno_add_to_contacts($user_id, $projectClient);
            }

            if ($projectClient) {
                update_field('_address', $projectAddress, 'user_' . $projectClient);
            }

            update_field('project_scopes', array($scopetId), $project_id);
            update_field('project_address', $projectAddress, $project_id);
            update_field('date_start', $projectDateStart, $project_id);
            update_field('stage', $projectStage, $project_id);

            update_field('client', $projectClient, $project_id);
            update_field('business', array($projectBusiness), $project_id);
            update_field('head', array($projectHead), $project_id);

            update_field('total_price', $total_price, $project_id);
            update_field('status', 'quote', $project_id);

            $contract_field = acf_get_field('contract');
            update_field('contract', $contract_field['default_value'], $project_id);

            update_field('template_photo', get_field('template_photo', $template_id), $project_id);
            update_field('template_icon', get_field('template_icon', $template_id), $project_id);

            $user_data = aireno_get_userdata($user_id);
            $message_content = $_POST['message'];
            if ($message_content != '') {
                $message_title = 'Message from  ' . $user_data->display_name . ' on ' . get_post($project_id)->post_title;
                $message_id = wp_insert_post(
                    array(
                        'post_title' => $message_title,
                        'post_content' => $message_content,
                        'post_author' => $user_id,
                        'post_type' => AIRENO_CPT_MESSAGE,
                        'post_status' => 'publish',
                    )
                );
                update_field('project_id', $project_id, $message_id);
            }

        } else {
            $scopeIds = get_field('project_scopes', $project_id);
            $scopeIds[] = $scopetId;
            update_field('project_scopes', $scopeIds, $project_id);
            aireno_recalculate_project_price($project_id);
        }

        update_field('project_id', $project_id, $scopetId);

        if (isset($_POST['business_id']) && is_business($_POST['business_id']) && $user_id != $_POST['business_id'] && pmpro_hasMembershipLevel(null, $_POST['business_id'])) {
            update_field('business', array($_POST['business_id']), $project_id);
        }

        if ($newProject == true) {
            $projectMessage = 'Quote successfully created...';
        } else {
            $projectMessage = 'Quote successfully updated...';
        }

        aireno_recalculate_project_price($project_id);

        aireno_add_activity($project_id, 'add_quote', "New Quote \"{$scope_title}\" added.", date_i18n('Y-m-d H:i:s'), get_current_user_id());;

        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " added a new Quote on " . get_post($project_id)->post_title;
        $link = get_permalink($project_id);
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));

        aireno_add_notification($title, $content, $project_users);

        $response = array(
            "message" => $projectMessage,
            "redirect" => get_permalink($project_id),
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_register_client', 'aireno_register_client');
function aireno_register_client()
{
    $user_email = $_POST['email'];
    $display_name = $_POST['display_name'];
    $phone = $_POST['phone'];
    $user_pwd = wp_generate_password();
    $user_role = $_POST['user_role'];
    $user_type = 'Business';
    if (isset($_POST['user_role'])) {
        switch ($user_role) {
            case 'Client':
            case 'Partner':
            case 'Designer':
            case 'Supplier':
                $user_type = 'Client';
                break;
            case 'Business':
            case 'Contractor':
            case 'Planner':
                $user_type = 'Business';
                break;
            default:
                break;
        }
    }

    $user_login = $display_name . time();
    $user_id = wp_insert_user(
        array(
            'user_login' => $user_login,
            'user_nicename' => $display_name,
            'user_email' => $user_email,
            'display_name' => $display_name,
            'user_pass' => $user_pwd,
            'meta_input' => array(
                'user_type' => $user_type,
            )
        )
    );

    if (empty($user_id) || is_wp_error($user_id)) {
        $e_msg = 'New user registration failed';
        if (is_wp_error($user_id)) {
            $e_msg = $user_id->get_error_message();
        }
        $response = array(
            'status' => false,
            'msg' => $e_msg,
        );
    } else {
        update_field('user_type', $user_type, 'user_' . $user_id);
        update_field('_phone', $phone, 'user_' . $user_id);

        $creater_id = get_current_user_id();
        $creater_data = aireno_get_userdata($creater_id);

        aireno_add_to_contacts(get_current_user_id(), $user_id);

        $title = $subject = "{$creater_data->display_name} invited you to Aireno";
        $text = "Here is your account information for Aireno<br/>";
        $text .= "Display Name : " . $display_name . "<br/>";
        $text .= "Username : " . $user_login . "<br/>";
        $text .= "User Email : " . $user_email . "<br/>";
        $text .= "Password : " . $user_pwd . "<br/>";
        $text .= '<a href="http://aireno.com.au/login" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Login</a>';

        aireno_send_email($subject, $title, $text, null, $user_email);

        if (isset($_POST['project_id']) && is_numeric($_POST['project_id']) && get_post($_POST['project_id'])->post_type == AIRENO_CPT_PROJECT) {
            $project_id = intval($_POST['project_id']);
            $project_title = get_post($project_id)->post_title;
            $user_role = strtolower($_POST['user_role']);
            $members = get_field($user_role, $project_id);
            $members[] = $user_id;
            update_field($user_role, $members, $project_id);

            aireno_add_activity($project_id, 'add_user', 'User added to project.', date_i18n('Y-m-d H:i:s'), get_current_user_id());;

            $title = $subject = "{$creater_data->display_name} assigned you a project";
            $text .= "Project Title : " . $project_title . "<br/>";
            $text .= "Role : " . $_POST['user_role'] . "<br/>";
            $text .= '<a href="'.get_permalink($project_id).'" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a>';

            aireno_send_email($subject, $title, $text, null, $user_email);
        }

        $response = array(
            'status' => true,
            'client' => array(
                'ID' => $user_id,
                'display_name' => $display_name . '(' . $user_email . ')',
            )
        );

    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_search_users', 'aireno_search_users');
function aireno_search_users()
{
    $email_or_phone = $_POST['email_or_phone'];

    $user_id = get_current_user_id();
    $contacts = aireno_get_contacts($user_id);

    $users = get_users(
        array(
            'meta_key' => '_phone',
            'meta_value' => $email_or_phone,
            'meta_compare' => '=',
        )
    );
    $users = array_unique($users);

    $user = get_user_by('email', $email_or_phone);
    $user_data = aireno_get_userdata($user_id);
    $is_self = false;
    if ($user) {
        if ($user_data->email == $email_or_phone) {
            $is_self = true;
            $response = array(
                'status' => 0,
                'msg' => 'You searched yourself!',
            );
        } else {
            $users = array_merge($users, array($user));
        }
    }

    if (!$is_self && count($users) > 0) {

        $users_data = array();
        foreach ($users as $u) {
            $users_data[] = aireno_get_userdata($u->ID);
        }
        $response = array(
            'status' => 3,
            'users' => $users_data,
        );

        foreach ($users as $u) {
            if (in_array($u->ID, $contacts)) {
                $response = array(
                    'status' => 1,
                    'msg' => 'This user is already in your contact list!',
                );
                break;
            } else if ($user_data->phone && $users_data[$u->ID]->phone && $user_data->phone == $users_data[$u->ID]->phone) {
                $response = array(
                    'status' => 0,
                    'msg' => 'You searched yourself!',
                );
                break;
            }
        }
    } else {
        if ($is_self)
            $response = array(
                'status' => 0,
                'msg' => 'You searched yourself!',
            );
        else $response = array(
            'status' => 2,
            'msg' => 'No member found! Will you create new account for this user?',
        );
    }

    echo json_encode($response);
    exit;
}