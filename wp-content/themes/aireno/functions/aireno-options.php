<?php
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => __('Global Settings', TEXT_DOMAIN),
        'menu_title' => __('Global Settings', TEXT_DOMAIN),
        'menu_slug' => 'aireno-global',
    ));

    acf_add_options_sub_page(array(
        'page_title' => __('Emailing Settings', TEXT_DOMAIN),
        'menu_title' => __('Emailing Settings', TEXT_DOMAIN),
        'parent_slug' => 'aireno-global',
    ));

    acf_add_options_sub_page(array(
        'page_title' => __('Master Pricing', TEXT_DOMAIN),
        'menu_title' => __('Master Pricing', TEXT_DOMAIN),
        'parent_slug' => 'aireno-global',
    ));

    add_filter( 'wp_mail_from', 'custom_wp_mail_from' );
    function custom_wp_mail_from( $original_email_address ) {
        //Make sure the email is from the same domain
        //as your website to avoid being marked as spam.
        $from = get_field('email_from_address','options');
        return $from;
    }

    add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );
    function custom_wp_mail_from_name( $original_email_from ) {
        $from = get_field('email_from','options');
        return $from;
    }

//    acf_add_options_sub_page(array(
//        'page_title' => __('Invoice Settings', TEXT_DOMAIN),
//        'menu_title' => __('Invoice Settings', TEXT_DOMAIN),
//        'parent_slug' => 'aireno-global',
//    ));
//
//    acf_add_options_sub_page(array(
//        'page_title' => __('Default Proposal', TEXT_DOMAIN),
//        'menu_title' => __('Default Proposal', TEXT_DOMAIN),
//        'parent_slug' => 'aireno-global',
//    ));
//    acf_add_options_sub_page(array(
//        'page_title' => __('Strings', TEXT_DOMAIN),
//        'menu_title' => __('Strings', TEXT_DOMAIN),
//        'parent_slug' => 'aireno-global',
//    ));
//    acf_add_options_sub_page(array(
//        'page_title' => __('Calculator', TEXT_DOMAIN),
//        'menu_title' => __('Calculator', TEXT_DOMAIN),
//        'parent_slug' => 'aireno-global',
//    ));
//
//    acf_add_options_sub_page(array(
//        'page_title' => __('Service Block', TEXT_DOMAIN),
//        'menu_title' => __('Service Block', TEXT_DOMAIN),
//        'parent_slug' => 'aireno-global',
//    ));
}