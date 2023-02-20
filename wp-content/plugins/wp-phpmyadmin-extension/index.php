<?php
/*
 * Plugin Name:       WP phpMyAdmin
 * Description:       The famous database browser & manager (for MySQL & MariaDB) - use it inside WordPress Dashboard without an extra hassle.
 * Text Domain:       wp-phpmyadmin-extension
 * Domain Path:       /languages
 * Version:           5.2.1
 * WordPress URI:     https://wordpress.org/plugins/wp-phpmyadmin-extension/
 * Plugin URI:        https://puvox.software/software/wordpress-plugins/?plugin=wp-phpmyadmin-extension
 * Contributors:      puvoxsoftware,ttodua
 * Author:            Puvox.software
 * Author URI:        https://puvox.software/
 * Donate Link:       https://paypal.me/Puvox
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 
 * @copyright:        Puvox.software
*/

declare(strict_types=1);

namespace WpPhpMyAdminExtension
{
  if (!defined('ABSPATH')) exit;
  require_once( __DIR__."/library.php" );
  require_once( __DIR__."/library_wp.php" );
  
  class PluginClass extends \Puvox\wp_plugin
  {

    protected $required_version = "7.2.0";

    public function declare_settings()
    {
        $this->initial_static_options    =
        [
            'has_pro_version'        => 0, 
            'show_opts'              => true, 
            'show_rating_message'    => true, 
            'show_donation_footer'   => true, 
            'show_donation_popup'    => true, 
            'menu_pages'             => [
                'first' =>[
                    'title'           => 'WP-phpMyAdmin', 
                    'default_managed' => 'network',            // network | singlesite
                    'required_role'   => 'install_plugins',
                    'level'           => 'mainmenu', 
                    'icon'            => $this->helpers->baseURL.'assets/media/menu_icon.png', 
                    'page_title'      => 'WP phpMyAdmin Options page',
                    'tabs'            => [],
                ],
            ]
        ];
    
        $this->initial_user_options   = 
        [        
            'randomCookieName'       => "pma_".$this->helpers->randomString(16), 
            'randomCookieValue'      => "pma_".$this->helpers->randomString(16), 
            'RandomFolderSuffix'     => "_".$this->helpers->randomString(23), 
            'manual_pma_login_url'   => '',
            'require_ip'             => true,
            'hide_phma_errors'       => false,
            'strip_slashes'          => true,
            'use_https'              => false,
            'is_localhost'           => $this->helpers->is_localhost
        ];
        
        $this->is_new_php = $this->helpers->above_version($this->required_version);
    }

    //by default, this will is disabled per requirements. Users can enable only for themselves.
    private $allow_work = true;
    
    public function __construct_my()
    {
        add_action('admin_init', [$this, 'setup_definitions'], 2 );
        add_action('admin_init', [$this, 'if_needs_redirect_to_pma'], 3);
        add_action('wp_logout', [$this, 'logout_pma_clear'], 33 );
    }

    // =========================================================================== //
    // =========================================================================== //

    public function setup_definitions()
    {
        // Don't save in DB table ! this is for multi-instance installations
        try{
            $prefix = '<?php //';
            if ( file_exists($a=__DIR__.'/lib/name.php') ) {
                $suffix = str_replace($prefix, '', file_get_contents($a));
            }
            else {
                $suffix = $this->opts['RandomFolderSuffix'];
                $this->file_put_contents($a, $prefix . $suffix);
            }
        }
        catch(\Exception $ex){
            _e("DIRECTORY SEEMS NOT WRITABLE! WP-PHPMYADMIN PLUGIN WILL NOT WORK. Fix the permissions, or delete the plugin.");
            echo $ex->getMessage();
            $this->allow_work=false;
            return;
        }

        $this->lib_relpath            = '/lib';    
        $this->lib_absPath            = __DIR__ . $this->lib_relpath;      
        $this->pma_name               = "phpMyAdmin". $suffix;   
        $this->pma_name_real          = "phpMyAdmin"; 
        $this->pma_relpath            = $this->lib_relpath . '/'. $this->pma_name;
        $this->pma_relpath_real       = $this->lib_relpath . '/'. $this->pma_name_real;
        $this->pma_abspath            = __DIR__ . $this->pma_relpath;     
        $this->pma_abspath_real       = __DIR__ . $this->pma_relpath_real;
         
        $this->pma_mainpage_from_plugin= $this->pma_relpath.'/index.php' ;
        $this->pma_mainpage_url      = $this->helpers->baseURL    . substr($this->pma_mainpage_from_plugin,1);
        $this->pma_mainpage_path     = $this->pma_abspath    . '/index.php';
        
        $this->pma_zipPath           = $this->lib_absPath    . '/phpMyAdmin.zip'; 
        $this->pma_langfiles_zipPath = $this->lib_absPath    . '/phpMyAdmin_langs.zip'; 
        $this->pma_sessionfile       = $this->pma_abspath    . '/_session_temp.php'; 
        $this->pma_sessionAllowfile  = $this->pma_abspath    . '/_session_temp_allow.php';
        $this->pma_sessionDbfile     = $this->pma_abspath    . '/_session_temp_db_name_'. $this->helpers->array_value($_SERVER,'HTTP_HOST','undefined_server') .'.php';
        $this->path_to_pma_config    = $this->pma_abspath    . '/config.inc.php';
        $this->path_to_def_config    = __DIR__ . '/default_config.php';
        $this->path_to_pma_common    = $this->pma_abspath    . '/libraries/classes/Common.php';
        $this->path_to_def_common    = __DIR__ . '/default_common_inc_code.php';
        //deleted targets //details: https://goo.gl/tCWdEv
        $this->pma_delete_dirs       = [ '/js/src', '/vendor/tecnickcom/tcpdf', '/locale', '/themes/original', '/themes/bootstrap', '/themes/metro', '/doc', '/setup', '/examples', '/install', '/js/vendor/openlayers', '/vendor/phpmyadmin/sql-parser/locale'];      //
        $this->pma_delete_files      = ['/ChangeLog', '/composer.lock', '/yarn.lock'];    
        $this->pma_create_files      = ['/vendor/tecnickcom/tcpdf/tcpdf.php'];    
        $this->conflict_file_1       = $this->pma_abspath . '/vendor/phpmyadmin/motranslator/src/functions.php';
        $this->replace_export_pdf_file= $this->pma_abspath . '/libraries/classes/Pdf.php';
    }
     
