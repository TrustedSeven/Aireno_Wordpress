<?php
add_action('wp_ajax_nopriv_aireno_register_user', 'aireno_register_user');
function aireno_register_user()
{
    $user_email = $_POST['email'];
    $display_name = $_POST['display_name'];
    $user_pwd = $_POST['password'];
    $user_type = $_POST['user_type'];

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
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        $msg = 'Registered Successfully.';
        $redirect_link = aireno_get_page_link_by_name('account-settings');
        if (isset($_POST['redirect']) && $_POST['redirect'] != '')
            $redirect_link = urldecode(base64_decode($_POST['redirect']));
        $response = array(
            'status' => true,
            'msg' => $msg,
            'redirect' => $redirect_link,
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_nopriv_aireno_login_user', 'aireno_login_user');
function aireno_login_user()
{

    $user_login = $_POST['email'];
    $user_pwd = $_POST['password'];

    $user = get_user_by('email', $user_login);
    if ($user && wp_check_password($user_pwd, $user->data->user_pass, $user->ID)) {
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login, $user);

        if (isset($_REQUEST['redirect']) && $_REQUEST['redirect'] != '')
            $redirect = urldecode(base64_decode($_REQUEST['redirect']));
        else {
            if (user_can($user->ID, 'manage_options')) $redirect = site_url() . '/wp-admin/';
            else
                $redirect = aireno_get_page_link_by_name('account-settings');
        }
        $response = array(
            'status' => true,
            'msg' => 'Sign in successfully!',
            'redirect' => $redirect,
        );
    } else {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Email or Password!',
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_nopriv_aireno_send_pin', 'aireno_send_pin');
function aireno_send_pin()
{

    $user_email = $_POST['email'];
    $user = get_user_by('email', $user_email);
    if ($user == false) {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Email address',
        );
    } else {
        $pin = rand(00000, 99999);
        update_user_meta($user->ID, '_pin', $pin);

        $subject = 'Password recovery PIN-code';
        $title = 'Here is your PIN-code to recover password:';
        $text = '<div style="text-align:center; padding:25px 0;">
                                <div style="display:inline-block; background:#f1f4f5; border-radius: 4px; padding:20px; text-align:center;">
                                        <div style="font-size:16px; padding:5px 0 5px 0; ">' . $pin . '</div>
                                </div>
                        </div>';
        aireno_send_email($subject, $title, $text, $user->ID);

        $response = array(
            'status' => true,
            'msg' => 'PIN-code sent to your email. Please check your email inbox.',
            'user_id' => $user->ID,
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_nopriv_aireno_reset_password', 'aireno_reset_password');
function aireno_reset_password()
{
    $pin_code = $_POST['resent_pin'];
    $user_id = intval($_POST['user_id']);

    $sent_pin_code = get_user_meta($user_id, '_pin', true);
    if ($sent_pin_code == $pin_code) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        if ($password == $confirm_password) {

            $change_pass = wp_update_user(array('ID' => $user_id, 'user_pass' => $password));
            if (is_wp_error($change_pass)) {
                $response = array(
                    'status' => false,
                    'msg' => 'Password update failed',
                );
            } else {
                delete_user_meta($user_id, '_pin', $pin_code);
                $response = array(
                    'status' => true,
                    'msg' => 'Password reset successfully. Please login!',
                    'redirect' => aireno_get_page_link_by_name('login'),
                );
            }
        } else {
            $response = array(
                'status' => false,
                'msg' => 'Password does not match!',
                'pwd' => $password,
                'confirm' => $confirm_password,
            );
        }
    } else {
        $response = array(
            'status' => false,
            'msg' => 'Password Reset failed!',
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_nopriv_aireno_check_pin', 'aireno_check_pin');
function aireno_check_pin()
{
    $pin_code = $_POST['pin_code'];
    $user_id = intval($_POST['user_id']);

    $sent_pin_code = get_user_meta($user_id, '_pin', true);
    if ($sent_pin_code == $pin_code) {
        $response = array(
            'status' => true,
            'msg' => 'PIN-code is correct. Enter your new Password!',
            'pin_code' => $sent_pin_code,
            'user_id' => $user_id,
        );
    } else {
        $response = array(
            'status' => false,
            'msg' => 'Wrong PIN-code!.',
        );
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_save_account_details', 'aireno_save_account_details');
function aireno_save_account_details()
{
    $response = array();

    $user_id = get_current_user_id();
    $address = $_POST['address'];
    $display_name = $_POST['display_name'];
    $phone = $_POST['phone'];

    $user_id = wp_update_user(
        array(
            'ID'            => $user_id,
            'user_nicename' => aireno_esc_nicename($_POST['profile_url']),
        )
    );
    
    $user = get_user_by('ID', $user_id);
    $user->data->display_name = $display_name;
    wp_update_user($user);

    update_field('_phone', $phone, 'user_'.$user_id);
    update_field('_address', $address, 'user_'.$user_id);

    if (isset($_POST['company_name']))
        update_field('_company_name', $_POST['company_name'], 'user_'.$user_id);
    if (isset($_POST['company_abn']))
        update_field('_company_abn', $_POST['company_abn'], 'user_'.$user_id);
    if (isset($_POST['company_name']))
        update_field('_payment_instructions', $_POST['payment_instructions'], 'user_'.$user_id);
    if (isset($_POST['company_abn']))
        update_field('_payment_details', $_POST['payment_details'], 'user_'.$user_id);
    if (isset($_POST['company_services']))
        update_field('_company_services', $_POST['company_services'], 'user_'.$user_id);
    if (isset($_POST['company_margin']))
        update_field('_company_margin', str_replace("%", "", $_POST['company_margin']), 'user_'.$user_id);

    if (!empty($_FILES['avatar'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $f = 0;
        $_FILES[$f] = $_FILES['avatar'];

        $attachment_id = media_handle_upload($f, 0);

        if (is_wp_error($attachment_id)) {
            $response['avatar'] = array(
                'status' => false,
            );
        } else {
            $avatar = get_field('_avatar', 'user_'.$user_id);
            if ($avatar) {
                wp_delete_attachment($avatar['ID'], true);
            }

            //Get the attachment entry in media library
            $image_full_attributes = wp_get_attachment_image_src($attachment_id, 'thumbnail');
            $image_thumb_attributes = wp_get_attachment_image_src($attachment_id, 'full');

//            $arr = array(
//                'attachment_id' => $attachment_id,
//                'url' => $image_full_attributes[0],
//                'full' => $image_thumb_attributes[0]
//            );

            //Save the image in the user metadata
            update_field('_avatar', $attachment_id, 'user_'.$user_id);

            $response['avatar'] = array(
                'status' => true,
                'url' => $image_full_attributes[0],
                'attachment_id' => $attachment_id,
            );
        }
    } else {
        $response['avatar'] = false;
    }

    if (!empty($_FILES['business_logo'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $f = 1;
        $_FILES[$f] = $_FILES['business_logo'];

        $attachment_id = media_handle_upload($f, 0);

        if (is_wp_error($attachment_id)) {
            $response['business_logo'] = false;
        } else {
            $business_logo = get_field('_business_logo', 'user_'.$user_id);
            if ($business_logo) {
                wp_delete_attachment($business_logo['ID'], true);
            }

            //Get the attachment entry in media library
            $image_full_attributes = wp_get_attachment_image_src($attachment_id, 'thumbnail');
            $image_thumb_attributes = wp_get_attachment_image_src($attachment_id, 'full');

//            $arr = array(
//                'attachment_id' => $attachment_id,
//                'url' => $image_full_attributes[0],
//                'full' => $image_thumb_attributes[0]
//            );

            //Save the image in the user metadata
            update_field('_business_logo', $attachment_id, 'user_'.$user_id);

            $response['business_logo'] = array(
                'status' => true,
                'url' => $image_full_attributes[0],
                'attachment_id' => $attachment_id,
            );
        }
    } else {
        $response['business_logo'] = false;
    }

    $response['services'] = $_POST['company_services'];

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_user_email', 'aireno_change_user_email');
function aireno_change_user_email()
{
    $user_id = get_current_user_id();
    if ($_POST['user_id'] == $user_id) {
        $confirmpwd = $_POST['confirmemailpassword'];
        $userdata = get_userdata($user_id);
        $user_login = $userdata->data->user_login;
        $authenticate = wp_authenticate($user_login, $confirmpwd);
        if (is_wp_error($authenticate)) {
            $response = array(
                'status' => false,
                'msg' => 'Wrong Password!',
            );
        } else {
            $update_login = wp_update_user(
                array(
                    'ID' => $user_id,
                    'user_login' => $_POST['emailaddress'],
                    'user_email' => $_POST['emailaddress'],
                )
            );
            if (is_wp_error($update_login)) {
                $response = array(
                    'status' => false,
                    'msg' => 'Update failed',
                );
            } else {
                $response = array(
                    'status' => true,
                    'msg' => 'Successfully Changed!',
                );
            }
        }
    } else {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Action!',
        );
    }

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_change_user_password', 'aireno_change_user_password');
function aireno_change_user_password()
{
    $user_id = get_current_user_id();
    if ($_POST['user_id'] == $user_id) {
        $current_pass = $_POST['currentpassword'];
        $userdata = get_userdata($user_id);
        $user_login = $userdata->data->user_login;
        $authenticate = wp_authenticate($user_login, $current_pass);

        if (is_wp_error($authenticate)) {
            $response = array(
                'status' => false,
                'msg' => 'Old password is wrong!',
            );
        } else {
            $change_pass = wp_update_user(array('ID' => $user_id, 'user_pass' => $_POST['newpassword']));
            if (is_wp_error($change_pass)) {
                $response = array(
                    'status' => false,
                    'msg' => 'Password update failed!',
                );
            } else {
                $response = array(
                    'status' => true,
                    'msg' => 'Successfully updated!',
                );
            }
        }
    } else {
        $response = array(
            'status' => false,
            'msg' => 'Wrong Action!',
        );
    }

    echo json_encode($response);
    exit;
}


add_action('wp_ajax_aireno_upload_portfolios', 'aireno_upload_portfolios');
function aireno_upload_portfolios(){
    $response = array(
        'status' => false,
        'message' => $_FILES['portfolios'],
    );

    $user_id = get_current_user_id();
    $portfolios = get_field('_company_portfolios', 'user_' . $user_id);
    if (!$portfolios)  $portfolios = array();

    if (isset($_FILES)) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $upload_overrides = array('test_form' => false);
        $added = false;

        if (count($_FILES['portfolios']['name']) > 0) {

            $files = $_FILES['portfolios'];
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
                    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                    if ($movefile && !isset($movefile['error'])) {
                        $filename = $movefile['file'];
                        $filetype = wp_check_filetype(basename($filename), null);
                        $wp_upload_dir = wp_upload_dir();
                        $attachment_name = preg_replace('/\.[^.]+$/', '', basename($filename));
                        $attachment_arg = array(
                            'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                            'post_mime_type' => $filetype['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );
                        $attach_id = wp_insert_attachment($attachment_arg, $filename, -1);

                        require_once(ABSPATH . 'wp-admin/includes/image.php');

                        $attach_data = get_post_mime_type($attach_id);

                        $attach_img_data = wp_generate_attachment_metadata($attach_id, $filename);
                        wp_update_attachment_metadata($attach_id, $attach_img_data);

                        $uploaded_url = wp_get_attachment_image_src($attach_id, 'thumbnail');
                        $portfolios[] = $attach_id;
                        $added = true;
                    }
                }
            }
        }

        update_field('_company_portfolios', $portfolios, 'user_' . $user_id);
        if ($added)
            $response = array(
                'status' => true,
                'message' => $portfolios,
            );
    }

    echo json_encode($response);
    exit;
}


add_action('wp_ajax_aireno_remove_portfolio', 'aireno_remove_portfolio');
function aireno_remove_portfolio(){
    $response = array(
        'status' => false,
        'message' => 'Failed',
    );

    $portfolio = $_POST['portfolio'];
    $user_id = get_current_user_id();
    $portfolios = get_field('_company_portfolios', 'user_' . $user_id);

    $deleted = wp_delete_attachment($portfolio, true);

    if ($deleted) {
        unset($portfolios[array_search($portfolio, $portfolios)]);
        update_field('_company_portfolios', $portfolios, 'user_' . $user_id);

        $response = array(
            'status' => true,
            'message' => 'Success',
        );
    }

    echo json_encode($response);
    exit;
}