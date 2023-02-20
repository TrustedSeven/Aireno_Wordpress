<?php
add_action('wp_ajax_aireno_edit_scope', 'aireno_edit_scope');
function aireno_edit_scope()
{
    $scopeID = $_POST['scopeID'];
    $project_id = $_POST['project_id'];

    $scopeTitle = $_POST['scopeName'];
    $scopePrice = $_POST['total_price'];

    $args = array(
        'ID' => $scopeID,
        'post_title' => $scopeTitle,
        'post_content' => base64_encode(json_encode($_POST))
    );
    wp_update_post($args);
    update_field('scope_price', $scopePrice, $scopeID);
    aireno_recalculate_project_price($project_id);
    aireno_add_activity($project_id, 'edit_quote', "Quote \"{$scopeTitle}\" is edited.", date_i18n('Y-m-d H:i:s'), get_current_user_id());;
    echo json_encode(
        array(
            "redirect" => get_permalink($project_id),
        )
    );
    exit;
}
