<?php
function aireno_get_scope_details($template_id, $scopeId)
{
    $scopeData = get_field('scopeData', $scopeId);
    $scopeDataDecoded = base64_decode($scopeData);
    $scopeDataArray = json_decode($scopeDataDecoded, true);

    return aireno_scope_details_by_scope_data($template_id, $scopeDataArray);
}

function aireno_scope_details_by_scope_data($template_id, $scopeDataArray)
{
    $section_details = array();
    while (have_rows('quote_fields', $template_id)) : the_row();
        $layout = get_row_layout();
        $slug = get_sub_field('slug');
        $title = get_sub_field('title');
        switch ($layout) {
            case 'width_and_height':
                $width = $scopeDataArray[$slug . "_width"];
                $lenght = $scopeDataArray[$slug . "_height"];
                $wallarea = $width * $lenght;
                $value =  $width . "x" . $lenght . " <br/> <b>Surface Area:" . $wallarea . " m2</b>";
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'room_size':
                $width = $scopeDataArray[$slug . "_width"];
                $lenght = $scopeDataArray[$slug . "_length"];
                $height = $scopeDataArray[$slug . "_height"];
                $floorarea = $width * $lenght;
                $walllength = ($width + $width + $lenght + $lenght) * $height;
                $wallarea = $walllength;
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $value = $width . "m x " . $lenght . "m x " . $height . "m<br/> <b>Floor Area:</b> <b>" . $floorarea . "m2 </b><br/><b>Wall Area:</b> <b>" . round($wallarea, 2) . "m2</b>";
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'width_and_length':
                $width = $scopeDataArray[$slug . "_width"];
                $lenght = $scopeDataArray[$slug . "_length"];
                $floorarea = $width * $lenght;
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $value =  $width . " x " . $lenght . "<br/> <b>Area:" . $floorarea . "m2</b>";
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'price_and_area':
                $supply_price = $scopeDataArray[$slug . "_price"];
                $supply_area = $scopeDataArray[$slug . "_area"];
                $supply_total = $supply_price * $supply_area;
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $value =  "$" . $supply_price . " x " . $supply_area . "m2 - Supply Allowance: $" . $supply_total . "inc gst";
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'length':
                $width = $scopeDataArray[$slug];
                $value =  $width . "m";
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'area':
                $width = $scopeDataArray[$slug];
                $value =  $width . "m2";
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'height':
                $height = $scopeDataArray[$slug];
                $value =  $height . "m";
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $section_details[] = array('section_title' => $title, 'section_values' => array($value), 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'fields':
                $data = $scopeDataArray[$slug . ""];
                $notes = $scopeDataArray[$slug . "_notes"];
                $cprice = $scopeDataArray[$slug . "_cprice"];
                $new_value = array();
                if (is_array($data)) {
                    foreach ($data as $d) {
                        $cnt_field_name = preg_replace("/[^a-zA-Z0-9]/", "", $d);
                        $cnt_field_name = strtolower($cnt_field_name);
                        $cnt_field_name = $cnt_field_name . "";
                        if (array_key_exists($cnt_field_name, $scopeDataArray)) {
                            $value_cnt = $scopeDataArray[$cnt_field_name];
                            $new_value[] = $d . " x <b>" . $value_cnt . '</b>';
                        } else {
                            $new_value[] = $d;
                        }
                    }
                    $value = $new_value;
                } else {
                    $cnt_field_name = preg_replace("/[^a-zA-Z0-9]/", "", $data);
                    $cnt_field_name = strtolower($cnt_field_name);
                    $cnt_field_name = $cnt_field_name . "";
                    if (array_key_exists($cnt_field_name, $scopeDataArray)) {
                        $value_cnt = $scopeDataArray[$cnt_field_name];
                        $new_value[] = $d . " x <b>" . $value_cnt . '</b>';
                    } else {
                        $new_value[] = $data;
                    }
                    $value = $new_value;
                }
                $section_details[] = array('section_title' => $title, 'section_type' => 'flds', 'section_values' => $value, 'section_notes' => ($notes), 'section_cprice' => ($cprice));
                break;
            case 'additional_notes':
                $notes = $scopeDataArray[$slug];
                $value = $notes;
                $value = str_replace("\'", "'", $notes);
                $section_details[] = array('section_title' => $title, 'section_type' => 'notes', 'section_values' => array($value));
                break;
            case 'styles':
            case 'moods':
            case 'exclusions':
                $data = $scopeDataArray[$slug . ""];
                $new_value = array();
                if (is_array($data)) {
                    foreach ($data as $d) {
                        $cnt_field_name = preg_replace("/[^a-zA-Z0-9]/", "", $d);
                        $cnt_field_name = strtolower($cnt_field_name);
                        $cnt_field_name = $cnt_field_name . "";
                        if (array_key_exists($cnt_field_name, $scopeDataArray)) {
                            $value_cnt = $scopeDataArray[$cnt_field_name];
                            $new_value[] = $d . " x <b>" . $value_cnt . '</b>';
                        } else {
                            $new_value[] = $d;
                        }
                    }
                    $value = $new_value;
                } else {
                    $cnt_field_name = preg_replace("/[^a-zA-Z0-9]/", "", $data);
                    $cnt_field_name = strtolower($cnt_field_name);
                    $cnt_field_name = $cnt_field_name . "";
                    if (array_key_exists($cnt_field_name, $scopeDataArray)) {
                        $value_cnt = $scopeDataArray[$cnt_field_name];
                        $new_value[] = $d . " x <b>" . $value_cnt . '</b>';
                    } else {
                        $new_value[] = $data;
                    }
                    $value = $new_value;
                }
                $section_details[] = array('section_title' => $title, 'section_type' => 'flds', 'section_values' => $value);
                break;
            default:
                break;
        }

    endwhile;

    return $section_details;
}

function aireno_get_project_client($project_id) {
    $clients = get_field('client', $project_id);
    if (is_array($clients) && count($clients) > 0) return $clients[0];
    else return $clients;
}

function aireno_recalculate_project_price($project_id) {
    $project_scopes = get_field('project_scopes', $project_id);
    // get total of project based on subtotals of scopes
    $projectTotal = 0;
    $project_scopes = is_array($project_scopes) ? $project_scopes  : array($project_scopes);
    foreach ($project_scopes as $pS) {
        $scopePrice = get_field('scope_price', $pS);
        $scopeAdjustment = get_field('total_adjustment', $pS);
        $scopePriceTotal = $scopePrice + $scopeAdjustment;
        $projectTotal += $scopePriceTotal;
    }
    $projectTotal = number_format($projectTotal, 2, '.', '');

    // saving Price in project custom field
    $report = update_field('total_price', $projectTotal, $project_id);

    return $report;
}

function aireno_project_save_coupon($coupon, $project_id)
{
    $coupon = trim($coupon);
    $coupon_meta_query = array(
        'relation' => 'AND',
        array(
            'key' => 'meta_coupon_code',
            'value' => $coupon,
            'compare' => '='
        ),
        array(
            'key' => 'meta_expiry',
            'value' => date('Y-m-d'),
            'compare' => '>='
        )
    );

    $coupon_args = [
        'post_type' => 'coupon',
        'meta_query' => $coupon_meta_query
    ];

    $coupons = get_posts($coupon_args);
    if (empty($coupons)) return [
        'status' => 'danger',
        'message' => 'Sorry, the coupon doesn`t exist, or has expired'
    ];

    $discount = get_post_meta($coupons[0]->ID, 'wps_coupon_offer', true);

    update_field('coupon', $coupon, $project_id);
    update_field('discount', $discount, $project_id);

    return [
        'status' => 'success',
        'message' => 'The coupon has been activated successfully'
    ];
}

function aireno_get_project_total($project_id)
{
    $projectTotal = floatval(get_field('total_price', $project_id));
    $projectDiscount = floatval(get_field('discount', $project_id));
    return round($projectTotal * (100 - $projectDiscount) / 100, 2);
}

function aireno_display_project_total($project_id)
{
    $projectTotal = get_field('total', $project_id);

    $projectDiscount = get_field('discount', $project_id);
    $projectTotalWithDiscount = getProjectTotal($project_id);

    if (empty($projectDiscount)) return $projectTotal;

    return "<s>{$projectTotal}</s>(-{$projectDiscount}%) <br/><b>$</b>{$projectTotalWithDiscount}";
}

function aireno_get_scope_price($scopeId, $project_id)
{
    $scopePriceTemp = get_field('scopePrice', $scopeId);
    $scopeAdjustment = get_field('totalAdjustment', $scopeId);
    $scopePrice = $scopePriceTemp + $scopeAdjustment;

    $projectDiscount = get_field('discount', $project_id);

    return $scopePrice * (100 - $projectDiscount) / 100;
}

function aireno_can_update_task($project_id, $task_id, $user_id) {
    if (get_post($task_id)->post_type != AIRENO_CPT_TASK) {
        $response = array(
            'status' => false,
            'msg' => 'This is not a task',
        );
        return $response;
    }
    if (get_field('project_id', $task_id) != $project_id) {
        $response = array(
            'status' => false,
            'msg' => 'Wrong task or wrong project',
        );
        return $response;
    }
    $client = get_field('client', $project_id);
    $business = get_field('business', $project_id);
    $user_id = get_current_user_id();
    if (!current_user_can('manage_options') && !in_array($user_id, $client) && !in_array($user_id, $business)) {
        $response = array(
            'status' => false,
            'msg' => 'You do not have permission to delete this task',
        );
        return $response;
    }
    return array(
        'status' => true,
        'msg' => 'Yes, you can',
    );
}

function aireno_send_message_on_project($message_title, $message_content, $user_id, $project_id) {

    $message_id = wp_insert_post(
        array(
            'post_title' => $message_title,
            'post_content' => $message_content,
            'post_author' => $user_id,
            'post_type' => AIRENO_CPT_MESSAGE,
            'post_status' => 'publish',
        )
    );
    if ($message_id && !is_wp_error($message_id)) {
        update_field('project_id', $project_id, $message_id);
        $project_users = aireno_get_project_users($project_id, $user_id);
        update_field('unread_users', $project_users, $message_id);
    }
    return $message_id;
}

/**
 * This functions converts the URLs available in the provided string to links.
 *
 * @param $string
 *
 * @return array|string|string[]|null
 */
function aireno_convert_to_link($string) {

    $search = array('/([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/');
    $replace = array('<a href="mailto:$1">$1</a>');
    $out_text = preg_replace($search, $replace, $string);

    $rexProtocol = '(https?://)?';
    //$rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})';
    $rexDomain = '((?:[0-9]*[-a-zA-Z]+[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63})';
    $rexPort = '(:[0-9]{1,5})?';
    $rexPath = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
    $rexQuery = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
    $rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
    $out_text = preg_replace_callback(
        "&\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))&",
        'aireno_format_callback',
        $out_text
    );

    $out_text = preg_replace('$(\s|^)(https?://[a-z0-9_./?=&-]+)(?![^<>]*>)$i', ' <a href="$2" target="_blank">$2</a> ', $out_text . " ");
    return $out_text;
}

function aireno_format_callback($match)
{
    // Prepend http:// if no protocol specified
    $completeUrl = $match[1] ? $match[0] : "http://{$match[0]}";
    return '<a href="' . $completeUrl . '">' . $match[2] . $match[3] . $match[4] . '</a>';
}

function aireno_get_project_percentage($project_id) {
    $args = array(
        'post_type' => AIRENO_CPT_SCHEDULE,
        'post_status' => array(
            'publish'
        ),
        'posts_per_page' => -1,
        'meta_key' => 'project_id',
        'meta_value' => $project_id,
        'meta_compare' => '='
    );
    $schedule_query = new WP_Query($args);
    $schedules = array();
    if ($schedule_query->have_posts()) {
        $total = 0;
        while ($schedule_query->have_posts()) {
            $schedule_query->the_post();
            $schedule_status = get_field('status', get_the_ID());
            $schedules[$schedule_status][] = get_the_ID();
            $total ++;
        }
        $percentage = ceil(count($schedules[2]) / $total * 100);
    }
    else $percentage = 0;
    wp_reset_query();

    return $percentage;
}

function aireno_get_project_reviews($project_id) {
    $reviews = get_field('reviews', $project_id);
    if (!$reviews) $reviews = array();
    return $reviews;
}

function aireno_user_left_review_on_project($project_id, $user_id){
    $left = false;

    $client = get_field('client', $project_id);
    if ($user_id == $client) {
        $project_users = aireno_get_all_project_users_for_review($project_id);
        $reviews_of_client = aireno_get_client_reviews_on_project($project_id, $user_id);
        $left = count($project_users) == count($reviews_of_client);
    }
    else {
        $reviews = aireno_get_project_reviews($project_id);
        foreach ($reviews as $review) {
            if ($user_id == $review['reviewer']) {
                $left = true;
                break;
            }
        }
    }

    return $left;
}

function aireno_get_client_reviews_on_project($project_id, $client_id) {
    $all_reviews = aireno_get_project_reviews($project_id);
    $reviews = array();
    foreach ($all_reviews as $single_review) {
        if ($client_id == $single_review['reviewer']) {
            $reviews[$single_review['receiver']] = $single_review;
        }
    }
    return $reviews;
}

function aireno_get_all_project_users_for_review($project_id) {
    $businesses = get_field('business', $project_id);
    if (!$businesses) $businesses = array();
    $contractors = get_field('contractor', $project_id);
    if (!$contractors) $contractors = array();
    $suppliers = get_field('supplier', $project_id);
    if (!$suppliers) $suppliers = array();
    $designers = get_field('designer', $project_id);
    if (!$designers) $designers = array();
    $planners = get_field('planner', $project_id);
    if (!$planners) $planners = array();

    $project_users = array_merge($businesses, $contractors, $suppliers, $designers, $planners);
    $project_users = array_unique($project_users);

    return $project_users;
}

function aireno_get_project_users_for_review($project_id, $user_id) {
    $client = get_field('client', $project_id);
    if ($user_id == $client) {
        $reviews = aireno_get_client_reviews_on_project($project_id, $user_id);
        $reviewed_users = array_keys($reviews);

        $project_users = aireno_get_all_project_users_for_review($project_id);
        $project_users = array_diff($project_users, $reviewed_users);
    }
    else $project_users = array($client);

    return $project_users;
}

function aireno_check_user_left_review_for_receiver($project_id, $user_id, $receiver_id) {
    $reviews = aireno_get_project_reviews($project_id);
    $left = false;
    foreach ($reviews as $review) {
        if ($review['reviewer'] == $user_id && $review['receiver'] == $receiver_id) {
            $left = true;
            break;
        }
    }
    return $left;
}

function aireno_leave_review_on_project($project_id, $user_id, $receiver_id, $content, $date, $rating) {
    $review = array(
        'content' => $content,
        'date' => $date,
        'rating' => $rating,
        'reviewer' => $user_id,
        'receiver' => $receiver_id,
    );

    add_row('reviews', $review, $project_id);

    $user_reviews = get_field('reviews', 'user_' . $receiver_id);
    if (!$user_reviews) $user_reviews = array();
    $user_reviews[] = array(
        'review' => $content,
        'project_id' => $project_id,
        'rating' => $rating,
        'user_id' => $user_id,
        'review_date' => $date,
    );
    update_field('reviews', $user_reviews, 'user_' . $receiver_id);
}

function aireno_get_user_role_in_project($user_id, $project_id){
    $userdata = aireno_get_userdata($user_id);
    $role = $userdata->user_type;

    $client = get_field('client', $project_id);

    $businesses = get_field('business', $project_id);
    if (!is_array($businesses))
        $businesses = array();

    $partners = get_field('partner', $project_id);
    if (!is_array($partners))
        $partners = array();

    $contractors = get_field('contractor', $project_id);

    if (!is_array($contractors))
        $contractors = array();

    $suppliers = get_field('supplier', $project_id);
    if (!is_array($suppliers))
        $suppliers = array();

    $planners = get_field('planner', $project_id);
    if (!is_array($planners))
        $planners = array();

    $designers = get_field('designer', $project_id);
    if (!is_array($designers))
        $designers = array();

    $heads = get_field('head', $project_id);
    if (!is_array($heads))
        $heads = array();

    if ($user_id == $client) {
        $role = 'Client';
    }
    else if (in_array($user_id, $businesses)) {
        $role = 'Business';
    }
    else if (in_array($user_id, $partners)) {
        $role = 'Partner';
    }
    else if (in_array($user_id, $contractors)) {
        $role = 'Contractor';
    }
    else if (in_array($user_id, $suppliers)) {
        $role = 'Supplier';
    }
    else if (in_array($user_id, $planners)) {
        $role = 'Planner';
    }
    else if (in_array($user_id, $designers)) {
        $role = 'Designer';
    }
    return $role;
}