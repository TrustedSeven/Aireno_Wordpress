<?php
add_action('wp_ajax_add_contact_on_contacts', 'add_contact_on_contacts');
function add_contact_on_contacts(){
    $response = array(
        'status' => true,
        'message' => 'Success',
    );

    $user_id = get_current_user_id();
    $contact_id = $_POST['contact_id'];

    aireno_add_to_contacts($user_id, $contact_id);

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_remove_contacts', 'aireno_remove_contacts');
function aireno_remove_contacts(){
    $response = array(
        'status' => true,
        'message' => 'Success',
    );

    $contacts = $_POST['contacts'];
    $user_id = get_current_user_id();

    $user_contacts = aireno_get_contacts($user_id);
    foreach ($contacts as $contact) {
        unset($user_contacts[array_search($contact, $user_contacts)]);
    }

    update_field('contacts', $user_contacts, 'user_' . $user_id);

    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_clear_unread_notifications', 'aireno_clear_unread_notifications');
function aireno_clear_unread_notifications(){
    $response = array(
        'status' => true,
        'message' => 'Success',
    );

    $user_id = get_current_user_id();
    $unread_notifications = aireno_get_unread_notifications($user_id);
    foreach ($unread_notifications as $unread_notification) {
        $assigned_users = get_field('assigned_users', $unread_notification);
        unset($assigned_users[array_search($user_id, $assigned_users)]);
        update_field('assigned_users', $assigned_users, $unread_notification);

        $unread_users = get_field('unread_users', $unread_notification);
        unset($unread_users[array_search($user_id, $unread_users)]);
        update_field('unread_users', $unread_users, $unread_notification);
    }
    echo json_encode($response);
    exit;
}

add_action('wp_ajax_aireno_clear_unread_messages', 'aireno_clear_unread_messages');
function aireno_clear_unread_messages(){
    $response = array(
        'status' => true,
        'message' => 'Success',
    );

    $user_id = get_current_user_id();
    $unread_messages = aireno_get_unread_messages($user_id);
    foreach ($unread_messages as $unread_message) {
        $unread_users = get_field('unread_users', $unread_message);
        unset($unread_users[array_search($user_id, $unread_users)]);
        update_field('unread_users', $unread_users, $unread_message);
    }
    echo json_encode($response);
    exit;
}