    private function installed() {
        return !(is_dir($this->pma_abspath_real) && !is_dir($this->pma_abspath) );
    }
    private function initialize_unpacked_pma()
    {
        if (!$this->installed())  
        {
            // avoid simultaneous re-creations caused by WP load from other instances
            $this->lockFile=__DIR__."/install_lock.txt";
            $this->locker    = fopen( $this->lockFile, "w+"); 
            if (flock($this->locker,LOCK_EX))  
            { 
                if(!$this->installed()) //check again after LOCK 
                {
                    $this->helpers->try_increase_exec_time(120);

                    //rename files
                    $dir = $this->pma_abspath_real; // $this->getPMA_FolderName();
                    // private function getPMA_FolderName(){
                    //     $x = glob($this->lib_absPath.'/phpMyAdmin*',  GLOB_ONLYDIR);  return (!empty($x) ? $x[0] : "");
                    // }

                    if(!empty($dir) && !rename($dir, $this->pma_abspath )) {
                        exit(__('Failure: can\'t rename <code>'.$dir.'</code> to <code>'.$this->pma_abspath.'</code>. Either do it manually from FTP, or try completely re-install the plugin.', 'wp-phpmyadmin-extension') );
                        usleep(500000);
                    }

                    // delete extra directories
                    foreach($this->pma_delete_dirs as $eachDir){
                        $fullPath = $this->helpers::realpath($this->pma_abspath.'/'.$eachDir.'/');
                        if( is_dir($fullPath) ){
                            $this->helpers->file->delete_directory($fullPath);
                        }
                    }
                    // delete extra files
                    foreach($this->pma_delete_files as $eachFile){
                        $fullPath = $this->pma_abspath.'/'.$eachDir.'/';
                        if( file_exists($fullPath) ){
                            unlink($fullPath);
                        }
                    }

                    // strip-out PDF export functionality (because we have removed technikPdf package from vendor-libraroes to save space)
                    $this->file_put_contents($this->replace_export_pdf_file, '<?php declare(strict_types=1);  namespace PhpMyAdmin { class Pdf { public function __construct() { } } }');

                    // create extra directories & files
                    foreach($this->pma_create_files as $eachFile){
                        $file = $this->pma_abspath.'/'.$eachFile; $this->helpers->file->create_directory( dirname($file) );
                        $this->file_put_contents($file,""); 
                    }


                    // create config
                    if(is_admin())
                    {
                        $force =  false;
                        if( $this->helpers->is_localhost != $this->opts['is_localhost']){
                            $force =  true;
                            $this->opts['is_localhost']=$this->helpers->is_localhost;
                            $this->update_opts();
                        }
                        // MY NOTE: config.inc.php should alwyas be in pma folder 
                        // include_once( dirname( dirname(dirname( dirname(__DIR__) ) ) ).'/wp_phpmyadmin_config.inc.php' );
                        if(!file_exists($this->path_to_pma_config) || $force)
                        {
                            $content = file_get_contents($this->path_to_def_config);
                            $content = str_replace('___ALLOWNOPASS___',            ($this->helpers->is_localhost ? "true" : "false"),                $content);
                            $content = str_replace('___BLOWFISHSECRET___',        '\''. addslashes($this->create_blowfish_secret()).'\'',    $content);
                            $content = str_replace('___LANG___',                '\''.$this->static_settings['lang'].'\'',                $content);
                            $content = str_replace('___DBARRAY___',                '[file_get_contents(__DIR__."/_session_temp_db_name_".$_SERVER["HTTP_HOST"].".php")]',    $content);   //DB_NAME //$_COOKIE["pma_DB_NAME"]
                                        $path_to_index =str_replace( $this->helpers->domain,'', $this->helpers->OneSlash($this->helpers->baseURL . $this->pma_relpath))."/";
                            $content = str_replace('___PmaAbsoluteUri___',    "'$path_to_index'",    $content);
                            $content = str_replace('___SignOnUri___',    "'".$this->pmaLoginUrl()."'",    "$content");
                            $content = str_replace('___LogoutURL___',    "'".$this->pmaLogoutUrl()."'",    "$content");
                            //$content = str_replace( '___RELATIVEPATHTOFOLDER___',    '\'/plugins/wp-phpmyadmin/'.$this->pma_dirname.'\'',    $content);  
                            //
                            //$content = str_replace('___RESTRICTORCOOKIENAME___','\''.$this->opts['randomCookieName'].'\'',        $content);  
                            //$content = str_replace('___RESTRICTORCOOKIEVALUE___','\''.$this->opts['randomCookieValue'].'\'',    $content);  
                            
                            //solution for socket connections too , like : 'localhost:/run/mysqld/mysqld10.sock'
                            $dbhost    = DB_HOST;
                            $dbport    = '';
                            $connectionType    ='tcp';
                            $socket            ='';
                            // if custom format, i.e. .sock/mysql or 123.123.123.123:xxx
                            if( stripos($dbhost, ':')!==false )
                            {
                                if ( stripos($dbhost, '.sock')!==false ||  stripos($dbhost, '/mysql')!==false )
                                {
                                    preg_match('/(.*?):(.*)/', $dbhost, $n);
                                    if (!empty($n[2]))
                                    {
                                        $dbhost = $n[1];
                                        $connectionType = 'socket';
                                        $socket    = $n[2];
                                    }
                                }
                                else
                                {
                                    preg_match('/(.*?):(.*)/', $dbhost, $n);
                                    if (!empty($n[2]))
                                    {
                                        $dbhost = $n[1];
                                        $dbport    = $n[2];
                                    }
                                }
                            }
                            $content = str_replace('___HOSTADR___',             "'$dbhost'",                             $content);
                            $content = str_replace('___PORTADR___',             "'$dbport'",                             $content);
                            $content = str_replace('___CONNECTIONTYPE___',         "'$connectionType'",                     $content);
                            $content = str_replace('___SOCKET___',                 "'$socket'",                             $content);
                            $this->file_put_contents($this->path_to_pma_config, $content);
                        }
                    }
                    
                    //add content into common.inc
                    $cont = file_get_contents($this->path_to_pma_common);
                    $flag = "//_WPMA__REPLACED_\r\n";
                    if ( stripos($cont,$flag) === false )
                    {
                        $addition= $flag . 'require_once(__DIR__."/../../../../'.basename($this->path_to_def_common).'"); WP_PHPMYADMIN_CONFIG_ADDITION(__DIR__);';
                        if (stripos($cont,$phrase='ServerRequestFactory::createFromGlobals();')!==false) {
                            $common_inc_content_new  = $this->helpers->str_replace_first( $phrase, $phrase."\r\n".$addition, $cont );
                        }
                        else
                        {
							wp_die(__("internal issue of WP-phpMyAdmin plugin, as seems PMA changed their internal approach. Please report us by opening a ticket at https://wordpress.org/support/plugin/wp-phpmyadmin-extension/"));
                        }
                        $this->file_put_contents( $this->path_to_pma_common, $common_inc_content_new);
                    }

                    // rename conflicting function named __(    //old method: pastebin_com/raw/v652Ef1A
                    //$file = $this->pma_abspath .'/vendor/phpmyadmin/motranslator/src/functions.php';
                    //file_put_contents( $file,   str_replace('function __(', 'if (!function_exists("__")) { function __($str) { return __RENAMED(function __RENAMED(', file_get_contents($file) ) );
                    
                    //$this->createHtaccessDirDisableBrowsing( $this->lib_absPath );
                }
                flock($this->locker,LOCK_UN);
            } //end locker
            fclose($this->locker);
            if (file_exists($this->lockFile)) @unlink($this->lockFile);
        }
    }
    

    
    //from PMA
    // same as:  public function generateRandom($length)

