<?php
/**
 * Plugin Name: Paid Memberships Pro - Kissmetrics Add On
 * Plugin URI: https://www.paidmembershipspro.com/add-ons/pmpro-kissmetrics/
 * Description: Integrates your WordPress site with Kissmetrics to track meaningful user data, with or without Paid Memberships Pro.
 * Version: .3.1
 * Author: Stranger Studios
 * Author URI: https://www.paidmembershipspro.com
 * Text Domain: pmpro-kissmetrics
 */

/*
 * Globals
 */
global $pmprokm_options;

$pmprokm_options = get_option('pmprokm_options');

if(empty($pmprokm_options)) {
    $pmprokm_options = array(
        'apikey' => '',
        'js' => '',
        'identify_by' => 'user_login',
        'track_wp_registrations' => '',
        'track_wp_logins' => '',
        'track_pmpro_pages' => '',
        'track_pmpro_cancel' => '',
        'track_pmpro_change_level' => '',
        'track_pmpro_checkout' => '',
        'track_pmpro_total' => '',
        'track_pmpro_trials' => '',
        'track_pmpro_discount_codes' => ''
    );
}

/*
 * Requires
 */
require_once(plugin_dir_path(__FILE__) . '/includes/lib/km.php');   //Kissmetrics PHP Library
require_once(plugin_dir_path(__FILE__) . '/includes/init.php');     //plugin initialization

/*
 * Identify for KM
 */
function pmprokm_identify($user_id = NULL, $how = NULL)
{
	global $pmprokm_options;
	
	//default user id
	if(empty($user_id))
	{
		global $current_user;
		$user_id = $current_user->ID;
	}

	//make sure we have a user id
	if(empty($user_id))
		return false;	
	$user = get_userdata($user_id);
	
	//make sure we have a user
	if(empty($user->ID))
		return false;
		
	//how?
	if(empty($how))
		$how = $pmprokm_options['identify_by'];
		
	//identify
    if($how == "user_email")
		KM::identify($user->user_email);
	elseif($how == "display_name")
		KM::identify($user->display_name);
	else
		KM::identify($user->user_login);
		
	//got here return true
	return true;
}

/*
 * Track WP Events
 */

//User registers
function pmprokm_user_register($user_id) {

    global $pmprokm_options;

    if(!defined('PMPROKM_READY') || empty($pmprokm_options['track_wp_registrations']))
        return;

    $user = get_userdata($user_id);
    $props = array(
        'WP Username' => $user->user_login,
        'Email Address' => $user->user_email,
        'Display Name' => $user->display_name,
        'User ID' => $user_id
    );

	//switch KM identity to affected user
	pmprokm_identify($user_id);
	
    KM::record('Registered', $props);
}
add_action('user_register', 'pmprokm_user_register');

//User logs in
function pmprokm_wp_login($user_login, $user) {

    global $pmprokm_options;

    if(!defined('PMPROKM_READY') || empty($pmprokm_options['track_wp_logins']))
        return;

	//switch KM identity to affected user
	pmprokm_identify($user->ID);
		
    KM::record('Logged in');

}
add_action('wp_login', 'pmprokm_wp_login', 10, 2);

/*
 * Track PMPro Events
 */

//User visits any PMPro front end page
function pmprokm_template_redirect() {

    global $post, $pmpro_pages, $pmprokm_options;

    if(!defined('PMPROKM_READY') || empty($pmprokm_options['track_pmpro_pages']))
        return;

    if(in_array($post->ID, $pmpro_pages)) {

        $event = 'Visited PMPro ' . ucfirst(array_search($post->ID, $pmpro_pages)) . ' Page';

        //include selected level if we're on che checkout page
        if($post->ID == $pmpro_pages['checkout']) {
            $level = pmpro_getLevel($_REQUEST['level']);
            $event .= ' (' . $level->name . ')';
        }

		//identify as current user if possible
		pmprokm_identify();
		
        //record event
        KM::record($event);
    }
}
add_action('template_redirect', 'pmprokm_template_redirect');

//User changes level or cancels
function pmprokm_after_change_membership_level($level_id, $user_id) {

    global $current_user, $pmprokm_options;

    if(!defined('PMPROKM_READY'))
        return;

    //switch KM identity to affected user
    pmprokm_identify($user_id);

    //user changed level
    if(!empty($pmprokm_options['track_pmpro_change_level']) && !empty($level_id)) {
        $level = pmpro_getLevel($level_id);
        KM::record('Membership Level Changed', array('Membership Level' => $level->name));
    }

    //user cancelled
    if(!empty($pmprokm_options['track_pmpro_cancel']) && pmpro_hasMembershipLevel(0, $user_id)) {
        KM::record('Membership Level Cancelled');
    }

}
add_action('pmpro_after_change_membership_level', 'pmprokm_after_change_membership_level', 10, 2);

