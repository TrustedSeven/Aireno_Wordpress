<?php
function aireno_get_asp_product_for_project($project_id)
{
    $project_fee = floatval(get_field('fee', $project_id));

    $args = array(
        'post_type' => 'asp-products',
        'meta_key' => 'project_id',
        'meta_value' => $project_id,
        'meta_compare' => '=',
        'post_status' => array('publish'),
    );
    $search_products = new WP_Query($args);

    if ($project_fee > 0) {
        if ($search_products->have_posts()) {
            $asp_products = $search_products->posts;
            $asp_product = $asp_products[0]->ID;
            $project_price = floatval(get_field('total_price', $project_id));
            $asp_product_price = $project_fee * $project_price / 100;
            update_post_meta($asp_product, 'asp_product_price', $asp_product_price);
        } else {
            $asp_product = aireno_insert_asp_product($project_id);
        }
        return $asp_product;
    } else if ($search_products->have_posts()) {
        while ($search_products->have_posts()) {
            $search_products->the_post();
            wp_delete_post(get_the_ID(), true);
        }
        return false;
    }
}

function aireno_get_asp_fee_category()
{
    $term = get_term_by('slug', 'project-fee', 'asp-category');
    if ($term) return $term->term_id;
    else return false;
}

function aireno_insert_asp_product($project_id)
{
    $project = get_post($project_id);
    $project_fee = floatval(get_field('fee', $project_id));

    if ($project_fee > 0) {
        $args = array(
            'post_type' => 'asp-products',
            'post_title' => $project->post_title . ' Acceptance Fee',
            'post_status' => 'publish',
            'post_category' => array(aireno_get_asp_fee_category()),
        );
        $asp_product = wp_insert_post($args);

        if ($asp_product && !is_wp_error($asp_product)) {
            wp_set_post_terms( $asp_product, array( aireno_get_asp_fee_category() ), 'asp-category', false );

            update_post_meta($asp_product, 'asp_product_currency', '');
            update_post_meta($asp_product, 'asp_product_shipping', '');
            update_post_meta($asp_product, 'asp_product_tax', '');
            update_post_meta($asp_product, 'asp_product_tax_variations', array());
            update_post_meta($asp_product, 'asp_product_tax_variations_type', 'b');
            update_post_meta($asp_product, 'asp_product_quantity', '');
            update_post_meta($asp_product, 'asp_product_custom_quantity', '');
            update_post_meta($asp_product, 'asp_product_enable_stock', '');
            update_post_meta($asp_product, 'asp_product_stock_items', 0);
            update_post_meta($asp_product, 'asp_product_show_remaining_items', '');
            update_post_meta($asp_product, 'asp_product_force_test_mode', '');
            update_post_meta($asp_product, 'asp_product_authorize_only', '');
            update_post_meta($asp_product, 'asp_use_other_stripe_acc', '');
            update_post_meta($asp_product, 'asp_stripe_live_pub_key', NULL);
            update_post_meta($asp_product, 'asp_stripe_live_sec_key', NULL);
            update_post_meta($asp_product, 'asp_stripe_test_pub_key', NULL);
            update_post_meta($asp_product, 'asp_stripe_test_sec_key', NULL);
            update_post_meta($asp_product, 'asp_product_pdf_stamper_enabled', '');
            update_post_meta($asp_product, 'asp_product_coupons_setting', '');
            update_post_meta($asp_product, 'asp_product_custom_field', 0);
            update_post_meta($asp_product, 'asp_product_button_text', 'Accept');
            update_post_meta($asp_product, 'asp_product_button_class', '');
            update_post_meta($asp_product, 'asp_product_button_only', 0);
            update_post_meta($asp_product, 'asp_product_show_your_order', 0);
            update_post_meta($asp_product, 'asp_product_description', '');//$project->post_title . ' acceptance fee'
            update_post_meta($asp_product, 'asp_product_upload', '');
            update_post_meta($asp_product, 'asp_product_thumbnail', '');
            update_post_meta($asp_product, 'asp_product_thumbnail_thumb', '');
            update_post_meta($asp_product, 'asp_product_no_popup_thumbnail', '');
            update_post_meta($asp_product, 'asp_product_thankyou_page', '');//get_permalink($project_id)
            update_post_meta($asp_product, 'asp_product_collect_shipping_addr', '');
            update_post_meta($asp_product, 'asp_product_collect_billing_addr', '');
            update_post_meta($asp_product, 'asp_product_emember_level', '');
            update_post_meta($asp_product, 'asp_product_swpm_level', '');
            update_post_meta($asp_product, 'asp_sub_plan_id', 0);
            update_post_meta($asp_product, 'asp_variations_groups', '');
            update_post_meta($asp_product, 'asp_variations_names', '');
            update_post_meta($asp_product, 'asp_variations_prices', '');
            update_post_meta($asp_product, 'asp_variations_urls', '');
            update_post_meta($asp_product, 'asp_variations_opts', '');
            update_post_meta($asp_product, 'asp_product_hide_amount_input', '');
            update_post_meta($asp_product, 'asp_product_type', 'one_time');
            update_post_meta($asp_product, 'project_id', $project_id);

            $project_price = floatval(get_field('total_price', $project_id));
            $asp_product_price = $project_fee * $project_price / 100;
            update_post_meta($asp_product, 'asp_product_price', number_format($asp_product_price, 2));

            $client_id = get_field('client', $project_id);
            $client_data = aireno_get_userdata($client_id);
            update_post_meta($asp_product, 'asp_product_customer_name_hardcoded', $client_data->display_name);
            update_post_meta($asp_product, 'asp_product_customer_email_hardcoded', $client_data->email);

            return $asp_product;
        } else return false;
    } else return false;
}