    private function create_blowfish_secret(){
        $blowfishSecret = '';
        $random_func = (function_exists('openssl_random_pseudo_bytes')) ? 'openssl_random_pseudo_bytes' : 'phpseclib\\Crypt\\Random::string';
        while (strlen($blowfishSecret) < 32) {
            $byte = $random_func(1);
            // We want only ASCII chars
            if (ord($byte) > 32 && ord($byte) < 127) {
                $blowfishSecret .= $byte;
            }
        }
        return $blowfishSecret;
    }


    // ======

    public function create_session_file($force=false){ 
        $new_content = '<?php $sess_vars = ["time"=>'.time().', "name"=>"wp_pma_'.$this->helpers->randomString(14).'",  "value"=>"wp_pma_'.$this->helpers->randomString(23).'",  "require_ip"=>'.($this->opts['require_ip']? 'true':'false').', "ip"=>"'.$this->helpers->ip.'", "strip_slashes"=>'. ($this->opts['strip_slashes']? 'true':'false') .'];'; 

        $create=false;
        if($force || !file_exists($this->pma_sessionfile)){
            $create= true;
        }
        else{
            include($this->pma_sessionfile);
            //don't reset if login happens in last 30 seconds again.
            if( $sess_vars["time"] + 30 < time() ){
                $create = true;
            }
        } 
        if ($create) $this->file_put_contents($this->pma_sessionfile, $new_content);
    } 


