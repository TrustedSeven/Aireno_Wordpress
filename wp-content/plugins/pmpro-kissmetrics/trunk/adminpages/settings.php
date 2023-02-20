<?php

/*
 * Display Settings Sections
 */
function pmprokm_general() {
    ?>
    <p><?php _e('Enter your API key and JavaScript Tracking Code in the fields below. These values can be found on the "Site Settings" page in the Kissmetrics dashboard.', 'pmpro-kissmetrics'); ?></p>
    <?php
}
function pmprokm_wp() {}
function pmprokm_pmpro() {}

/*
 * Display Settings Fields
 */

//general settings
function pmprokm_apikey() {
    global $pmprokm_options;
    ?>
    <input type="text"  name="pmprokm_options[apikey]" size=45 value="<?php echo $pmprokm_options['apikey']; ?>">
<?php
}
function pmprokm_js() {
    global $pmprokm_options;
    ?>
    <textarea rows=13 cols=80 name="pmprokm_options[js]"><?php echo $pmprokm_options['js']; ?></textarea>
<?php
}

//wordpress tracking settings
function pmprokm_identify_by() {
    global $pmprokm_options;
    ?>
    <select name="pmprokm_options[identify_by]">
        <option value="user_login" <?php selected($pmprokm_options['identify_by'], 'user_login'); ?>><?php _e('Username', 'pmpro-kissmetrics'); ?></option>
        <option value="user_email" <?php selected($pmprokm_options['identify_by'], 'user_email'); ?>><?php _e('Email', 'pmpro-kissmetrics'); ?></option>
        <option value="display_name" <?php selected($pmprokm_options['identify_by'], 'display_name'); ?>><?php _e('Display Name', 'pmpro-kissmetrics'); ?></option>
    </select>
<?php
}
function pmprokm_track_wp_registrations() {
    global $pmprokm_options;
    ?>
    <input id="track_wp_registrations" type="checkbox" name="pmprokm_options[track_wp_registrations]" value="1"
        <?php if(!empty($pmprokm_options['track_wp_registrations'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_wp_logins() {
    global $pmprokm_options;
    ?>
    <input id="track_wp_logins" type="checkbox"  name="pmprokm_options[track_wp_logins]" value="1"
        <?php if(!empty($pmprokm_options['track_wp_logins'])) echo 'checked="true"'; ?>>
<?php
}

//pmpro tracking settings
function pmprokm_track_pmpro_pages() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_pages" type="checkbox"  name="pmprokm_options[track_pmpro_pages]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_pages'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_pmpro_change_level() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_change_level" type="checkbox"  name="pmprokm_options[track_pmpro_change_level]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_change_level'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_pmpro_cancel() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_cancel" type="checkbox"  name="pmprokm_options[track_pmpro_cancel]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_cancel'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_pmpro_checkout() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_checkout" type="checkbox"  name="pmprokm_options[track_pmpro_checkout]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_checkout'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_pmpro_total() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_total" type="checkbox"  name="pmprokm_options[track_pmpro_total]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_total'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_pmpro_trials() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_trials" type="checkbox"  name="pmprokm_options[track_pmpro_trials]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_trials'])) echo 'checked="true"'; ?>>
<?php
}
function pmprokm_track_pmpro_discount_codes() {
    global $pmprokm_options;
    ?>
    <input id="track_pmpro_discount_codes" type="checkbox"  name="pmprokm_options[track_pmpro_discount_codes]" value="1"
        <?php if(!empty($pmprokm_options['track_pmpro_discount_codes'])) echo 'checked="true"'; ?>>
<?php
}

/*
 * Display Page
 */
?>

<div class="wrap">
    <h2><?php _e('Kissmetrics Integration Settings', 'pmpro-kissmetrics'); ?></h2>
    <p><?php echo sprintf('This plugin integrates your WordPress site with %s to track meaningful user data, with or without %s.', '<a href="https://www.kissmetrics.com" target="_blank">Kissmetrics</a>', '<a href="https://www.paidmembershipspro.com" target="_blank">Paid Memberships Pro</a>', 'pmpro-kissmetrics'); ?></p>
	<hr />
    <form action="options.php" method="POST">
        <?php
        settings_fields('pmprokm_options');
        do_settings_sections('pmpro-kissmetrics');
        submit_button();
        ?>
    </form>
</div>