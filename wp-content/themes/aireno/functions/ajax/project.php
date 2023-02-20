<?php
//change project title
function aireno_change_project_name()
{
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project-name'];

    $args = array(
        'post_title' => $project_name,
        'ID' => $project_id
    );
    $result = wp_update_post($args);

    if (is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'Something went wrong!',
        );
    } else {
        $response = array(
            'status' => true,
            'msg' => $project_name,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_project_name', 'aireno_change_project_name');

//change project fee
function aireno_change_project_fee()
{
    $project_id = $_POST['project_id'];
    $project_fee = $_POST['project-fee'];

    update_field('fee', $project_fee, $project_id);
    $result = aireno_get_asp_product_for_project($project_id);

    $response = array(
        'status' => true,
        'msg' => $result,
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_project_fee', 'aireno_change_project_fee');

//change project address
function aireno_change_project_address()
{
    $project_id = $_POST['project_id'];
    $project_address = $_POST['project_address'];

    $result = update_field('project_address', $project_address, $project_id);
    $client = get_field('client', $project_id);
    update_field('_address', $project_address, 'user_' . $client);

    if (is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'Something went wrong!',
        );
    } else {
        $response = array(
            'status' => true,
            'msg' => $project_address,
            'project_id' => $project_id,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_project_address', 'aireno_change_project_address');

//change project date
function aireno_change_project_date()
{
    $project_id = $_POST['project_id'];
    $project_date = $_POST['date_start'];

    $result = update_field('date_start', $project_date, $project_id);

    if (is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'Something went wrong!',
        );
    } else {
        $response = array(
            'status' => true,
            'msg' => $project_date,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_project_date', 'aireno_change_project_date');

//accept project
function aireno_accept_project()
{
    $project_id = $_POST['project_id'];
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    update_field('status', 'live', $project_id);
    update_field('client_approve', true, $project_id);

    aireno_add_activity($project_id, 'accept_quote', $user_data->display_name.' accepted the quote.', date_i18n('Y-m-d H:i:s'), get_current_user_id());;

    $project_users = aireno_get_project_users($project_id, $user_id);
    $title = $description = $user_data->display_name . " accepted project " . get_post($project_id)->post_title;
    $link = get_permalink($project_id);
    $content = aireno_encode_content(array('description' => $description, 'link' => $link));
    aireno_add_notification($title, $content, $project_users);

    $response = array(
        'status' => true,
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_accept_project', 'aireno_accept_project');

//change project stage
function aireno_change_project_stage()
{
    $project_id = $_POST['project_id'];
    $stage = $_POST['stage'];

    $result = update_field('stage', $stage, $project_id);

    if (is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'Something went wrong!',
        );
    } else {
        $response = array(
            'status' => true,
            'msg' => $stage,
        );
        aireno_add_activity($project_id, 'update_startdate', 'Project Stage updated', date_i18n('Y-m-d H:i:s'), get_current_user_id());;
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_project_stage', 'aireno_change_project_stage');

//manage project status
function aireno_manage_project_status()
{
    $project_id = $_POST['project_id'];
    $status = $_POST['status'];

    $result = update_field('status', $status, $project_id);

    if (is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'Something went wrong!',
        );
    } else {
        $projectStatus = aireno_project_status($project_id);
        $response = array(
            'status' => true,
            'msg' => $projectStatus->label,
        );

        $new_status = AIRENO_PROJECT_STATUSES[$status];

        aireno_add_activity($project_id, 'change_status', 'Project Status Changed to ' . $new_status , date_i18n('Y-m-d H:i:s'), get_current_user_id());;

        $user_id = get_current_user_id();
        $user_data = aireno_get_userdata($user_id);

        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " changed status of Project "  . get_post($project_id)->post_title . ' to ' . $new_status;
        $link = get_permalink($project_id);
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);

        if ($status == 'pending') {
            $client_id = get_field('client', $project_id);
            $userdata = aireno_get_userdata($user_id);
            $client_userdata = aireno_get_userdata($client_id);
            $project_title = get_post($project_id)->post_title;

            $content = "Hello {$client_userdata->display_name} \n";
            $subject = "Your quote is ready for acceptance.";
            $email_title = "<h2>Your quote: {$project_title} is ready to review.</h2>";
            $content .= "<p>{$userdata->display_name} is ready to start your project.</p>";
            $content .= "<p>Please review the details and accept the quote to start.</p>";
            $content .= '<hr/><br/>';
            $content .= '<a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Review Quote</a>';

            aireno_send_email($subject, $email_title, $content, $client_id, null, array());
        }
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_manage_project_status', 'aireno_manage_project_status');

//close project
function aireno_close_project()
{
    $project_id = $_POST['project_id'];
    $cancel_reason = $_POST['cancel_reason'];
    $explained = $_POST['explained'];

    $projectStatus = aireno_project_status($project_id);

    if ($projectStatus->status != 'cancelled' && $projectStatus->status != 'completed') {
        update_field('cancel_reason', $cancel_reason, $project_id);
        update_field('explained', $explained, $project_id);

        $changeDate = date('d/m/Y H:i');
        $user_id = get_current_user_id();
        $changeUserData = aireno_get_userdata($user_id);
        $changeWho = $changeUserData->display_name;

        $clientId = get_field('client_id', $project_id);
        $client_data = aireno_get_userdata($clientId);

        // updating project status
        update_field('status', 'cancelled', $project_id);

        // make Activity row
        $activityText = $changeWho . ' declined quote because of ' . $cancel_reason . '.';
        aireno_add_activity($project_id, 'canceled_project', $activityText, date_i18n('Y-m-d H:i:s'), $user_id);


        $subject = 'Your project is now closed';
        $title = 'Thanks for using Aireno. Your project is now close';
        $text = '<p>Thanks for using Aireno.com.au. Your project is now closed or cancelled becuase of ' . $cancel_reason . ' reasons. </p> <br/><hr> 
        <a href="' . get_permalink($project_id) . '" style="background:#f96868; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto;">Open Project</a>';
        aireno_send_email($subject, $title, $text, $clientId);


        $response = array("message" => '', "status" => true);
    } else {
        $response = array("message" => 'This project is already closed or completed', "status" => false);
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_close_project', 'aireno_close_project');

//delete project
function aireno_delete_project()
{
    $project_id = $_POST['project_id'];

    //delete project scopes codes

    wp_delete_post($project_id, true);
    //    wp_trash_post($project_id);
    echo json_encode(array('status' => true, 'redirect' => aireno_get_page_link_by_name('quotes')));
    exit;
}

add_action('wp_ajax_aireno_delete_project', 'aireno_delete_project');

//send follow
function aireno_send_follow()
{
    $response = array(
        'status' => false,
        'message' => '',
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_send_follow', 'aireno_send_follow');

//contractor reminder
function aireno_contractor_reminder()
{
    $date = date('Y-m-d H:i:s');
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);
    $who = $user_data->first_name . " " . $user_data->last_name;

    if ($_POST && $_POST['project_id']) {
        $project_id = $_POST['project_id'];
        $project = get_post($project_id);
        $inv_title = $project->post_title;
        $inv_title = str_replace("\'", "'", $inv_title);

        $contractors = get_field('contractor', $project_id);
        if (!is_array($contractors)) $contractors = array();

        // foreach ($contractors as $contractor) {
        //     $contractor_data = aireno_get_userdata($contractor);

        //     // $activityText = $who . ' sent contractor update reminder.  ';
        //     // aireno_add_activity($project_id, 'add_user', $who . 'sent contractor update reminder.', $date, get_current_user_id());;

        //     // $args = array(
        //     //     'number_to' => '+61' . $contractor_data->phone,
        //     //     'number_from' => 'Aireno',
        //     //     'message' => 'ACTION REQUIRED: Hey ' . $contractor_data->first_name . ', this is a reminder to upload your progress update with a photo for "' . $inv_title . '"  ' . get_bloginfo('url') . '/?p=' . $project_id . '. Thanks, Aireno.',
        //     // );
        //     // twl_send_sms($args);
        // }
        $response = array(
            'status' => true,
            'message' => "$inv_title",
        );
    } else {
        $response = array(
            'status' => false,
            'message' => 'Invalid Data',
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_contractor_reminder', 'aireno_contractor_reminder');

//add members to project
function aireno_add_member_to_project()
{
    $user_id = get_current_user_id();
    $project_id = $_POST['project_id'];
    $project_members = $_POST['project_members'];

    foreach ($project_members as $project_member) {
        $target_user_role = $_POST['role_member' . $project_member];
        $project_member_data = aireno_get_userdata($project_member);

        $can_add = false;
        $added = false;
        if ($target_user_role == 'partner' && $project_member_data->user_type == 'Client') $can_add = true;
        if (!$can_add && $target_user_role == strtolower($project_member_data->user_type)) $can_add = true;

        if ($can_add && in_array($target_user_role, aireno_get_user_fields_by_role($user_id))) {
            $members = get_field($target_user_role, $project_id);
            if (!is_array($members)) $members = array($members);

            if (!in_array($project_member, $members)) {
                $members[] = $project_member;
                update_field($target_user_role, $members, $project_id);
                $added = true;
                aireno_add_activity($project_id, 'add_user', 'User added to project.', date_i18n('Y-m-d H:i:s'), get_current_user_id());;
            }
        }
    }
    $response = array(
        'status' => $added,
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_add_member_to_project', 'aireno_add_member_to_project');

function aireno_add_note_of_project()
{

    $response = array(
        'status' => false,
        'msg' => 'Adding note failed',
    );

    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $project_id = $_POST['project_id'];
    $note_content = aireno_convert_to_link($_POST['note']);
    $note_title = 'Note of ' . get_post($project_id)->post_title . ' by ' . $user_data->display_name;
    $viewer = $_POST['viewer'];

    $note_id = wp_insert_post(
        array(
            'post_title' => $note_title,
            'post_content' => $note_content,
            'post_author' => $user_id,
            'post_type' => AIRENO_CPT_NOTE,
            'post_status' => 'publish',
        )
    );

    if ($note_id && !is_wp_error($note_id)) {
        update_field('project_id', $project_id, $note_id);
        update_field('viewer', $viewer, $note_id);

        $response = array(
            'status' => true,
            'note_id' => $note_id,
            'content' => $note_content,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_add_note_of_project', 'aireno_add_note_of_project');

function aireno_remove_note_of_project()
{

    $response = array(
        'status' => false,
        'msg' => 'Deleting the note failed',
    );

    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);
    $project_id = $_POST['project_id'];

    $note_id = $_POST['note_id'];

    $result = wp_delete_post($note_id, true);

    if ($result) {
        $response = array(
            'status' => true,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_remove_note_of_project', 'aireno_remove_note_of_project');

function aireno_edit_note_of_project()
{

    $response = array(
        'status' => false,
        'msg' => 'Updating note failed',
    );

    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);
    $project_id = $_POST['project_id'];

    $note_id = $_POST['note_id'];
    $note_content = aireno_convert_to_link($_POST['note_content']);
    $viewer = $_POST['viewer'];

    if (get_post($note_id)->post_type == AIRENO_CPT_NOTE) {
        if (get_post($note_id)->post_status == 'publish') {
            $result = wp_update_post(array(
                'post_content' => $note_content,
                'ID' => $note_id,
            ));

            if ($result && !is_wp_error($result)) {
                update_field('viewer', $viewer, $note_id);
                $response = array(
                    'status' => true,
                    'content' => $note_content,
                    'note_id' => $note_id,
                );
            }
        } else {
            $response['msg'] = 'This note does not exist.';
        }
    } else {
        $response['msg'] = 'This note does not exist.';
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_edit_note_of_project', 'aireno_edit_note_of_project');

function aireno_manage_task()
{
    $response = array(
        'status' => true,
    );

    $task_id = $_POST['task_id'];
    $task_title = aireno_convert_to_link($_POST['task_title']);
    $task_type = $_POST['task_type'];
    $task_users = explode(',', $_POST['task_users']);
    $task_datetime = $_POST['task_datetime'];

    $project_id = $_POST['project_id'];

    $args = array(
        'post_title' => $task_title,
    );

    if ($task_id) {
        $args['ID'] = $task_id;
        wp_update_post($args);

        $user_id = get_current_user_id();
        $user_data = aireno_get_userdata($user_id);
        $title = $description = $user_data->display_name . " assigned a task on " . get_post($project_id)->post_title;
        $link = get_permalink($project_id);
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $task_users);
    } else {
        $args['post_type'] = AIRENO_CPT_TASK;
        $args['post_status'] = 'publish';
        $args['post_author'] = get_current_user_id();

        $task_id = wp_insert_post($args);

        update_field('project_id', $project_id, $task_id);
    }

    update_field('task_type', $task_type, $task_id);
    update_field('task_datetime', $task_datetime, $task_id);
    update_field('task_users', $task_users, $task_id);

    $data = array();
    foreach ($task_users as $task_user) {
        $task_userdata = aireno_get_userdata($task_user);
        $usernames[] = $task_userdata->display_name;
        $data[] = array(
            'id' => $task_user,
            'name' => $task_userdata->display_name,
        );
    }

    $response['usernames'] = implode(', ', $usernames);
    $response['data'] = json_encode($data);
    $response['task_id'] = $task_id;
    $response['task_type'] = $task_type;
    $response['task_datetime'] = $task_datetime;
    $response['task_title'] = $task_title;

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_manage_task', 'aireno_manage_task');

function aireno_delete_task_from_project()
{
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $user_id = get_current_user_id();

    $can_delete_task = aireno_can_update_task($project_id, $task_id, $user_id);
    if (!$can_delete_task['status']) {
        $response = array(
            'status' => false,
            'msg' => $can_delete_task['msg'],
        );
        echo json_encode($response);
        exit;
    }

    $result = wp_delete_post($task_id);

    if ($result && is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'An error occurred during deleting the task',
        );
        echo json_encode($response);
        exit;
    }
    $response = array(
        'status' => true,
        'msg' => 'Successfully deleted',
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_delete_task_from_project', 'aireno_delete_task_from_project');

function aireno_mark_task_completed()
{
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $user_id = get_current_user_id();

    $can_complete_task = aireno_can_update_task($project_id, $task_id, $user_id);
    if (!$can_complete_task['status']) {
        $response = array(
            'status' => false,
            'msg' => $can_complete_task['msg'],
        );
        echo json_encode($response);
        exit;
    }

    $result = update_field('completed', true, $task_id);

    if ($result && is_wp_error($result)) {
        $response = array(
            'status' => false,
            'msg' => 'An error occurred during this action',
        );
        echo json_encode($response);
        exit;
    }
    $response = array(
        'status' => true,
        'msg' => 'Successfully marked as completed',
    );

    $user_data = aireno_get_userdata($user_id);
    $project_users = aireno_get_project_users($project_id, $user_id);
    $title = $description = $user_data->display_name . " completed task on " . get_post($project_id)->post_title;
    $link = get_permalink($project_id);
    $content = aireno_encode_content(array('description' => $description, 'link' => $link));
    aireno_add_notification($title, $content, $project_users);

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_mark_task_completed', 'aireno_mark_task_completed');

function aireno_send_message()
{
    $response = array(
        'status' => false,
        'msg' => 'Sending message failed',
    );

    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $project_id = $_POST['project_id'];

    $message_content = $_POST['message'];
    $message_content = aireno_convert_to_link($message_content);

    $message_title = 'Message from  ' . $user_data->display_name . ' on ' . get_post($project_id)->post_title;

    $message_id = aireno_send_message_on_project($message_title, $message_content, $user_id, $project_id);
    $attachments = array();
    $attached_filenames = array();

    if (isset($_FILES['files'])) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $upload_overrides = array('test_form' => false);
        $filetypes = array();
        $allowed_img_file_types = array(
            'image/png',
            'image/jpeg',
            'image/jpg',
            'image/bmp',
            'image/jpe',
            'image/gif',
            'image/ico',
            'image/svg',
            'image/svgz',
            'image/tif',
            'image/tiff',
            'image/ai',
            'image/drw',
            'image/pct',
            'image/psp',
            'image/xcf',
            'image/psd',
            'image/raw',
            'image/webp',
        );
        $allowed_other_file_types = array(
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'application/vnd.ms-excel',
            'text/plain',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        );

        $allowed_file_types = array_merge($allowed_img_file_types, $allowed_other_file_types);

        $email_attachments = array();

        if (count($_FILES['files']['name']) > 0) {

            $files = $_FILES['files'];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $uploadedfile = array(
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    );
                    $filename_to_show = $uploadedfile['name'];
                    if (in_array($uploadedfile['type'], $allowed_file_types)) {
                        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                        if ($movefile && !isset($movefile['error'])) {
                            $filename = $movefile['file'];
                            $filetype = wp_check_filetype(basename($filename), null);
                            $wp_upload_dir = wp_upload_dir();
                            $attachment_name = preg_replace('/\.[^.]+$/', '', basename($filename));
                            $attached_filenames[] = basename($filename);
                            $attachment = array(
                                'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                                'post_mime_type' => $filetype['type'],
                                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attach_id = wp_insert_attachment($attachment, $filename, $message_id);
                            update_post_meta($attach_id, 'message_id', $message_id);

                            update_post_meta($attach_id, 'project_id', $project_id);
                            update_post_meta($attach_id, 'type', 'project');

                            aireno_add_activity($project_id, 'upload_file', "File uploaded.", date_i18n('Y-m-d H:i:s'), get_current_user_id());;

                            require_once(ABSPATH . 'wp-admin/includes/image.php');

                            $attach_data = get_post_mime_type($attach_id);

                            if (in_array($filetype, $allowed_img_file_types)) {
                                $attach_img_data = wp_generate_attachment_metadata($attach_id, $filename);
                                wp_update_attachment_metadata($attach_id, $attach_img_data);
                            }

                            $uploaded_url = wp_get_attachment_image_src($attach_id, 'thumbnail');
                            $attachments[] = array(
                                'url' => $uploaded_url[0],
                                'preview' => in_array($attach_data, PREVIEW_ALLOWED_IMG_FILE_TYPES),
                                'title' => basename(get_attached_file($attach_id)),
                            );
                            $email_attachments[] = $uploaded_url[0];
                        }
                    }
                }
            }
        }
    }


    if ($message_id && !is_wp_error($message_id)) {

        $response = array(
            'status' => true,
            'message' => $message_content,
            'attachments' => $attachments,
        );

        $subject = "You have an unread message on Aireno";
        $title = "New Message from " . $user_data->display_name . " on " . get_post($project_id)->post_title;
        $project_users = aireno_get_project_users($project_id, $user_id);
        $message_content .= '<hr><br/>';
        $message_content .= '<div style="text-align: center"><a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius:4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto;">Open Project</a></div>';
        foreach ($project_users as $project_user) {
            aireno_send_email($subject, $title, $message_content, $project_user, null, $email_attachments);
        }
    }

    if (count($attachments) > 0) {
        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " uploaded file(s) on " . get_post($project_id)->post_title;
        $link = get_permalink($project_id)."?tab=project-files";
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_send_message', 'aireno_send_message');

function aireno_attach_files_schedule()
{
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $project_id = $_POST['project_id'];
    $schedule_id = $_POST['schedule_id'];
    $schedule_title = get_post($schedule_id)->post_title;
    $type = $_POST['type'];

    $attachments = array();
    $attached_filenames = array();

    if (isset($_FILES)) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $upload_overrides = array('test_form' => false);
        $filetypes = array();

        $allowed_file_types = array_unique(array_merge(array_values(ALLOWED_IMG_FILE_TYPES), array_values(ALLOWED_OTHER_FILE_TYPES)));

        if (count($_FILES['files']['name']) > 0) {

            $files = $_FILES['files'];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $uploadedfile = array(
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    );
                    $filename_to_show = $uploadedfile['name'];
                    if (in_array($uploadedfile['type'], $allowed_file_types)) {
                        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                        if ($movefile && !isset($movefile['error'])) {
                            $filename = $movefile['file'];
                            $filetype = wp_check_filetype(basename($filename), null);
                            $filetypes[] = $filetype;
                            $wp_upload_dir = wp_upload_dir();
                            $attachment_name = preg_replace('/\.[^.]+$/', '', basename($filename));
                            $attached_filenames[] = basename($filename);
                            $attachment_arg = array(
                                'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                                'post_mime_type' => $filetype['type'],
                                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attach_id = wp_insert_attachment($attachment_arg, $filename, $schedule_id);
                            update_post_meta($attach_id, 'schedule_id', $schedule_id);
                            update_post_meta($attach_id, 'project_id', $project_id);
                            update_post_meta($attach_id, 'type', $type);

//                            aireno_add_activity($project_id, 'upload_file', " uploaded to Schedule \"{$schedule_title}\".", date_i18n('Y-m-d H:i:s'), get_current_user_id());;

                            require_once(ABSPATH . 'wp-admin/includes/image.php');

                            $attach_data = get_post_mime_type($attach_id);

                            if (in_array($filetype, ALLOWED_IMG_FILE_TYPES)) {
                                $attach_img_data = wp_generate_attachment_metadata($attach_id, $filename);
                                wp_update_attachment_metadata($attach_id, $attach_img_data);
                            }

                            $uploaded_url = wp_get_attachment_image_src($attach_id, 'thumbnail');
                            $preview = in_array($uploadedfile['type'], PREVIEW_ALLOWED_IMG_FILE_TYPES) ? true : false;
                            $attachments[$attach_id] = array(
                                'src' => $uploaded_url[0],
                                'preview' => $preview,
                            );
                        }
                    }
                }
            }
        }
    }

    if (count($attachments) > 0) {
        $status = true;
        //        $schedule_attachments = get_field('attachments', $schedule_id);
        //
        //        $datetime = date_i18n('d/m/Y g:i a');
        //        $images = array();
        //        foreach ($attachments as $attached_id => $attached_detail) {
        //            $images[] = array('image' => $attached_id);
        //        }
        //        $schedule_attachment = array(
        //            'attachment' => array(
        //                'images' => $images,
        //                'author' => $user_id,
        //                'datetime' => $datetime,
        //                'type' => $type,
        //            ),
        //        );
        //        $schedule_attachments[] = $schedule_attachment;
        //        update_field('attachments', $schedule_attachments, $schedule_id);

        $message_title = $user_data->display_name . ' uploaded attachment(s) ' . ' on schedule - ' . get_post($schedule_id)->post_title;
        $message_content = $user_data->display_name . " uploaded " . implode(', ', $attached_filenames) . " on schedule - {$schedule_title}";

        aireno_send_message_on_project($message_title, $message_content, $user_id, $project_id);

        aireno_add_activity($project_id, 'upload_file', $message_content, date_i18n('Y-m-d H:i:s'), $user_id);

        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " uploaded file(s) on " . get_post($project_id)->post_title;
        $link = get_permalink($project_id)."?tab=project-files";
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);

    } else $status = false;

    $response = array(
        'status' => $status,
        'attachments' => $attachments,
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_attach_files_schedule', 'aireno_attach_files_schedule');

function aireno_send_comment_schedule()
{
    $response = array(
        'status' => false,
        'msg' => 'Commenting failed',
    );

    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);
    $author = get_the_author_meta('display_name', $user_id);
    $avatar = get_field('_avatar', 'user_' . $user_id);
    if ($avatar) {
        $avatar_url = $avatar['sizes']['thumbnail'];
    } else {
        $avatar_url = get_avatar_url($user_id);
    }

    $project_id = $_POST['project_id'];
    $schedule_id = $_POST['schedule_id'];
    $content = $_POST['comment'];
    $content = aireno_convert_to_link($content);
    $datetime = date_i18n('d/m/Y g:i a');

    $comment = array(
        'content' => $content,
        'author' => $user_id,
        'datetime' => $datetime,
    );

    $comments = get_field('comments', $schedule_id);
    $comments[] = array(
        'comment' => $comment,
    );
    $result = update_field('comments', $comments, $schedule_id);
    if ($result) {
        $response = array(
            'status' => true,
            'author' => $author,
            'avatar' => $avatar_url,
            'comment' => $content,
            'datetime' => $datetime,
        );

        $schedule_title = get_post($schedule_id)->post_title;

        aireno_add_activity($project_id, 'edit_quote', $user_data->display_name . " commented on \"{$schedule_title}\".", date_i18n('Y-m-d H:i:s'), $user_id);;
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_send_comment_schedule', 'aireno_send_comment_schedule');

function aireno_schedule_change_status()
{
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);
    $project_id = $_POST['project_id'];
    $schedule_id = $_POST['schedule_id'];
    $status = intval($_POST['status']);
    $origin_status = intval(get_field('status', $schedule_id));
    $response = array(
        'status' => false,
        'msg' => 'Failed',
    );

    $statuses = array(0, 1, 2);
    if ($status != $origin_status && in_array($status, $statuses)) {
        update_field('status', $status, $schedule_id);

        $from_status = AIRENO_SCHEDULE_STATUSES[$origin_status];
        $to_status = AIRENO_SCHEDULE_STATUSES[$status];

        $response = array(
            'status' => true,
            'schedule_status' => $status,
            'schedule_id' => $schedule_id,
            'origin_status' => $origin_status,
        );

        $schedule_title = get_post($schedule_id)->post_title;
        $project_title = get_post($project_id)->post_title;

        aireno_add_activity($project_id, 'edit_quote', $user_data->display_name . " changed status for \"{$schedule_title}\" from \"{$from_status}\" to \"{$to_status}\".", date_i18n('Y-m-d H:i:s'), $user_id);;

        $link = add_query_arg(
            array(
                'tab' => 'project-schedules',
            ),
            get_permalink($project_id),
        );
        $project_users = aireno_get_project_users($project_id, $user_id);

        foreach ($project_users as $project_user) {
            $client_userdata = aireno_get_userdata($project_user);
            $content = "Hello {$client_userdata->display_name} \n";
            $subject = "Status of Schedule \"{$schedule_title}\" on Project \"{$project_title}\" was updated.";
            $email_title = "<h2>Status of Schedule \"{$schedule_title}\" on Project \"{$project_title}\" was updated.</h2>";
            $content .= "<p>".$user_data->display_name . " changed status of Schedule \"{$schedule_title}\" from \"{$from_status}\" to \"{$to_status}\" on Project \"{$project_title}\".</p>";
            $content .= "<p>Please review the details.</p>";
            $content .= '<hr/><br/>';
            $content .= '<div style="text-align: center"><a href="' . $link . '" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a></div>';

            aireno_send_email($subject, $email_title, $content, $project_user, null, array());
        }

        $title = $description = $user_data->display_name . " changed status of \"{$schedule_title}\" from \"{$from_status}\" to \"{$to_status}\" on Project \"{$project_title}\"";
        $link = get_permalink($project_id)."?tab=project-schedules";
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);

    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_schedule_change_status', 'aireno_schedule_change_status');

function aireno_delete_schedule()
{
    $project_id = $_POST['project_id'];
    $schedule_id = $_POST['schedule_id'];
    $user_id = get_current_user_id();

    $response = array('status' => false);

    $result = wp_delete_post($schedule_id, true);
    if ($result) {
        $response = array(
            'status' => true,
            'id' => $schedule_id,
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_delete_schedule', 'aireno_delete_schedule');

function aireno_add_schedule()
{
    $response = array('status' => false);
    $project_id = $_POST['project_id'];
    $schedule_id = $_POST['schedule_id'];
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $title = $_POST['schedule_title'];
    $status = $_POST['schedule_status'];
    $duration = $_POST['schedule_duration'];
    $details = trim($_POST['schedule_details']);
    $tasks = array();

    $is_new = false;

    if (count($_POST['schedule_tasks']) > 0) {
        $i = 0;
        foreach ($_POST['schedule_tasks'] as $schedule_task) {
            if ($schedule_task != '')
                $tasks[] = array(
                    'done' => ($_POST['schedule_tasks_completed' . $i] == 'on') ? true : false,
                    'title' => $schedule_task
                );
            $i++;
        }
    }

    if (!$schedule_id) {
        $args = array(
            'post_type' => AIRENO_CPT_SCHEDULE,
            'post_status' => 'publish',
            'post_title' => $title,
            'post_content' => $details,
        );
        $schedule_id = wp_insert_post($args);
        $is_new = true;
    }

    if (!is_wp_error($schedule_id)) {
        $args = array(
            'post_type' => AIRENO_CPT_SCHEDULE,
            'post_title' => $title,
            'post_content' => $details,
            'ID' => $schedule_id,
        );
        $schedule_id = wp_update_post($args);

        $origin_status = get_field('status', $schedule_id);

        update_field('status', $status, $schedule_id);
        update_field('duration', $duration, $schedule_id);
        update_field('project_id', $project_id, $schedule_id);
        update_field('tasks', $tasks, $schedule_id);

        if ($status == 'completed') {
            $project_users = aireno_get_project_users($project_id, $user_id);
            $title = $description = $user_data->display_name . " completed a schedule on " . get_post($project_id)->post_title;
            $link = get_permalink($project_id)."?tab=project-schedules";
            $content = aireno_encode_content(array('description' => $description, 'link' => $link));
            aireno_add_notification($title, $content, $project_users);
        }

        $response = array(
            'status' => true,
            'id' => $schedule_id,
            'title' => $title,
            'detail' => $details,
            'schedule_status' => $status,
            'origin_status' => $origin_status,
            'duration' => $duration,
            'tasks' => $tasks,
            'is_new' => $is_new,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_add_schedule', 'aireno_add_schedule');

function aireno_schedule_task_completed()
{
    $project_id = $_POST['project_id'];
    $schedule_id = $_POST['schedule_id'];
    $schedule_title = get_post($schedule_id)->post_title;
    $task_index = $_POST['task_index'];
    $tasks = get_field('tasks', $schedule_id);
    $i = 0;
    $new_tasks = array();
    $done_task_title = '';
    foreach ($tasks as $task) {
        if ($i == $task_index) {
            $new_tasks[] = array('done' => true, 'title' => $task['title']);
            $done_task_title = $task['title'];
        } else $new_tasks[] = $task;
        $i++;
    }
    update_field('tasks', $new_tasks, $schedule_id);
    aireno_add_activity($project_id, 'mark_done', "Task \"{$done_task_title}\" of Schedule \"{$schedule_title}\" is marked as DONE.", date_i18n('Y-m-d H:i:s'), get_current_user_id());;

    echo json_encode(array('status' => true));
    exit;
}

add_action('wp_ajax_aireno_schedule_task_completed', 'aireno_schedule_task_completed');

function aireno_load_schedules_from_template()
{
    $response = array(
        'status' => true,
    );

    $st_ID = intval($_POST['st_ID']);
    $project_id = intval($_POST['project_id']);

    if (get_post($project_id)->post_type != AIRENO_CPT_PROJECT || get_post($st_ID)->post_type != AIRENO_CPT_SCHEDULE_TEMPLATE) {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Project or Schedule Template!',
        );
    } else {
        $args = array(
            'post_type' => AIRENO_CPT_SCHEDULE,
            'post_status' => array('publish'),
            'posts_per_page' => -1,
            'meta_query' => array(
                'key' => 'project_id',
                'value' => $project_id,
                'compare' => '=',
                'type' => 'numeric',
            ),
        );
        $schedule_query = new WP_Query($args);
        if ($schedule_query->have_posts()) {
            while ($schedule_query->have_posts()) {
                $schedule_query->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }

        $st_templates = get_field('schedule_template', $st_ID);

        wp_reset_query();

        foreach ($st_templates as $st_template) {
            $c_args = array(
                'post_type' => AIRENO_CPT_SCHEDULE,
                'post_status' => 'publish',
                'post_title' => $st_template['title'],
                'post_content' => aireno_convert_to_link($st_template['description']),
            );
            $is_ID = wp_insert_post($c_args);

            if ($is_ID && !is_wp_error($is_ID)) {
                update_field('duration', $st_template['duration'], $is_ID);
                update_field('status', $st_template['status'], $is_ID);
                update_field('tasks', $st_template['tasks'], $is_ID);
                update_field('project_id', $project_id, $is_ID);
            }
        }
        $response['msg'] = $st_templates;
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_load_schedules_from_template', 'aireno_load_schedules_from_template');

//add payment
function aireno_add_payment()
{
    $project_id = $_POST['project_id'];
    $payment_id = $_POST['payment_id'];
    $user_id = get_current_user_id();

    $title = $_POST['payment_title'];
    $amount = $_POST['payment_amount'];
    $payment_user = $_POST['payment_user'];
    $description = $_POST['payment_description'];

    if (is_business($user_id) || is_head($user_id) || current_user_can('manage_options')) {
        if (!$payment_id) {
            $args = array(
                'post_type' => AIRENO_CPT_PAYMENT,
                'post_status' => 'publish',
                'post_title' => $title,
                'post_content' => $description,
            );
            $payment_id = wp_insert_post($args);
            update_field('project_id', $project_id, $payment_id);
            update_field('status', 'Pending', $payment_id);
            if (is_business($user_id)) {
                update_field('sender', $user_id, $payment_id);
            } else {
                $businesses = get_field('business', $project_id);
                if (is_array($businesses)) {
                    update_field('sender', $businesses[0], $payment_id);
                }
            }
        }
        if (!is_wp_error($payment_id)) {
            if ($title && $description) {
                $args = array(
                    'post_type' => AIRENO_CPT_PAYMENT,
                    'post_title' => $title,
                    'post_content' => $description,
                    'ID' => $payment_id,
                );
                $payment_id = wp_update_post($args);
            }

            update_field('amount', $amount, $payment_id);
            update_field('payment_user', $payment_user, $payment_id);

            $response = array(
                'status' => true,
                'message' => 'Success',
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Something went wrong.',
            );
        }
    } else {
        $response = array(
            'status' => false,
            'message' => 'You don\'t have permission to do this action.',
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_add_payment', 'aireno_add_payment');

//load payments from template
function aireno_load_payments_from_template()
{
    $response = array(
        'status' => true,
    );

    $pt_ID = intval($_POST['pt_ID']);
    $project_id = intval($_POST['project_id']);
    $project_budget = aireno_get_project_total($project_id);

    if (get_post($project_id)->post_type != AIRENO_CPT_PROJECT || get_post($pt_ID)->post_type != AIRENO_CPT_PAYMENT_TEMPLATE) {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Project or Payment Template!',
        );
    } else {
        $args = array(
            'post_type' => AIRENO_CPT_PAYMENT,
            'post_status' => array('publish'),
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => $project_id,
            'meta_compare' => '='
        );
        $origin_payments_query = new WP_Query($args);
        if ($origin_payments_query->have_posts()) {
            while ($origin_payments_query->have_posts()) {
                $origin_payments_query->the_post();
                wp_delete_post(get_the_ID(), true);
            }
        }
        wp_reset_query();

        $pt_templates = get_field('payment_template', $pt_ID);

        foreach ($pt_templates as $pt_template) {
            $c_args = array(
                'post_type' => AIRENO_CPT_PAYMENT,
                'post_status' => 'publish',
                'post_title' => $pt_template['title'],
                'post_content' => aireno_convert_to_link($pt_template['description']),
            );
            $ip_ID = wp_insert_post($c_args);

            if ($ip_ID && !is_wp_error($ip_ID)) {
                update_field('amount', number_format(($project_budget * floatval($pt_template['amount']) / 100), 2), $ip_ID);
                update_field('status', $pt_template['status'], $ip_ID);
                update_field('project_id', $project_id, $ip_ID);
                $client = get_field('client', $project_id);
                update_field('payment_user', $client, $ip_ID);
                $user_id = get_current_user_id();
                if (is_business($user_id)) {
                    update_field('sender', $user_id, $ip_ID);
                } else {
                    $businesses = get_field('business', $project_id);
                    if (is_array($businesses)) {
                        update_field('sender', $businesses[0], $ip_ID);
                    }
                }
            }
        }
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_load_payments_from_template', 'aireno_load_payments_from_template');

//claim payment
function aireno_claim_payment_of_project()
{
    $project_id = $_POST['project_id'];
    $payment_id = $_POST['payment_id'];
    $user_id = get_current_user_id();

    $payment_project_id = get_field('project_id', $payment_id);

    if ($project_id != $payment_project_id) {
        $response = array(
            'status' => false,
            'message' => 'Wrong Payment of project.',
        );
    } else {
        $businesses = get_field('business', $project_id);
        if (!is_array($businesses))
            $businesses = array();
        if (is_business($user_id) || is_head($user_id) || current_user_can('manage_options')) {
            if (get_post_type($payment_id) != AIRENO_CPT_PAYMENT || get_post_type($project_id) != AIRENO_CPT_PROJECT) {
                $response = array(
                    'status' => false,
                    'message' => 'Wrong Payment or Project',
                );
            } else {
                $payment_status = get_field('status', $payment_id);
                if ($payment_status != 'Pending') {
                    $response = array(
                        'status' => false,
                        'message' => 'This payment can not be claimed.',
                    );
                } else {
                    update_field('status', 'Ready', $payment_id);

                    $payment_user = get_field('payment_user', $payment_id);
                    $userdata = aireno_get_userdata($user_id);
                    $payment = get_post($payment_id);

                    $title = $payment->post_title;
                    $description = $payment->post_content;
                    $amount = get_field('amount', $payment_id);

                    $payment_userdata = aireno_get_userdata($payment_user);
                    $content = "Hello {$payment_userdata->display_name} \n";
                    $subject = "You received a payment request";
                    $email_title = "<h2>{$userdata->display_name} assigned a payment to you.</h2>";
                    $content .= "<p>{$userdata->display_name} assigned a payment to you.</p>";
                    $content .= "<p>Here are the details.</p>";
                    $content .= "<p>Title : {$title}</p>";
                    $content .= "<p>Description : {$description}</p>";
                    $content .= "<p>Amount : $" . $amount . "</p>";
                    $content .= "<p>Please review and proceed.</p>";
                    $content .= '<hr/><br/>';
                    $content .= '<div style="text-align: center"><a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a></div>';

                    aireno_send_email($subject, $email_title, $content, $payment_user, null, array());
                    if (is_business($user_id) && in_array($user_id, $businesses)) {
                        update_field('sender', $user_id, $payment_id);
                    }

                    $project_users = aireno_get_project_users($project_id, $user_id);
                    $title = $description = $userdata->display_name . " sent " . $payment_userdata->display_name ." an invoice on project " . get_post($project_id)->post_title;
                    $link = add_query_arg(
                        array(
                            'tab' => 'project-payments',
                        ),
                        get_permalink($project_id)
                    );
                    $content = aireno_encode_content(array('description' => $description, 'link' => $link));
                    aireno_add_notification($title, $content, $project_users);

                    $response = array(
                        'status' => true,
                        'message' => 'Success',
                    );
                }
            }
        } else {
            $response = array(
                'status' => false,
                'message' => 'You don\'t have permission to do this action.',
            );
        }
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_claim_payment_of_project', 'aireno_claim_payment_of_project');

//cancel payment
function aireno_cancel_payment_of_project()
{
    $project_id = $_POST['project_id'];
    $payment_id = $_POST['payment_id'];
    $user_id = get_current_user_id();

    $payment_project_id = get_field('project_id', $payment_id);

    if ($project_id != $payment_project_id) {
        $response = array(
            'status' => false,
            'message' => 'Wrong Payment of project.',
        );
    } else {
        if (is_business($user_id) || is_head($user_id) || current_user_can('manage_options')) {
            if (get_post_type($payment_id) != AIRENO_CPT_PAYMENT || get_post_type($project_id) != AIRENO_CPT_PROJECT) {
                $response = array(
                    'status' => false,
                    'message' => 'Wrong Payment or Project',
                );
            } else {
                $payment_status = get_field('status', $payment_id);
                if ($payment_status == 'Cancelled') {
                    $response = array(
                        'status' => false,
                        'message' => 'This payment is already cancelled.',
                    );
                } else {
                    update_field('status', 'Cancelled', $payment_id);

                    $payment_user = get_field('payment_user', $payment_id);
                    $userdata = aireno_get_userdata($user_id);
                    $payment = get_post($payment_id);

                    $title = $payment->post_title;
                    $description = $payment->post_content;
                    $amount = get_field('amount', $payment_id);

                    $payment_userdata = aireno_get_userdata($payment_user);
                    $content = "Hello {$payment_userdata->display_name} \n";
                    $subject = "{$userdata->display_name} cancelled a payment assigned you";
                    $email_title = "<h2>{$userdata->display_name} cancelled a payment assigned you.</h2>";
                    $content .= "<p>{$userdata->display_name} cancelled a payment assigned you.</p>";
                    $content .= "<p>Here are the details.</p>";
                    $content .= "<p>Title : {$title}</p>";
                    $content .= "<p>Description : {$description}</p>";
                    $content .= "<p>Amount : $" . $amount . "</p>";
                    $content .= '<hr/><br/>';
                    $content .= '<div style="text-align: center"><a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a></div>';
                    aireno_send_email($subject, $email_title, $content, $payment_user, null, array());

                    $response = array(
                        'status' => true,
                        'message' => 'Success',
                    );

                    wp_delete_post($payment_id, true);
                }
            }
        } else {
            $response = array(
                'status' => false,
                'message' => 'You don\'t have permission to do this action.',
            );
        }
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_cancel_payment_of_project', 'aireno_cancel_payment_of_project');


//delete a project file
function aireno_delete_project_file()
{
    $response = array(
        'status' => true,
        'msg' => 'Success!',
    );

    $fileID = intval($_POST['fileID']);
    $project_id = intval($_POST['project_id']);

    if (get_post($project_id)->post_type != AIRENO_CPT_PROJECT) {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Project!',
        );
    } else {
        $schedule_id = get_post_meta($fileID, 'schedule_id', true);
        if ($schedule_id) {
        }
        wp_delete_attachment($fileID, true);
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_delete_project_file', 'aireno_delete_project_file');

function aireno_delete_quote()
{
    $response = array(
        'status' => true,
        'msg' => 'Wrong Project!',
    );
    $project_id = intval($_POST['project_id']);
    $project_title = get_post($project_id)->post_title;
    $scope_id = intval($_POST['scope_id']);
    $scope_title = get_post($scope_id)->post_title;
    wp_delete_post($scope_id, true);

    $scopes = get_field('project_scopes', $project_id);
    unset($scopes[array_search($scope_id, $scopes)]);
    update_field('project_scopes', $scopes, $project_id);

    aireno_recalculate_project_price($project_id);

    $user_id = get_current_user_id();
    $userdata = aireno_get_userdata($user_id);

    aireno_add_activity($project_id, 'delete_quote', "{$userdata->display_name} deleted a quote \"{$scope_title}\" of project \"{$project_title}\".", date_i18n('Y-m-d H:i:s'), get_current_user_id());;

    $project_users = aireno_get_project_users($project_id, $user_id);
    $title = $description = $userdata->display_name . " deleted a Quote on " . get_post($project_id)->post_title;
    $link = get_permalink($project_id);
    $content = aireno_encode_content(array('description' => $description, 'link' => $link));
    aireno_add_notification($title, $content, $project_users);

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_delete_quote', 'aireno_delete_quote');


function save_contract_on_project()
{

    $project_id = intval($_POST['project_id']);
    $contract = aireno_convert_to_link($_POST['contract']);

    update_field('contract', $contract, $project_id);
    $response = array(
        'status' => true,
        'msg' => 'Success!',
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_save_contract_on_project', 'save_contract_on_project');

function aireno_change_client_on_project()
{

    $project_id = intval($_POST['project_id']);
    $client_id = intval($_POST['client']);
    $userdata = aireno_get_userdata($client_id);

    update_field('client', $client_id, $project_id);
    aireno_add_activity($project_id, 'add_user', "{$userdata->display_name} was added as client on this project", date_i18n('Y-m-d H:i:s'), get_current_user_id());;

    $response = array(
        'status' => true,
        'msg' => 'Success!',
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_client_on_project', 'aireno_change_client_on_project');

function aireno_remove_user_on_project()
{
    $project_id = intval($_POST['project_id']);
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $user_type = $_POST['user_type'];

    $member_id = $_POST['user_id'];
    $member_data = aireno_get_userdata($member_id);

    aireno_add_activity($project_id, 'add_user', "{$member_data->display_name} was removed from this project", date_i18n('Y-m-d H:i:s'), get_current_user_id());

    $field = strtolower($user_type);
    $users = get_field($field, $project_id);
    unset($users[array_search($member_data, $users)]);
    update_field($field, $users, $project_id);

    $project_users = aireno_get_project_users($project_id, $user_id);
    $title = $description = $user_data->display_name . " removed " . $member_data->display_name . " from " . get_post($project_id)->post_title;
    $link = get_permalink($project_id)."?tab=project-users";
    $content = aireno_encode_content(array('description' => $description, 'link' => $link));
    aireno_add_notification($title, $content, $project_users);

    $response = array(
        'status' => true,
        'msg' => 'Success!',
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_remove_user_on_project', 'aireno_remove_user_on_project');


function aireno_load_contacts()
{
    $user_id = get_current_user_id();
    $contacts = aireno_get_contacts($user_id);
    $project_id = $_POST['project_id'];
    $project_users = aireno_get_project_users($project_id);

    if (count($contacts) > 0) {
        $results = array();
        foreach ($contacts as $contact) {
            $user_data = aireno_get_userdata($contact);
            if (in_array($contact, $project_users)) {
                $user_data->in_project = 1;
                $user_data->role = aireno_get_user_role_in_project($contact, $project_id);
            } else {
                $user_data->in_project = 0;
                $user_data->role = $user_data->user_type;
            }
            $results[] = $user_data;
        }
        $response = array(
            'status' => true,
            'message' => $results,
        );
    } else {
        $response = array(
            'status' => false,
            'message' => 'No members found',
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_load_contacts', 'aireno_load_contacts');

function aireno_close_project_no_contact()
{
    $project_id = $_POST['project_id'];

    $projectStatus = aireno_project_status($project_id);

    if ($projectStatus->status != 'cancelled' && $projectStatus->status != 'completed') {
        update_field('cancel_reason', 'No Contact', $project_id);
        update_field('status', 'cancelled', $project_id);

        $changeDate = date('d/m/Y H:i');
        $user_id = get_current_user_id();
        $changeUserData = aireno_get_userdata($user_id);
        $changeWho = $changeUserData->display_name;

        $clientId = get_field('client', $project_id);
        $client_data = aireno_get_userdata($clientId);

        // updating project status
        update_field('status', 'cancelled', $project_id);

        // make Activity row
        $activityText = $changeWho . ' declined quote because of No Contact.';
        aireno_add_activity($project_id, 'canceled_project', $activityText, date_i18n('Y-m-d H:i:s'), $user_id);


        $subject = 'Your Aireno project is now closed';
        $title = 'Thanks for using airneo. Your project is now close';
        $text = '<p>Thanks for using Aireno.com.au. Your project is now closed or cancelled becuase of No Contact. </p> <br/><hr> 
        <a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius: 4px;  color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a>';
        aireno_send_email($subject, $title, $text, $clientId);

        $response = array("message" => '', "status" => true);
    } else {
        $response = array("message" => 'This project is already closed or completed', "status" => false);
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_close_project_no_contact', 'aireno_close_project_no_contact');

function aireno_upload_files_on_project()
{
    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $project_id = $_POST['project_id'];
    $project_title = get_post($project_id)->post_title;
    $type = $_POST['type'];

    $attachments = array();
    $attached_filenames = array();

    if (isset($_FILES)) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $upload_overrides = array('test_form' => false);
        $filetypes = array();

        $allowed_file_types = array_unique(array_merge(array_values(ALLOWED_IMG_FILE_TYPES), array_values(ALLOWED_OTHER_FILE_TYPES)));

        if (count($_FILES['files']['name']) > 0) {

            $files = $_FILES['files'];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $uploadedfile = array(
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    );
                    $filename_to_show = $uploadedfile['name'];
                    if (in_array($uploadedfile['type'], $allowed_file_types)) {
                        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                        if ($movefile && !isset($movefile['error'])) {
                            $filename = $movefile['file'];
                            $filetype = wp_check_filetype(basename($filename), null);
                            $wp_upload_dir = wp_upload_dir();
                            $attachment_name = preg_replace('/\.[^.]+$/', '', basename($filename));
                            $attached_filenames[] = basename($filename);
                            $attachment_arg = array(
                                'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                                'post_mime_type' => $filetype['type'],
                                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attach_id = wp_insert_attachment($attachment_arg, $filename, $project_id);
                            update_post_meta($attach_id, 'project_id', $project_id);
                            update_post_meta($attach_id, 'type', $type);

                            require_once(ABSPATH . 'wp-admin/includes/image.php');

                            $attach_data = get_post_mime_type($attach_id);

                            if (in_array($filetype, ALLOWED_IMG_FILE_TYPES)) {
                                $attach_img_data = wp_generate_attachment_metadata($attach_id, $filename);
                                wp_update_attachment_metadata($attach_id, $attach_img_data);
                            }

                            $uploaded_url = wp_get_attachment_image_src($attach_id, 'thumbnail');
                            $preview = in_array($uploadedfile['type'], PREVIEW_ALLOWED_IMG_FILE_TYPES) ? true : false;
                            $attachments[$attach_id] = array(
                                'src' => $uploaded_url[0],
                                'preview' => $preview,
                            );
                        }
                    }
                }
            }
        }
    }

    if (count($attachments) > 0) {
        $status = true;

        $message_title = $user_data->display_name . ' uploaded attachment(s) ' . ' on project - ' . $project_title;
        $message_content = $user_data->display_name . " uploaded " . implode(', ', $attached_filenames) . " on Uploads";

        aireno_send_message_on_project($message_title, $message_content, $user_id, $project_id);

        aireno_add_activity($project_id, 'upload_file', $message_content, date_i18n('Y-m-d H:i:s'), $user_id);;

        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " uploaded file(s) on " . get_post($project_id)->post_title;
        $link = get_permalink($project_id)."?tab=project-files";
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);

    } else $status = false;

    $response = array(
        'status' => $status,
        'attachments' => $attachments,
    );

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_upload_files_on_project', 'aireno_upload_files_on_project');

function aireno_add_activity_manually()
{
    $project_id = $_POST['project_id'];

    $activity_type = $_POST['activity_type'];
    $activity_datetime = $_POST['activity_datetime'];
    $activity_content = $_POST['activity_content'];
    $activity_user = $_POST['activity_user'];

    aireno_add_activity($project_id, $activity_type, $activity_content, $activity_datetime, $activity_user);

    $response = array(
        'status' => true,
        'message' => 'Success',
    );
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_add_activity_manually', 'aireno_add_activity_manually');

function aireno_mark_payment_paid()
{
    $response = array(
        'status' => false,
        'message' => 'Failed',
    );

    $project_id = $_POST['project_id'];
    $payment_id = $_POST['payment_id'];
    $user_id = get_current_user_id();

    $payment_project_id = get_field('project_id', $payment_id);

    if ($project_id != $payment_project_id) {
        $response = array(
            'status' => false,
            'message' => 'Wrong Payment of project.',
        );
    } else {
        if (is_business($user_id) || is_head($user_id)) {
            if (get_post_type($payment_id) != AIRENO_CPT_PAYMENT || get_post_type($project_id) != AIRENO_CPT_PROJECT) {
                $response = array(
                    'status' => false,
                    'message' => 'Wrong Payment or Project',
                );
            } else {
                $payment_status = get_field('status', $payment_id);
                if ($payment_status != 'Ready') {
                    $response = array(
                        'status' => false,
                        'message' => 'This payment can\'t be marked as Paid.',
                    );
                } else {
                    update_field('status', 'Paid', $payment_id);

                    $payment_user = get_field('payment_user', $payment_id);
                    $payment_sender = get_field('sender', $payment_id);

                    $userdata = aireno_get_userdata($user_id);
                    $sender_data = aireno_get_userdata($payment_sender);
                    $payment = get_post($payment_id);

                    $title = $payment->post_title;
                    $description = $payment->post_content;
                    $due_date = get_field('due_date', $payment_id);
                    $amount = get_field('amount', $payment_id);

                    $payment_userdata = aireno_get_userdata($payment_user);
                    $content = "Hello {$payment_userdata->display_name} \n";

                    $subject = "{$userdata->display_name} marked a payment assigned you as PAID.";
                    $email_title = "<h2>{$userdata->display_name} marked a payment assigned you as PAID.</h2>";
                    $sub_content = "<p>{$userdata->display_name} marked a payment assigned you as PAID.</p>";
                    $sub_content .= "<p>Here are the details.</p>";
                    $sub_content .= "<p>Title : {$title}</p>";
                    $sub_content .= "<p>Description : {$description}</p>";
                    $sub_content .= "<p>Amount : $" . $amount . "</p>";
                    $content .= $sub_content;
                    $content .= '<hr/><br/>';
                    $content .= '<div style="text-align: center"><a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius:4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a></div>';
                    aireno_send_email($subject, $email_title, $content, $payment_user, null, array());

                    $content = "Hello {$sender_data->display_name} \n";
                    $content .= $sub_content;
                    $content .= '<hr/><br/>';
                    $content .= '<div style="text-align: center"><a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius: 4px; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto;">Open Project</a><div style="text-align: center">';
                    aireno_send_email($subject, $email_title, $content, $payment_sender, null, array());

                    $project_users = aireno_get_project_users($project_id, $user_id);
                    $title = $description = $userdata->display_name . " marked a payment as Paid on " . get_post($project_id)->post_title;
                    $link = get_permalink($project_id);
                    $content = aireno_encode_content(array('description' => $description, 'link' => $link));
                    aireno_add_notification($title, $content, $project_users);

                    $response = array(
                        'status' => true,
                        'message' => 'Success',
                    );
                }
            }
        } else {
            $response = array(
                'status' => false,
                'message' => 'You don\'t have permission to do this action.',
            );
        }
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_mark_payment_paid', 'aireno_mark_payment_paid');

function aireno_download_invoice()
{
    require("download-invoice.php");
    exit;
}

add_action('wp_ajax_download_invoice', 'aireno_download_invoice');

function aireno_add_user_to_project()
{
    $response = array(
        'status' => true,
        'message' => 'Success',
    );

    $project_id = $_POST['project_id'];
    $member_id = $_POST['member_id'];
    $member_data = aireno_get_userdata($member_id);
    $type = $_POST['type'];

    $user_id = get_current_user_id();
    $user_data = aireno_get_userdata($user_id);

    $content = "Hello {$member_data->display_name} \n";

    $subject = "You've been assigned to a project on Aireno";
    $email_title = "<h2>New Project</h2>";

    $project_users = array();
    $client = get_field('client', $project_id);
    if ($client) $project_users[] = $client;

    $businesses = get_field('business', $project_id);
    if (!$businesses) $businesses = array();
    $contractors = get_field('contractor', $project_id);
    if (!$contractors) $contractors = array();
    $suppliers = get_field('supplier', $project_id);
    if (!$suppliers) $suppliers = array();
    $designers = get_field('designer', $project_id);
    if (!$designers) $designers = array();
    $partners = get_field('partner', $project_id);
    if (!$partners) $partners = array();
    $planners = get_field('planner', $project_id);
    if (!$planners) $planners = array();

    $project_users = array_merge($project_users, $businesses, $contractors, $suppliers, $designers, $partners, $planners);
    if (!in_array($member_id, $project_users)) {
        $success = true;

        switch ($type) {
            case 'Business':
                if (is_business($member_id)) {
                    $businesses[] = $member_id;
                    $businesses = array_unique($businesses);
                    update_field('business', $businesses, $project_id);
                } else {
                    $response = array(
                        'status' => false,
                        'message' => 'This user should be Business to be added as Business',
                    );
                    $success = false;
                }
                break;
            case 'Client':
                if ($client) {
                    $response = array(
                        'status' => false,
                        'message' => 'A member is already assigned as Client',
                    );
                    $success = false;
                } else {
                    update_field('client', $member_id, $project_id);
                }
                break;
            case 'Contractor':
                if (is_business($member_id)) {
                    $contractors[] = $member_id;
                    $contractors = array_unique($contractors);
                    update_field('contractor', $contractors, $project_id);
                } else {
                    $response = array(
                        'status' => false,
                        'message' => 'This user should be Business to be added as Contractor',
                    );
                    $success = false;
                }
                break;
            case 'Supplier':
                $suppliers[] = $member_id;
                $suppliers = array_unique($suppliers);
                update_field('supplier', $suppliers, $project_id);
                break;
            case 'Designer':
                $designers[] = $member_id;
                $designers = array_unique($designers);
                update_field('designer', $designers, $project_id);
                break;
            case 'Planner':
                if (is_business($member_id)) {
                    $planners[] = $member_id;
                    $planners = array_unique($planners);
                    update_field('planner', $planners, $project_id);
                    break;
                } else {
                    $response = array(
                        'status' => false,
                        'message' => 'This user should be Business to be added as Planner',
                    );
                    $success = false;
                }
            case 'Partner':
                $partners[] = $member_id;
                $partners = array_unique($partners);
                update_field('partner', $partners, $project_id);
                break;
        }
    } else {
        $success = false;
        $response = array(
            'status' => false,
            'message' => 'This member is already assigned to the project.',
        );
    }

    if ($success) {
        $link = get_permalink($project_id);

        $sub_content = "{$user_data->display_name} assigned you as " . $type . " to project - " . get_post($project_id)->post_title;
        $content .= $sub_content;
        $content .= '<hr/><br/>';
        $content .= '<a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; margin: auto; ">Open Project</a>';
        aireno_send_email($subject, $email_title, $content, $member_id, null, array());

        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " assigned " . $member_data->display_name." Project " . get_post($project_id)->post_title;

        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);

        aireno_add_to_contacts($user_id, $member_id);
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_add_user_to_project', 'aireno_add_user_to_project');


function aireno_update_user_to_project()
{
    $response = array(
        'status' => true,
        'message' => 'Success',
    );

    $project_id = $_POST['project_id'];
    $member_id = $_POST['member_id'];
    $member_data = aireno_get_userdata($member_id);
    $type = $_POST['type'];

    if (is_client($member_id) && ($type == 'Business' || $type == 'Contractor' || $type == 'Planner')){
        $response = array(
            'status' => false,
            'message' => 'This user can not be added as ' . $type . ' because user is not a Business',
        );
    } else {
        $user_id = get_current_user_id();
        $user_data = aireno_get_userdata($user_id);

        $content = "Hello {$member_data->display_name}, <br/>";

        $subject = "Your role in a project has changed";
        $email_title = "<h2>New role</h2>";

        $client = get_field('client', $project_id);

        $contractors = get_field('contractor', $project_id);
        if (!$contractors) $contractors = array();
        $suppliers = get_field('supplier', $project_id);
        if (!$suppliers) $suppliers = array();
        $designers = get_field('designer', $project_id);
        if (!$designers) $designers = array();
        $partners = get_field('partner', $project_id);
        if (!$partners) $partners = array();
        $planners = get_field('planner', $project_id);
        if (!$planners) $planners = array();

        //remove user from project
        if ($member_id == $client) {
            update_field('client', null, $project_id);
        }
        if (in_array($member_id, $contractors)) {
            unset($contractors[array_search($member_id, $contractors)]);
            update_field('contractor', $contractors, $project_id);
        }
        if (in_array($member_id, $suppliers)) {
            unset($suppliers[array_search($member_id, $suppliers)]);
            update_field('supplier', $suppliers, $project_id);
        }
        if (in_array($member_id, $planners)) {
            unset($planners[array_search($member_id, $planners)]);
            update_field('planner', $planners, $project_id);
        }
        if (in_array($member_id, $designers)) {
            unset($designers[array_search($member_id, $designers)]);
            update_field('designer', $designers, $project_id);
        }
        if (in_array($member_id, $partners)) {
            unset($partners[array_search($member_id, $partners)]);
            update_field('partner', $partners, $project_id);
        }

        //add user to new user role
        switch ($type) {
            case 'Client':
                update_field('client', $member_id, $project_id);
                break;
            case 'Contractor':
                $contractors[] = $member_id;
                update_field('contractor', $contractors, $project_id);
                break;
            case 'Supplier':
                $suppliers[] = $member_id;
                update_field('supplier', $suppliers, $project_id);
                break;
            case 'Planner':
                $planners[] = $member_id;
                update_field('planner', $planners, $project_id);
                break;
            case 'Designer':
                $designers[] = $member_id;
                update_field('designer', $designers, $project_id);
                break;
            case 'Partner':
                $partners[] = $member_id;
                update_field('partner', $partners, $project_id);
                break;
        }

        $sub_content = "{$user_data->display_name} assigned you as " . $type . " on - " . get_post($project_id)->post_title;
        $content .= $sub_content;
        $content .= '<hr/><br/>';
        $content .= '<div style="text-align: center"><a href="' . get_permalink($project_id) . '" style="background:#f1416c; border-radius: 4px; margin: auto; color:#fff; padding:12px 25px; text-decoration:none; font-size:16px; ">Open Project</a></div>';
        aireno_send_email($subject, $email_title, $content, $member_id, null, array());
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_update_user_to_project', 'aireno_update_user_to_project');

function aireno_ajax_search_from_contacts()
{
    $response = array(
        'status' => false,
        'message' => 'No members found!',
    );

    $user_id = get_current_user_id();
    $search = $_POST['search'];

    $results = aireno_search_from_contacts($user_id, $search);

    if (count($results) > 0) {
        $response = array(
            'status' => true,
            'message' => $results,
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_ajax_search_from_contacts', 'aireno_ajax_search_from_contacts');

function aireno_rate_project()
{
    $project_id = $_POST['project_id'];
    $user_id = get_current_user_id();
    $rate = $_POST['rating'];
    $review = $_POST['review'];
    $date = date_i18n('Y-m-d H:i:s');
    $receivers = $_POST['receivers'];

    if (aireno_user_left_review_on_project($project_id, $user_id)) {
        $response = array(
            'status' => false,
            'message' => 'You already finished review on this project!',
        );
    } else {
        $reviewed_users = 0;
        foreach ($receivers as $receiver) {
            if (!aireno_check_user_left_review_for_receiver($project_id, $user_id, $receiver)) {
                aireno_leave_review_on_project($project_id, $user_id, $receiver, $review, $date, $rate);
                $reviewed_users ++;
            }
        }

        if ($reviewed_users == 0) {
            $response = array(
                'status' => false,
                'message' => 'You already rated!',
            );
        } else {
            $response = array(
                'status' => true,
                'message' => 'Success!',
            );
        }
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_rate_project', 'aireno_rate_project');

function aireno_export_quotes()
{
    require("export-quotes.php");
    exit;
}

add_action('wp_ajax_export_quotes', 'aireno_export_quotes');