    public function session_pre_pma(){
        // Use cookies for session 
        ini_set('session.use_cookies', 'true');
        // Change this to true if using phpMyAdmin over https
        $secure_cookie = $this->helpers->is_https;
        // Need to have cookie visible from parent directory
        session_set_cookie_params(0, '/', '', $secure_cookie, true);
        // Create signon session
        $session_name = 'SignonSession';
        session_name($session_name);
        // Uncomment and change the following line to match your $cfg['SessionSavePath']
        session_save_path(sys_get_temp_dir());
        session_start();
    }

    public function create_signon($login){ 
        try{
            // https://docs.phpmyadmin.net/en/latest/setup.html#signon-authentication-mode '
            $this->session_pre_pma();
            if ($login)
            {
                // Store there credentials 
                $_SESSION['PMA_single_signon_user'] = DB_USER;
                $_SESSION['PMA_single_signon_password'] = DB_PASSWORD;
                // the below are predefined in config.inc
                //$_SESSION['PMA_single_signon_host'] = '127.0.0.1';
                //$_SESSION['PMA_single_signon_port'] = 3306;
                // Update another field of server configuration 
                $_SESSION['PMA_single_signon_cfgupdate'] = ['verbose' => 'Signon test'];
                $_SESSION['PMA_single_signon_HMAC_secret'] = hash('sha1', uniqid(strval(rand()), true));

                $id = session_id();
                //header('Location: ../index.php');
            } else {
                unset($_SESSION['PMA_single_signon_user']);
                unset($_SESSION['PMA_single_signon_password']);
                unset($_SESSION['PMA_single_signon_cfgupdate']);
                unset($_SESSION['PMA_single_signon_HMAC_secret']);
            }
            // Close that session 
            if (!session_write_close() ){
                exit(__("Can not create the session file using 'session_write_close'. Only after fixing that, you will be able to enter PMA"));
            }
        }
        catch (\Exception $e){
            exit(__("Error: could not create the session file. " .$e->getMessage()));
        }
    }

    public function create_userip_file(){ 
        $this->file_put_contents($this->pma_sessionAllowfile, $this->helpers->ip);
        $this->file_put_contents($this->pma_sessionDbfile, DB_NAME);
        include($this->pma_sessionfile);
        if(empty($_COOKIE[$sess_vars["name"]]) || $_COOKIE[$sess_vars["name"]] != $sess_vars["value"] ){
            $hours = 3*60*60;
            $this->helpers->set_cookie($sess_vars["name"], $sess_vars["value"], $hours);
            $this->helpers->set_cookie("pma_DB_NAME", DB_NAME, $hours);
        }
    }

    public function replace_in_file($file, $from_pattern, $to){
        if(file_exists($file))
        {
            $cont= file_get_contents($file);
            $new_cont= preg_replace($from_pattern, $to, $cont);
            $this->file_put_contents($file, $new_cont);
        }
    }

    public function checkShowLastLoginError(){
        // just my addition, to 
        $this->session_pre_pma();
        if (isset($_SESSION['PMA_single_signon_error_message'])) {
            _e("Go back to plugin's dashboard page. Last PMA login error was:" . $_SESSION['PMA_single_signon_error_message']);
            exit;
        }
        session_write_close();
    }

    public function logout_pma_clear($user_id){
        // clear PMA signon
        $this->create_signon(false); 
    }