//User checks out
function pmprokm_after_checkout($user_id) {

    global $current_user, $pmprokm_options, $discount_code;

    if(!defined('PMPROKM_READY'))
        return;

	//switch KM identity to affected user
	pmprokm_identify($user_id);

    $order = new MemberOrder;
    $order->getLastMemberOrder($user_id, 'success');
    $level = pmpro_getLevel($order->membership_id);
		
    if(!empty($pmprokm_options['track_pmpro_checkout'])) {
        $props = array(
            'Last Order ID' => $order->id
        );

        if(!empty($pmprokm_options['track_pmpro_total']))
            $props['Total'] = $order->total;		
			
        //track event
        KM::record('Checked Out', $props);
    }

    //track discount code usage if enabled
    if(!empty($discount_code) && !empty($pmprokm_options['track_pmpro_discount_codes']))
        KM::record('Discount Code Used', array('Discount Code' => $discount_code));

    //if level contains trial, track trial as well
    
    // Because trial can mean different things to different systems, let's give
    // some flexibility through a filter. Default is that it's a trial if trial_limit>0.
    $is_trial = apply_filters('pmprokm_is_trial', $level->trial_limit > 0, $level);
    
    if($is_trial && !empty($pmprokm_options['track_pmpro_trials']))
        KM::record('Started Trial');
}
add_action('pmpro_after_checkout', 'pmprokm_after_checkout');



/*
 * Setup Settings Page
 */
function pmprokm_admin_menu() {
    add_options_page('PMPro Kissmetrics Settings', 'PMPro Kissmetrics', apply_filters('pmpro_edit_member_capability', 'manage_options'), 'pmpro-kissmetrics', 'pmprokm_settings_page');
}
add_action('admin_menu', 'pmprokm_admin_menu');

function pmprokm_admin_init() {

    //register setting
    register_setting('pmprokm_options', 'pmprokm_options');

    //add settings sections
    add_settings_section('pmprokm_general', 'General Settings', 'pmprokm_general', 'pmpro-kissmetrics');
    add_settings_section('pmprokm_wp', 'WordPress User Tracking', 'pmprokm_wp', 'pmpro-kissmetrics');

    if(defined('PMPRO_VERSION'))
        add_settings_section('pmprokm_pmpro', 'Paid Memberships Pro Tracking', 'pmprokm_pmpro', 'pmpro-kissmetrics');

    //add settings fields
    add_settings_field('apikey', 'API Key', 'pmprokm_apikey', 'pmpro-kissmetrics', 'pmprokm_general');
    add_settings_field('js', 'JavaScript Tracking Code', 'pmprokm_js', 'pmpro-kissmetrics', 'pmprokm_general');
    add_settings_field('identify_by', 'Identify By', 'pmprokm_identify_by', 'pmpro-kissmetrics', 'pmprokm_wp');
    add_settings_field('track_wp_registrations', 'Track Registrations', 'pmprokm_track_wp_registrations', 'pmpro-kissmetrics', 'pmprokm_wp');
    add_settings_field('track_wp_logins', 'Track Logins', 'pmprokm_track_wp_logins', 'pmpro-kissmetrics', 'pmprokm_wp');

    if(defined('PMPRO_VERSION')) {
        add_settings_field('track_pmpro_pages', 'Track PMPro Front End Page Visits', 'pmprokm_track_pmpro_pages', 'pmpro-kissmetrics', 'pmprokm_pmpro');
        add_settings_field('track_pmpro_change_level', 'Track Membership Level Changes', 'pmprokm_track_pmpro_change_level', 'pmpro-kissmetrics', 'pmprokm_pmpro');
        add_settings_field('track_pmpro_cancel', 'Track Membership Cancellations', 'pmprokm_track_pmpro_cancel', 'pmpro-kissmetrics', 'pmprokm_pmpro');
        add_settings_field('track_pmpro_checkout', 'Track Membership Checkouts', 'pmprokm_track_pmpro_checkout', 'pmpro-kissmetrics', 'pmprokm_pmpro');
        add_settings_field('track_pmpro_discount_codes', 'Track Discount Code Usages', 'pmprokm_track_pmpro_discount_codes', 'pmpro-kissmetrics', 'pmprokm_pmpro');
        add_settings_field('track_pmpro_total', 'Track Checkout Total', 'pmprokm_track_pmpro_total', 'pmpro-kissmetrics', 'pmprokm_pmpro');
        add_settings_field('track_pmpro_trials', 'Track Membership Trials', 'pmprokm_track_pmpro_trials', 'pmpro-kissmetrics', 'pmprokm_pmpro');
    }

}
add_action('admin_init', 'pmprokm_admin_init');

function pmprokm_settings_page() {
    require_once(plugin_dir_path(__FILE__) . '/adminpages/settings.php');
}

/*
Function to add links to the plugin action links
*/
function pmprokm_add_action_links($links) {
	
	$new_links = array(
			'<a href="' . get_admin_url(NULL, 'options-general.php?page=pmpro-kissmetrics') . '">Settings</a>',
	);
	return array_merge($new_links, $links);
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'pmprokm_add_action_links');


/**
 * Load the languages folder for translations.
 */
function pmprokm_load_textdomain(){
	load_plugin_textdomain( 'pmpro-kissmetrics', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'pmprokm_load_textdomain' );

/*
Function to add links to the plugin row meta
*/
function pmprokm_plugin_row_meta($links, $file) {
	if(strpos($file, 'pmpro-kissmetrics.php') !== false)
	{
		$new_links = array(
			'<a href="' . esc_url('https://www.paidmembershipspro.com/add-ons/pmpro-kissmetrics/') . '" title="' . esc_attr( __( 'View Documentation', 'pmpro' ) ) . '">' . __( 'Docs', 'pmpro' ) . '</a>',
			'<a href="' . esc_url('http://paidmembershipspro.com/support/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro' ) ) . '">' . __( 'Support', 'pmpro' ) . '</a>',
		);
		$links = array_merge($links, $new_links);
	}
	return $links;
}
add_filter('plugin_row_meta', 'pmprokm_plugin_row_meta', 10, 2);
