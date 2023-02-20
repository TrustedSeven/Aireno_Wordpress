<?php
 
 // ============================================================================================= //
 // ================================ wp-phpMyAdmin addition ===================================== //
 // ============================================================================================= //
 
function WP_PHPMYADMIN_CONFIG_ADDITION($DIR_PATH)
{
	$libdir = $DIR_PATH; //__DIR__

	//note, cookies are nulled after the below "use" namespaces load, so lets check here.
	$file = dirname(dirname($libdir))."/_session_temp.php";  	if (!file_exists($file)) exit("session file doesn't exist. This might happen if your wordpress does not have write permissions, try to fix it and re-login into phpMyAdmin from plugin dashboard page.");
	include($file);
	$your_ip 			= $_SERVER['REMOTE_ADDR'];
	$expiration_hours   = 1;
	$incorrect_session	= ( empty($_COOKIE[$sess_vars["name"]]) ||  $_COOKIE[$sess_vars["name"]] !=  $sess_vars["value"]);
	$incorrect_ip		= ( $sess_vars['require_ip'] && $your_ip !== $sess_vars['ip'] );
	$incorrect_time		= $sess_vars['time'] < time() - $expiration_hours*60*60;
	if( $incorrect_session || $incorrect_ip || $incorrect_time )	{
		$notice = $incorrect_session ? "Session mismatch." : ($incorrect_ip ? "Your IP ($your_ip) not allowed. If your ISP provider assigns you the dynamic IP address on each request, then you can temporarily disable the checkbox <code style='background:#e7e7e7;'>Restrict access only to current IP</code> on settings page (and after you are done with your work in PhpMyAdmin, enable that checkbox again, so you dont leave it unchecked)." : ($incorrect_time ? "Session time ($expiration_hours hours) expired." : "Undefined")); 
		exit($notice ."<br/> Go back and click <b>Enter phpMyAdmin</b> button again. If you still experience issue, try to open a ticket at <a href=\"https://wordpress.org/support/plugin/wp-phpmyadmin-extension/\">Support pages</a> and provide some details.");
	}
	else{
		define('wp_pma_allowed', true);
	}

}

// ============================================================================================= //
// ============================================================================================= //
// ============================================================================================= //