    public function pmaLoginUrl(){
        return trailingslashit(admin_url()).'?rand='.rand(1,99999999).'&goto_wp_phpmyadmin=1';
    }
    public function pmaLogoutUrl(){
        return trailingslashit(admin_url()).'?rand='.rand(1,99999999).'&pma_logout=1';
    }

    // https://docs.phpmyadmin.net/en/latest/setup.html#signon-authentication-mode 
    public function if_needs_redirect_to_pma()
    { 
        // for manual logout
        if(isset($_GET['pma_logout']))
        {
            $this->create_signon(false); 
            wp_die("Logout done!");
        }

        if( isset($_GET['goto_wp_phpmyadmin']) ){ 
            if( current_user_can('install_plugins') && current_user_can("manage_options") )
            { 
                $this->checkShowLastLoginError();

                if (empty($this->opts['ssl_error_shown'])) {
                    $this->opts['ssl_error_shown']=1; $this->update_opts();
                }
                
                if(isset($_GET['hosting_pma'])){
                    $m_url    = sanitize_url($this->opts['manual_pma_login_url']);
                    if( stripos( $m_url , '/index.php') === false){
                        $m_url .=  ! $this->helpers->endsWith($m_url, '/')  ?   '/index.php' : 'index.php';
                    }
                    $this->chosen_server_url = $m_url;
                }
                else{
                    $this->chosen_server_url = $this->pma_mainpage_url;
                    //$this->helpers->disable_cache(true);
                    // when chosen our installed pma-url, then we can use protection too
                    // p.s. SESSIONS DOESNT WORK for some reasons, probably WP resets then in 'shutdown' and start... SO WE USE COOKIES... 
                    $this->create_session_file();
                    $this->create_userip_file(); 
                    $this->create_signon(true);
                     //debug ::    $this->helpers->set_cookie('xxxxxxx', json_encode($_SESSION) );
                }
				$this->helpers->php_redirect($this->chosen_server_url);
				// old methods don't work : https://pastebin_com/ERNBRY56 &&  https://pastebin_com/5ydiUKsj
                exit;
            }
            else{
                wp_die(__("You do not have enough privilegges to open this page."));
            }
        }
        return;
    }