function aireno_display_project_fee_asp_product($project_id)
{
    $project_fee = floatval(get_field('fee', $project_id));
    if ($project_fee > 0) {
        $project_price = floatval(get_field('total_price', $project_id));
        $asp_product_price = $project_fee * $project_price / 100;
        $project_title = get_post($project_id)->post_title;
        echo do_shortcode('[accept_stripe_payment name="' . $project_title . ' Acceptance Fee" price="' . $asp_product_price . '"]');
    }
}


add_filter('asp_ng_pp_data_ready', 'aireno_asp_ng_pp_data_ready', 10, 2);
function aireno_asp_ng_pp_data_ready($data, $product) {
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $userdata = aireno_get_userdata($user_id);
        $data['customer_name'] = $userdata->display_name;
        $data['customer_email'] = $userdata->email;
    }
    return $data;
}


add_shortcode('asp-products', 'aireno_display_asp_addon_products');
function aireno_display_asp_addon_products($atts)
{
    $atts = wp_parse_args(
        array(
            'category' => 'project-addon',
        ),
        $atts,
    );
    $args = array(
        'post_type' => 'asp-products',
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'asp-category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        ),
    );
    $asp_query = new WP_Query($args);

    if ($asp_query->have_posts()) {
        ?>
        <div class="row">
            <?php
            while ($asp_query->have_posts()) {
                $asp_query->the_post();
                $asp_price = number_format(get_post_meta(get_the_ID(), 'asp_product_price', true), 2);
                $description = get_post_meta(get_the_ID(), 'asp_product_description', true);
                $thumbnail = get_post_meta(get_the_ID(), 'asp_product_thumbnail_thumb', true);
                ?>
                <div class="col-md-4 text-center">
                    <div class="text-center py-3 mb-3">
                        <h2><?= get_the_title() ?></h2>
                        <p><?= $description ?></p>
                        <?php
                        if ($thumbnail) {
                            ?>
                            <img src="<?= $thumbnail ?>" class="h-100px w-auto mb-5"/>
                            <?php
                        }
                        ?>
                        <p class="fw-boldest">$<?= $asp_price ?></p>
                        <?php
                        echo do_shortcode('[accept_stripe_payment name="' . get_the_title() . '" product_id="' . get_the_ID() . '" button_text="Purchase Now" project_id="' . $atts["project_id"] . '"]');
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}


add_action('asp_stripe_payment_completed', 'aireno_mark_project_accepted_after_pay_fee', 10, 2);
function aireno_mark_project_accepted_after_pay_fee($data, $charge)
{
    $asp_product = $data['product_id'];
    $asp_categories = wp_get_post_terms($asp_product, 'asp-category');
    $asp_category = $asp_categories[0];
    $project_id = get_post_meta($asp_product, 'project_id', true);

    if (!$project_id) {
        $project_id = filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_NUMBER_INT, null);
    }
    $order_id = $data['order_post_id'];
    update_post_meta($order_id, 'project_id', $project_id);
    update_field('project_id', $project_id, $order_id);

    if ($project_id && $asp_category->slug == 'project-fee') {
        $user_id = get_current_user_id();
        $user_data = aireno_get_userdata($user_id);

        update_field('status', 'live', $project_id);
        update_field('client_approve', true, $project_id);

        aireno_add_activity($project_id, 'accept_quote', $user_data->display_name . ' accepted the project.', date_i18n('Y-m-d H:i:s'), get_current_user_id());;

        $project_users = aireno_get_project_users($project_id, $user_id);
        $title = $description = $user_data->display_name . " accepted project " . get_post($project_id)->post_title;
        $link = get_permalink($project_id);
        $content = aireno_encode_content(array('description' => $description, 'link' => $link));
        aireno_add_notification($title, $content, $project_users);
    }
}


add_filter('asp-button-output-data-ready', 'aireno_asp_button_output_data_ready', 10, 2);
function aireno_asp_button_output_data_ready($data, $atts)
{
    if (isset($atts['project_id'])) $data['project_id'] = $atts['project_id'];
    return $data;
}


add_filter('asp_ng_button_output_before_button', 'aireno_asp_ng_button_output_before_button', 10, 3);
function aireno_asp_ng_button_output_before_button($output, $data, $class)
{
    if (isset($data['project_id'])) {
        $insert = '<input type="hidden" name="project_id" value="' . $data['project_id'] . '" />';
        $strs = explode('</form>', $output);
        $output = $strs[0] . $insert . '</form>' . $strs[1];
    }
    return $output;
}


add_filter('asp_stripe_payments_checkout_page_result', 'aireno_change_project_fee_thankyou_page_content', 10, 2);
function aireno_change_project_fee_thankyou_page_content($output, $aspData)
{
    $order_post_id = $aspData['order_post_id'];
    $project_id = get_post_meta($order_post_id, 'project_id', true);

    $product_id = $aspData['product_id'];
    $asp_categories = wp_get_post_terms($product_id, 'asp-category');
    $asp_category = $asp_categories[0];
    if ($project_id) {
        $output = '';
        switch ($asp_category->slug) {
            case 'project-fee':
                $output .= '<p class="asp-thank-you-page-msg1 text-dark">' . __('Thank you for your payment.', TEXT_DOMAIN) . '</p>';
                $output .= '<p class="asp-thank-you-page-msg2 text-dark">You paid <span class="fw-boldest">{item_price_curr}</span> for Project acceptance.</p>';
                $output .= '<p class="asp-thank-you-page-msg2 text-dark"><span class="fw-boldest">' . __('Project Title: ', TEXT_DOMAIN) . '</span>' . get_post($project_id)->post_title . '</p>';
                //check if there are any additional items available like tax and shipping cost
                $output .= AcceptStripePayments::gen_additional_items($aspData, '<br />');
                $output .= '<div class="asp-thank-you-page-txn-id text-dark"><span class="fw-boldest">' . __('Transaction ID', TEXT_DOMAIN) . '</span>' . ': {transaction_id}' . '</div>';

                break;
            case 'project-addon':
                $output .= '<p class="asp-thank-you-page-msg1 text-dark">' . __('Thank you for your payment.', TEXT_DOMAIN) . '</p>';
                $output .= '<p class="asp-thank-you-page-msg2 text-dark">You paid <span class="fw-boldest">{item_price_curr}</span> for ' . '<span class="fw-boldest">'.$aspData['item_name'] . '</span> ' . $asp_category->name . '.</p>';
                $output .= '<p class="asp-thank-you-page-msg2 text-dark"><span class="fw-boldest">' . __('Project Title: ', TEXT_DOMAIN) . '</span>' . get_post($project_id)->post_title . '</p>';
                //check if there are any additional items available like tax and shipping cost
                $output .= AcceptStripePayments::gen_additional_items($aspData, '<br />');
                $output .= '<div class="asp-thank-you-page-txn-id text-dark"><span class="fw-boldest">' . __('Transaction ID', TEXT_DOMAIN) . '</span>' . ': {transaction_id}' . '</div>';
                break;
            default:
                break;
        }

        $output .= '<hr />';

        $link = get_permalink($project_id);
        $redirect_str = "";
        $redirect_str .= "<div class='asp-thank-you-page-download-link'>";
        $redirect_str .= "<a href='" . $link . "' class='btn btn-danger'>Return to Project</a>";
        $redirect_str .= '</div>';

        $output .= $redirect_str;

        $output .= '<style>.asp-thank-you-page-msg-wrap {background: #dff0d8; border: 1px solid #C9DEC1; margin: 10px 0px; padding: 15px;}</style>';
        $wrap = "<div class='asp-thank-you-page-wrap'>";
        $wrap .= "<div class='asp-thank-you-page-msg-wrap'>";
        $output = $wrap . $output;
        $output .= '</div>'; //end of .asp-thank-you-page-msg-wrap
        $output .= '</div>'; //end of .asp-thank-you-page-wrap
    }

    return $output;
}


//add_filter('asp_order_before_insert', 'aireno_asp_order_before_insert', 10, 3);
function aireno_asp_order_before_insert($post, $order_details, $charge_details)
{
    $output = '';

    // Add error info in case of failure
    if (!empty($charge_details->failure_code)) {
        $output .= '<h2>Payment Failure Details</h2>' . "\n";
        $output .= $charge_details->failure_code . ': ' . $charge_details->failure_message;
        $output .= "\n\n";
    } else {
        $post['post_status'] = 'publish';
    }

    $order_date = date('Y-m-d H:i:s', $charge_details->created);
    $order_date = get_date_from_gmt($order_date, get_option('date_format') . ', ' . get_option('time_format'));

    $output .= '<h2>' . __('Order Details', TEXT_DOMAIN) . "</h2>\n";
    $output .= __('Order Time', TEXT_DOMAIN) . ': ' . $order_date . "\n";
    $output .= __('Transaction ID', TEXT_DOMAIN) . ': ' . $charge_details->id . "\n";
    $output .= __('Stripe Token', TEXT_DOMAIN) . ': ' . $order_details['stripeToken'] . "\n";
    $output .= __('Description', TEXT_DOMAIN) . ': ' . $order_details['charge_description'] . "\n";
    $output .= '--------------------------------' . "\n";
    $output .= __('Product Name', TEXT_DOMAIN) . ': ' . $order_details['item_name'] . "\n";
    $output .= __('Quantity', TEXT_DOMAIN) . ': ' . $order_details['item_quantity'] . "\n";
    $output .= __('Item Price', TEXT_DOMAIN) . ': ' . AcceptStripePayments::formatted_price($order_details['item_price'], $order_details['currency_code']) . "\n";
    //check if there are any additional items available like tax and shipping cost
    $output .= AcceptStripePayments::gen_additional_items($order_details);
    $output .= '--------------------------------' . "\n";
    $output .= __('Total Amount', TEXT_DOMAIN) . ': ' . AcceptStripePayments::formatted_price(($order_details['paid_amount']), $order_details['currency_code']) . "\n";

    $output .= "\n\n";

    $output .= '<h2>' . __('Customer Details', TEXT_DOMAIN) . "</h2>\n";
    // translators: %s is email address
    $output .= sprintf(__('E-Mail Address: %s', TEXT_DOMAIN), $order_details['stripeEmail']) . "\n";
    // translators: %s is payment source (e.g. 'card' etc)
    $output .= sprintf(__('Payment Source: %s', TEXT_DOMAIN), $order_details['stripeTokenType']) . "\n";

    //Custom Fields (if set)
    if (isset($order_details['custom_fields'])) {
        $custom_fields = '';
        foreach ($order_details['custom_fields'] as $cf) {
            $custom_fields .= $cf['name'] . ': ' . $cf['value'] . "\r\n";
        }
        $custom_fields = rtrim($custom_fields, "\r\n");
        $output .= $custom_fields;
    }

    //Check if we have TOS enabled and need to store customer's IP and timestamp
    $asp_options = get_option('AcceptStripePayments-settings');
    $tos_enabled = $asp_options['tos_enabled'];
    $tos_store = $asp_options['tos_store_ip'];

    if ($tos_enabled && $tos_store) {
        $ip = !empty($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : __('Unknown', TEXT_DOMAIN);
        // translators: %s is IP address
        $output .= sprintf(__('IP Address: %s', TEXT_DOMAIN), $ip) . "\n";
    }

    //Billing address data (if any)
    if (isset($order_details['billing_address']) && strlen($order_details['billing_address']) > 5) {
        $output .= '<h2>' . __('Billing Address', TEXT_DOMAIN) . "</h2>\n";
        $output .= $order_details['billing_address'];
    }

    //Shipping address data (if any)
    if (isset($order_details['shipping_address']) && strlen($order_details['shipping_address']) > 5) {
        $output .= '<h2>' . __('Shipping Address', TEXT_DOMAIN) . "</h2>\n";
        $output .= $order_details['shipping_address'];
    }

    $post['post_content'] = $output;
    return $post;
}


add_filter('asp_buyer_email_subject', 'asp_buyer_email_from', 10, 2);
function asp_buyer_email_from($subj, $post_data) {
    $order_post_id = $post_data['order_post_id'];
    $project_id = get_field('project_id', $order_post_id);
    $product_id = $post_data['product_id'];
    $asp_categories = wp_get_post_terms($product_id, 'asp-category');
    $asp_category = $asp_categories[0];
    switch ($asp_category->slug) {
        case 'project-fee':
            $subj = 'Congratulations you’ve successfully accepted your quote';
            break;
        case 'project-addon':
            $subj = 'You’ve successfully purchased a project upgrade on ' . get_post($project_id)->post_title;
            break;
        default:
            break;
    }
    return $subj;
}


add_filter('asp_buyer_email_body', 'aireno_asp_buyer_email_body', 10, 3);
function aireno_asp_buyer_email_body($body, $post_data, $seller_email = false){
    $order_post_id = $post_data['order_post_id'];
    $project_id = get_field('project_id', $order_post_id);
    $product_id = $post_data['product_id'];
    $asp_categories = wp_get_post_terms($product_id, 'asp-category');
    $asp_category = $asp_categories[0];
    $link = get_permalink($project_id);
    $link_tag = '<p><a href="'.$link.'" style="padding:5px 7px; color:white; font-weight:900; background: deeppink;">Open Project</a></p>';
    switch ($asp_category->slug) {
        case 'project-fee':
            $output = '<p>Congratulations! You just accepted in your online quote, login to review your project. </p>';
            $body = $output . $body;
            $body .= $link_tag;
            break;
        case 'project-addon':
            $output = '<p>This is confirmation for purchasing your project upgrade addon for '.get_post($project_id)->post_title.', our team will be in touch shortly to get started. Thanks</p>';
            $body = $output . $body;
            $body .= $link_tag;
            break;
        default:
            break;
    }
    return $body;
}


add_filter('asp_buyer_email_from', 'aireno_asp_buyer_email_from', 10, 2);
function aireno_asp_buyer_email_from($from, $post_data){
    $from = get_field('email_from_address','options');
    return $from;
}