    public function opts_page_output()
    {  
        $this->settings_page_part("start", "first");
        ?> 
        <style>
        p.submit { text-align:center; }
        .settingsTitle{display:none;}
        .myplugin {padding:10px;}
        .myplugin #old_pma_install:disabled{opacity:0.3;}
        .myplugin .enterb{font-size:1.5em; padding:10px; } 
        #mainsubmit-button{display:none; background:green;}
        .myplugin .sample_disabled{opacity:0.3;}
        body .ui-tooltip{background:pink;}
        td:nth-child(3) { width: 280px; }
        .myplugin .comingsoon{ opacity:0.4; }
        .warning_ssl_img{ text-align:center; }
        .warning_ssl_img img{ filter: sepia(0.6) contrast(1.1); }
        .installed_logins .manual_login {display:none;}
        .red_warning {color:orange;}
        .error_ {color:red;}
        </style>

        <?php
        $this->setup_definitions();
        if ($this->allow_work) $this->initialize_unpacked_pma();
        else _e("WP-PHPMYADMIN can not work on your server. Try to reinstall plugin and note any issues it might show.");
        ?>

        <?php if ($this->active_tab=="Options") 
        { 
            //if form updated
            if( $this->checkSubmission() ) 
            { 
                $this->opts['manual_pma_login_url']    = sanitize_url($_POST[ $this->plugin_slug ]['manual_pma_login_url']);
                
                $this->opts['use_https']        = isset($_POST[ $this->plugin_slug ]['use_https']); 
                $this->opts['strip_slashes']    = isset($_POST[ $this->plugin_slug ]['strip_slashes']); 
                $this->opts['require_ip']        = isset($_POST[ $this->plugin_slug ]['require_ip']); 
                $this->opts['hide_phma_errors']    = isset($_POST[ $this->plugin_slug ]['hide_phma_errors']); 
                $this->update_opts(); 
                
                if (isset($_POST[ $this->plugin_slug ]['install_languages'])) {
                    $this->obtainLanguagePackages();
                }
                //reflect changes immediately
                $this->replace_in_file($this->path_to_pma_config, '/\$cfg\[\WSendErrorReports\W\]\s+=\s+\W(.*?)\W/', '$cfg["SendErrorReports"] = \''. ($this->opts['hide_phma_errors'] ? 'never':'ask') .'\''); 
            }


            $this->ssl_notice_msg = __("This is a one-time message! <br/><br/> Seems that your site doesn\\'t use HTTPS. We strongly recommend to use HTTPS (SSL) with PhpMyAdmin (Automatic login at this moment works only for HTTPS). To use this feature, then you should bypass the SSL warning on the next page, like shown on this screenshot: ", "wp-phpmyadmin-extension") ."<br/><div class=\\'warning_ssl_img\\'><img src=\\'".$this->helpers->baseURL."/assets/media/example_warning.png\\' /></div>".__("If the next page doesn\\'t work at all, then uncheck the HTTPS checkbox on this page, or try to open your WP-Dashboard with <code>https://</code> prefix and then try to enter PhpMyAdmin", "wp-phpmyadmin-extension");

            $url_to_open = $this->pmaLoginUrl();
            ?> 
        
            <form class="mainForm" method="post" action="">
            
            <table class="form-table">
                <tr class="installed_logins">
                    <td><h3><?php _e("phpMyAdmin in your WP", 'wp-phpmyadmin-extension');?></h3></td>
                    <td>
                    <?php  
                        $sitewides = get_site_option('active_sitewide_plugins');
                        $singlesites= get_site_option('active_plugins');
                        $ITHEMES_SLUG = 'better-wp-security/better-wp-security.php';
                        if (is_plugin_active('better-wp-security') || ( is_array($sitewides) && array_key_exists($ITHEMES_SLUG, $sitewides) ) || ( is_array($singlesites) && in_array($ITHEMES_SLUG, $singlesites) ) ) {
                            $path = '/admin.php?page=itsec&path=%2Fsettings%2Fconfigure%2Fadvanced%2Fsystem-tweaks';
                            _e('<br/> <b style="color:red;">(Note: Seems you are using iThemes Security, which places specific restriction in htaccess. So,you might need to turn off "Disable PHP in Plugins" setting :  <a target="_blank" href="'. (is_multisite() ? network_admin_url($path) : admin_url($path)).'"> Security > Settings > System Tweaks > PHP in Plugins </a>, othewise you might be restricted to enter PMA)</b>');
                        }
                    ?>
                    <?php  
                    $error=false;
                    foreach ( array_filter($this->is_new_php ? ['hash','ctype'] : [] ) as $extension)
                    {
                        if(!extension_loaded($extension)) { 
                            $error=true;
                            _e('<div class="error_">extension <code>'.$extension.'</code> not enabled on your server. PhpMyAdmin can not work, unless you(or your hoster) enables it</div>', 'wp-phpmyadmin-extension');
                        }
                    }
                    
                    if (!$this->is_new_php)
                    {
                        _e('<div class="error_">Your server\'s PHP version is lower than required '.$this->required_version.'. The latest PhpMyAdmin can\'t work, so we <b>strongly</b> recommend to contact your hosting administrator to update your obsolete PHP version.</div>', 'wp-phpmyadmin-extension');
                        if (!file_exists($this->pma_zipPath)) {
                            $error=true;
                            //_e('<div class="error_2">If neither your hosting provider can help you, then as a temporary solution, you can <button id="old_pma_install">download & install PhpMyAdmin 4.9.4</button> from official website, but we strongly recommend to upgrate your PHP and then you will be able to use latest up-to-date version, instead of using old version.</div>', 'wp-phpmyadmin-extension');
                        }
                    }

                    if ( ! is_writable(dirname(__DIR__)) ) 
                        _e('<div class="error_">Your <code>WP-CONTENT/PLUGINS/WP-PHPMYADMIN-EXTENSION</code> directory is not writable. Correct that at first, from hosting/sFTP settings</div>');

                    ?>
                    </td>
                    <td>
                    <p class="submit automatic_login">
                        <?php
                        if (isset($this->PMA_LAST_LOGIN_ERROR)) {
                            echo 
                            '<p class="error">'
                            . __('Last error: ') .$this->PMA_LAST_LOGIN_ERROR
                            .'</p>';
                        }
                        ?>
                        <a class="<?php if (!is_dir($this->pma_abspath) || $error) echo "sample_disabled";?> button button-primary type_auto enterb enter_automatic" target="_blank" href="<?php echo $url_to_open;?>&automatic_login" id="installed_automatic" onclick="show_ssl_wanring1(event, this);"><?php _e("Enter local phpMyAdmin", 'wp-phpmyadmin-extension');?></a> 
                        <!-- <br/><span style="color:red;">(Note: Don't forget to logout from PMA after you finish your work there)</span> -->
                    </p> 
                    </td>
                </tr> 

                <tr class="hostinged_logins">
                    <?php $pma_url = $this->helpers->domain.'/phpmyadmin/'; ?>
                    <td><h3><?php _e("phpMyAdmin on hosting:", 'wp-phpmyadmin-extension');?></h3></td>
                    <td>
                    <?php _e('If above method doesn\'t work for you, you can use an alternative - some hostings might already have phpMyAdmin setup for customers. If so, just paste the phpMyAdmin login page url here:', 'wp-phpmyadmin-extension');?>
                    <input type="text" class="regular-text" id="manual_pma_login_url" data-onchange-save="true"  data-onchange-hide=".type_manual" name="<?php echo $this->plugin_slug;?>[manual_pma_login_url]" value="<?php echo esc_url($this->opts['manual_pma_login_url']);?>" placeholder="" />  
                    <br/><?php _e('( That url might be <code><a href="'.$pma_url.'" target="_blank">'.$pma_url.'</a></code> or <code>https://xyz123.yourhosting.com/phpmyadmin/</code>. You can find out that url in your hosting\'s Control-Panel &gt; <b>phpMyAdmin</b> and you will be redirected to "login" url. Then paste that base url here.)', 'wp-phpmyadmin-extension');?>
                    </td>
                    <td>
                    <p class="submit"><a class="button button-primary type_manual enterb enter_manual" target="_blank"  href="<?php if(empty($this->opts['manual_pma_login_url'])) echo "javascript:alert('url is empty');void(0);"; else if(stripos($this->opts['manual_pma_login_url'], '//')===false) echo "javascript:alert('incorrect url format');void(0);"; else echo $url_to_open.'&hosting_pma&manual_login';?>"><?php _e("Enter hosting's phpMyAdmin", 'wp-phpmyadmin-extension');?></a></p>
                    <!-- <p class="submit"><a class="button button-primary type_manual enterb enter_automatic comingsoon" target="_blank"  href="<?php if(empty($this->opts['manual_pma_login_url'])) echo "javascript:alert('url is empty');void(0);"; else if(stripos($this->opts['manual_pma_login_url'], '//')===false) echo "javascript:alert('incorrect url format');void(0);"; else echo $url_to_open.'&hosting_pma&automatic_url';?>" id="hosting_automatic" ><?php _e("Login Automatically", 'wp-phpmyadmin-extension');?></a></p> -->
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <b><p class="description"><?php _e("Credentials:", 'wp-phpmyadmin-extension');?></p></b> <?php _e('DB Username', 'wp-phpmyadmin-extension');?>: <input type="text" value="<?php echo DB_USER;?>" disabled />
                        <br/><?php _e('DB Password', 'wp-phpmyadmin-extension');?>: <b><?php _e('Get from wp-config.php', 'wp-phpmyadmin-extension');?></b>
                        <br/>
                    </td>
                </tr>
                <?php if ( !is_ssl() ) { ?>
                <tr>
                    <td class="red_warning"><?php _e("Use HTTPS (in case it does not automatically use)", 'wp-phpmyadmin-extension');?> <?php echo $this->helpers->question_mark($this->ssl_notice_msg, $dialogType=2);?></td> 
                    <td><input type="checkbox" name="<?php echo $this->plugin_slug;?>[use_https]" <?php checked($this->opts['use_https']);?> data-onchange-save="true" /></td>
                    <td></td>
                </tr>
                <?php } ?>
                <tr>
                    <td><?php $ip=$this->helpers->ip; _e("Restrict access only to current IP (<code>$ip</code>) to login into PMA <br/>(in rare cases, if you have continiously changing dynamic IP address, then you will need to uncheck IP restriction)", 'wp-phpmyadmin-extension');?></td> 
                    <td><input type="checkbox" name="<?php echo $this->plugin_slug;?>[require_ip]" <?php checked($this->opts['require_ip']);?> data-onchange-save="true" /> </td>
                    <td></td>
                </tr>
                <tr>
                    <td><?php _e('Hide errors in PMA <br/>(if you face error popup-boxes in phpMyAdmin frequently, you can hide them)', 'wp-phpmyadmin-extension');?></td> 
                    <td><input type="checkbox" name="<?php echo $this->plugin_slug;?>[hide_phma_errors]" <?php checked($this->opts['hide_phma_errors']);?> data-onchange-save="true" /> </td>
                    <td></td>
                </tr>
                <tr>
                    <td><?php _e('Strip slashes in PMA <br/>(if you see that when you update a textfield in phpMyAdmin, and extra backslash <code>\\</code> is added in front of <code>\\</code> or <code>\'</code> or <code>"</code> characters, then check this) :', 'wp-phpmyadmin-extension');?></td> 
                    <td><input type="checkbox" name="<?php echo $this->plugin_slug;?>[strip_slashes]" <?php checked($this->opts['strip_slashes']);?> data-onchange-save="true" /> </td>
                    <td></td>
                </tr>
                <?php if ($this->checkNeedLanguageFiles()) { ?>
                <tr>
                    <td><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.02 0c6.614.011 11.98 5.383 11.98 12 0 6.623-5.376 12-12 12-6.623 0-12-5.377-12-12 0-6.617 5.367-11.989 11.981-12h.039zm3.694 16h-7.427c.639 4.266 2.242 7 3.713 7 1.472 0 3.075-2.734 3.714-7m6.535 0h-5.523c-.426 2.985-1.321 5.402-2.485 6.771 3.669-.76 6.671-3.35 8.008-6.771m-14.974 0h-5.524c1.338 3.421 4.34 6.011 8.009 6.771-1.164-1.369-2.059-3.786-2.485-6.771m-.123-7h-5.736c-.331 1.166-.741 3.389 0 6h5.736c-.188-1.814-.215-3.925 0-6m8.691 0h-7.685c-.195 1.8-.225 3.927 0 6h7.685c.196-1.811.224-3.93 0-6m6.742 0h-5.736c.062.592.308 3.019 0 6h5.736c.741-2.612.331-4.835 0-6m-12.825-7.771c-3.669.76-6.671 3.35-8.009 6.771h5.524c.426-2.985 1.321-5.403 2.485-6.771m5.954 6.771c-.639-4.266-2.242-7-3.714-7-1.471 0-3.074 2.734-3.713 7h7.427zm-1.473-6.771c1.164 1.368 2.059 3.786 2.485 6.771h5.523c-1.337-3.421-4.339-6.011-8.008-6.771"/></svg> <?php _e('Install all languages for PhpMyAdmin:', 'wp-phpmyadmin-extension');?></td> 
                    <td><input type="checkbox" name="<?php echo $this->plugin_slug;?>[install_languages]" data-onchange-save="true" /> </td>
                    <td></td>
                </tr>
                <?php } ?>
            </table>
            
            <?php $this->nonceSubmit();  ?>
            </form>
 
            
            <script> 
            // warning tooltips
            shown_error_once = 0;
            function show_ssl_wanring1(e, elem){
                lastEl = jQuery(elem); //jQuery(this) 
                if(location.protocol != 'https:')
                {
                    if (shown_error_once || <?php echo ( array_key_exists('ssl_error_shown', $this->opts) ? "true" : "false"); ?>) return;
                    shown_error_once = 1;
                    jQuery('<div><?php echo $this->ssl_notice_msg;?></div>').dialog({
                        modal:true,
                        width:700,
                        close: function(){ document.getElementById(lastEl.attr("id")).click(); }
                    });
                    e.preventDefault();
                }
            }



            jQuery(function(){ 
                jQuery(".comingsoon").attr("title", "Coming soon").on("click", function(e){e.preventDefault();}); 
                
                jQuery(".myplugin").tooltip({ show: { effect: "blind", duration: 800 } }); 
                
                jQuery("#old_pma_install").on("click", function(e){
                    var targetEl= this;
                    e.preventDefault();
                    PuvoxLibrary.backend_call
                    (
                        {
                            'act': 'old_pma_install' 
                        },
                        function(response)
                        {
                            PuvoxLibrary.message(response);
                        }
                    );
                    window.setTimeout( function(){ PuvoxLibrary.message("<?php _e('Please don\'t refresh the page untill it refreshes automatically (might need up to 30-60 seconds).', 'wp-phpmyadmin-extension');?>"); }, 2000);
                    //window.setTimeout( function(){ jQuery('.ttDialog').dialog('close'); }, 7000);
                });

            });
            </script>

        <?php 
        } 

        $this->settings_page_part("end", "");
    } 

    private function checkNeedLanguageFiles () {
        return (!is_dir($this->pma_abspath.'/locale'));
    }
    private function obtainLanguagePackages () {
        $lang_files_zip = 'https://plugins.svn.wordpress.org/wp-phpmyadmin-extension/assets/pma-locales.zip';
        wp_remote_get( $url=$lang_files_zip, ['timeout'=>300,  'stream'=>true,  'filename'=>$this->pma_langfiles_zipPath ] );
        $this->helpers->unzip($this->pma_langfiles_zipPath, $this->pma_abspath);
        usleep(500000);
        unlink($this->pma_langfiles_zipPath);
    }

    public function backend_call($act)
    {
        // removed : https://pastebin_com/Pi6jCbrf
    }


    public function file_put_contents($path, $content, $third = null)
    {
        $dir = dirname($path);
        if(!is_dir($dir))  $this->helpers->file->create_directory($dir);
        $path = $this->helpers->realpath($path);  
        $content = is_array($content) || is_object($content) ? json_encode($content) : $content;
        if ( is_writable( $dir ) ){
            return file_put_contents($path, $content, ($third==null ? LOCK_EX : $third | LOCK_EX) );
        }
        else{
            throw new \Exception("This plugin doesn't have a permission to write file at:". $path);
        }
    }
    
    
    
    
  } // End Of Class





  $GLOBALS[__NAMESPACE__] = new PluginClass();

} // End Of NameSpace
?>