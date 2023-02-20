<?php
/**
 *   ####################################################################################
 *   ################################  Our PHP Library   ################################
 *   ####### Here we collect frequently used methods across our PHP applications. #######
 *   ####################################################################################
 *
 *   ### Example usage: ###
 *         $helpers = new \Puvox\library_wp();
 *         $helpers-> remove_admin_bar ();
 *                 -> disable_emojis ();
 *                 -> delete_transients_by_prefix ('something');
 *                 -> unzip ('file.zip');
 *                    ...
 * 
 * Note: This file also contains additional 'wp_plugin' class. example use: https://bit.ly/puvox_wp_plugin
*/


 
namespace Puvox;


if (!class_exists('\\Puvox\\library_wp')) {
  class library_wp extends library
  {
	  
	public function __construct()
	{
		parent::__construct();
	}

	public $logs_table_maxnum=100;
	public $logs_table_name  ='_default_table_ERRORS_LOGS';
	
	public function init_module($args=[])
	{
		parent::init_module($args);
		
		//get blog-slug
		if(is_multisite()){
			global $blog_id;  if(empty($blog_id)) $blog_id = get_current_blog_id();  
			$current_blog_details = function_exists('get_sites') ? get_site($blog_id) : get_blog_details( array( 'blog_id' => $blog_id ) );
			$b_slug = basename($current_blog_details->path);
		} 
		$this->BLOGSLUG = (!empty($b_slug)? $b_slug : basename($this->homeFOLDER) );

		// others
		$this->this_file_link= '';//$this->baseURL . $this->urlify( explode( basename($this->baseURL), __FILE__  )[1] );
		$this->PHP_customCALL= '';//$this->this_file_link .'?custom_php_load=scripts_load&actionn=';
		
		if ($this->is_development)
		{
			$this->js_debugmode("debugmode");
		} 
	}
	
	public function CurrentHomeIs($path){ return trailingslashit($path)==trailingslashit(str_replace( trailingslashit(network_site_url()), '', trailingslashit(home_url())) ); } //return in_array(home_url(), ["http://$site","https://$site"]) || home_url('', 'relative')==$site; } 

	public function home_url(){ return trailingslashit(home_url());} 
	public function blogSlug(){ 
		$blogname =  str_replace(basename(get_site_url()),'', basename( get_site($GLOBALS['blog_id'])->path));
		return ($blogname !=='' ? $blogname : str_replace('www','',$_SERVER['HTTP_HOST']));
	} 
	

	public function loadScripsStyles()
	{
		add_action( 'admin_head', function (){ if ($this->property('admin_styles')) echo ' <style type="text/css">'.$this->admin_styles.'</style>'; } );

		//load desired scripts 
		add_action( 'wp_enqueue_scripts', 		[$this, 'my_styles_hook'], 9); 
		add_action( 'admin_enqueue_scripts',	[$this, 'my_styles_hook'], 9);  
	}
	
	public function init_properties()
	{
		if ($this->property('auth_expiration_hours'))	 	$this->init__cookieexpiration();
		if ($this->property('navmenu_search_items'))		$this->init__quicksearch();
		if ($this->property('extend_shortcodes')) 			$this->extendShortcodes();
		if ($this->property('posts_per_page')) 				$this->init__postsperpage($this->posts_per_page); 
		// This is not enabled, unless user explicitly enables it during tests!!! IT IS NOWHERE ENABLED, UNLESS YOU INSERT IN CODE YOURSELF. so, don't fear.
		if ($this->property("enable_write_logs"))			$this->SaveLogs( $this->baseDIR  .'/___logs_' ); 
		if ($this->property('disable_update'))				$this->init__disableupdate();
	}
	
	//when is_admin or when page is unknown (for example, custom page or "wp-login.php" or etc... )
	public function Is_Backend(){
		$includes=get_included_files();
		$path	= str_replace( ['\\','/'], DIRECTORY_SEPARATOR, ABSPATH);
		return (is_admin() || in_array($path.'wp-login.php', $includes) || in_array($path.'wp-register.php', $includes) );
		//return (!!array_intersect([$ABSPATH_MY.'wp-login.php',$ABSPATH_MY.'wp-register.php'] , get_included_files())) ;
	}
		
	public function is_gutenberg($active=true){
		return ( function_exists( 'is_gutenberg_page' ) && (!$active || $this->is_gutenberg_page() ) );
	}
		
	public function is_gutenberg_page($active=true){
		if (is_admin()) {
			global $current_screen;
			if (!isset($current_screen)) {$current_screen = get_current_screen();}
			if ( method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor() ||  $this->is_gutenberg(true) ) {
				return true;
			}
		}
		return false;
	}

	public function init__disableupdate() 
	{
		add_filter('site_transient_update_plugins', function ($value) { if (isset($value)) { if ( isset($value->response[$name=plugin_basename($this->baseFILE)]) ) { unset($value->response[$name]); } } return $value; });
	}


	//Get Blog slug, i.e. "subdir"  from "http://example.com/subdir/"
	public function get_blog_name(){
		if(is_multisite())
		{
			global $blog_id;
			$current_blog_details = !function_exists('get_blog_details') ? get_site($blog_id) : get_blog_details( ['blog_id' => $blog_id] );
			$b_slug = basename($current_blog_details->path);
			return $b_slug;
		}
		return false;
	}

	public function sqlResultsToArray($tableName, $first_key, $second_key=false, $data_key=false)
	{ 
		$array=$this->object_to_array( $this->get_table_my($tableName) );

		$new_array=[];
		foreach($array as $id=>$block)
		{
			if(array_key_exists($first_key, $block))
			{
				if ($second_key)
				{
					if(array_key_exists($second_key, $block))
						$new_array[$block[$first_key]][$block[$second_key]] = $data_key ? json_decode($block[$data_key]) : $block;
				}
				else
					$new_array[$block[$first_key]] = $data_key ? json_decode($block[$data_key]) : $block;
			}
		}
		return $new_array;
	}


	public function get_locale__SANITIZED(){
		return ( get_locale() ? "en" : preg_replace('/_(.*)/','',get_locale()) ); //i.e. 'en'
		//$x=$GLOBALS['wpdb']->get_var("SELECT lng FROM ".$this->options." WHERE `lang` = '".$lang."'"); return !empty($x);
	}

	
	public function blog_prefix()
	{
		$blog_prefix = '';
		if ( is_multisite() && ! is_subdomain_install() && is_main_site() && 0 === strpos( get_option( 'permalink_structure' ), '/blog/' ) ) {
			$blog_prefix = '/blog';
		}
		$this->blog_prefix = $blog_prefix;
		return $blog_prefix;
	}

	public function path_after_blog()
	{
		$prf = $this->blog_prefix();
		$path = $this->pathAfterHome; 
		return ( ($prf=="/blog") ? str_replace('/blog/', '', '/'.$path) : $path );
	}

	public function disable_metabox_folding()
	{
		add_action('admin_footer', function ()
		{ ?><script>
			jQuery(window).load(function() {
			   jQuery('.postbox .hndle').css('pointer-events', 'none');
			   jQuery('.postbox .hndle input, .postbox .hndle select').css('pointer-events', 'all');
			   { jQuery('.postbox .hndle').unbind('click.postboxes'); jQuery('.postbox .handlediv').remove(); jQuery('.postbox').removeClass('closed'); }
			});
			</script><?php
		} ); 
	}

	
	
	public function checkMyselfAgainstModification()
	{
		//if ($this->is_development) return;
		$name = '_puvox_default_lib_last_revision';
		$opt= $this->get_option_CHOSEN($name, 0 );
		$days=7;
		if( time() - $opt > $days* 86400 )
		{
			//https://plugins.trac.wordpress.org/browser/'.$this->slug.'/trunk/default_library_puvox.php
			update_option_CHOSEN($name, time() );
		}
		if(time() - $opt < 0 ){
			update_option_CHOSEN($name, 0 );
		}
	}

	
	public function enable_admin_debug($exit=false){
		if (WP_DEBUG)
			add_filter('wp_php_error_message', function($message, $error) use ($exit) { return $message. $this->var_dump($error['message']); if($exit) die();} , 10,2);
		//add_filter( foreach(['wp_die_ajax_handler',  'wp_die_json_handler',  'wp_die_handler'] as $each){ 
	}
	

	public function disable_php_in_wpcontent()
	{
		if (last_checkpoint('uploads_htaccess', 500000))
		add_action('init', function() {
			$uploads_dir = defined('UPLOADS') ? UPLOAD : get_option('upload_path');
			$uploads_dir = !empty($uploads_dir) ?  $uploads_dir : WP_CONTENT_DIR.'/uploads';
			$file=$uploads_dir.'/.htaccess';
			if(!file_exists($file)) {
				$this->file_put_contents($file, '<Files ~ "\.php">'."\r\n".
					'Order allow,deny'."\r\n".
					'Deny from all'."\r\n".
					'</Files>'
				);
			}
		});
	}


	// add personal notes page:
	public function mynots222() {
		add_action('admin_menu', function() { 
			add_menu_page('myNOTES', 'myNOTES', 'read','mynotes-urllll', [$this, 'ntsFNC222'] ); } );
	}
	public function ntsFNC222() {
		if (!$this->NonceCheck($_POST['nonce'], 'myact')) return;
		
		if (isset($_POST['nmtIDv'])) { update_option('myfuture_notes_contentt', sanitize_text_field($_POST['nmtIDv'])); }
		$contn = get_option('myfuture_notes_contentt');
					echo 
		'<form style="margin:50px 0 0 0;" action="" method="POST">On this page you can save custom notes';
			if (current_user_can('create_users')) { echo '<div style="color:red;font-style:italic;"></div>';}
					echo
			'<div class="mpmybook_textareaDIV"> 
				<style>	#nmtIDv_div{width:100% !important; height:1000px !important;}</style>';
				wp_editor($contn, 'nmtIDv', $settings = array(
				'editor_class'=>'notesmyyCLASS',    'textarea_name'=>'mynots123', 'editor_height'=>'1000px', 'textarea_rows'=>'1000',
				'tinymce'=>true ,'wpautop'=>false,	'media_buttons'=>true,	'teeny'=>false,	'quicktags'=>false,		'drag_drop_upload'=>true )); echo
			'</div>
			<br/><input style="position:fixed;left:45%;bottom:10px;background-color:#1FC81F;" type="submit" value="SAVE" />
		</form>';
	}

	
	public function my_site_variables__secret($var_name=false, $value=false){
		$final= $this->SITE_VARIABLES = get_site_option('site_variables_my_secret',[]);
		if ($var_name) {
			if(array_key_exists($var_name, $this->SITE_VARIABLES)){
				$final = $this->SITE_VARIABLES[$var_name];
			}
			elseif($value) {
				$final = $this->SITE_VARIABLES[$var_name]=$value;
				update_site_option('site_variables_my_secret', $this->SITE_VARIABLES);
			}
			else{
				$final = '';
			}
			return $final;
		}
		else{ return $this->SITE_VARIABLES; }
	}



	public function dashicon_styled($name, $style){
		return '//" class="dashicons-before '.$name.'" style="opacity:0.91; '.$style;
	}
	


	// ====================== tinymce buttons ==================== //
	
	// $this->my_default_buttons= array('superscript', 'subscript') + array( "|", "youtube_video","audioo", "add_spacee_button", "removeline_button", "abzac_button","videomovie", "lists", "script");
 
	public function tinymce_funcs()
	{
		// Add button in TinyMCE 
		add_action( 'admin_init', 			function(){
			if ( get_user_option('rich_editing') == 'true') {
				add_filter( 'mce_external_plugins',	function ( $plugin_array ) { return array_merge($plugin_array, ["button_handle_" . $this->slug=> $this->homeURL  . '?tinymce_buttons_'.$this->slug] );  } );
				add_filter( 'mce_buttons_2',	function ( $button_names ) { return array_merge( $button_names, array_map(  function($ar){ return $ar['button_name']; }, $this->tinymce_buttons )); } );
				//this is must for REFRESHING!
				add_filter( 'tiny_mce_version',  function ( $ver ) {  $ver += 3;  return $ver;}  );
			}
		} );
		//tinymce buttons if needed
		$this->tinymce_buttons_body();
		foreach($this->tinymce_buttons as $each_button){
			if( !empty($each_button["shortcode"]) ){
				add_shortcode($each_button["shortcode"], [$this, $each_button["shortcode"]] );
			}
		} 
	}

	public function tinymce_buttons_body( )
	{
		if( ! isset($_GET['tinymce_buttons_'. $this->slug] ) ) return;
		header("Content-type: application/javascript;  charset=utf-8");
		?>
		// ************ these useful scripts got from: https://github.com/ttodua/useful-javascript/   **********
		// "<script>"  dont remove this line,,, because, now JAVSCRIPT highlighting started in text-editor
		<?php $random_name = "button_".rand(1,999999999).rand(1,999999999); ?>
		"use strict";

		(function ()
		{
			// Name the plugin anything we want
			tinymce.create( 'tinymce.plugins.<?php echo $random_name;?>',
			{
				init: function (ed, url)
				{

				<?php foreach ($this->tinymce_buttons as $each_button ) { ?>
					// The button name should be the same as used in PHP function of WP
					ed.addButton( '<?php echo $each_button["button_name"];?>',
					{
						// Title of button
						title: '<?php echo $each_button["shortcode"];?>',
						// icon url of button
						image: '<?php echo $each_button["icon"];?>', //url +
						// Onclick action onto button
						onclick: function ()
						{
							// Create shortcode string, with default values
							var val = '<?php echo $this->shortcode_example($each_button["shortcode"], $each_button["default_atts"]);?>';
							// Insert shortcode in text-editor
							ed.execCommand( 'mceInsertContent', false, val );

							//var newtex= prompt("Audio link", ""); if (null == newtex) {return;}
							//var gotted= tinyMCE.activeEditor.selection.getContent({format : 'raw'})
								//var newtex= gotted.replace(/<br \/>/g,'');
								//	newtex= newtex.replace(/\r\n/g,'');
								//	newtex= newtex.replace(/\n/g,'');
								//ed.execCommand('mceInsertContent', false, newtex);
						}
					});
				<?php } ?>


				},
				createControl: function (n, cm) {
					return null;
				}

			});

			// first parameter	- the same name as defined in PHP function of WP
			// second parameter	- the module name (as defined a bit above)
			tinymce.PluginManager.add( '<?php echo "button_handle_" . $this->slug;?>', tinymce.plugins.<?php echo $random_name;?> );

		})();
		//</script>
		<?php
		exit;
	}
	
	// show toggled (2-lined) tinymce editor 
	public function tinymceToggled(){
		add_filter( 'tiny_mce_before_init', function($array){ $array[ 'wordpress_adv_hidden' ]=false; return $array; } );
		add_filter( 'mce_buttons',	function ( $button_names ) { return array_diff( $button_names, ['wp_adv'] ); } ); 
	}
	public function tinymceAddMediaButton(){
		add_filter( 'mce_buttons',	function ( $button_names ) { $button_names[]='wp_add_media';  return $button_names; } );
	}
				
	public function tinymceRemoveButtons($buttons){
		//add_filter( 'mce_buttons',	function ( $button_names ) {  return array_diff( $button_names, $buttons ); } ); 
		//'strikethrough','hr','forecolor','pastetext','removeformat','charmap','outdent','indent','undo','redo','wp_help'
		//add_filter( 'mce_buttons_2',	function ( $button_names ) {  return array_diff( $button_names, $buttons ); } ); 
	}
			//if ($GLOBALS['current_screen']->post_type==$post_type) { 
    public function remove_media_button()
    {
		add_action('admin_head', function() { remove_action('media_buttons', 'media_buttons'); });
	}
	//other mods: https://developer.wordpress.org/reference/functions/wp_tinymce_inline_scripts/
	// =========================== TinyMce ================================ //
 
	// set desired number of revisions
	//add_filter( 'wp_revisions_to_keep', function($num,$post){return (defined("POSTS_REVISION_NUMBERS") ? POSTS_REVISION_NUMBERS : 3) ; }  , 10, 2 );

	public function compress_php_header($isWP=false)
	{
		ob_start('ob_gzhandler');	//similar as: ini_set('zlib.output_compression', '1');
		if ($isWP){
			add_action('wp', (function (){ if (!is_admin()) ob_start('ob_gzhandler'); } ) ,1);
			remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
		}
	}

	
	public function remove_admin_bar($from_backend_too=true)
	{
		add_action('init', function() use ($from_backend_too) {
			if ($this->is_administrator()) return;
			//remove admin bar from FRONTEND 
			add_filter('show_admin_bar', '__return_false');	//show_admin_bar(false);
			//remove admin bar from BACKEND
			if ($from_backend_too)
			{
				add_filter( 'admin_title', function(){ $GLOBALS['wp_query']->is_embed=true;  add_action('admin_xml_ns', function(){ $GLOBALS['wp_query']->is_embed=false; } ); } );
				remove_action( 'in_admin_header', 'wp_admin_bar_render', 0 );
			}
		});
	}
	

	//add_action( 'pre_get_posts', 'querymodify_2322',77); 
	public function querymodify_2322($query) { $q=$query;
		if( $q->is_main_query() && !is_admin() ) {
			if($q->is_home){
				$q->init();			
				$q->set('post_type',LNG);
				$q->set('category__not_in', 64);
				$q->set_query_vars('category__not_in',array(64)  );
			}
		}
		return $q;
	}

	// Register Custom Post 	
	public function register_post_type($name, $title='', $thumb='') {
		// https://codex.wordpress.org/Function_Reference/register_post_type 
		add_action('init', function() use ($name, $title)  {
			$title = !empty($title) ? $title : strtoupper($name);
			register_post_type( $name, [
				'label'	=> __( $title ),	'description' => __( $name.'s'),
				'labels'=> ['name' => $name, 'singular_name' => $name.' '.'page'],
				'supports'	=> ['title','editor', 'thumbnail', 'excerpt', 'page-attributes', 'post_tag', 'revisions','comments','post-formats'],
				'taxonomies'=> ['category', 'post_tag'],  
				'public'=> true,	'query_var'=> true,				'publicly_queryable'=>true,	'show_ui'=> true,	'show_in_menu'	=> true,
				'show_in_nav_menus'	=> true,	'show_in_admin_bar'	=> true,	'menu_position'	=> 18,
				'can_export' => true, 'hierarchical' => true, 'has_archive'=> true, 'menu_icon' => 'dashicons-editor-spellcheck', // https://developer.wordpress.org/resource/dashicons/#editor-spellcheck
				'exclude_from_search' => false,	'capability_type'=> 'page',
				'rewrite' => array('with_front'=>true,   ), 
			] );
		}); 
	}
	//add_action('init', 'my_custom_init');  function my_custom_init() { add_post_type_support( 'page', 'excerpt' ); }


	// increase filtering quick-menu-search results (this seems better than other a bit harder methods, like: https://goo.gl/BWMmDp )
	public function init__quicksearch($amount=30) { $this->navmenu_search_items=$amount; add_action( 'pre_get_posts', [$this, 'myFilter_quicksearch'], 10, 2 );  }
	public function myFilter_quicksearch( $q ) {
		// example of $q properties: https://goo.gl/SNeDwX
		if(isset($_POST['action']) && $_POST['action']=="menu-quick-search" && isset($_POST['menu-settings-column-nonce'])){	
			// other parameters for more refinement: https://goo.gl/m2NFCr
			if( is_a($q->query_vars['walker'], 'Walker_Nav_Menu_Checklist') ){
				$q->query_vars['posts_per_page'] = $this->navmenu_search_items;
			}
		}
		return $q;
	}


	public function init__postsperpage($amount=30) {  $this->posts_per_page=$amount;  add_action( 'pre_get_posts', [$this,'wpsites_query'], 15);  }
	public function wpsites_query( $query ) {
		if ( !is_admin() && $query->is_archive && $query->is_main_query() ) {
			$query->set( 'posts_per_page', $this->posts_per_page );
		}
	} 

	//  add_action( 'admin_init', 'allow_editor_increased_access');
	// https://codex.wordpress.org/Roles_and_Capabilities#edit_theme_options
	public function allow_editor_increased_access(){
		$role_object = get_role( 'editor' );
		if(empty($role_object )) return;
		$role_object->add_cap( 'edit_theme_options' );
		$role_object->add_cap( 'update_core' );
		$role_object->add_cap( 'update_themes' );
		$role_object->add_cap( 'switch_themes' );
		$role_object->add_cap( 'delete_themes' );
		$role_object->add_cap( 'delete_plugins' );
		$role_object->add_cap( 'update_plugins' );
		//$role_object->add_cap( 'create_users' );  // will access ADMIN!
		//$role_object->add_cap( 'edit_users' );  // will access ADMIN!
		//$role_object->add_cap( 'delete_users' );
		$role_object->add_cap( 'remove_users' );
		$role_object->add_cap( 'list_users' );
		$role_object->add_cap( 'edit_files' );
		$role_object->add_cap( 'edit_dashboard' );
		// CAREFULL !
		//$role_object->add_cap( 'manage_options' );
	}

 
	//add_filter('excerpt_more', 'excerpt_more_func');   public function excerpt_more_func($more) {	return ' <a class="read-more" href="'. get_permalink(get_the_ID()) . '"> (Continue Reading)</a>';}
	//add_filter('excerpt_length', 'excerpt_length_func');   public function excerpt_length_func() {    return 25;} 

	public function noindex_pagesss() {
		if ( !is_404() && !is_page() && !is_single() && !is_search() && !is_archive() && !is_admin() && !is_attachment() && !is_author() && !is_category() && !is_front_page() && !is_home() && !is_preview() && !is_tag())  { echo '<meta name="robots" content="noindex, nofollow"><!-- by MLSS -->'; }
	}

	// remove category base: pastebin_com/raw/YpV0wp27
	
	public function referrerIsSameDomain()
	{
		return $this->startsWith(wp_get_referer(), home_url());
	}
	
	//add_action( 'after_setup_theme', 'theme_supportss' );  
	public function add_theme_supports(){
		// https://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
		//remove_theme_support( 'custom-header' ); 
		add_theme_support('menus');			// Add support for:		menus
		add_theme_support('title-tag');   	// Add support for:		titles
		add_theme_support('editor-style');	// Editor Styles
		add_editor_style();
		add_theme_support( 'post-thumbnails');	// Enable Thumbnails for Feature Images 
		set_post_thumbnail_size( 200, 150 );
		add_image_size('my-small-thumbnail', 150, 150, true);
		add_image_size('my-medium-thumbnail', 650, 150, true);
		// Translation Ready
				//load_theme_textdomain( 'my', get_template_directory() . '/languages' );
		//add_theme_support('automatic-feed-links');	// Add default posts and comments RRS feeds links to the head.
		add_theme_support( 'html5', ['search-form'] );//Suppot HTML5 Search Form
		//load_theme_textdomain( 'my', get_template_directory() . '/languages' );
	}

	public function add_zip_mime_types () {
		add_filter('upload_mimes', function($existing_mimes){
			// add your extension to the mimes array as below
			$existing_mimes['zip']	= 'application/zip';
			$existing_mimes['gz']	= 'application/x-gzip';
			$existing_mimes['txt']	= 'text/plain'; 
			
			if (!array_key_exists('zip', $existing_mimes)) $existing_mimes['zip'] = 'application/zip';  
			if (!array_key_exists('gz|gzip|zip', $existing_mimes)) $existing_mimes['gz|gzip|zip'] = 'application/x-zip'; 
			//	['gz|gzip'] => application/x-gzip
			//	[rar] => application/rar
			//	[7z] => application/x-7z-compressed
			return $existing_mimes;
		}, 99);

		add_filter( 'wp_check_filetype_and_ext', function ( $types, $file, $filename, $mimes ) {
			// Do basic extension validation and MIME mapping
			$wp_filetype = wp_check_filetype( $filename, $mimes );
			if( in_array( $wp_filetype['ext'], array( 'zip', 'gz', 'txt' ) ) ) { // it allows zip files
				$types['ext']  = $wp_filetype['ext'];
				$types['type'] = $wp_filetype['type'];
			}
			return $types;
		}, 99, 4 );
	}
	

	
	
	public function inprogress_flag_cache($flagname, $max_seconds=999999999){
		$flagname_final = "inprogress_$flagname";
		$start_time = $this->cache_get($flagname_final,null);
		if($start_time && time()<$start_time+$max_seconds) {
			return true;
		}
		else{
			$this->cache_set($flagname_final, time(), $max_seconds);
			register_shutdown_function(function() use($flagname_final){ $this->cache_set($flagname_final,null); });
			return false;
		}
	}

	public function inprogress_flag($flagname, $max_seconds=60){
		$flagname_final = "inprogress_$flagname";
		$start_time = $this->get_transient($flagname_final,null);
		if($start_time && time()<$start_time+$max_seconds) {
			return true;
		}
		else{
			$this->set_transient($flagname_final, time(), $max_seconds);
			register_shutdown_function(function() use($flagname_final){ $this->inprogress_flag_reset($flagname_final); });
			return false;
		}
	}
	public function inprogress_flag_reset($flagname_final){
		$flagname_final = !$this->startsWith($flagname_final, 'inprogress_') ? "inprogress_$flagname_final" : $flagname_final;
		if( !empty($this->get_transient($flagname_final) ) ) {
			if( ! $this->set_transient($flagname_final,0,0) ) {
				if( ! $this->set_transient($flagname_final,0,0) ) {
					throw new \Exception("Cant update status: $flagname_final | ". $GLOBALS['wpdb']->last_error);
				}
			}
		}
	}


	/*
 
		//		wp_register_script( 'jquery', false, array( 'jquery-core', 'jquery-migrate' ), '1.11.0' );
		//		wp_register_script( 'jquery-core', '/wp-includes/js/jquery/jquery.js', false, '1.11.0' ); 
				//force to load my JQUERY
				$registered	= wp_script_is( $name, 'registered' );
				$enqueued	= wp_script_is( $name, 'enqueued' );
				if (!$registered)	{ 
					if(!empty($GLOBALS['odd']['scripts'][$name]['js'])) {
						wp_register_script($name, $GLOBALS['odd']['scripts'][$name]['js'], 	array(), $this->changeable_JS_CSS_version, false );	
					}
					if(!empty($GLOBALS['odd']['scripts'][$name]['css'])) {
						wp_register_style( $name, $GLOBALS['odd']['scripts'][$name]['css'],	array(), $this->changeable_JS_CSS_version, false );	
					}
				}
				if (!$enqueued)		{
					if(!empty($GLOBALS['odd']['scripts'][$name]['js'])) {
						wp_enqueue_script( $name );
					}
					if(!empty($GLOBALS['odd']['scripts'][$name]['css'])) {
						wp_enqueue_style	( $name );
					}
				} 
	*/


	public function register_stylescript($admin_or_wp, $type, $handle=false, $url=false, $dependant=null, $version=false, $target=false)
	{
		add_action( $admin_or_wp.'_enqueue_scripts',	function() use($type, $handle, $url, $dependant, $version, $target) {
			$this->enqueue($type, $handle, $url, $dependant, $version, $target);
		}, 100); 
	}

	public function enqueue($type, $handle=false, $url=false, $dependant=null, $version=false, $target=false)
	{
		//lets allow shorthanded start
		$localstart = 'assets';
		if( substr($url,0, strlen($localstart) ) == $localstart ) {
			$url = $this->moduleURL. $url;
		}
		if ( ! call_user_func("wp_".$type."_is",	$handle, "registered" ) ){
			call_user_func("wp_register_".$type,	$handle, $url,  $dependant,  $version, $target );   //,'jquery-migrate'
		}
		if ( ! call_user_func("wp_".$type."_is",	$handle, "enqueued" ) ){
			call_user_func("wp_enqueue_".$type,	$handle);
		}
	}

	public function deregister_jquery_scripts($admin_or_public=true, $jquery_too=false)
	{
		add_action( ($admin_or_public ? 'admin':'wp').'_enqueue_scripts', function () use($jquery_too) {
			foreach([
				"jquery-ui-widget", "jquery-ui-mouse", "jquery-ui-accordion", "jquery-ui-autocomplete", "jquery-ui-slider", "jquery-ui-tabs",  "jquery-ui-draggable", "jquery-ui-droppable", "jquery-ui-selectable", "jquery-ui-position", "jquery-ui-datepicker", "jquery-ui-resizable", "jquery-ui-dialog", "jquery-ui-button", ($jquery_too ?'jquery':'') 
			] as $script) wp_deregister_script($script); 
		});
	}



	//if used earlier than INIT 
	public function get_permalink_ADOPTED($post=false){
		global $wp_rewrite;	
		if (empty($wp_rewrite)){
			if(is_object($post))	 {$link=$post->guid; }
			elseif(is_numeric($post)){ $post_obj=get_post($post, OBJECT); $link=get_permalink($post_obj->ID); }
		}
		else{
			if(is_object($post))	{ $link=get_permalink($post->ID);}
			else					{ $link=get_permalink($post); }
		}
		return  $link;
	}

	//add_filter('the_content', 'empty_div_add');
	public function empty_div_add($content) {
		if (defined('IS_SINGLEE') && IS_SINGLEE){ $content = '<div class="bef_cont_div"></div><div class="cont_div">'.$content.'</div><div class="aft_cont_div"></div>'; } 
		return $content;
	}


	public function redirect_to_homefolder($siteSlug= "geo")
	{
		// redirect to /GEO
		$redirect_lang = 1;
		if ($redirect_lang)
			if (!is_admin())
				if( stripos($this->currentURL,"/$siteSlug/")===false && stripos($this->currentURL,'/wp-login')===false  && stripos($this->currentURL,'/wp-admin')===false   )
					$this->php_redirect( str_replace($this->domain, $this->domain."/$siteSlug/",  $this->currentURL));
	}

	//not_founded_images_redirections (when on FTP, the file is not found, then automatically, the site is loaded.. so, in this case, use our function.
	public function not_found_images_redirect() {
		if (in_array( $this->get_url_parts($this->currentURL,'extension'), ['png','jpg','jpeg','gif','bmp','svg']))		{  
			echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?><svg viewBox="0 85 80 120" xmlns="http://www.w3.org/2000/svg"><style></style><text x="0" y="100" class="small">Image error</text></svg>'; exit;
		}
	}

	public function OutputImageFile($file=''){ 
		if ( !in_array( $this->getExtension($file), ['jpg','jpeg','png','bmp','gif']) ) exit ('');
		header("Content-type: image/png");  die( $this->file_get_contents($file)  ); 
	}

	public function get_parent_slugs_path($post){
		$final_SLUGG = '';
		if (!empty($post->post_parent)){
			$parent_post= get_post($post->post_parent);
			while(!empty($parent_post)){
				$final_SLUGG =  $parent_post->post_name .'/'.$final_SLUGG; 
				if (!empty($parent_post->post_parent) ) { $parent_post = get_post( $parent_post->post_parent); } else{ break ;} 
			}
		}
		return $final_SLUGG;
	}
	
	// https://stackoverflow.com/questions/18401236/custom-category-tree-in-wordpress
	//foreach (get_terms($allTermSlugs, array('hide_empty'=>0, 'orderby'=>'id', 'parent'=>0)  ) as $category)  echo my_Categ_tree($category->taxonomy,$category->term_id);
	public function my_Categ_tree($TermName='', $termID=null, $separator='', $parent_shown=true ){
		$args = 'hierarchical=1&taxonomy='.$TermName.'&hide_empty=0&orderby=id&parent=';
				if ($parent_shown) {$term=get_term($termID , $TermName); $output=$separator.$term->name.'('.$term->term_id.')<br/>'; $parent_shown=false;}
		$separator .= '-';	
		$terms = get_terms($TermName, $args . $termID);
		if(count($terms)>0){
			foreach ($terms as $term) {
				//$selected = ($cat->term_id=="22") ? " selected": "";
				//$output .=  '<option value="'.$category->term_id.'" '.$selected .'>'.$separator.$category->cat_name.'</option>';
				$output .=  $separator.$term->name.'('.$term->term_id.')<br/>';
				$output .=  my_Categ_tree($TermName, $term->term_id, $separator, $parent_shown);
			}
		}
		return $output;
	}


	public function wp_mails_init()
	{
		add_filter( 'wp_mail_from',			function( $email ) { return 'contact@'.$_SERVER['HTTP_HOST']; } );
		add_filter( 'wp_mail_from_name',	function( $name ) { return 'WordPress Email System'; } );
		add_filter( 'wp_mail_content_type', function($cotnent_type=false){ return "text/html"; } ) ;
		// $headers = array('Content-Type: text/html; charset=UTF-8')
	}

	public function recountCategories($tax_name='category')
	{
		$terms_ids = get_terms( ['taxonomy' => $tax_name, 'fields' => 'ids','hide_empty' => false]);
		wp_update_term_count_now( $terms_ids, $tax_name);
	}

	public function random_val_for_site($name){
		$randoms = get_site_option('randoms_for_main_site', array());
		if(empty($randoms) || empty($randoms[$name])){
			$randoms[$name]= random_stringg(16);
			update_site_option('randoms_for_main_site', $randoms);
		}
		return $randoms[$name];
	}


 
	// https://pastebin_com/sPb1qvJ0
	public function delete_transients_by_prefix($myPrefix, $table_name, $column_name, $prefix=false){
		global $wpdb;
		$myPrefix 		= sanitize_key($myPrefix);
		$sql = $wpdb->prepare("delete from %s where %s like '%s' or %s like '%s'", $table_name, $column_name, '%_transient_$myPrefix%', $column_name, "%_transient_timeout_$myPrefix%" );
		return $wpdb->query($sql);
	}

	// add tinymce styles
	public function add_tinymce_styles($styles){ add_filter( 'tiny_mce_before_init', function($settings) use($styles) { return $this->wptrac_36636_editor_inline_style22($settings, $styles); } );  }
	public function wptrac_36636_editor_inline_style22( $settings, $styles) {$settings['content_style'] = (!empty($settings['content_style']) ? $settings['content_style'] : '') . (!empty($styles) ? addslashes($styles) : ''); return $settings;}
	//add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );
	public function my_theme_add_editor_styles() {
		add_editor_style( PHP_customCALL_1.'tinymce_styles&ver='.$this->changeable_JS_CSS_version );
	}
	//if ( $act=='tinymce_styles'){ header('Content-Type: text/css');  echo '	.anons_of{background: gray;} html .mceContentBody { max-width:100%;}'; exit; }







	// NONCES
	public function defNonceAction($actionName=null){ return ($actionName!=null? $actionName :  "_nonceAction"."_".$this->slug); }
	public function defNonceSlug($slugName=null){ return ($slugName!=null? $slugName :  "_wpnonce"."_".$this->slug); }

	public function checkSubmission($action=null, $slug=null)
	{  
		$action = $this->defNonceAction($action);
		$slug   = $this->defNonceSlug($slug);
		$result = isset($_POST[$slug]) && check_admin_referer($action, $slug);
		return $result;
	}
	public function nonce($action=null, $slug=null, $echo=true)
	{
		$out = wp_nonce_field( $this->defNonceAction($action), $this->defNonceSlug($slug), true, false );
		if ($echo) echo $out; else return $out;
	}
	public function nonceSubmit($text=null, $action=null, $slug=null, $centeredFloat=false, $echo=true)
	{
		$x = $this->submit_button($text, $action, $slug, $centeredFloat);
		if ($echo) echo $x; else return $x;
	}
	public function submit_button($text=null, $action=null, $slug=null, $centeredFloat=false, $echo=false)
	{
		$out = '';
		$out .= $this->nonce( $this->defNonceAction($action), $this->defNonceSlug($slug), false );
		if ($centeredFloat) $out .= '<div class="centered-float submitbutton">';
		$out .= get_submit_button( $text, $type='button-primary', $name='', $wrap=true, $other_attributes= ['id'=>'mainsubmit-button'] );
		if ($centeredFloat) $out .=  '</div>';
		if ($echo) echo $out; else return $out;
	}
	// old
	public function NonceCheck($value, $action_name){ 
		if ( !isset($value) || !wp_verify_nonce($value, $action_name) ) { die("not allowed. error_5151, Refresh the page");}
	}	
	public function NonceCheckk($name='nonce_input_name', $action_name='blabla')  {
		return ( wp_verify_nonce($_POST[$name], $action_name)  ?  true : die("not allowed, refresh page!") );
	}
	public function NonceFieldd($name='nonce_input_name', $action_name='blabla')  { return '<input type="hidden" name="'.$name.'" value="'.wp_create_nonce($action_name).'" />';}





	#region ######### OPTIONS TABLES #########
	/* **** USAGE from plugin *****
		$optsArray = [
			'send_email_to_me'     => ['value'=>true, 'description'=> 'allow sending mail to me'],
			'interval_seconds'     => ['value'=>30],
			'title_of_address'     => ['value'=>'wzt street #2', 'type'=>'textarea'],
		];
		$this->helpers->options_table_full( ['class'=>$this, 'prefix'=>'my_diary', 'options'=>$optsArray, 'in_form'=>true] );
	*/

	public function options_table_full( $args ){
		try{
			$holder_class       = $args['class'];
			$prefix				= $args['prefix']; 
			$initialOpts = $this->array_value ($args, 'options', $holder_class->initial_options_arrays[$prefix]);
			$updatedCallback = $this->array_value ($args, 'updatedCallback', null);
			$res = $this->options_default_parse( ['options'=>$initialOpts, 'prefix'=>$prefix, 'nonce'=>$args['nonce'], 'updatedCallback'=>$updatedCallback] );
			if (!empty($res)){
				$holder_class->setSubOption($prefix, $res);
			}
			echo $this->options_default_table( ['options'=>$initialOpts, 'currentvalues'=>$holder_class->getSubOption($prefix), 'prefix'=>$prefix, 'nonce'=>$args['nonce'], 'echo'=>$this->array_value($args,'echo',  false), 'echo'=>$this->array_value($args,'in_form', true) ]  );
		}
		catch(\Exception $ex){
			$this->var_dump($ex);
		}
	}

	public function options_default_table($args){
		$options_array      = $args['options'];
		$currentvalues_array= $args['currentvalues'];
		$prefix				= $args['prefix'];
		$nonceKey			= $args['nonce'];
		$echo				= $this->array_value($args,'echo',  false);
		$form				= $this->array_value($args,'in_form',  true);

		$out ='';
		$out .= $form ? '<form class="mainForm" method="post" action="">' : '';
 
		$out .= '<style> .form-table .sub_group_array{margin:20px; display:flex; flex-wrap:wrap; } .form-table .arraydiv{display: flex; flex-direction: column; background: #e7e7e7d7; margin: 2px; padding: 4px;}  </style>';
		$out .= '<table class="form-table"><thead></thead><tbody>';
		foreach($options_array as $key=>$block){
			// if block is also array of groups
			if(!array_key_exists('value',$block)){
				throw new \Exception('options_default_table: "value" key doesnt exist in block');
			}
			else{
				$line = $this->helper_optionsblock_TD($key,$block,$prefix,$currentvalues_array, $desc);
				// add line
				$out .= '<tr class="trline '.$key.'"><td>'. $desc .'</td><td>'.$line.'</td> </tr>';
			}
		}
		$out .= '</tbody></table>';

		$out .= $form ? $this->submit_button('SAVE SETTINGS', $nonceKey, 'nonceactxwe3_'.$prefix).'</form>' : '';
		return $out;
	  }
	  
	public function helper_optionsblock_TD($key, $block, $prefix,$currentvalues_array, &$desc){
		$desc = !empty( $this->array_value($block,'description') ) ? $this->array_value($block,'description') : $key;
		$type = !empty( $this->array_value($block,'type') )        ? $this->array_value($block,'type')        : $key;
		$line = '';
		$val = $block['value'];
		$placeholder = $this->array_value($block,'placeholder', $this->array_value($block,'value','')); 
		if    ( is_bool($val) )
			$line .= '<input name="'.$prefix.'['.$key.']" value="1" type="checkbox" '. $this->checked_if_value($currentvalues_array,$key).' />';
		elseif( is_double($val) )
			$line .= '<input name="'.$prefix.'['.$key.']" value="'. $this->array_value($currentvalues_array,$key) .'" placeholder="'.$placeholder.'" style="width:70px;" />';
		elseif( is_integer($val) )
			$line .= '<input name="'.$prefix.'['.$key.']" value="'. $this->array_value($currentvalues_array,$key) .'" placeholder="'.$placeholder.'" style="width:70px;" />';
		elseif( is_string($val) ){
			if($type=='textarea') 
				$line .= '<textarea name="'.$prefix.'['.$key.']" placeholder="'.$placeholder.'" >'. $this->array_value($currentvalues_array,$key) .'</textarea>';
			else if($type=='html') 
				$line .= $val; 
			else                  
				$line .= '<input name="'.$prefix.'['.$key.']" value="'. $this->array_value($currentvalues_array,$key) .'" placeholder="'.$placeholder.'" />'; 
		}
		elseif( is_array($val) ) {
			$arr = $this->array_value($currentvalues_array,$key);
			$rand_id=$this->randomId('v');
			if(!array_key_exists('disable_autoadd',$block)) $arr[$rand_id] = '';
			$line .= '<div class="sub_group_array">';
			foreach($arr as $bKey=>$bValue ){ 
				$is_random = $bKey==$rand_id;
				if( isset($bValue) || $is_random ) {	
					$line .= '<div class="arraydiv">';
					$line .= "<span>{$bKey}</span>";
					if($type=='textarea') 
						$line .= '<textarea name="'.$prefix.'['.$key.']['.$bKey.']" placeholder="'. (!is_array($placeholder)? $placeholder : '').'">'. $bValue .'</textarea>'; 
					else                  
						$line .= '<input name="'.$prefix.'['.$key.']['.$bKey.']" value="'. $bValue .'" placeholder="'. (!is_array($placeholder)? $placeholder : '').'" />'; 	
					$line .= '</div>';
				}
			}
			$line .= '</div>';
		}
		else{  //default to textbox
			$line .= '<input name="'.$prefix.'['.$key.']" value="'. $this->array_value($currentvalues_array,$key) .'" placeholder="'.$val.'" />'; 
		}
		return $line;
	  }

	public function options_default_parse( $args ){
		$res = [];
		$options_array      = $args['options'];
		$prefix				= $args['prefix'];
		$nonceKey			= $args['nonce']; 

		if( $this->checkSubmission( $nonceKey, 'nonceactxwe3_'.$prefix) ) {
			foreach($options_array as $key=>$block){
				$val = $block['value'];
				$type = $this->array_value ($block, 'type', '');
				if ($type === 'html') continue;
				if    ( is_bool   ($val) )   $res[$key] = isset($_POST[$prefix][$key]); 
				elseif( is_double ($val) )   $res[$key] = (double)($_POST[$prefix][$key]); 
				elseif( is_integer($val) )   $res[$key] = (int)($_POST[$prefix][$key]); 
				elseif( is_string ($val) )   $res[$key] = stripslashes(sanitize_textarea_field($_POST[$prefix][$key])); 
				elseif( is_array  ($val) )	$res[$key] = $this->array_map_recursive( 'stripslashes', $this->array_map_recursive( 'sanitize_textarea_field', $_POST[$prefix][$key] ) );
			}
			if (array_key_exists('updatedCallback',$args)) call_user_func($args['updatedCallback']);
		}
		return $res;
	}
	#endregion

	// backend
	private function backendActKey($actName){ return 'puvox_backend_call_'.$this->slug. "_".sanitize_key($actName); }
	public function add_action_backend_call($actName, $callback){
		add_action( $this->backendActKey($actName), $callback );
	}

	public function register_backend_call_actions(){
		add_action( 'wp_ajax_'.$this->plugin_slug_u.'_all',	[$this, 'ajax_backend_call'] );
		add_action( 'wp_ajax_nopriv_'.$this->plugin_slug_u.'_all',	[$this, 'ajax_backend_call_nopriv'] );
	}
	public function ajax_backend_call()
	{
		if(isset($_POST['action']) && $_POST['action']==$this->plugin_slug_u .'_all')
		{
			if( empty( $_POST["_wpnonce"] ) || !wp_verify_nonce( $_POST["_wpnonce"], "Puvox_BackendCallJS") ) 
			{
				exit( __('Incorrect nonce. Refresh page and try again.') );
			}

			if(isset($_POST['PRO_check_key'])){
				echo $this->license_status( sanitize_text_field($_POST['PRO_check_key']), "activate");
			}

			elseif(isset($_POST['PRO_save_results'])){

			}
			else{
				do_action($this->backendActKey($_POST['act']));
			}
			wp_die();
		}
		exit( __('Unknown-action') );
	}
	public function ajax_backend_call_nopriv(){
		
	}
	



	//if(!getBlogName()) { header("Location: http://www.mydomain.com/", true, 301); exit; }
	public function getBlogName(){
		global $current_blog; 
		$blog_path = explode('/',$current_blog->path); 
		if(isset($blog_path[2])) {
			return $blog_path[2];
		}
	}

	
	
	public function unzip_url($url, $where)
	{
		$zipLoc = $where.'/temp_'.rand(1,999999). "_". (basename($url)).'.zip';
		wp_remote_get
		(
			$url,
			[
				'timeout'  => 300,
				'stream'   => true,
				'filename' => $zipLoc
			]
		);
		$this->unzip($zipLoc, $where);
		@unlink($zipLoc);
	}

	public function unzip($path, $where)
	{ 
		$this->file->create_directory($where);
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		\WP_Filesystem();
		\unzip_file($path, $where);
		$this->usleep(300000);
	}
	
	public function unzip_in_dir($dir, $rewrite=true)
	{
		$this->temp_unziped_folders = [];
		foreach( array_filter(glob($dir.'/*.zip'), 'is_file')  as $each_zip)
		{
			$uniqueTag	= md5($each_zip);
			$each_dir	= substr($each_zip, 0, -4); //trim .zip
			if (empty($each_dir)) return; // ! must have, to avoid empty directory threat

			// remove if previous unpack was partial.
			if( is_dir($each_dir) && $rewrite )
			{
				if( !array_key_exists($uniqueTag, $this->temp_unziped_folders) || $this->temp_unziped_folders[$uniqueTag]==false )
				{
					$this->file->delete_directory($each_dir);
					$this->usleep(500000);
					//$this->create_directory($pathh);
				}
			}
			elseif( !is_dir($each_dir) )
			{
				$this->temp_unziped_folders[$uniqueTag] = false;
				$this->unzip($each_zip, dirname($each_zip));
				$this->temp_unziped_folders[$uniqueTag] = true;
			}
		}
	}


	public function is_plugin_active($name)  //i.e. woocommerce/woocommerce.php
	{
		return in_array($name, get_option('active_plugins') );
	}
	public function woocommerce_products_to_array($products)
	{
		$new = [];
		foreach($products as $p) $new[] =$p->get_data(); 
		return $new;
	}
	
	
	//disable emojis
	public function disable_emojicons()
	{
		add_action( 'init', function () {
		  // all actions related to emojis
		  remove_action( 'admin_print_styles', 'print_emoji_styles' );
		  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		  remove_action( 'wp_print_styles', 'print_emoji_styles' );
		  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		} );

		//to remove emojis from TinyMCE
		add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		  if ( is_array( $plugins ) ) {  return array_diff( $plugins, array( 'wpemoji' ) );} 
		  else { return array(); }
		} );
	}

	//add_action( 'admin_init', 'theme_options_init' );
	public function theme_options_init(){	 
		// https://codex.wordpress.org/Function_Reference/add_settings_field#Examples
		add_settings_field( 'myprefix_setting-id', 'This is the setting title', 'myprefix_setting_callback_function', 'general', 'myprefix_settings-section-name', array( 'label_for' => 'myprefix_setting-id' ) );
		
		// https://codex.wordpress.org/Function_Reference/add_settings_section#Notes
		add_settings_section('eg_setting_section',	'Example settings in reading',		'funcXXXX',		'reading');
		function funcXXXX( $arg ) {
			// echo section intro text here
			echo '<p>id: ' . $arg['id'] . '</p>';             // id: eg_setting_section
			echo '<p>title: ' . $arg['title'] . '</p>';       // title: Example settings section in reading
			echo '<p>callback: ' . $arg['callback'] . '</p>'; // callback: eg_setting_section_callback_function
		}
		//register_setting( 'bbbbbla', 'sample_theme_options');
	}
	

	public function shortcode_handler_OLD($atts, $content=false){
		$d=debug_backtrace()[0];
		if(!empty($d['args']))
		{
			if(!empty($d['args'][2]))
			{
				$name = $d['args'][2];
				$args = $this->shortcode_atts($name, $atts);
				return call_user_func( [$this, $name], $args, $content);
			}
		}
	}

	//Advanced custom fields alternative 
	public function acf_getfield_detect(){
		add_action('plugins_loaded', function(){
			if (!function_exists('get_field')){
				function get_field(){
					return 'Advanced Custom Fields plugin is not installed';
				}
			}
		}, 1);
	}
	
	
    public function jqueryRestore() { 
		add_action('admin_head',function(){ echo '<script>$=jQuery;</script>'; });
		add_action('wp_head',	function(){ echo '<script>$=jQuery;</script>'; });
	}

	public function disable_update_email_notifications(){
		add_filter( 'auto_core_update_send_email', function ( $send, $type, $core_update, $result ) { return ( ! empty( $type ) && $type == 'success'  ? false : true); }, 10, 4 );
		add_filter( 'auto_plugin_update_send_email', '__return_false' );
		add_filter( 'auto_theme_update_send_email', '__return_false' );
	}

	// ================ flash rules ================= // 
	public function flush_rules_double(){ add_action('wp', [$this, 'MyFlush__rewrite'] ); }
	public function MyFlush__rewrite($RedirectFlushToo=false){	
		$GLOBALS['wp_rewrite']->flush_rules(); 
		flush_rewrite_rules();
		//DUE TO WORDPRESS BUG ( https://core.trac.wordpress.org/ticket/32023 ) , i use this: (//USE ECHO ONLY! because code maybe executed before other PHP functions.. so, we shouldnt stop&redirect, but  we should redirect from already executed PHP output )
		if($RedirectFlushToo) {echo '<form name="mlss_frForm" method="POST" action="" style="display:none;"> <input type="text" name="mlss_FRRULES_AGAIN" value="ok" /> <input type="submit"> </form> <script type="text/javascript"> document.forms["mlss_frForm"].submit(); </script>';}
	}
	public function flush_rules($redirect=false){
		flush_rewrite_rules();
		if($redirect) {
			if ($redirect=="js"){ $this->js_redirect(); }   else { $this->php_redirect(); }
		}
	}
	

	
	// ==================== shortcodes =======================
	public function shortcode_atts($shortcode, $predefined_atts, $passed_atts){
		$new_arr=[]; 
		foreach($predefined_atts as $x){
			$new_arr[ $x[0] ] =  $this->stringToValue($x[1]) ;
		}
		if (!empty($passed_atts)) {
			$filtered_atts=[];
			foreach($passed_atts as $key=>$value){
				$filtered_atts[$key] =  $this->stringToValue($value) ;
			}
			$new_arr = array_merge($new_arr, $filtered_atts);
		}
		$new_arr = $this->sanitize_shortcode_empty_defaults_pre($new_arr);
		$new_atts = shortcode_atts($new_arr, [] );
		return $new_atts;
	}
	
	public function sanitize_shortcode_empty_defaults_pre($atts){
		$ar= ["...","___", 0];
		foreach($ar as $e) { if (array_key_exists($e, $atts)) unset($atts[$e]); }
		return $atts;
	}
	
	public function sanitize_shortcode_empty_defaults($attsArray){
		$new_arr = [];
		foreach($attsArray as $eachAttArr)
		{ 
			if ( empty($eachAttArr[0]) || in_array($eachAttArr[0], ["...","___"] )  ) continue;
			$new_arr[] = $eachAttArr;
		}
		return $new_arr;
	}
	public function shortcode_alternative_message($name, $params_name=false)
	{
		?>
		<div class="alertnative_to_shortcodes">
			<h2><?php _e('(Alternatives to shortcode)'); ?></h2>
			<?php _e('Note, you can always use programatical approach using:'); ?> 
			<br/> <code>&lt;?php echo do_shortcode('[.....]'); ?&gt;</code>
			<br/> or 
			<br/> <code>&lt;?php if (function_exists('<?php echo $name;?>'))		{ echo <?php echo $name;?>(["arg1"=>"value1", ...]); } ?&gt;</code>
		</div>
		<?php
	}
	
	public function shortcode_example_string($array, $strip_tags=false, $htmlentities=false, $ended=false){
		
		$out = '<code>';
		$out .= '['. $array['name'].'<span class="shortcode_atts">';  $atts = $this->sanitize_shortcode_empty_defaults($array['atts']); foreach( $atts  as $key=>$value){ $out .= " ".$value[0].'="'. htmlentities($this->truefalse_to_string($value[1])).'"';} $out .='</span>]'; 
		$out = ( $strip_tags	? strip_tags($out) : $out);
		$out = ( $htmlentities	? htmlentities($out) : $out);		
		if( $ended ) 
			$out .= "...[/".$array['name']."]";
		$out .= '</code>';
		return $out;
	}

	public function shortcode_example($shortcode, $array, $ended=false){
		$out="[$shortcode ";   foreach($array as $key=>$value){   $out .= $key.'="'.$this->valueToString($value) .'" ';  }   $out = trim($out). "]";
		if( $ended ) 
			$out .= "...[/$shortcode]";
		return $out;
	}

	public function shortcodes_table($name, $array)
	{ 
	// ======= example ========
	//	
	//	$this->shortcodes_table( "breadcrumbs", [
	//		[ 'id', 				'',			__('Post ID (you can ignore that parameter if you want to get for current post)', 'breadcrumbs-shortcode') ],
	//		[ 'delimiter',			'hello', 	__('Your desired delimiter', 'breadcrumbs-shortcode') ],
	//	] );
		
	?>
	<div class="shortcodes_block">
		<h3><?php echo $array['description'];?></h3>
		<table class="form-table shortcodes">
		<tr>
			<td><?php _e('Example:');?></td>
			<td>
				<?php echo $this->shortcode_example_string($array, false,false, array_key_exists('ended', $array) );?>
			</td>
		</tr>
		<tr>
			<td><?php _e('Parameters:');?></td>
			<td>
				<table>
				<tr class="shortcode_tr_descr">
					<td><?php _e('name');?></td><td><?php _e('default value');?></td><td><?php _e('description');?></td>
				<tr>
				<?php 
				foreach($array['atts'] as $key=>$value)
				{ ?>
				<tr>
					<td><code><?php echo htmlentities($value[0]);?></code></td><td><code><?php echo htmlentities($this->truefalse_to_string($value[1]));?></code></td><td><?php echo $value[2];?></td>
				</tr>
				<?php 
				}
				?>
				</table>
			</td>
		</tr>
		</table>
	</div>
		<?php
	}
	
	public function extendShortcodes(){
		add_shortcode ('date_day', function(){ return date_i18n ('l'); } );
		add_shortcode ('date_month', function(){ return date_i18n ('F'); } );
		add_shortcode ('date_year', function(){ return date_i18n ('Y'); } );
		add_shortcode ('date_ymd', function(){ return date_i18n ('y-m-d'); } );

		add_shortcode('image', function ($atts){ 	$GLOBALS['CategImgggg'] = $atts['url'];
			return '<div class="ImgShortcodeHolder"><img src="'.$atts['url'].'" alt="'.(!empty($atts['title']) ? $atts['title'] : basename($atts['url']) ).'" class="ShortcImageee" /></div>';
		}); 
		add_shortcode('link', function ($atts){
			return '<a href="'.basename($atts['url']).'" class="ShortcLinkk" target="_blank" />'.(!empty($atts['title']) ? $atts['title'] : basename($atts['url']) ).'</a>';
		} ); 

		add_shortcode('iframe', function ($atts){ 
			return '<div class="IframeHolder ifr_'.(!empty($atts['class']) ? $atts['class'] : 'defclass' ).'"><iframe src="'.$atts['url'].'"></iframe></div>';
		} ); 
		add_shortcode('@', function ($atts){ 
			return '&#64;';
		} );
		
		add_shortcode('script', function ($atts, $content=false){
			$cont= urldecode(  $content ? $content : $atts['content'] ); 
			return '<span class="cont_script '.(strpos($cont,'<iframe ')!== false  ?  'contains_frame':'') .'">'.$cont.'</span>';
		} ); 

		add_shortcode('list_subpages', function ($atts){ $out = ''; 
			if (IS_SINGULARR){
				$id= $GLOBALS['post']->ID;
				$args = array(
					'authors'=>'',  'child_of'=>$id,   'date_format'=>get_option('date_format'), 'depth'=> 0, 'echo'=>0,'exclude'=>'','include'=>'',
					'link_after'=>'',   'link_before'=>'',  'post_type'=>'page',  'post_status'=>'publish',  'show_date'=>'',  
					'sort_column'=> 'post_date', //'menu_order, post_title',
					'sort_order'=> '',  'title_li'=> __(''),   //'walker'       => new Walker_Page
				);
				$out = wp_list_pages( $args );
			}
			return '<div class="my_subpagelistt">'.$out.'</div>';
		} ); 


		add_shortcode( 'Youtube', function ($atts){
			$idd = get_youtube_id_from_contents($atts['url']);
			return '<div style="clear:both;"></div><div class="ytframe_parent"><iframe class="ytb_framee"  src="https://www.youtube.com/embed/'.$idd.'?rel=0" frameborder="0" allowfullscreen></iframe><div style="clear:both;"></div></div>';
		} );

		add_shortcode('video', function ($atts){ 
			$url	= $atts['url'];
			$player = !empty($atts['player']) ? $atts['player'] : 1;
			
			if ($player==1) { $out = 
				'<style type="text/css">body .video-js .vjs-tech {position:relative;} body #my-video{width: 80%; margin: 0 0 0 10%;} body .video-js .vjs-big-play-button{left: 45%; top:45%;}</style> 
				<video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
				poster="" data-setup="{}">
				<source src="'.$url.'" type="video/mp4">
				<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
				</video>';
			}
			elseif ($player==2) { $out = '<video width="'. (!empty($atts['width']) ? $atts['width'] : 480) . '" height="'. (!empty($atts['width']) ? $atts['width'] : 320) . '" controls="controls" preload="auto" poster="#"> <source src="'.$url.'" type="video/mp4" /> </video>';}
			else {$out='';}
			
			return '<div class="VidShortcodeHolder">'.$out.'</div>';
		} ); 
		
		add_shortcode('childpages', function($atts) { 
			global $post; 
			$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of='.$post->ID.'&echo=0&depth=1' );
			if ( $childpages ) {
				$string = '<ul class="child_page_list">' . $childpages . '</ul>';
			}
			return $string;
		});

		// i.e. [list type="categories"	id="32" depth=0 exclude="4,28"] 
		// i.e. [list type="pages"		id="32" depth=0 exclude="4,28"]    (or id="this")
		// i.e. [list type="menu" id="32"]
		add_shortcode( 'list',  function ($atts){
			global $post;
			$TYPEE	= !empty($atts['type'])	? $atts['type']	: '';  if(empty($TYPEE)) { return 'error2229.  please, set "type" parameter' ;  }
			$args	= $atts;

			if ( 'pages' == $TYPEE){
				// https://codex.wordpress.org/Function_Reference/wp_list_pages   //authors,child_of,date_format,depth,echo,exclude,include,link_after,link_before,post_type,post_status,show_date,sort_column,sort_order,title_li,
						if (empty($args['sort_column'])){$args['sort_column']= 'post_date';}
						//when ESSENTIAL parameters are not set
						if (empty($args['child_of']))	{ return 'error494__set child_of parameter for listed ' .$TYPEE;}
							elseif ($args['child_of']=='this') { $args['child_of']= $post->ID;}
						if (empty($args['depth']) )		{ $args['depth']= 1;}
						if (empty($args['echo']) )		{ $args['echo']	= 0;}
						if (empty($args['title_li']) )	{ $args['title_li']	= "";}
						if (empty($args['post_type']))	{ $args['post_type']=$post->post_type;} 
				$X= wp_list_pages($args);
			}
			
			elseif ( 'categories' == $TYPEE){
				// https://codex.wordpress.org/Function_Reference/wp_list_categories //show_option_all,orderby,order,style,show_count,hide_empty,use_desc_for_title,child_of,feed,feed_type,feed_image,exclude,exclude_tree,include,hierarchical,show_option_none,number,echo,current_category,pad_counts,taxonomy
				
						//when ESSENTIAL parameters are not set
						if (empty($args['child_of']))		{ return 'error494__set child_of parameter for listed ' .$TYPEE;}
						if (empty($args['depth']) )			{ $args['depth']= 0;}
						if (empty($args['echo']) )			{ $args['echo']	= 0;}
						if (empty($args['hide_empty']) )	{ $args['hide_empty']= 0;}
						if (empty($args['title_li']) )		{ $args['title_li']	= "";}
						
					//this doesnt work when used inside LOOP
						//$X =  get_categories('echo=1&child_of=30') );
				$X = wp_list_categories($args);
			}
			elseif ( 'posts' == $TYPEE){
				// https://codex.wordpress.org/Function_Reference/wp_list_categories //show_option_all,orderby,order,style,show_count,hide_empty,use_desc_for_title,child_of,feed,feed_type,feed_image,exclude,exclude_tree,include,hierarchical,show_option_none,number,echo,current_category,pad_counts,taxonomy
				
						//when ESSENTIAL parameters are not set
						if (empty($args['child_of']))		{ return 'error494__set child_of parameter for listed ' .$TYPEE;}
						if (empty($args['depth']) )			{ $args['depth']= 0;}
						if (empty($args['echo']) )			{ $args['echo']	= 0;}
						if (empty($args['posts_per_page']) ){ $args['posts_per_page']	= -1;}
						if (empty($args['hide_empty']) )	{ $args['hide_empty']	= 0;}
						if (empty($args['post_type']) )		{ $args['post_type']	= get_post_types();}
						if (empty($args['category']) )		{ $args['category']	= $args['child_of'];}
						
				$out = '';
				$array =  get_posts($args); 
				foreach ($array as $key=> $value) {
					$out .= '<li class="manual_posts"><a href="'.get_permalink($value->ID).'">'.$value->post_title.'</a></li>';
				}

					//this doesnt work when used inside LOOP
						//$X =  get_categories('echo=1&child_of=30') );
						//$X = wp_list_categories($args);
				$X =$out;
			}
			elseif ( 'menu' == $TYPEE){
				// https://codex.wordpress.org/Function_Reference/wp_nav_menu  //theme_location,menu,container,container_class,container_id,menu_class,menu_id,echo,fallback_cb,before,before,after,link_before,link_after,items_wrap,depth,
					
						//when ESSENTIAL parameters are not set
						if (empty($args['menu']))	{ return 'error494__set "menu" parameter for listed ' .$TYPEE;}
				$X= wp_nav_menu($args);
					//https://codex.wordpress.org/Function_Reference/wp_nav_menu
					//https://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
					$sample_arr= array(
						'theme_location'  => '',
						'menu'            => '_main_menu',
						'container'       => 'div',			'container_class' => 'sideMyBox',			'container_id'    => 'my_SideTreeee',
						'menu_class'      => 'menu',		'menu_id'         => '',
						'echo'            => 0,				'fallback_cb'     => 'wp_page_menu',
							'before'          => '',		'after'           => '',
							'link_before'     => '',		'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
					);
			}
			return '<div class="listed_shortcode listed_'.$TYPEE.'"><ul>'.$X.'</ul></div>';
		} );

	} 
	
	// ==================== END | Shortcodes =======================
	
	
	
	
	public function init__cookieexpiration(){   add_filter('auth_cookie_expiration', [$this,'my_auth_cookie_expiration'], 99, 3);   }
	public function my_auth_cookie_expiration($seconds, $user_id, $remember){
		$expiration = $remember ? $this->auth_expiration_hours*60*60 : 2*24*60*60;

		// https://en.wikipedia.org/wiki/Year_2038_problem
		if ( PHP_INT_MAX - time() < $expiration ) {
			//Fix to a little bit earlier!
			$expiration =  PHP_INT_MAX - time() - 5;
		}
		return $expiration;
	}

	//breadcrumbs: pastebin_com/CzNyaEKE
	public function addTitleFieldToCat(){
		add_action ( 'edit_category_form_fields', function(){
			$cat_title = get_term_meta( (int) $_POST['tag_ID'], '_pagetitle', true);
			?> 
			<tr class="form-field">
				<th scope="row" valign="top"><label for="cat_page_title"><?php _e('Category Page Title'); ?></label></th>
				<td>
				<input type="text" name="cat_title" id="cat_title" value="<?php echo $cat_title ?>"><br />
					<span class="description"><?php _e('Title for the Category '); ?></span>
				</td>
			</tr>
			<?php
		});
		add_action ( 'edited_category', function() {
			if ( isset( $_POST['cat_title'] ) ) {
				update_term_meta( (int) $_POST['tag_ID'], '_pagetitle', sanitize_text_field($_POST['cat_title']) );
			}
		} );
	}


	public function get_template_filename($post_id=false){
		if(is_page()){
			$name=	get_post_meta( $post_id ?: $GLOBALS['post']->ID, '_wp_page_template', true);   // page-templates/my_homepage_1.php
			return basename($name);
		}
		return false;
	}


	// disable georgian russian slugs: https://pastebin_com/UmvhEmuz
 
	//execute explicitly when testing
	//add_action('save_post',  function () { var_dump($_POST); exit; }, 99, 11);  

	public function debug_actions(){	add_action( 'wp_footer', function (){ var_dump( $GLOBALS['wp_filter']); } );   }
	public function calledScript()	{ return $_SERVER["SCRIPT_FILENAME"];}
	public function is_subscriber()	  { return $this->is_helper_('read'); }
	public function is_contributor()  { return $this->is_helper_('edit_posts'); }
	public function is_author()		  { return $this->is_helper_('upload_files'); }
	public function is_editor()		  { return $this->is_helper_('edit_others_posts'); }
	public function is_administrator(){ return $this->is_helper_('install_plugins'); }
	private function is_helper_($what){ return (function_exists('current_user_can') || require_once(ABSPATH.'wp-includes/pluggable.php')) && current_user_can($what); }

	public function user_id(){return (function_exists('current_user_can') || require_once(ABSPATH.'wp-includes/pluggable.php')) ? get_current_user_id() : -1; }
	public function initIfEditor($func, $initPriority=1){
		add_action('init', function() use ($func) { 
			if ($this->is_editor()) 
				call_user_func($func);
		}, $initPriority);
	}

	public function get_user_role( $user_id = 0 ) {
		$user = ( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();
		return current( $user->roles );
	}


	// ##############
	public function get_transient($transientName, $default=''){
		if( ($value = get_transient($transientName))===false ) { 
			$value = $default;
		}
		return $value;
	}
	public function set_transient($transientName, $value, $seconds=8640000){
		return set_transient($transientName, $value, $seconds);
	}
	public function append_transient_array($transientName, $key=null, $valueToAddInArray=null, $seconds=8640000, $autoreset_if_array_above=999){
		$current_arr= $this->get_transient($transientName, []);
		if( count($current_arr) > $autoreset_if_array_above ) 
		$current_arr = $this->array_part( $current_arr, $autoreset_if_array_above, 'end');
		if ($key) $current_arr[$key] = $valueToAddInArray;
		else $current_arr[] = $valueToAddInArray;
		return $this->set_transient($transientName,$current_arr, $seconds);
	}

	public function timer_remains( $uniqueActionId, $cache_seconds=9999999999, $reset=false ){
		return $this->check_timer_remains($uniqueActionId, $cache_seconds, $reset );
	}
	public function check_timer_remains($uniqueActionId, $cache_seconds=9999999999, $reset=false ){
		$remains = 0;
		if ( $cache_seconds>0 )
		{
			$transientName = $this->slug ."_px_timer_flag_".$uniqueActionId;
			$last_time = $this->get_transient($transientName,0);
			if( $last_time > 0  ) { 
				$remains = ($last_time + $cache_seconds) - time();
				if ($reset)
					$this->set_transient($transientName, time(), $cache_seconds);
			}
			else{
				$this->set_transient($transientName, time(), $cache_seconds);
			}
		}
		return $remains;
	}

	public function check_timer_remains_function($uniqueActionId, $callback, $cache_seconds=9999999999){
		$remains = 0;
		if ( $cache_seconds>0 )
		{
			$transientName = $this->slug ."_px_timer_flag_".$uniqueActionId;
			$last_time = $this->get_transient($transientName,0);
			if( $last_time > 0  ) { 
				$remains = ($last_time + $cache_seconds) - time();
			}
			else{
				call_user_func($callback);
				$this->set_transient($transientName, time(), $cache_seconds);
			}
		}
		return $remains;
	}


	//delete all transients:
	public function delete_all_transients(){
		global $wpdb; 
		$wpdb->query("DELETE FROM `{$wpdb->prefix}options` WHERE `option_name` LIKE ('_transient_%');");
		$wpdb->query("DELETE FROM `{$wpdb->prefix}options` WHERE `option_name` LIKE ('_site_transient_%');");
	}
	
	public function option_exists($name, $site_wide=false){
		global $wpdb;
		$tablename = ($site_wide ? $wpdb->base_prefix : $wpdb->prefix).'options';
		$sql = $wpdb->prepare("SELECT * FROM " . $tablename . " WHERE option_name ='%s' LIMIT 1", $name);
		return $wpdb->query($sql);
	}

	public function transient_exists ($transientName, $site_wide = false) {
		// get_option('_transient_timeout_' . $your_transient);  gets timestamp of expiration, but is heavier than below line
		return $this->option_exists('_transient_timeout_'.$transientName, $site_wide);
	}



	// ################################

	public function post_is_in_descendant_category($cat, $postttId) {
		$descendants = array_merge( array($cat,''),     get_term_children((int) $cat, 'category')   ); 
		return (in_category($descendants, $postttId))  ? true : false;
	}

	//if post is ansector of category  //is_category(4)		
	public function post_or_cat_is_in_ansector($upper_category_id){
		$truee_fals =false;	global $post;
		//for categories
		if (is_archive())	{ $cur_cat_id = get_query_var('cat');
			if ($cur_cat_id == $upper_category_id || cat_is_ancestor_of($upper_category_id, $cur_cat_id)) {return true;} 
		}
		else	{
			if (in_category( $upper_category_id, $post->ID )) { return true;} 
		}
		//$curr_post = get_post($post->ID); $truee_fals=cat_is_ancestor_of($upper_category_id, $curr_post->$post_category) ? true : $truee_fals;
		
	}


	public function output_js_categories_ids()
	{
		if( ! ($out = get_transient('termids_for_js'))) {
			$terms= get_terms();
			foreach($terms as $term){
				$cats[$term->term_id] = urldecode($term->slug);
			}
			$out = json_encode($cats, JSON_UNESCAPED_UNICODE);
			set_transient('termids_for_js', $out , 60*60);
		}
		echo "<script>cat_term_ids = $out;</script>";	
	}			
		
			
	public function get_metas_by_metakv($key, $value=null, $what=false) {
		global $wpdb;
		$results =  $wpdb->get_results( 
			$wpdb->prepare( "SELECT %s FROM ".$wpdb->postmeta." WHERE meta_key=%s %s", ($what ?: "*"),  $key,  ($value ? " AND meta_value=$value" : "") ) 
		);

		if (!empty($results)) {
			if ($what){
				$array= array();
				foreach($results as $index => $result) {  $array[$index] = $result->{$what};  }
				return $array;	
			}	
			return $results;
		}
		return false;
	}
		
 
	
	// metaboxes, meta-box, media-uploaders:  https://pastebin_com/ePszrRWb
	
	public function error_mail($subject, $text){
		return wp_mail(get_option('admin_email'),  $subject,  $text );
	}

	public function myframe_center($content){
		if(is_singular() && stripos($content,'<iframe') !==false){
			$content= preg_replace('/\<iframe (.*?)\>/si','<div class="frame_parentt" style="text-align:center;">$0</div>', $content);
		}
		return $content;
	}

	public function change_output()
	{
		add_action('wp_loaded', function() { ob_start( function ($buffer) {
			// modify buffer here, and then return the updated code
			$buffer = str_replace('MERCEDES','FERRARIIII',$buffer);
			return $buffer;
		}); } ); 
		add_action('shutdown',  function() { ob_end_flush(); } );     
	}

	public function disable_rest_api()
	{
		$restrict_rest_api_to_localhost = function () {
			$whitelist = [ '127.0.0.1', "::1" ];

			if( ! in_array($_SERVER['REMOTE_ADDR'], $whitelist ) ){
				die( 'REST API is disabled.' );
			}
		};
		add_action( 'rest_api_init', $restrict_rest_api_to_localhost, 0 );
		
		$func= function( $result ) {
			if ( ! empty( $result ) ) {
				return $result;
			}
			if ( ! is_user_logged_in() ) {
				return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
			}
			return $result;
		};
		add_filter( 'rest_authentication_errors', $func);
	}

    
	// name, columns (included), excluded
	public function output_table_from_db_table($opts)
	{
		$opts['excluded'] = $this->array_value($opts,'excluded',[]);
		$opts['reverse']  = $this->array_value($opts,'reverse',true);
		$opts['limit']    = $this->array_value($opts,'limit',9999);
		$opts['datetime_key']  = $this->array_value($opts,'datetime_key', 'time');


		$results = $this->db_get_results( $opts['name'], '*');
		if ($opts['reverse'])
			$results = array_reverse($results); //reverse chronologically
		$results = array_slice($results, 0, $opts['limit']);
		$out = '';
		$out .= '
		<style>
		.typicalTable {border: 1px solid black;}
		.typicalTable td {border: 1px solid black;}
		</style>
		
		';

		$out .= 
		'<table class="typicalTable"><thead>';
			if (!empty($results))
			{
				$headrows = array_keys((array)$results[0]);
				$out .= '<tr>';
				foreach($headrows as $key){
					if (!in_array($key, $opts['excluded'])) 
						$out .= "<th>$key</th>";
				}
				$out .= '</tr>';
			}
			$out .= 
		'</thead><tbody>';

			foreach($results as $eachBlock)
			{
				$out .= '<tr>';
				foreach($eachBlock as $key=>$value){
					if (!in_array($key, $opts['excluded'])) {
						if ($key===$opts['datetime_key']){
							$value = date('Y-m-d H:i:s', $value);
						}
						$out .= "<td>$value</td>";
					}
				}
				$out .= '</tr>';
			}

			$out .= 
		'</tbody></table>';
		return $out;
	}


	#region     DATABASE FUNCTIONS
	
	// $this->create_table_my( 'myTable1', [ '`gmdate` datetime', '`function_args` longtext NOT NULL' ] );
	public function create_table_my($table_name, $array, $auto_increment_ID=true){
		global $wpdb;
		//	`meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		//	................................. NULL DEFAULT '0',
		//	`meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
		//  varchar(255) | longtext | 
		//	PRIMARY KEY (`meta_id`),
		//	KEY `post_id` (`post_id`),
		//	KEY `meta_key` (`meta_key`(191)) 
		//)
		$sql ="(";
		if ($auto_increment_ID===true) 
			$sql .="`ID` bigint NOT NULL AUTO_INCREMENT,";
		foreach( $array as $key=>$val){
			$sql .= $val . ',' ;//' NOT NULL,';
		}
		if ($auto_increment_ID===true)
			$sql .= "PRIMARY KEY (`ID`), UNIQUE KEY `ID` (`ID`) ";
		elseif (is_string($auto_increment_ID))
			$sql .= "PRIMARY KEY (`$auto_increment_ID`), UNIQUE KEY `$auto_increment_ID` (`$auto_increment_ID`) ";
		else
			$sql = $this->charsWithoutStartEnd($sql,0,1);
		$sql .=") ";
		if ($auto_increment_ID===true)
			$sql .=" AUTO_INCREMENT=1 ";
			// text text NOT NULL, name tinytext NOT NULL, time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,  id mediumint(9) NOT NULL AUTO_INCREMENT,
		return $this->create_table_command($table_name, $sql);
	}
	public function create_table_command($table_name, $sql_inner){
		global $wpdb;
		$sql  = "CREATE TABLE IF NOT EXISTS `%s`";
		$sql .= $sql_inner;
		$sql .=" %s;";
		$charset = $wpdb->get_charset_collate();
		//$charset = 'DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci';
		$sql = $wpdb->prepare( $sql, $table_name, $charset );
		$sql = $this->unquote($sql);
		$x= $wpdb->query($sql );
		//require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//dbDelta( $sql );
		return $x;

	}

	public function update_or_insert($tablename, $NewArray, $WhereArray=[]){   	
		return $this->db_update_or_insert($tablename, $NewArray, $WhereArray);
	}
	public function db_update_or_insert($tablename, $NewArray, $WhereArray=[]){   	
		global $wpdb; 
		// if string (i.e. key), then grab it from $NewArray[key]
		if (is_string($WhereArray)) $WhereArray=[$WhereArray=>$NewArray[$WhereArray]];
		elseif (!$this->array_is_associative($WhereArray) ) { foreach($WhereArray as $key) $WhereArray[$key]=$NewArray[$key]; } 
 
		//check if already exist
		if(!empty($WhereArray)){
			// ### now check, if it exists, and it was not updated, then return false ### 
			$whereStr=''; $i=1; foreach ($WhereArray as $key=>$value){ $whereStr .= $wpdb->prepare( sanitize_key($key) . " = '%s'", $value); if ($i != count($WhereArray)) { $whereStr .=' AND '; $i++;}  }
			$sql = ("SELECT * FROM `".sanitize_key($tablename)."` WHERE $whereStr");
			$CheckIfExists = $wpdb->get_results($sql);
			if (!empty($CheckIfExists)){
				$result_Update = $wpdb->update($tablename, $NewArray, $WhereArray );
				return $result_Update;
			}
		}
		if ( $wpdb->insert($tablename, array_merge($NewArray, $WhereArray) ) ) return true;
		return false;
	}
	public function db_update_or_insert_OLD($tablename, $NewArray, $WhereArray=[]){   	
		global $wpdb; 
		// if string (i.e. key), then grab it from $NewArray[key]
		if (is_string($WhereArray)) $WhereArray=[$WhereArray=>$NewArray[$WhereArray]];
		elseif (!$this->array_is_associative($WhereArray) ) { foreach($WhereArray as $key) $WhereArray[$key]=$NewArray[$key]; } 
 
		//check if already exist
		if(!empty($WhereArray)){
			$result_Update = $wpdb->update($tablename, $NewArray, $WhereArray );
			if ($result_Update) {
				return true;
			}
			// ### now check, if it exists, and it was not updated, then return false ### 
			$whereStr=''; $i=1; foreach ($WhereArray as $key=>$value){ $whereStr .= $wpdb->prepare( sanitize_key($key) . " = '%s'", $value); if ($i != count($WhereArray)) { $whereStr .=' AND '; $i++;}  }
			$sql = ("SELECT * FROM `".sanitize_key($tablename)."` WHERE $whereStr");
			$CheckIfExists = $wpdb->get_results($sql);
			if (!empty($CheckIfExists)){
				return $result_Update;
			}
		}
		if ( $wpdb->insert($tablename, 	array_merge($NewArray, $WhereArray)	) ) return true;
		return false;
	}

	public function wp_bulk_update($table, $rows, $delete_array) {
		global $wpdb;
		$whereStr=''; $i=1; foreach ($delete_array as $key=>$value){ $whereStr .= $wpdb->prepare( sanitize_key($key) . " = '%s'", $value); if ($i != count($delete_array)) { $whereStr .=' AND '; $i++;}  }
		$wpdb->query("DELETE FROM ". $table. " WHERE $whereStr"); 
		return $this->wp_bulk_insert($table, $rows);
	}

	public function wp_bulk_insert($table, $rows) {
        global $wpdb;
		$columns = array_keys($rows[0]); // Extract column list from first row of data!
		asort($columns);
		$columnList = '`' . implode('`, `', $columns) . '`';
		$sql = "INSERT INTO `$table` ($columnList) VALUES\n";
		$placeholders = [];
		$data = []; 
 
		// Build placeholders for each row, and add values to data array
		foreach ($rows as $row) {
			ksort($row); //because columns were sorted by "array_keys"
			$rowPlaceholders =[];
			foreach ($row as $key => $value) { 
				$value_corrected = is_array($value) ? json_encode($value) : $value;
				$data[] = $value_corrected;
				if (is_numeric($value_corrected)) {		// differentiate values and set placeholders
					$rowPlaceholders[] = is_float($value_corrected) ? '%f' : '%d';
				} else {
					$rowPlaceholders[] = '%s';
				}
			}
			$placeholders[] = '(' . implode(', ', $rowPlaceholders) . ')';
		}
		$sql .= implode(",\n", $placeholders);	 			// Stitching all rows together
		//$q = rtrim( $q, ',' ) . ';';
		return $wpdb->query($wpdb->prepare($sql, $data));	// Run the query.  Returning number of affected rows for this chunk
    }
 

	public function add_column_my($table_name, $column_name, $column_type="mediumtext", $afterColumn=false){
		global $wpdb;
		$all_columns = $this->db_table_columns($table_name);
		$result= 'already exists';
		if (!in_array($column_name, $all_columns )){  
			$sql = "ALTER TABLE `".sanitize_key($table_name)."` ADD `".sanitize_key($column_name)."` ".sanitize_key($column_type)." NOT NULL". ($afterColumn? " AFTER ".sanitize_key($afterColumn) : "");
			//$sql = $wpdb->prepare ($sql, ''); throws error, we dont need here sanitization at all
			$result= $wpdb->query( $sql);  // CHARACTER SET utf8 
		}
		return $result;
	}
	public function db_get_results($table_name='tablename', $which_columns='*', $key='', $value=''){
		global $wpdb;
		if (empty($key) )
			$sql = "SELECT ". (empty($which_columns) ? '*':esc_sql($which_columns))." FROM `".sanitize_key($table_name).'`';
		else
			$sql = $wpdb->prepare( "SELECT ". (empty($which_columns) ? '*':esc_sql($which_columns))." FROM `".sanitize_key($table_name)."` WHERE `".sanitize_key($key)."` = '%s'", $value);
		return $wpdb->get_results( $sql );
	}
			public function db_get_results_sorted($table_name='tablename', $which_columns='*', $key='', $value='', $set_array_key=''){
				$res = $this->db_get_results($table_name, $which_columns, $key, $value);
				return ( empty($set_array_key) ? $res : $this->array_makeKeyedBySubkey($res, $set_array_key) );
			}
			
	public function db_get_row($table_name='tablename', $key='', $value='', $type='object'){
		//$res = $this->db_get_vars($table_name, $what, $key, $value);
		//return (empty($res))
		global $wpdb;
		$sql = $wpdb->prepare( "SELECT * FROM `". sanitize_key($table_name). "`". (empty($key) ? '' : " WHERE `".sanitize_key($key)."` = '%s'") , $value);
		$res = $wpdb->get_row( $sql );
		return ($type==='object' ? $res : $this->object_to_array($res));
	} 
	public function db_get_var($table_name='tablename', $key='', $value='',  $what='', $type='object'){ 
		$res = $this->db_get_row($table_name, $key, $value, $type);
		return ( !empty($res) && property_exists($res, $what) ? $res->$what : '' );
	} 
	public function db_get_table($table_name='tablename', $line = '`ID` = 42'){
		global $wpdb;  
		$table_name= sanitize_key($table_name);
		$sql =  "SELECT * FROM `$table_name`";
		$res = $wpdb->get_results( $sql);
		return $res;
	}
	public function get_table_my($table_name='tablename', $line = '`ID` = 42'){
		return $this->db_get_table($table_name, $line );
	}
	public function db_table_columns($table_name='tablename' ){
		return $GLOBALS['wpdb']->get_col("DESC `". $this->sanitize_key($table_name)."`", 0);
	} 

	public function checkErrorAddColumn($tablename, $added_column_type="mediumtext")
	{
		global $wpdb;
		//"Unknown column 'c_contract' in 'field list'";
		$err =$wpdb->last_error;
		if (!empty($err))
		{
			preg_match('/Unknown column \'(.*?)\' in/', $err, $n);
			if ( !empty($n[1]) )
			{
				$column_name = $this->sanitize_key($n[1]);
				$res = $this->add_column_my($tablename, $column_name, $added_column_type);
				if($res)
					$wpdb->query($wpdb->last_query) ;
				else
					$this->log($wpdb->last_error);
			}
		}
	}
 
    public function db_alldata_tablename()  { 
		return $GLOBALS['wpdb']->base_prefix. $this->slug.'_datacache';
	}
	public function db_create_datacache_table()
	{    
		$this->create_table_my( $this->db_alldata_tablename(), [ 
			'`uniq_id`      TINYTEXT NOT NULL',
			'`option_name`  TEXT NOT NULL',
			'`text`         LONGTEXT',
			'`time`         bigint'
		] );
	}
	public function cache_db_set($key, $data, $time=false)
	{    
		$time = $time ?: time();
		$res =  $this->update_or_insert( $this->db_alldata_tablename(), 
			['option_name'=>$key, 'text'=>$this->textify_or_not($data), 'time'=>$time],  
			'option_name');
		return $res;
	}
	public function cache_db_get($key, $default=[], $expire_seconds=-1, $decode='array')
	{    
		$expire_seconds = $expire_seconds===-1 ? 999999999 : $expire_seconds;

		$res_initial = $this->db_get_var( $this->db_alldata_tablename(), 'option_name', $key, 'text' );
		if (empty($res_initial)){
			$res=$default;
		}
		else{
			if ( $decode && $this->maybe_json($res_initial) ){
				$res=json_decode($res_initial, ($decode==='array'));
				if (is_null($res)){
					$res = $res_initial;
				}
			}
			else{
				$res=$res_initial;
			}
		}
		return $res;
	}
	public function cache_db_append($key, $data, $time=false)
	{    
		$existing=$this->cache_db_get($key);
		$time = $time ?: time();
		if ( is_array($existing) && is_array($data) ){
			$finalData = array_merge_recursive($existing,$data);
			$finalData = $this->stringify($finalData);
		}
		else 
			$finalData = $this->stringify($existing) . $this->stringify($data);


		$res =  $this->update_or_insert( $this->db_alldata_tablename(), 
			[ 'option_name'=>$key, 'text'=>$finalData, 'time'=>$time],  
			'option_name');
		return $res;
	}
	
	public function cache_db_append_array($key, $data, $time=false)
	{    
		$existing  = $this->cache_db_get($key,[]);
		$newData   = is_array($data) ? $data : [$data];
		$finalData = array_merge_recursive($existing,$newData);
		$res = $this->update_or_insert( $this->db_alldata_tablename(), 
			[ 'option_name'=>$key, 'text'=>json_encode($finalData), 'time'=>$time ?: time()],  
			'option_name');
		return $res;
	}


	// types
	private $db_types_arr=[];
	public function db_type($which_db='', $which_table=''){
		global $wpdb;
		$key = 'key_'. md5($which_db.'_'.$which_table);
		if( ! array_key_exists($key, $this->db_types_arr) ) 
			$this->db_types_arr[$key]= $wpdb->get_var("SELECT `ENGINE` FROM `information_schema`.`TABLES`  WHERE `TABLE_SCHEMA`='".DB_NAME."' AND `TABLE_NAME`='".$wpdb->prefix."users'" );
		return $this->db_types_arr[$key];
	}
	public function db_type_is_myisam(){ return $this->db_type()=="MyISAM"; }

	// https://stackoverflow.com/a/32913817/2377343 [ SET auto_commit = 1 ] 
	public function db_disable_autocommit(){
		global $wpdb;
		wp_defer_term_counting( true );
		wp_defer_comment_counting( true );
		if ( $this->db_type()=='MyISAM'){ 
			return $wpdb->query('SET AUTOCOMMIT = 0');
		}
		else{ //if($this->db_type()=='InnoDB'){
			return $wpdb->query('START TRANSACTION;');
		}
	}
	public function db_enable_autocommit($commit=true){
		global $wpdb;
		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );
		if ( $this->db_type()=='MyISAM'){ 
			return $wpdb->query('SET AUTOCOMMIT = 1;');
		}
		else{ //if($this->db_type()=='InnoDB'){
			return $wpdb->query('COMMIT;');
		}
	}
	public function db_commit_query($callback){
		$this->db_disable_autocommit();
		call_user_func($callback);
		$this->db_enable_autocommit();
	}



	// ### DELIVERY LOGS ###
	public $notifications_enable_db_logs = false;
	public $notifications_excluded_db_channels = [];
	public $notifications_db_logs_maxrows = 100;
	public function notifications_db_tablename(){ return $GLOBALS['wpdb']->base_prefix. $this->slug.'_notificationslogs'; }
	public function notifications_db_table_create(){
		if (!$this->notifications_enable_db_logs) return;
		global $wpdb;
		$table_name = $this->notifications_db_tablename();
		$sql  =
		"CREATE TABLE IF NOT EXISTS `%s` (
			`ID` bigint NOT NULL AUTO_INCREMENT,
			`uID` bigint,
			`app` tinytext,
			`chat_id` tinytext,
			`text` mediumtext NOT NULL,
			`time` bigint NOT NULL,
			`status` mediumtext NOT NULL,
			PRIMARY KEY (`ID`)
		) AUTO_INCREMENT=1 %s;";
		$charset = $wpdb->get_charset_collate(); //'DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci';
		$sql = $wpdb->prepare( $sql, $table_name, $charset );
		$sql = $this->unquote($sql);
		$res= $wpdb->query($sql );
		//require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//dbDelta( $sql );
		return $res;
	} 
	public function notifications_db_entry($id, $chat_id, $text, $time, $status){
		if (!$this->notifications_enable_db_logs) return;
		if (in_array($chat_id, $this->notifications_excluded_db_channels)) return;

		global $wpdb;
		$this->trim_tablerows( $this->notifications_db_tablename(), $this->notifications_db_logs_maxrows);
		$res = $this->db_update_or_insert($this->notifications_db_tablename(), ['uID'=>$id, 'chat_id'=>$chat_id, 'time'=>$time,'text'=>$text,'status'=>$status], []); //['uID'=>$id] 
		// check if first trigger, then returns false, and thus, auto-create table
		if (!$res)
		{
			$errMsg = $wpdb->last_error;
			if ( is_string($errMsg) && preg_match("/Table '(.*?)".$this->notifications_db_tablename()."(.*?)' doesn't exist/s",$errMsg) && !$this->get_transient($tr_key = $this->slug.'tg_tablecreate_checkpoint') )  //if($this->notifications_db_table_create_tried)
			{
				$this->set_transient($tr_key, true, 60*10);
				$this->var_dump('<h1>NOTE: If you see some MYSQL error messages above, they are probably one-time events, because the TABLE is being initialized at this moment for the first time</h1>');
				$res=$this->notifications_db_table_create();
				$this->notifications_db_entry($id, $chat_id, $text, $time, $status);
			}
		}
	}
	public function notifications_db_entries(){
		return $this->db_get_results($this->notifications_db_tablename());
	}
	public function notifications_db_table_output($show_rows =100){
		echo $this->datatablesnet_scripts(); 
        $datas = $this->db_get_results( $this->notifications_db_tablename() );
		$columns_array = count($datas)>=1 ? $this->array_keys($datas[0]) : $this->db_table_columns($this->notifications_db_tablename());
		?>
		<table class="notificationslogs-table">
		<thead><tr><?php foreach($columns_array as $key){$key=sanitize_key($key); echo "<th class='$key'>".$key."</th>"; } ?></tr></thead>
        <tbody><?php 
        $datas = array_reverse($datas);
        $datas = array_slice($datas, 0, $show_rows);
        foreach($datas as $block)
        { ?>
            <tr>
                <?php foreach($block as $key2=>$val2){ 
                    $key2=sanitize_key($key2); 
                    $val2 = sanitize_text_field($val2);
                    if ($key2==='time'){
                        $d1= date("Y-m-d H:i:s", $val2);
                        $out= $d1;
                    }
                    else{
                        $out=$val2; 
                    }
                    echo "<td class='$key2'>$out</td>";
                } ?>
            </tr>
            <?php
        } ?>
        </tbody>
		</table>
		<script>
		jQuery(document).ready( function () {
			jQuery(".notificationslogs-table").DataTable({
				paging:false
			});
		} );
		</script>
		<?php
	}
	// ###################################










	// ============ ERRORS LOGS ============ //
	// if used in WP (check to create)
	public function create_log_table()
	{
		global $wpdb;
		$res = $wpdb->query("Show tables like '{$this->logs_table_name}'" );
		if (!$res){
			$res = $GLOBALS['wpdb']->query("CREATE TABLE IF NOT EXISTS `{$this->logs_table_name}` (
					`id` int(50) NOT NULL AUTO_INCREMENT,
					`gmdate` datetime, 
					`function_name` longtext NOT NULL,
					`function_args` longtext NOT NULL,
					`message` longtext NOT NULL, 
					PRIMARY KEY (`id`),
					UNIQUE KEY `id` (`id`)
				)  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci AUTO_INCREMENT=1" 
				//	)  " . $wpdb->get_charset_collate()   || DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci AUTO_INCREMENT=1
			);
		}
		else {
			$res = $wpdb->query("SHOW COLUMNS FROM `{$this->logs_table_name}` LIKE 'function_name'");
			if (!$res){
				$this->add_column_my($this->logs_table_name, 'function_name', 'longtext', 'gmdate'); 
			}
		} 
	} 
	
	//i.e. $this->log("couldnt get results", '<code>'.print_r($response, true).'</code>' );
	public function log( $message ="", $exception="", $trim_chars=1000)
	{	
		global $wpdb; 
		try{
			$this->trim_tablerows($this->logs_table_name, $this->logs_table_maxnum); 
			$trace=debug_backtrace(); array_shift($trace); $last_func = $trace[0];//$trace=array_splice($trace, 0, 6); //get only first 6 functions 
			$chain=""; foreach($trace as $e) {$chain='['.basename($this->array_value($e,'file') ).'::'.$e['function']."] ---> ".$chain;} 
	
			// --- trim-down the object ---
			$args_str=''; foreach($last_func['args'] as $i=>$e) { 
				$final_obj = '';
				if (is_array($e)){
					$innerArray =[];
					foreach($e as $key=>$value){
						$innerArray[$key] = is_object($value) ? get_class($value) : $value;
					}
					$final_obj = $innerArray;
				}
				elseif(is_object($e)){
					$final_obj = get_class($e);
				}
				else{
					$final_obj = $e;
				}
				$args_str .= "\r\n[$i] --->; ". $this->charsFromStart( print_r($final_obj,true), $trim_chars) ;
			} 
			// -----------------------------

			$trimmed_msg = empty($message)   ? '' : '[Message]: '.$this->charsFromStart( print_r($message, true), $trim_chars );
			$trimmed_exc = empty($exception) ? '' : "\r\n".'[Exception]: '.$this->charsFromStart( print_r($exception, true), $trim_chars );

			$res = $wpdb->insert( $this->logs_table_name, $arr=[ 
				'gmdate'       => gmdate("Y-m-d H:i:s.fff"), 
				'function_name'=> $chain, 
				'function_args'=> $args_str, 
				'message'      => $trimmed_msg. $trimmed_exc] 
			);
			return $res;
		}
		catch(\Excetpion $ex){
			return $ex->getMessage();
		}
	}

	public function clear_errorslog(){ return $GLOBALS['wpdb']->query("TRUNCATE TABLE `".$this->logs_table_name."`" ); } 
	public function get_errorslog()	 { return $GLOBALS['wpdb']->get_results("SELECT * from `".$this->logs_table_name."`");	}

	// Removes  oldest rows if rows count exceeds the limit 
	private static $temp_tablenames_array=[];  
	public function trim_tablerows($tablename, $max_rows_amount)
	{ 
		global $wpdb;
		$tablename = sanitize_key($tablename); 
		$colum_names = $this->db_table_columns($tablename);
		$rows_amount = $wpdb->query("SELECT COUNT(*) FROM `". $tablename ."` GROUP BY `".$colum_names[0]."`");
		if( $rows_amount > $max_rows_amount )	
		{
			$amount_to_delete=$rows_amount - $max_rows_amount; 
			return $wpdb->query("DELETE FROM `". $tablename. "` WHERE 1=1 ORDER BY id LIMIT " . (int)$amount_to_delete ); 
		}
		return null;
	}  
	#endregion
	

	public function show_post_categories($vars=array('POST_ID'=>false, 'excluded_categories'=>array(-1) ) )  {   $x=''; 
		if (!$vars['POST_ID']) { $vars['POST_ID']= $GLOBALS['post']->ID; }
		$post_categories = wp_get_post_categories( $vars['POST_ID'] ); 
		$cats=array();
		foreach($post_categories as $c){   $cats[] = get_category( $c );   }
		foreach($cats as $c){ if (!in_array($c->term_id,   ($vars['excluded_categories'] ?: array())      ) ) {$x .= '<a href="'.get_term_link( $c->term_id, 'category' ).'" target="_blank">'.$c->name.'</a>, '; }  }  return $x;
	}
	
	//change slug,if already exists slug for any other posts/or/pages
	//add_action('save_post', 'efrg324f3f32f4',3);	
	public function efrg324f3f32f4($post) 	{
		if (isset($_POST['post_name'])) { 
			global $wpdb;
			$slug = sanitize_text_field($_POST['post_name']); 
			
			$Post_id_1		= $wpdb->get_var($wpdb->prepare("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = '%s' AND ( post_type = 'page' OR post_type = 'post') ", $slug) );
			$post_counts_1	= $wpdb->get_var($wpdb->prepare("SELECT count(post_name) FROM ".$wpdb->posts ." WHERE post_name like '%s'", $slug) );
			
			if (!empty($Post_Object_1) || $post_counts_1 < 1) {
				$_POST['post_name'] = $slug. '-'.rand(11,9999999);
			}
		} 
	}	

	//lets load after init of LANGUAGE phrazes
	//if (isset($_GET['contactMAILpage']))  mailform_page(); 
	public function mailform_page($title=false){
		echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>'.(isset($title) ? $title : 'Mail Sending'). '('.$_SERVER['http_host'].')'.'</title></head><body>';      
		echo $this->contacttt_form() ;
		echo '</body></html>';
		exit;
	}
	public function contact_form_init(){
		add_shortcode('MyCONTACT_FORM', 'contacttt_form' );
	}
	public function contacttt_form($extra_block=''){  $rand= rand(1,111); $multiplier=date('j');  
		$extra_bl =(!is_array($extra_block) ? $extra_block : '');
		$x = utf8_declarationn() . '
		<div id="contac_DIV">'
			.'<style type="text/css"> #submitContatForm{cursor:pointer;} .cf_formm{ display:block;	margin:0 auto;}       .cf_formm table{width:100%; max-width:400px; margin:0 auto;} .brdr{ border-radius:5px; border:1px solid; padding:3px; margin:5px; background-color:#E6E6E6; } .cfinputt{display:block; width:92%; height:30px; min-width:140px; }      .cftxtarea{display:block; width:96%; height:200px;} .submt{ cursor:pointer; } td{vertical-align: middle;}         td.leftflot{float:left; padding:0 0 0 10px;}     span.antWORD{font-weight:bold;} </style>'
			.'<form class="cf_formm" action="" method="POST" id="contactFormID" target="_blank"> 	<input type="hidden" name="contactIsSubmited" value="y" />'
			.'<table><tbody>'
			.$extra_bl
			.'<tr><td>Your Name</td><td><input class="cfinputt brdr" name="namee" value="" placeholder="" type="text" /></td></tr>'
			.'<tr><td>Your Mail</td><td><input class="cfinputt brdr" name="emailii" value="" placeholder="" type="text" /></td></tr>'
			.'<tr><td colspan="2"><textarea class="cftxtarea brdr" name="teext"/></textarea></td></tr>'
			.'<tr><td><span class="antWORD">'. $rand . "*". $multiplier.'=<input type="hidden" name="initiall" value="'. $rand .'" /></span></td><td class="leftflot"><input class="cfinputt brdr" type="text" value="" name="antiSpamm"  /></td></tr>'
			.'<tr><td><input class="cfinputt brdr submt" type="submit" value="SEND" id="submitContatForm"  /></td><td>&nbsp;</td></tr>'
			.'</tbody></table>'
			.'</form>'
		.'</div>';
		return $x;
	} 
	public function mailsent_page($to,$subject,$message,$from, $title=false){
		echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>'.(isset($title) ? $title : 'Mail Sending'). '('.$_SERVER['http_host'].')'.'</title></head><body>';      
		echo send_maill($to,$subject,$message,$from);
		echo '</body></html>';
		exit;
	}
	//if(!$this->definedTRUE('avoid_mailcheck')) { add_actionX('init','check_mailsentt'); }
	public function check_mailsentt(){
		if (!empty($_POST['contactIsSubmited'])){
			header('Content-Type: text/html; charset=utf-8');  
			global $odd,$lang;
			$messiji	= isset($_POST['teext'])	? sanitize_text_field($_POST['teext'])	: '';
			$maill		= isset($_POST['emailii'])	? sanitize_text_field($_POST['emailii'])	: ''; 
				$from_mail =(!stristr($maill,'@yahoo.com')) ?		$maill : 'X'.rand(1,1111111).rand(1,1111111).'@no-reply.com';
			$nameei		= isset($_POST['namee'])	? sanitize_text_field($_POST['namee'])	: '';
			
			$admin_mail	= get_option('admin_email');
			$subjectt	= $_SERVER['HTTP_HOST'] . '-dan gamogzavnilia shetyobineba';
			$full_messag="FROM: $nameei ($maill) \r\n\r\n Message:\r\n" . $messiji;
			
			
			//if (($_POST['antisp_conf']=='yess') && (!empty($_POST['namee']) && !empty($_POST['emailii']) && !empty($_POST['teext'])))
			if(empty($_POST['namee']) || empty($_POST['emailii']) || empty($_POST['teext']))					{die(!defined('LNG') ? "please, fill form" : $lang['fill_form_'.LNG] ); }	
			elseif ( ! ( in_array($_POST['antiSpamm']/$_POST['initiall'],  array(date('j'),date('j')-1))) ) 	{die("Error Captcha");	}
			else {  exit(send_maill($admin_mail,$subjectt,$full_messag, $from_mail )); }
		}		
	}
 
	public function check_mailsent2(){
		if(isset($_GET['sendmessage'])){
			$to			= get_option('admin_mail');
			$subject	= !empty($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '' ;
			$from		= validate_mail($_POST['email']) ? sanitize_text_field($_POST['email']) : die("incorrect_mail");
			$name		= isset($_POST['name']) ? sanitize_text_field($_POST['name']) : die("incorrect NAME");
			$messg		= isset($_POST['content']) ? sanitize_text_field($_POST['name']) : die("incorrect NAME");
			$phone		= !empty($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '' ;
			$message	= "Name: ".$name."\r\nE-mail: ".$from."\r\nPhone: ".$phone."\r\nMessage:\r\n\r\n".$messg;
			if($_POST['captxt'] != $_POST['Captcha']){ die("incorrect captcha"); }
			// mailsent_page($to,$subject,$message, $from);
			send_maill($to,$subject,$message,$from);
		}
	}
 
	public function send_maill($to, $subject, $message, $from=false, $reply_to=false){
		$result = my_mail($to ,$subject, $message ,  default_mail_headers($from));

		if ($result) { $success_messg='<span class="seent" style="color:green; display:block; font-size:25px;">SENT!</span>';}
		else		 { $success_messg='<span class="cant_send" style="color:red;">ERRORR..</span>';	}
		return $success_messg;
	}
 
	
	// inject loader into wp_config : https://pastebin_com/zUTBWvpP

	// https://wordpress.stackexchange.com/questions/16382/showing-errors-with-wpdb-update
	public function show_wp_error(){
		global $wpdb; 
		$wpdb->show_errors = TRUE;
		$wpdb->suppress_errors = FALSE;

		$wpdb->show_errors(); $wpdb->print_error();  
		if ($wpdb->last_error) {
		  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
		}
	}


	public function test_favicons(){
		$image = is_admin() ? 'M8,3A2,2,0,1,1,6,1,2,2,0,0,1,8,3' : 'M8,3A2,2,0,1,1,4,3';
		$color = $this->is_localhost() ?'ff0000' : '00ff00';
		$tmp   = '<link rel="icon" rel2="tempFav" type="image/png"  href="'. (!empty($url) ? $url : "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='5 1 2 4'%3E%3Cpath d='$image' fill='%23$color'/%3E%3C/svg%3E").'" />';
		add_action('admin_head', function() use($tmp) { echo $tmp; } );
		add_action('wp_head',    function() use($tmp) { echo $tmp; } );
	}

	// add widgets: https://pastebin_com/VzDQgJrF

	// Default classes 
	public function add_content_classes()
	{
		add_action('the_excerpt',		[$this, 'defaultContainers_excerpt']);  
		add_action('the_excerpt_rss',	[$this, 'defaultContainers_excerpt']); //<-deprecated or not?  
		add_action('the_excerpt_feed',	[$this, 'defaultContainers_excerpt']);

		add_action('the_content',		[$this, 'defaultContainers_content'] );
		add_action('the_content_rss',	[$this, 'defaultContainers_content']); //<-deprecated
		add_action('the_content_feed',	[$this, 'defaultContainers_content']);
	}
	public function defaultContainers_content($cont){ return !isset($GLOBALS['post']) ? $cont : '<div class="default-content-clss cnt_' . $GLOBALS['post']->ID .' type_'.$GLOBALS['post']->post_type.' ">'.$cont.'</div>';  }
	public function defaultContainers_excerpt($cont){ return !isset($GLOBALS['post']) ? $cont : '<div class="default-content-clss excp_'. $GLOBALS['post']->ID .' type_'.$GLOBALS['post']->post_type.' ">'.$cont.'</div>';  }

	//CSS CLASSES for BODY
	public function add_my_body_classes() { add_filter( 'body_class', 		[$this, 'add_my_body_classes_HELPER'] ); add_filter( 'admin_body_class', [$this, 'add_my_body_classes_HELPER'] ); }
	public function add_my_body_classes_HELPER( $classes )
	{
		$this->add_body_class_($classes, " ". $this->domainReal);
		$this->add_body_class_($classes, " ". (is_admin() ? "backend":"frontend") );
		//$this->add_body_class_($classes, $GLOBALS['odd']['is_pc_platform'] ? "pcOS" : "mobileOS");
		
		//add role
		$roles = ( array ) wp_get_current_user()->roles;
		$chosen = " ".'role-'.(isset($roles[0]) ? $roles[0] : 'guest');
		$this->add_body_class_($classes, $chosen);
		//
		return $classes;
	}
	public function add_body_class_(&$classes, $value){ if (is_array($classes)) $classes[] = $value;  else $classes .= $value; return $classes;  }
	 
	
	//allsite_options
	public function get_option_my($keyNAME, $re_call = false, $defaultvalue=false){
		if (!isset($this->my_custom_optioned_array) || !array_key_exists($keyNAME, $this->my_custom_optioned_array) || $re_call) {
			$x = get_option('my_optioned_arrayyy',array());
			if (!array_key_exists($keyNAME,$x))  { $x[$keyNAME]=false;}
			if ($x[$keyNAME]==false || !empty($defaultvalue) ) { $x[$keyNAME]=$defaultvalue;   update_option('my_optioned_arrayyy',$x); }
			$this->my_custom_optioned_array = $x;
		}
		return $this->my_custom_optioned_array[$keyNAME];
	}

	public function update_option_my($keyNAME, $value){
		$x= get_optionX($keyNAME, true);
		$x[$keyNAME] = $value;
		update_option('my_optioned_arrayyy',$x);
	}

	// video audio :og: https://pastebin_com/azNfyg02
	public function is_login_page(){ return did_action('login_init'); }
	public function is_posteditor_page(){ global $pagenow;
		if 	( is_admin()
			&& 
			(
				(in_array( $pagenow, array('post.php'))  && 'edit' ==$_GET['action'])	//if Edit page 
				|| (in_array( $pagenow, array('post-new.php'))) 						//if NEW page
			)
		){	return true;	}
		else{ return false;}
		
	} 


}} // class





















#region WP_PLUGIN class
if (! class_exists('\\Puvox\\wp_plugin')) {

//==================================================================================
//============================= Main base for WP plugin ============================
//==================================================================================

  class wp_plugin
  {

	// ##########################################################
	public $helpers;
	public function __construct($arg1=[])
	{ 
		$this->helpers = new library_wp();
		//$this->h = $this->helpers;
		if (method_exists($this, 'after_construct')) $this->after_construct(); //for rebasing the plugin url
		$this->helpers->init_module(['class'=>get_called_class()] + $arg1);
		$this->plugin_inits();
	}

    public function __call($method, $arguments)
    {
        try {
            return call_user_func_array([$this->helpers, $method], $arguments);
        } catch (Exception $e) {
            throw $e;
        }
    }

	public function plugin_inits()
	{			
		$this->wpdb 	= $GLOBALS['wpdb']; 
		$this->helpers->loadScripsStyles();

		if (!$this->helpers->above_version("5.4")){
			register_activation_hook( $this->helpers->plugin_entryfile,	function(){ exit( __("Sorry, your PHP version ". phpversion() ." is very old. We suggest changing your hosting's PHP version to latest available v7 version.") ); }	);
			return;
		}
		// initial variables
		$this->my_plugin_vars();
		$this->network_managed_is_selected	= is_multisite() && $this->IsNetworkManaged();
		$this->opts				= $this->refresh_options();							// Setup final variables
		$this->refresh_options_TimeGone();
		$this->helpers->logs_table_name	= $this->get_prefix_CHOSEN() . $this->plugin_slug_u.'__errors_log';	// error logs table name
		$this->helpers->logs_table_maxnum= 50;	// maximum rows in errors logs table
		$this->helpers->create_log_table();

		$this->notes_enabled	= false;
		$this->check_if_pro_plugin();
		$this->__construct_my();		// All other custom construction hooks 

		$this->network_wide_active          = is_plugin_active_for_network($this->static_settings['plugin_basename']) ;  //during network-activation,this is yet false so this will not be usable for activate-redirection link

		// single-site: if main-button: admin.php | else: options-general.php
		// multi-site:  if main-button: admin.php (multi & sub) | else: if sub-site: options-general.php else: settings.php
		$this->settingsPHP_page_dynamic = $this->static_settings['menu_pages']['first']['level']=='mainmenu' ? 'admin.php' : ( !is_multisite() ? 'options-general.php' :  (!is_network_admin() ? 'options-general.php' : 'settings.php' ) );  // || !$this->network_managed_is_selected <--- no need, let users allow to have menu page in other panels too, there we give notice to manage from appropriate place 

		//$this->plugin_page_url = ( !is_multisite() || !$this->ManagerPageAllow_network() || !$this->network_managed_is_selected ) ? admin_url() : network_admin_url();
		$this->plugin_page_url = ( !is_multisite() || !$this->ManagerPageAllow_network() || !$this->network_managed_is_selected ) ? admin_url() : network_admin_url();

		$this->plugin_page_url .= ( !empty($this->static_settings['custom_opts_page']) ?  $this->static_settings['custom_opts_page'] : $this->settingsPHP_page_dynamic.'?page='.$this->slug); 

		$this->plugin_files		= array_merge( (property_exists($this, 'plugin_files') ? $this->plugin_files : [] ),   ['index.php'] );
		$this->translation_phrases= $this->get_phrases();
		$this->is_in_customizer	= (stripos($this->helpers->currentURL, admin_url('customize.php')) !== false);
		$this->myplugin_class	= 'myplugin puvox_plugin postbox version_'. (!$this->static_settings['has_pro_version']  ? "free" : ($this->is_pro_legal ? "pro" : "not_pro") );
		$this->addon_namepart	= 'puvox.software';

		//activation & deactivation (empty hooks by default. all important things migrated into `refresh_options`)
		register_activation_hook( $this->helpers->plugin_entryfile,	[$this, 'activate']		);
		register_deactivation_hook( $this->helpers->plugin_entryfile, [$this, 'deactivate']	);

		//translation hook
		add_action('init', [$this, 'load_textdomain'] );

		//==== my other default hooks ===//
		$this->plugin__setupLinksAndMenus();

		//shortcodes
		$this->shortcodes_initialize();

		// if buttons needed
		//if( property_exists($this, 'tinymce_buttons') ) $this->tinymce_funcs();

		// for backend ajax
		$this->helpers->register_backend_call_actions();

		add_action( 'admin_head', [$this,'admin_head_func']);
		add_action( 'current_screen', function(){ $this->admin_scripts(null); } );

		//add uninstaller file
		if(is_admin() && method_exists($this->helpers,'add_default_uninstall')) $this->helpers->add_default_uninstall();	//add_action( 'shutdown', [$this, 'my_shutdown_for_versioning']);

		add_action('wp',		[$this, 'flush_checkpoint'], 999);

		// functions for PRO-ADDON upload
		// add_filter( 'pre_move_uploaded_file', function( $null, $file, $new_file, $type ){ return $path; }, 10, 4);
		$this->pro_file_part = 'puvox-software';
		if($this->static_settings['has_pro_version']) 	{
			add_filter( 'upload_mimes', [$this->helper,'upload_mimes_filter'], 1); 
			add_filter( 'wp_handle_upload', [$this->helper,'wp_handle_upload_filter'], 10, 2);
		}
		 
		$this->init_properties();
	}
	
		
	//add my default values
	public function my_plugin_vars($step=0)
	{
		include_once(ABSPATH . "wp-admin/includes/plugin.php");
		$plugin_vars = $this->pluginvars();
		$this->slug			= sanitize_key($plugin_vars['TextDomain']);	//same as foldername
		$this->plugin_slug	= $this->slug;								//same as foldername
		$this->plugin_slug_u= str_replace('-','_', $this->slug);
		// set in helpers too:
		$this->helpers->slug	     = $this->slug;
		$this->helpers->plugin_slug  = $this->plugin_slug;
		$this->helpers->plugin_slug_u= $this->plugin_slug_u;
 
		
		$AuthorDomain = !property_exists($this, 'PuvoxDomain') ? 'https://puvox.software/' : 'https://127.0.0.1/wp/puvox.software/';
		$temp2	= $plugin_vars   +  
		[
			'plugin_basename'	=> plugin_basename($this->helpers->plugin_entryfile),
			'menu_text'			=> array(
				'donate'				=>__('Donate'),
				'settings'				=>__('Settings'),
				'open_settings'			=>__('You can access settings from dashboard of:'),
				'activated_only_from'	=>__('Plugin activable only from'),
				'deactivated_only_from'	=>__('Plugin deactivable only from'),
			),
			'lang'				=> $this->helpers->get_locale__SANITIZED(),
			'wp_rate_url'		=> 'https://wordpress.org/support/plugin/'.$this->slug.'/reviews/#new-post',
			'donate_url'		=> 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=contact@puvox.software&tax=0&currency=USD&item_name=For%20Programming%20Services', // business: http://paypal.me/Puvox   ||  personal : http://paypal.me/ttodua || https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=contact@puvox.software&tax=0&currency=USD&item_name=For%20Programming%20Services  || https://stackoverflow.com/a/43083891/2377343
			'donate_default'	=> 4,
			'mail_errors'		=> 'wp_plugin_errors@puvox.software',
			'licenser_domain'	=> $AuthorDomain,
			'musthave_plugins'	=> $AuthorDomain.'blog/must-have-wordpress-plugins/',
			'purchase_url'		=> $AuthorDomain.'?purchase_wp_plugin='.$this->slug,
			'purchase_check'	=> $AuthorDomain.'?purchase_wp_act=',
			'firebase_url'		=> 'https://linksaf.page.link/?link=',
		];
		$temp2	= $temp2   + [
			'wp_tt_freelancers'	=> 'https://goo.gl/wZKANN',
			'wp_fl_freelancers'	=> 'https://goo.gl/JSVy37',
			'wp_pph_freelancers'=> 'https://goo.gl/vhrqiM',
			'wp_elementor_link' =>  $temp2['firebase_url'].urlencode('https://elementor.com/pricing/?ref=16338&campaign='.$this->slug),
		];
		//enrich from main class (overrides some settings. "is_admin" removed because it fails on front-end /wp-json/wp/v2/posts/8?_locale=user )
		$this->initial_user_options=[]; 
		if(method_exists($this,'declare_settings') ) 
		{
			$this->declare_settings();
		}
		$temp1= []; //remove sample plugin
		$this->initial_static_options = array_replace_recursive($temp1, $this->initial_static_options);
		$this->static_settings	= array_replace_recursive($temp2,$this->initial_static_options);
	}

 

	public function plugin__setupLinksAndMenus()
	{
		// If plugin has options, show button (in admin menu sidebar)
		if($this->static_settings['show_opts']===true)  //only this, because sometimes if we want to disable menu-button, then we set to "submodule" instead of true
		{
			if (is_multisite()){
				if ( $this->network_wide_active )
					add_action('network_admin_menu', [$this, 'plugin__registerHandle'] );
				if ( !$this->network_managed_is_selected ){
					add_action('admin_menu',  [$this, 'plugin__registerHandle'] );
				}
			}
			else {
				add_action('admin_menu',  [$this, 'plugin__registerHandle'] );
			}		
			//redirect to settings page after activation (if not bulk activation)
			add_action('activated_plugin', function($plugin) { if ($this->is_not_bulk_activation($plugin))  { exit( wp_redirect($this->plugin_page_url.'&isactivation') ); } } );
		}


		// show author & donate urls (unless hidden)
		if ( !array_key_exists('hide_plugin_links', $this->static_settings))
		{
			// add Settings & Donate buttons in plugins list
			add_filter( (is_network_admin() ? 'network_admin_' : ''). 'plugin_action_links_'. $this->static_settings['plugin_basename'],  function($links){
				if(!$this->static_settings['has_pro_version'])	{ $links[] = '<a href="'.$this->static_settings['donate_url'].'">'.$this->static_settings['menu_text']['donate'].'</a>'; }
				if($this->static_settings['show_opts']){ $links[] = '<a href="'.$this->plugin_page_url.'">'.$this->static_settings['menu_text']['settings'].'</a>';  }
				//if(is_network_admin() && $this->initial_static_options['allowed_on'] =='subsite'){ unset($links['activate']); $links[] = '<b style="color:red;">'.$this->static_settings['menu_text']['deactivated_only_from'].' SUB-SITES</b>';  }
				return $links;
			});
		}
	}
		//helper for above func
		public function plugin__registerHandle()
		{
			foreach($this->static_settings['menu_pages'] as $menuTitle=>$menuBlock){
				$menu_button_name = $menuBlock['title'];
				if ( $this->helpers->valueIs($menuBlock, 'level', 'mainmenu' )  )  // icons: https://goo.gl/WXAYCi 
					add_menu_page($menu_button_name, $menu_button_name, $menuBlock['required_role'] , $this->slug, [$this, 'opts_page_output_parent'], $menuBlock['icon'] );
				else 
					add_submenu_page($this->settingsPHP_page_dynamic, $menu_button_name, $menu_button_name, $menuBlock['required_role'] , $this->slug,  [$this, 'opts_page_output_parent'] );

				// if target is custom link (not options page)//add_action( 'admin_footer', function (){ <script type="text/javascript"> jQuery('a.toplevel_page_<?php echo $this->slug;').attr('href','echo $this->opts['menu_button_link'];').attr('target','_blank'); </script> 
			}
		}
	

	// ================  dont use activation/deactivation hooks =====================//
	// happens before REAL activation (activated_plugin happens after individual DB activation) 
	public function activate($network_wide)
	{
		// Differentiation only applies when/if MultiSite enabled. Otherwise, always master site
		if ( is_multisite() )
		{ 
			if(
				( !$this->ManagerPageAllow_network() && ( $this->is_network_admin_referrer()  || $network_wide) )
					||
				( !$this->ManagerPageAllow_singlesite() && (!$this->is_network_admin_referrer() || !$network_wide ) )
			)
			{
				$text= '<h2><code>'.$this->opts['name'].'</code>: '. $this->static_settings['menu_text']['activated_only_from']. ' <b style="color:red;">'.($this->ManagerPageValue()).'</b></h2>';
				//$text .=  '<script>alert("'.strip_tags($text).'");</script>';
				//header_remove("Location"); header_remove("X-Redirect-By"); 
				die($text);
			}
		}
		//$this->plugin_updated_hook();
		if ( method_exists($this, 'activation_funcs') ) { $this->activation_funcs($network_wide); } 
	}
	// commented part:  pastebin_com/KNM3iMEs

	public function deactivate($network_wide){
		if(method_exists($this, 'deactivation_funcs') ) {   $this->deactivation_funcs($network_wide);  }
	}

	//load translation
	public function load_textdomain(){
		load_plugin_textdomain( $this->slug, false, basename($this->helpers->baseDIR). '/languages/' );
	}

	public function is_not_bulk_activation($plugin)
	{
		return ( $plugin == $this->static_settings['plugin_basename'] && !((new \WP_Plugins_List_Table())->current_action()=='activate-selected'));
	}
	
	// for some reasons, native "is_network_admin()" doesn't work during ACTIVATION hook, and we need to manually use this
	public function is_network_admin_referrer()
	{
		return (array_key_exists("HTTP_REFERER", $_SERVER) && stripos($_SERVER["HTTP_REFERER"],'/wp-admin/network/') !==false);
	}

	// remove library file on uninstall
	public function add_default_uninstall(){
		return;
		if( is_admin() && !$this->is_development)
		{
			$wp_uninstall_file = $this->baseDIR.'/uninstall.php';
			if( !file_exists($wp_uninstall_file) )
			{
				$content='<'.'?php
				// If uninstall not called from WordPress, then exit
				if ( ! defined( "WP_UNINSTALL_PLUGIN" ) ) exit; 
				';
				@$this->file_put_contents($wp_uninstall_file, $content);
			}
		}
	}

	public function pluginvars(){
		// https://goo.gl/Z3z8FW : Name, PluginURI, Version, Description, Author, AuthorURI, TextDomain, DomainPath, Network, Title, AuthorName
		return get_plugin_data( $this->helpers->plugin_entryfile, $markup = true, $translate = false);    //dont $translate, otherwise you will get error of: https://core.trac.wordpress.org/ticket/43869
	}

	//get latest options (in case there were updated,refresh them)
	public function refresh_options(){
		$this->opts	= $this->get_option_CHOSEN($this->slug, []);
		if(!is_array($this->opts)) $this->opts = $this->initial_user_options;
		foreach($this->initial_user_options as $name=>$value){ if (!array_key_exists($name, $this->opts)) { $this->opts[$name]=$value;  $should_update=true; }  }
		$this->opts = array_merge($this->opts, $this->initial_static_options);
		$this->opts['name']		=$this->static_settings['Name'];
		$this->opts['title']	=$this->static_settings['Title'];
		$this->opts['version']	=$this->static_settings['Version'];
		if(isset($should_update)) {	$this->update_opts(); }
		return $this->opts;
	}
	public function get_options(){ return $this->opts; }

	public function refresh_options_callback($func){
		$this->refresh_options();  call_user_func($func); $this->update_opts();
	}

	public function refresh_options_TimeGone(){
		//if never updated
		if(empty($this->opts['first_install_date'])) {
			$should_update=true;	$this->opts['first_install_date'] = time();
		}
		if(empty($this->opts['last_update_time'])) {
			$should_update=true;	$this->opts['last_update_time'] = time();
		}
		if(empty($this->opts['last_updates'])) {
			$should_update=true;	$this->opts['last_updates'] = [];   		
		}
		//if plugin updated through hook or manually... to avoid complete break..
		if( empty($this->opts['last_version']) || $this->opts['last_version'] != $this->opts['version'] ){
			$should_update=true; $this->opts['last_version'] = $this->opts['version']; $reload_needed=true;
		}
		if(isset($should_update)) {	$this->update_opts(); }
		if(isset($reload_needed)) { $this->plugin_updated_hook(true); }
	}


	//once_in_a_while time() timegone transient
	public function last_checkpoint($var_name, $seconds_to_check=86400){
		$opt= "last_checkpoints_rand_24df3023yfdh3qfhs";
		$this->$opt= !empty($this->$opt) ? $this->$opt : get_option($opt, []);
		if(empty($this->$opt) || empty($this->$opt[$var_name]) || !is_numeric($this->$opt[$var_name]) || $this->$opt[$var_name]< time()-$seconds_to_check ){
			$this->$opt[$var_name]	= time();
			update_option($opt, $this->$opt);
			return true;
		}
		return false;
	}

	public function check_if_pro_plugin()
	{
		$this->is_pro		= null;
		$this->is_pro_legal	= null;
		if( $this->static_settings['has_pro_version'] ){
			//$this->has_pro_version = true;  // it is price of plugin
			$ar= $this->get_license();
			$this->is_pro		= $ar['status'];
			$this->is_pro_legal	= $ar['legal'];
		}
		if(is_admin()) {
			if ($this->is_pro) {
				if (!$this->is_pro_legal) {
					add_action('network_admin_notices', [$this, 'admin_error_notice_pro'] ); 
					add_action('admin_notices', [$this, 'admin_error_notice_pro'] ); 
				}
				else{
					$this->pro_check_once_in_a_while();
				}
			}
		}
		$this->addons_dir = WP_PLUGIN_DIR.'/_addons'; //wp_plugins_dir();
	}

	public function reset_plugin_to_defaults()
	{
		$this->update_opts([]) ;
		$this->update_phrases([]) ;
		if(method_exists($this, 'plugin_reset_callback'))   $this->plugin_reset_callback();
	}

	//update library file on activation/update
	public function plugin_updated_hook($redirect=false)
	{
		return;	
	}
	
	public function get_prefix_CHOSEN(){
		return ($this->network_managed_is_selected ? $GLOBALS['wpdb']->base_prefix : $GLOBALS['wpdb']->prefix);
	}

	// quick method to update this plugin's opts
	public function optName($optname, $prefix=false){
		if( substr($optname,  0, 1) == '`'  ) {  $prefix=true;  $optname= substr($optname,1); }
		return ( !$prefix || stripos($optname, $this->slug) !== false )  ? $optname :  $this->slug . '_' . $optname;
	}

	public function setProperty($name, $value) {
		if (property_exists($this->helpers, $name)) {
			$this->helpers->$name = $value;
		}
		else {
			$this->$name = $value;
		}
	}

	public $options_save_privilege ='manage_options';
	public function update_opts($opts=null){
		if (!$opts) $opts = $this->opts; 
		else $this->opts = $opts;
		return $this->update_option_CHOSEN($this->slug, $opts );
	}
	public function update_opts_permission($opts=null){
		return ( !did_action('init') || !current_user_can($this->options_save_privilege) ? false : $this->update_opts() );
	}

	public function get_option_CHOSEN($optname, $default=false        				, $prefix=false){
		return call_user_func("get_".		( $this->network_managed_is_selected ? "site_" : "" ). "option",  $this->optName($optname, $prefix), $default );
	}
	public function update_option_CHOSEN($optname, $optvalue, $autoload=null		, $prefix=false){
		return call_user_func("update_".	( $this->network_managed_is_selected ? "site_" : "" ). "option",  $this->optName($optname, $prefix), $optvalue, $autoload );
	}
	public function delete_option_CHOSEN($optname									, $prefix=false){
		return call_user_func("delete_".	( $this->network_managed_is_selected ? "site_" : "" ). "option",  $this->optName($optname, $prefix) );
	}

	public function get_transient_CHOSEN($optname, $default=false        			, $prefix=false){
		return call_user_func("get_".		( $this->network_managed_is_selected ? "site_" : "" ). "transient",  $this->optName($optname, $prefix), $default );
	} 
	public function set_transient_CHOSEN($optname, $value, $seconds					, $prefix=false){
		return call_user_func("set_".		( $this->network_managed_is_selected ? "site_" : "" ). "transient",  $this->optName($optname, $prefix), $value, $seconds );
	} 
	public function update_transient_CHOSEN($optname, $optvalue, $expiry=null		, $prefix=false){
		return call_user_func("set_".		( $this->network_managed_is_selected ? "site_" : "" ). "transient",  $this->optName($optname, $prefix), $optvalue, $expiry );
	}
	public function delete_transient_CHOSEN($optname								, $prefix=false){
		return call_user_func("delete_".	( $this->network_managed_is_selected ? "site_" : "" ). "transient",  $this->optName($optname, $prefix) );
	}
	public function delete_transients_by_prefix_CHOSEN($myPrefix					, $prefix=false){
		global $wpdb;
		$table_name		= $this->network_managed_is_selected ? $wpdb->base_prefix.'sitemeta' : $wpdb->prefix .'options' ;
		$column_name	= $this->network_managed_is_selected ? 'meta_key' : 'option_name';
		return $this->helpers->delete_transients_by_prefix($myPrefix, $table_name, $column_name);
	}
	public function get_transient_ONCE_DELETE($optname, $default=false ){
		if( ($x = get_transient($optname))!==false ) { delete_transient($optname); return $x;  }
		return false;
	}
	
	//
	
	public function addSettingsPage($array){
		$actions = [];
		if (is_multisite()){
			if ( $this->network_wide_active ) $actions[] = 'network_admin_menu'; 
			if ( !$this->network_managed_is_selected ) $actions[]= 'admin_menu'; 
		}
		else {
			$actions[] = 'admin_menu';
		}
		$slug_name = array_keys($array)[0];
		$menuOpts = $array[$slug_name];
		foreach ($actions as $act) {
			add_action($act, function() use ($slug_name, $menuOpts) {
				$menu_button_name = $menuOpts['button_title'];
				$this->current_page_tabs = ['id'=>$slug_name, 'tablist'=>$menuOpts['tabs']];
				if ( $menuOpts['level'] === 'mainmenu' )  // icons: https://goo.gl/WXAYCi 
					add_menu_page($menu_button_name, $menu_button_name, $menuOpts['required_role'], $slug_name, $menuOpts['callback'], $menuOpts['icon'] );
				else {
					$parent = $this->helpers->array_value($menuOpts, 'parent_page_slug', $this->settingsPHP_page_dynamic);
					add_submenu_page($parent, $menu_button_name, $menu_button_name, $menuOpts['required_role'], $slug_name, $menuOpts['callback'] );
				}
			});
		}
		$this->options_into_parent($slug_name, $menuOpts['options']);
	}
	
    public function options_into_parent($prefix, $options_array)
    {
		$this->initial_options_arrays[$prefix] = $options_array; 
		$changed = false;
		foreach ($options_array as $key => $value) {
		  $subPrefx = 'sub_'.$prefix;
		  if (!isset($this->opts[$subPrefx][$key])) {
			if (array_key_exists('value', $value)) {
			  $this->opts[$subPrefx][$key] = $value['value'];
			  $changed = true;
			} elseif (is_array($value)) {
			  foreach ($value as $key2 => $value2) {
				$changed = true;
				$this->opts[$subPrefx][$key2] = $value2['value'];
			  }
			}
		  }
		}
		if ($changed){
		  $this->update_opts();
		}
    }
	public function getSubOption($subChildSlug, $keyName=null, $default =null){
		return is_null($keyName) ? $this->opts['sub_'.$subChildSlug] : $this->array_value($this->opts['sub_'.$subChildSlug], $keyName, $default); 
	}
	public function setSubOption($subChildSlug, $value, $keyName=null){ 
		if(empty($keyName)) $this->opts['sub_'.$subChildSlug]=$value; else $this->opts['sub_'.$subChildSlug][$keyName]=$value; return $this->update_opts(); 
	}
	public function updateSubOption($subChildSlug, $value, $keyName=null){ 
		return $this->setSubOption($subChildSlug, $value, $keyName);
	}


	
	// ######################
	public function postOptionIsset($name){
		return isset($_POST[$this->slug][$name]);
	}
	public function postOptionValue($name){
		return $_POST[$this->slug][$name];	//Note, the response of this method is always "sanitized & filtered" in any implemented methods
	}
	public function postOptionText($name){
		return $this->sanitize_text_field($this->postOptionValue($name));
	}
	public function postOptionNumber($name){
		return (int) $this->postOptionValue($name);
	}
	public function postOptionKey($name){
		return sanitize_key($this->postOptionValue($name));
	}
	//
	
	
	
	public function ManagerPageValue($menuNameId='first') { return $this->static_settings['menu_pages'][$menuNameId]['default_managed'] ; }
	public function ManagerPageAllow_network() { return ( (is_multisite() && in_array($this->ManagerPageValue(), ['network','both']) ) || ( !is_multisite() ) ) ; }
	public function ManagerPageAllow_singlesite() {( (is_multisite() && in_array($this->ManagerPageValue(), ['subsite','both']) ) || ( !is_multisite() ) ) ; }
	
	public function IsNetworkManaged(){
		return get_site_option( $this->slug . '_network_managed', true );
	}

	public function updateNetworkedState($value){
		$key = $this->slug . '_network_managed';
		if ( ! $this->option_exists( $key, true) ){
			add_site_option( $key, true );
		}
		$res = update_site_option( $key, $value );
		return $res;
	}
	
	public function phrase($key, $is_variable=false) {
		if($is_variable){
			if (!isset($this->translation_phrases[$key])){
				$this->translation_phrases[sanitize_title($key)] = sanitize_title($key);
				$this->update_phrases();
			}
		}
		return ( isset($this->translation_phrases[$key]) ? $this->translation_phrases[$key] : $key ); 
	}
	

	public function is_this_settings_page(){
	  return 
	  (
		is_admin() && 
		( 
			( stripos(get_current_screen()->base, $this->slug) !== false)  &&  (isset($_GET['page']) && $_GET['page']==$this->slug ) 
				||
			( stripos($this->helpers->currentURL, basename($this->plugin_page_url)) !==false  )	//for submodules or custom cases
		)
	  );
	}
		


	public function paypalDonationButton(){ return '<a class="button" style="display:inline-block; line-height:1em; min-height:25px; color:#179bd7; " href="javascript:tt_donate_trigger(event);" onclick="tt_donate_trigger(event);"/> <img style="height:20px; vertical-align:middle;" src="'.  $this->helpers->imageSvg("paypal") .'" /> '. __("donation") .'</a>'; }
	
	public function donations_trigger_popup()
	{
		// ############ donations #############
		if ( $this->static_settings['show_donation_popup'] && ! $this->helpers->valueIs($this->opts, 'donate_popup_a2', '1d') )
		{
			//show only after save/redirection
			if (  $this->opts['first_install_date'] != $this->opts['last_update_time'] )
			{
				$this->opts['donate_popup_a2']="1d";
				$this->update_opts();
				$text = sprintf(__('Dear users, our plugin (<code>%s</code>) is free. However, every plugin needs noticeable amount of work by developer. If you found this plugin useful, your minimal %s will support developer to maintain this plugin and keep it functional. <br/>Thank you.'), $this->static_settings['Name'], $this->paypalDonationButton() );
				?>
				<div id="paypal_donation_popup_2"><input type="hidden" autofocus/><?php echo $text;?></div>
				<script>
				jQuery(function(){  
					window.setTimeout(function(){ 
					jQuery('#paypal_donation_popup_2').dialog({ title:"<?php echo $this->static_settings['Name'];?>",  modal:true,   width:600 });
					
					jQuery("#puvox_donate_button").click(function(e) {
						e.preventDefault();
						jQuery('div.ui-dialog-content').dialog('close');
						jQuery([document.documentElement, document.body]).animate({
							scrollTop: jQuery(".puvox_plugin .in_additional").offset().top
						}, 1000);
					});
					}, 1000 );
				});
				</script>
				<?php
			}
		}
	}


	public function wp_kses($text, $tagsArr=[]){
		return wp_kses($text,$tagsArr);
	}
	public function notes_field(){
		if ($this->notes_enabled && current_user_can("manage_options") )
		{
			$optname=  'my_custom_note_'.$this->plugin_slug;
			//if form updated
			if( $this->checkSubmission('_wp_note_nonce2', 'note_nonce2_' ) )
			{
				update_option($optname, $this->wp_kses($_POST['mynote']) );
			}
			?>
			<div id="notesfield">
				<form action="" method="POST" style="background:pink; padding:5px 10px;">
					<h2>Your notes</h2>
					<textarea style="width:100%; height:200px;" name="mynote"><?php echo get_option($optname,'');?></textarea>
					<?php  $this->nonceSubmit('save only note', '_wp_note_nonce2', 'note_nonce2_') ; ?>
				</form>
			</div>
			<?php
		}
	}
	
	

	public function is_activation(){
		return (isset($_GET['isactivation']));
	}

	public function reload_without_query($params=array(), $js_redir=true){
		$url = self::remove_query_arg( array_merge($params, ['isactivation'] ) );
		if ($js_redir=="js"){ $this->js_redirect($url); }
		else { $this->php_redirect($url); }
	}

	public function if_activation_reload_with_message($message){
		if($this->is_activation()){
			echo '<script>alert(\''.$message.'\');</script>';
			$this->reload_without_query();
		}
	}


    public function OptionsForKeys_helper($keyName, $include_type=''){
        $array = [];
        foreach($this->initial_user_options as $key=>$val)
        {
			if (!is_array($val))
			{
				if ( empty($keyName) ){
					$array[$key]=$val;
				} 
				else if ( 
					   ($include_type==""      && $this->helpers->contains($key, $keyName) )
					|| ($include_type=="start" && $this->helpers->startsWith($key,$keyName))
					|| ($include_type=="end"   && $this->helpers->endsWith($key,$keyName))
				)
				{
					$array[$key]=$val;
				}
			}
        }
        return $array;
    }
    public function OptionsForKeys_table($keyName='', $include_type=''){
		?><table class="form-table"><td colspan="100%"><h3>Options</h3></td><?php $this->OptionsForKeys_Output();?></table><?php 
	}
    public function OptionsForKeys_Output($keyName='', $include_type=''){
		foreach ( $this->OptionsForKeys_helper($keyName,$include_type) as $key=>$val ) { 
			$value   = $this->opt($key);
			$is_bool = is_bool($value);  
			?>
			<tr class="def">
				<td scope="row">
					<code><?php echo $key;?></code>
				</td>
				<td scope="row">
					<?php echo '<input name="'.$this->plugin_slug.'['.$key.']" '. ($is_bool ? 'type="checkbox" value="1" '. checked($value, true, false) : 'type="text" value="'. $value .'" />');?>
				</td>
			</tr>
		<?php }
	}
    public function OptionsForKeys_update($keyName='', $include_type=''){
		foreach ( $this->OptionsForKeys_helper($keyName,$include_type) as $key=>$val ) { 
			$value   = $this->opt($key);
			$is_bool = is_bool($value);
			$this->opts[$key] = $is_bool ? isset($_POST[ $this->plugin_slug ][$key]) : sanitize_text_field( stripslashes($_POST[ $this->plugin_slug ][$key]) );   
		}
	}
    public function opt($key) {  return isset($this->opts[$key]) ? $this->opts[$key] : ''; }


	// navigation menu nav menu hooks: pastebin_com/BcGsVpe9

	// if post_exists query: https://goo.gl/aHZzv9

	public function send_error_mail($error){
		return wp_mail($this->static_settings['mail_errors'], 'wp plugin error at '. home_url(),  (is_array($error) ? print_r($error, true) : $error)  );
	}
	
		// unique func to flush rewrite rules when needed. if not hooked into wp_footer, hangs plugin options resaving 
	public function flush_rules_if_needed($temp_key="sample" ){
		// lets check if refresh needed
		$key="b".get_current_blog_id()."_". md5( ( is_file($temp_key) ? md5(filemtime($temp_key)) : $temp_key )    );
		if( !array_key_exists($key, $this->opts['last_updates']) || $this->opts['last_updates'][$key] < $this->opts['last_update_time']){
			$this->opts['last_updates'][$key] = $this->opts['last_update_time'];
			$this->update_opts();
			add_action('wp_footer', function(){ $this->helpers->flush_rules("js"); } );
		}
	}
	
	public function flush_rules_checkmark($redirect=false){
		flush_rewrite_rules();
		$this->opts['needs_flushing'] = true; $this->update_opts();
		if($redirect) {
			if ($redirect=="js"){ $this->helpers->js_redirect(); }   else { $this->helpers->php_redirect(); }
		}
	}
	public function flush_checkpoint(){
		if(isset($this->opts['needs_flushing']))
		{
			unset($this->opts['needs_flushing']);
			$this->update_opts();
			$this->helpers->flush_rules(true);
		}
	}
	
	public function shortcodes_initialize(){
		if(property_exists($this,'shortcodes'))
		{
			//enable shortcodes (if it's disabled)
			add_filter( 'widget_text', 'do_shortcode' );

			foreach($this->shortcodes as $name=>$val)
			{
				//add "name" manually as name
				$this->shortcodes[$name]['name']=$name; 
				$funcName = isset($this->shortcodes[$name]['name']['callback'])? $this->shortcodes[$name]['name']['callback'] : $name;
				add_shortcode($name, [$this, $funcName] );
			}
		}
	}

	
	/*  loader_wp_config.php
	// check if this file is included IN WP-CONFIG
			if (defined("include_my_custom_wpConfig")) {
				if (!defined("my_wp_cofnig_called")) { define("my_wp_cofnig_called", 1);
					define("WP_DEBUG", 	0); 
					define("WP_DEBUG_DISPLAY", 0);
					return;
				}
			} 
	*/


	public function get_phrases()
	{
		return $this->get_option_CHOSEN('`translated_phrases', []);
	}

	public function update_phrases($array=null)
	{
		if(!isset($array)) $array=$this->translation_phrases;
		return $this->update_option_CHOSEN('`translated_phrases', $array);
	}

	public function phrases_array()
	{ 
		$cont='';
		foreach( $this->plugin_files as $each)
		{
			$cont .= file_get_contents( $this->helpers->baseDIR.'/'. basename($each) );
		}
		preg_match_all( '/\$this\-\>phrase\((.*?)\)/si', $cont, $matches );
		$phrases_array = $this->get_phrases();
		foreach($matches[1] as $value) {
			$value=trim($value);
			//if not variable
			if(substr($value, 0, 1) != '$')
			{
				$sanitized_value = preg_replace("/[\"\']/", "", $value);
				$phrases_array[$sanitized_value] = $sanitized_value;
			}
		}
		return $phrases_array;
	}


	public function define_translations_exist(){
		//check if translations exist
		$last_vers  = get_site_option($this->slug . '_transl_lastvers');
		if( ! $last_vers || $last_vers != $this->static_settings["Version"] ){
			update_site_option($this->slug . '_transl_lastvers', $this->static_settings["Version"]);
			$res = !empty($this->phrases_array());
			update_site_option($this->slug . '_transl_exists', $res);
			return $res;
		}
		return get_site_option($this->slug . '_transl_exists');
	}

	private $current_page_tabs =[];
	public function options_tab($tabs_array =false, $menuId='first'){
		if(!$tabs_array) {
			$tabs_array = [];
			$tabs_array[] ='Options';
			if (!empty($this->current_page_tabs)) {
				$allTabs = $this->current_page_tabs['tablist'];
				$tabs_array =array_merge($tabs_array, $allTabs);
			} else {
				$tabs_array =array_merge($tabs_array, $this->helpers->array_value ($this->static_settings['menu_pages'][$menuId], 'tabs', []));
				if ($this->helpers->notifications_enable_db_logs) $tabs_array[] ='Notifications';
				if (property_exists($this,'shortcodes')) $tabs_array[] ='Shortcodes';
				if ($this->define_translations_exist())  $tabs_array[] ='Translations & Phrases';
			}
			$tabs_array[] ='Errors-Log & Reset';
		}
		if (!isset($_GET['tab'])) {
			$this->active_tab = $tabs_array[0];
		} else {
			foreach($tabs_array as $each_tab){
				if (sanitize_key($each_tab)==$_GET['tab'])  
					$this->active_tab=$each_tab;
			}
		}
		echo '<div class="nav-tab-wrapper customNav '. (false && empty($this->static_settings['display_tabs']) ? "displaynone" : "") .'">';
		foreach($tabs_array as $each_tab){
			$tab_TITLE = $each_tab=="Shortcodes" ? "Shortcodes & Api" : $each_tab;
			echo '<a href="'. self::add_query_arg('tab', sanitize_key($each_tab) ).'" class="nav-tab '. sanitize_key($each_tab).' '. ($this->active_tab == $each_tab ? 'nav-tab-active  whiteback' : ''). '">'. __( $tab_TITLE).'</a>';
		}
		echo '</div>';
	}
	
	public static function add_query_arg($param, $val){
		return esc_url(add_query_arg($param, $val));
	}
	public static function remove_query_arg($param, $val = false){
		return esc_url(remove_query_arg($param, $val));
	}

	public function checkNonce($str1="mng_nonce", $str2="nonce_mng_" ){
		return !empty( $_POST[$str1] ) && check_admin_referer( $str2 . $this->slug, $str1);
	}
	
	public function opts_page_output_parent($args=false)
	{
		if(is_network_admin())
		{
			if( $this->checkNonce( "mng_nonce_ADM", "nonce_mng_ADM_" ) ) 
			{
				if( isset( $_POST[$this->slug]['managed_from_changer'] ) ){
					$val = $_POST[$this->slug]['managed_from_site']=='network' ;
					$this->network_managed_is_selected = $val;
					$this->updateNetworkedState($val);
					$this->helpers->js_redirect();
				}
			}
			?>
			<style>
			.networked_switcher_itsf_parent {position:relative;}
			.networked_switcher_itsf { box-shadow: 0px 0px 15px #329c1e; z-index: 3; min-width:210px; background:#ffa637; border-radius: 0 10px 0 190px;  border: 2px solid #80808094; padding:2px 10px 4px 30px; position: fixed; top: 32px; right: 0px;  line-height:1.2em; text-align: center; z-index: 77; }
			.networked_switcher_itsf .modeChooser1 { display: flex; flex-direction: row; justify-content: center; align-items: center; }
			@media all and (max-width: 850px) { .networked_switcher_itsf .modeChooser1 { flex-wrap:wrap;}  }
			.networked_switcher_itsf label { padding-right: 20px!important;  border-radius: 0px!important; margin: 2px !important;}
			.networked_switcher_itsf label.networkwide { border-radius: 100px 0px 0px 100px!important;}
			.networked_switcher_itsf label.subsite { border-radius: 0px 100px 100px 0!important;}
			.networked_switcher_itsf input[type="radio"] { margin:2px 0 0 -20px ;}
			</style>
			<div class="networked_switcher_itsf_parent">
				<div class="networked_switcher_itsf">
					<form method="POST" action="" name="networked_switcher_form">
					<?php _e("You can change from where you'd like to manage this plugin's settings page"); ?></b>
					<div class="modeChooser1">
				
						<label for="networkwide" class="networkwide button<?php echo $this->network_managed_is_selected ? "-primary":"";?> "><?php _e("Network dashboard (controls all subsites)");?></label>
						<input id="networkwide" onchange="managed_from_onchanger(this)" type="radio" name="<?php echo $this->slug;?>[managed_from_site]" value="network" <?php checked($this->network_managed_is_selected);?> />
						<label for="subsite" class="subsite button<?php echo !$this->network_managed_is_selected ? "-primary":"";?>"><?php _e("Each Sub-Site with own settings page");?></label>
						<input id="subsite" onchange="managed_from_onchanger(this)"  type="radio" name="<?php echo $this->slug;?>[managed_from_site]" value="subsite" <?php checked(!$this->network_managed_is_selected);?>  />
						<input type="hidden" name="<?php echo $this->slug;?>[managed_from_changer]" value="ok" />  
						<?php wp_nonce_field( "nonce_mng_ADM_".$this->slug, "mng_nonce_ADM" ); ?>
					</div>
					</form>
					<script>
					//jQuery(".modeChooser1").controlgroup();
					function managed_from_onchanger(e)
					{
						document.forms["networked_switcher_form"].submit();
						document.getElementById("wpbody").style.opacity = 0.1;
					}
					</script>
				</div>
			</div>
		<?php 
		}
		if ( (is_network_admin() && $this->network_managed_is_selected) || (!is_network_admin() && !$this->network_managed_is_selected) ){
			if(method_exists($this, 'opts_page_output')) 
				$this->opts_page_output();
		}
		else{
			echo '<div style="display: flex; background: white; flex-direction: column; max-width: 600px; margin: 100px auto; border-radius: 10px; padding: 30px;"><h1>'.__('Plugin is set to be managed per: <span class="perChosen">'. ($this->network_managed_is_selected ? "Network": "Sub-sites") ).'</span></h1></div>';
		}
	}
	

	public function settings_page_check_save(){
		if( $this->checkSubmission( 'nonce3'. $this->slug, 'nonceact3'. $this->slug ) )
		{
			if(!empty($_POST[$this->slug]) ) {
				$this->opts['last_update_time'] = time();
				$this->update_opts();
			}

			if(isset( $_POST[$this->slug]['clear_error_logs'] ) ){
				$this->helpers->clear_errorslog();
			}

			if(isset( $_POST[$this->slug]['reset_plugin_defaults'] ) ){
				$this->reset_plugin_to_defaults(); $this->helpers->js_redirect();
			}
			
			if(isset( $_POST[$this->slug]['import_settings_json'] ) ){
				$array = json_decode( stripslashes($_POST[$this->slug]['import_settings_json']), true);
				$this->update_opts($array);
				$this->helpers->js_redirect();
			}

			if(isset( $_POST[$this->slug]['update_transl_phrases'] ) ){
				$this->translation_phrases =  array_map('sanitize_text_field', $_POST[$this->slug]['translation_phrases']);
				$this->update_phrases( $this->translation_phrases ) ;
			}

			if(isset($_GET[$this->slug.'-remove-pro']) ) {
				delete_site_option($this->license_keyname());
				$this->helpers->js_redirect(self::remove_query_arg($this->slug.'-remove-pro'));
			}
		}
	}

	public function settings_page_part($type, $menuId)
	{
 		if($type=="start")
		{
			$this->settings_page_check_save();
			?>
			<style>.myplugin .separate_block{ box-shadow: 0px 0px 20px black; margin:20px; padding:20px; } </style>
			<div class="clear"></div>
			<div class="<?php echo $this->myplugin_class;?>">

				<h1 class="plugin-title"><?php echo $this->helpers->array_value($this->opts['menu_pages'][$menuId], 'page_title', $this->opts['name']);?></h1> 
				<?php $this->options_tab(false, $menuId);  ?>
				<!-- <h2 class="settingsTitle"><?php _e('Plugin Settings Page!');?></h2> --> 
					<div class="optwindow">
			<?php
		}
		
		// be here atm
		if($type=="start")
		{
			if ($this->active_tab == 'Options')
			{ 
				if ($this->helpers->extra_options_enabled) $this->customOptsOutput();
			} 

			// #########################################################
			if ($this->active_tab == "Shortcodes")
			{ 
				echo '<h1 class="shortcodes_maintitle">'. __('Shortcodes Usage').'</h1>';
				
				foreach($this->shortcodes as $key=>$value)
				{
					$this->helpers->shortcodes_table($key, $value);
					$this->helpers->shortcode_alternative_message($key);
				}


				echo '<div class="hooks_examples">';
				echo '<h1 class="shortcodes_maintitle">'. __('Available hooks (to modify from external functions)') .'</h1>';
				if ( property_exists($this, "hooks_examples") ) {
					foreach ($this->hooks_examples as $key=>$block){
						echo '<div class="hook_example_block '.$key.'">';
						if ($block['type']=='filter'){
							echo '<div class="description">'. __($block['description']) .':</div>';
							echo '<code>add_filter("'.$key.'", "yourFunc", 10, '. count($block['parameters'] ) .' );'."\r\n".'function yourFunc($'. implode(', $', $block['parameters'] ).') { ... return $'.$block['parameters'][0].';} </code>'; 
						}
						echo '</div>';
					}
				}
				echo '</div>';
			}
			// #########################################################


			
			// #########################################################
			if ($this->active_tab == "Translations & Phrases")
			{ ?>
				<div class="translations_page">
					<form method="post" action="">
						<?php _e("Here will show up all phrases that are outputed on your site fron-end by this plugin, so you can translate/customize them."); ?>
						<table class="translations_table">
							<tbody>
								<?php 
								$phrases_arr = $this->phrases_array();
								$phrases = $this->translation_phrases;
								if(is_array($phrases_arr)){
									foreach ($phrases_arr as $key=>$value){
										$value = array_key_exists($key, $phrases) ? $phrases[$key] : $key;
										echo '<tr>';
										echo '<td>'. $key.'</td><td><input type="text" name="'.$this->slug.'[translation_phrases]['.$key.']" value="'. $value .'" /></td>';
										echo '</tr>';
									}
								}
								?>
							</tbody>
						</table>
						<input type="hidden" name="<?php echo $this->slug;?>[update_transl_phrases]" value="ok" />
						<?php
						wp_nonce_field( "nonce_".$this->slug);
						submit_button(  __( 'Save' ), 'button-secondary', '', true  );
						?>
					</form>
				</div>
			<?php
			}
			// #########################################################

			if ( ! ($last_options_json = $this->get_transient_chosen('`_plugin_last_options_json') ) )
			{
				$last_options_json =  $this->opts;
				$this->update_transient_chosen('`_plugin_last_options_json', $last_options_json, DAY_IN_SECONDS * 2);
			}



			// #########################################################
			if ($this->active_tab == "Errors-Log & Reset")
			{ ?>
				<div class="errors_page">
					<div class="errors_table_container">
						<table class="errors_log">
							<style>
							.myplugin .errors_page .errors_table_container { max-height: 400px;  overflow-y: scroll;  border: 1px solid #b5b5b5;}
							.myplugin .errors_page table {border-collapse: collapse;}
							.myplugin .errors_page table tr > * { border: 1px solid #c7c7c7; padding: 3px 5px; }
							.myplugin .errors_page .errors_log tr{transition:0.2s all;}
							.myplugin .errors_page .errors_log tr.headerRow{color:orange;}
							.myplugin .errors_page .errors_log tr:hover{background:#fdf7f7;}
							.myplugin .errors_page .errors_log td{min-width: 10px;} 
							.myplugin .errors_page .errors_log td pre { white-space: pre-wrap; word-wrap: break-word; }
							.myplugin .errors_page table .row_id { min-width:40px; width: 50px; max-width:50px; }
							.myplugin .errors_page table .row_gmdate { min-width:40px; width:80px; max-width:80px; }
							.myplugin .errors_page table .row_function_name { min-width:120px; width: 150px; max-width:150px; }
							.myplugin .import-json-settings{ width:100%; height:100px; }
							</style>
							<tbody>
								<?php
								//$this->log("asdddd", "");  
								$errors = $this->helpers->get_errorslog();
								if(!empty($errors))
								{
									rsort($errors);  //reverse order, last added to top
									$column_count =  count( $keys = array_keys( ((array)$errors[0]) )); 
									echo '<tr class="headerRow">'; for($i=0; $i<$column_count; $i++) echo "<th class='row_{$keys[$i]}'>$keys[$i]</th>";echo '</tr>'; 

									$j=0;
									foreach ($errors as $each_err) {
										//$j++; if ($j>$this->logs_table_maxnum) break;
										$each_err= (array) $each_err;
										echo '<tr>';
										for($i=0; $i<$column_count; $i++){
											$out='';
											$current = $each_err[ array_keys($each_err)[$i]];
											if (!empty($current) )
											{
												$out = $current;
											}
											echo '<td class="row_'.$keys[$i].'"><pre>'. htmlentities($out).'</pre></td>';
										}
										echo '</tr>';
									}

								}
								?>
							</tbody>
						</table>
					</div>
					

					<div class="clear-errors-log centered separate_block">
						<form method="post" action="">
							<input type="hidden" name="<?php echo $this->slug;?>[clear_error_logs]" value="ok" />
							<?php  $this->nonceSubmit( __( 'Clear Errors Log'),  "nonce3".$this->slug, 'nonceact3'.$this->slug) ; ?>
						</form>
					</div>

					
					<div class="plugin-export-import centered separate_block">
						<h2><?php echo __( 'Export settings' );?></h2>
						<textarea class="export_settings" style="min-width:200px;"><?php echo htmlentities(json_encode($this->opts));?></textarea>
						<!-- <div style="display:none;">(<?php _e("Backuped settings of 48 hours ago:");?><textarea><?php echo htmlentities(json_encode($last_options_json));?></textearea>) </div> -->
					</div>
					

					<div class="plugin-export-import centered separate_block">
						<h2><?php echo __( 'Import settings' );?></h2>
						<form method="post" action="">
							<textarea class="import-json-settings" name="<?php echo $this->slug;?>[import_settings_json]"></textarea>
							<?php  $this->nonceSubmit( __( 'Import (overwrite) settings !'),  "nonce3".$this->slug, 'nonceact3'.$this->slug) ; ?>
						</form>
					</div>


					<div class="plugin-reset-defaults centered separate_block">
						<form method="post" action="">
							<input type="hidden" name="<?php echo $this->slug;?>[reset_plugin_defaults]" value="ok" />
							<?php  $this->nonceSubmit( __( 'Reset plugin options to defaults' ),  "nonce3".$this->slug, 'nonceact3'.$this->slug) ; ?>
						</form>
					</div>


				</div>
			<?php
			}
			// #########################################################
			
		}

		
		elseif ($type=="end")
		{ ?>
				</div><!-- optwindow -->
				<?php $this->endStyles();?>
			</div><!-- myplugin -->
		<?php
		}
	}

	public function set_initial_static_options ($array){
		$this->initial_static_options = $array;
	}
	public function set_initial_user_options ($array){
		$this->initial_user_options = $array;
	}

	public function customOptsOutput() {
		$all_opts=$this->get_my_site_option();
		//if updated
		if (isset($_POST['securit_noncee223'])){    
			$this->NonceCheckk('securit_noncee223','myopts_exs2');

			$all_opts= $this->sanitize_text_field_recursive( $_POST['my'] ); 
			$this->update_my_site_options($all_opts);
		}

		?>
		<form action="" method="POST" class="custom_opts">
			<?php 	//wp_editor( htmlspecialchars_decode(get_option('nwsMTNG_notes_'.$laang)), 'mtng_notes_styl_ID'. $laang, $settings = array('textarea_name'=>'nwsMTNG_notes_'. $laang,  'editor_class' => "editoor_nws_note")); ?>
			<h2>Extra options   (0= OFF,  1= ON)</h2>
			<?php
			$this->input_fields_from_array($all_opts,'my');
			?>
			<div class="my_save_divv" style="text-align:center; padding:10px;  z-index:999; "><input type="submit" class="my_SUBMITT" value="SAVE" /></div> <?php echo $this->NonceFieldd('securit_noncee223','myopts_exs2'); ?> 
		</form>
		<?php 
	}


	
	public function endStyles($external=false)
	{ ?>
		<?php 
		if ($external===false) {
			//
		}
		elseif ($external===true) {
			echo '<div class="'.$this->myplugin_class.'">'; 
		}
		?>

		<style>
			.myplugin { margin: 20px 20px 0 0; line-height:1.2;  max-width:100%; display:flex; flex-wrap:rap; justify-content:center; flex-direction:column; padding: 20px; border-radius: 100px; }
			.myplugin * { position:relative;}
			.myplugin code {font-weight:bold; padding: 3px 5px;  display: inline-block;}
			.myplugin >h2 {text-align:center;}
			.myplugin h1,
			.myplugin h2,
			.myplugin h3 {text-align:center; margin: 0.5em 1em 1em;}
			.myplugin table tr { border-bottom: 1px solid #cacaca; }
			.myplugin table td {min-width:50px;}
			.myplugin .form-table  { border: 1px solid #cacaca; padding:2px;  }
			.myplugin .form-table td { padding: 15px 5px;  }
			.myplugin .form-table th { padding: 20px 10px 20px 10px; } 
			.myplugin p.submit {text-align: center;}
			.myplugin .optwindow { border: 1px solid #b5b5b56e;  padding: 10px; border-width: 0px 1px 1px 1px; border-radius: 0px 0px 30px 30px; }
			zz.myplugin input[type="text"]{width:100%;}
			.myplugin .additionals{ display:flex;  font-family: initial; font-size: 1.5em;   text-align:center; margin: 25px 5px 5px; padding: 5px; background: #efeab7;  padding: 5px 0 0 20px;  border-radius: 0% 20px 140px 90%; }
			z.myplugin .additionals:before { content: ""; position: absolute; top: 5%; left: 5%; height: 90%; width: 90%; background: #a222ff61; border-radius: 60% 60% 770% 110px;opacity: 0.6; transform: rotatez(-2deg); }
			.myplugin .additionals:after { content: ""; position: absolute; top: 5%; left: 5%; width: 90%; background: #6bd5ff45; border-radius: 10% 40% 20% 110px; opacity: 0.6; transform: rotatez(3deg); z-index: 0; height: 100px; }
			.myplugin .additionals a{font-weight:bold;font-size:1.1em; color:blue;}
			.myplugin .in_additional { z-index:3; width: 700px; background: #ffffff00; box-shadow: 0px 0px 20px #7d7474; border-radius: 30px; padding: 11px; margin: 0 auto; margin: 20px auto; }
			z.myplugin .additionals li { list-style-type: circle; list-style-type: circle; float: left; margin: 5px 0 5px 40px;}
			.myplugin .whiteback { background:white; border-bottom:1px solid white; }
			.myplugin.version_pro .donations_block, .myplugin.version_not_pro .donations_block { display:none; }
			.myplugin .donation_li a{  color: #d47b09; }
			.myplugin .customNav {margin: 0 0 0 0;}
			.myplugin .customNav .errors-logreset{ color: #903e4c; font-size: 0.7em; margin: 0.9em 0 0 0; font-style: italic; opacity:  0.6;  float:right;}
			.myplugin .customNav .nav-tab{ border-radius: 60% 30% 5% 0px; }
			.myplugin .customNav .nav-tab-active{ color: #43ceb5; pointer-events: none; }
			.myplugin .freelancers {font-style: italic; font-family: arial; font-size: 0.9em; margin: 15px; padding: 10px; border-radius: 5px; opacity: 0.7; }
			.myplugin .freelancers a{}
			.myplugin .button { top: -4px; }
			.myplugin .red-button { background: #ec5d5d;   zbackground:  #ffdfdf;}
			.myplugin .pink-button { background: pink; }
			.myplugin .green-button { background: #44d090; }
			.myplugin .float-left { float:left; }
			.myplugin .float-right { float:right; }
			.myplugin .displaynone { display:none; }
			.myplugin .clearboth { clear:both;  height: 20px;  }
			.myplugin .noinput { border: none!important; box-shadow:none!important; width:auto!important; display:inline-block!important; font-weight:bold; }
			.myplugin .translations_table { margin: 20px 0 0 30px; border-collapse: collapse;}
			xxx.ui-widget-overlay { background: #000000; opacity: 0.8; filter: Alpha(Opacity=80); }
			xxx.ui-dialog {z-index: 9222!important; }
			.myplugin .alertnative_to_shortcodes {margin:50px 10px; box-shadow: 0px 0px 20px grey; padding: 40px; }

			.myplugin .ui-sortable-handle.ui-sortable-helper{ cursor: move; }
			.myplugin textarea.fullwidth1{ display:block; width:100%; height:100px; }
			.myplugin textarea.fullwidth2{ display:block; width:100%; height:200px; }
			.myplugin textarea.fullwidth3{ display:block; width:100%; height:300px; }
			.myplugin textarea.fullwidth4{ display:block; width:100%; height:400px; }
			.myplugin textarea.halfwidth1{ display:block; width:50%; height:100px; margin: 0 auto;}
			.myplugin textarea.halfwidth2{ display:block; width:50%; height:200px; margin: 0 auto;}
			.myplugin textarea.halfwidth3{ display:block; width:50%; height:300px; margin: 0 auto;}
			.myplugin textarea.halfwidth4{ display:block; width:50%; height:400px; margin: 0 auto;}

			.myplugin .hook_example_block { margin: 10px 0; line-height: 1.4em; }
			.myplugin a,.myplugin a.button { display: inline; }
			.myplugin .disabled { pointer-events: none; }
			.myplugin .nonclickable { pointer-events: none; }
			.myplugin .hiddentransparent {position: relative; width: 1px; height: 1px; color: transparent; display: inline; overflow: hidden; }

			.myplugin .review_block{ float:right; }
			.myplugin .review_block a{ float:right; font-size:20px; font-weight:bold; }
			.myplugin .review_block .stars{ height:30px; }
			.myplugin .review_block span.leaverating {position:absolute; z-index:4; margin:0 auto; text-align:center; width:auto; white-space:nowrap; top:15px; color:#000000de; font-size:0.8em; left:20px; text-shadow:0px 0px 25px black;}
			.myplugin .review_block img.stars{ height:30px; vertical-align:middle; }

			.myplugin .shortcode_atts{ color:#b900f3; }
			.myplugin .shortcodes_maintitle { font-style:italic; }
			.myplugin table .shortcode_tr_descr { font-weight:bold; color:black; }
			.myplugin .site_author_block{ text-align:center; font-size:0.8em; }
			.myplugin .site_author_block a{ text-decoration:none; color:black;}
			.myplugin .shortcodes_block { box-shadow: 0px 0px 15px #00000066; padding: 10px 0 0 0; margin: 20px 0;}
			.myplugin .shortcodes_block z.h3{ color:#f34500; text-align:center; }

			.myplugin .datachange-save-button{ display:none; }
			.myplugin ._save_button{ display:none; }
			.myplugin .numeric_input{ width:50px; font-weight:bold;}
			.myplugin .form-table td { vertical-align: top; }
			
			.myplugin .centered {display: flex; justify-content: center; align-items: center; flex-direction: column; }
			.myplugin .centered.horizontal { flex-direction: row; }
			.myplugin .centered.vertical { flex-direction: column; }

			.myplugin .centered{ text-align:center; }
			.myplugin .flexrow   { display:flex; flex-direction:row; }
			.myplugin .flexcolumn{ display:flex; flex-direction:column; }
			.myplugin .separate_block{ margin:22px; padding:5px; box-shadow:0px 0px 3px black; }
			.myplugin .centered-float { position: fixed; bottom: 0; margin: 0 auto; left: 0; right: 0; z-index: 333;}
			
			ZZZ_example_jquery_u_ {url: (https://github.com/jquery/jquery-ui/tree/master/themes/base); }
			.ui-widget.ui-widget-content { border: 1px solid #c5c5c5; }
			.ui-corner-all { border-radius: 3px; }
			.ui-widget-header { border: 1px solid #dddddd; background: #e9e9e9; color: #333333; font-weight: bold; }
			
			.ui-dialog { padding: .2em; }
			
			.ui-tooltip {	padding: 8px;	position: absolute;	z-index: 9999;	max-width: 300px;}
			body .ui-tooltip {	border-width: 2px; border:1px solid #e7e7e7; box-shadow:0px 0px 3px gray; }
		</style>

		<div class="clear"></div>
		<?php if ($this->static_settings['show_rating_message'] || $this->static_settings['show_donation_footer'] ) { ?>
		<div class="newBlock additionals">
		
			<?php if ( $this->static_settings['show_donation_footer'] ) { ?>
			<div class="in_additional">
				<h4></h4>
				<h3><?php _e('More Actions');?></h3>
				<ul class="donations_block">
					<li class="donation_li">
						<!-- <?php _e('If you found this plugin useful, any donation is welcomed');?> :  $<input id="donate_pt" type="number" class="numeric_input" value="4" /> <button onclick="tt_donate_trigger(event);"/><?php _e('Donate');?></button> -->
						<?php _e('If you found this plugin useful, any amount of');?> <?php echo $this->paypalDonationButton();?> <?php _e(' is welcomed');?> 
						<script>
						function tt_donate_trigger(e)
						{
							e.preventDefault();
							var url= '<?php echo $this->static_settings['donate_url'];?>'; //+ '/'+ document.getElementById('donate_pt').value
							window.open(url,'_blank');
						}
						</script>
						<!-- <a href="%s" class="button" target="_blank">donation</a> -->
					</li>
				</ul>
				<ul>
					<li>
						<?php if (false) printf(__('You can check other useful plugins at: <a href="%s">Must have free plugins for everyone</a>'),  $this->static_settings['musthave_plugins'] ).'.';	?>
					</li>
				</ul>
			</div>
			<?php } ?>


			<?php if($this->static_settings['show_rating_message']) { ?>
			<div class="review_block">
				<a class="review_leave" href="<?php echo $this->static_settings['wp_rate_url'];?>" target="_blank">
					<span class="leaverating"><?php _e('Rate plugin');?></span>
					<img class="stars" src="<?php echo $this->helpers->imageSvg("rating-transparent");?>" />
				</a>
			</div>
			<?php } ?>
			
		</div>
		<?php } ?>

		<div class="clear"></div>
		<script> tt_ajax_action = '<?php echo $this->plugin_slug_u;?>_all';</script>
		
		<script>
		function pro_field(targetEl){
			var is_pro = false; <?php //echo $this->unregistered_pro() ? "true" : "false";?>; 
			if(is_pro) {
				targetEl.attr("data-pro-overlay","pro_overlay");
			}
		}
		</script> 

		<?php 
		// $this->purchase_pro_block();  
		?>

		
		<!-- Show "SAVE" button after input change,  type="text" id="manual_pma_login_url" data-onchange-save="true"  data-onchange-hide=".type_manual" name=" -->
		<div class="datachange-save-button">
			<?php submit_button( false, 'button-primary _save_button', '', true,  $attrib=  ['id' => '_save_button'] ); ?> 

			<script>
			(function($){ 

				// save button show/hide
				var save_button=$('.myplugin #_save_button');
				$('.myplugin [data-onchange-save]').on("change, input", function(e){
					save_button.insertAfter( $(this) );
					save_button.show();
					save_button.css( { 'margin-left': "-"+(save_button.css("width")), 'position':'relative', 'top':'0px', 'left':save_button.css("width")  });
					var target=$(this).attr("data-onchange-hide"); if(target && target.length) {   $( target ).css("visibility","hidden");   }
				});

				//noinput types
				if($(".noinput").length) $(".noinput").attr('size', $(".noinput").val().length);
			})(jQuery); 
			</script> 
		</div>
		
		<?php $this->donations_trigger_popup(); ?>
		<?php $this->notes_field(); ?>

		<?php if ($external===true) echo '</div>'; ?>
		<?php
	}
	 


	public function multitisteUninstall()
	{
		if (is_multisite()) {
			single_uninstall();

			// delete data foreach blog
			$blogs_list = $GLOBALS['wpdb']->get_results("SELECT blog_id FROM {$GLOBALS['wpdb']->blogs}", ARRAY_A);
			if (!empty($blogs_list)) {
				foreach ($blogs_list as $blog) {
					switch_to_blog($blog['blog_id']);
					single_uninstall();
					restore_current_blog();
				}
			}
		} else {
			single_uninstall();
		}
	}

	public function admin_scripts($hook)  //i.e. edit.php
	{
		if($this->is_this_settings_page()){
			$this->admin_scripts_out($hook);
		}
	}

	// https://github.com/WordPress/WordPress/blob/master/wp-includes/script-loader.php
	public function admin_scripts_out($hook)  //i.e. edit.php
	{
		$where='admin'; //admin|wp
		if (property_exists($this,'disable_admin_scripts_load')) return;
		
		$this->helpers->register_stylescript($where, 'script', 'jquery');

		//jquery ui core
		//$this->helpers->register_stylescript($where, 'script',	'jquery-ui-core');
		
		//jquery ui EFFECTS
		$this->helpers->register_stylescript($where, 'script',	'jquery-effects-core');

		//jquery ui DIALOG
		$this->helpers->register_stylescript($where, 'script',	'jquery-ui-dialog');
		$this->helpers->register_stylescript($where, 'style',	'wp-jquery-ui-dialog');	
		// download and include locally:	'ui-css', 'https://code (dot) jquery (dot) com/ui/1.12.1/themes/base/jquery-ui.css',  false,  '1.1');

		$this->helpers->register_stylescript($where, 'script',	'jquery-ui-tooltip');
 
		//add_action('admin_footer', function() { <script></script> } );
	}

	
	public function admin_head_func()
	{ 
		if( defined("PuvoxLibrary_scripts_loaded") ) return;  define("PuvoxLibrary_scripts_loaded", true); 
		?>
		<script>
		//window.onload REPLACEMENT
		// window.addEventListener ? window.addEventListener("load",yourFunction,false) : window.attachEvent && window.attachEvent("onload",yourFunction);
		PuvoxLibrary =
		{
			// check for Ajax calls from front-end
			backend_call(actName, data, callback, displayLoader)
			{
				var self=this;

				data["action"]    = tt_ajax_action;
				data["_wpnonce"]  = '<?php echo wp_create_nonce( "Puvox_BackendCallJS");?>';
				data["act"]       = actName;
				var displayLoader = displayLoader || false;
				if (displayLoader)
					PuvoxLibrary.spinner(true);
				jQuery.post
				(
					ajaxurl,
					data,
					function(response){   
					}
				)
				.done(function(res) {
					if (displayLoader)
						PuvoxLibrary.spinner(false);
					callback(self.responseStringify(res), true, res);
				})
				.fail(function(res) {
					if (displayLoader)
						PuvoxLibrary.spinner(false);
					callback(self.responseStringify(res), false, res);
				})
				//.always(function(res) { })
			},

			reload_this_page(){
				window.location = window.location.href;
			},

			is_object(variable){
				return typeof variable === 'object' && variable !== null;
			},
			responseStringify(obj_or_text){
				return ! this.is_object(obj_or_text) ? obj_or_text : ( 'responseText' in obj_or_text ? obj_or_text.responseText : JSON.stringify(obj_or_text) );
			},

			//show Spinner (loader-waiter)
			spinner(action)
			{
				var spinner_id = "tt_spinner";
				if(action)
				{
					var div=
					'<div id="'+spinner_id+'" style="background:black; position:fixed; height:100%; width:100%; opacity:0.9; z-index:9990;   display: flex; justify-content: center; align-items: center;">'+
						'<div style="">Please Wait...</div>'+
					'</div>';
					document.body.insertAdjacentHTML("afterbegin", div);
				}
				else
				{
					var el = document.getElementById(spinner_id);
					if (el) {
						el.parentNode.removeChild(el);
					}
				}
			},

			//shorthand for jQuery dialog
			dialog: function(message)
			{
				jQuery('<div class="ttDialog">'+message+'</div>').dialog({
					modal: true,
					width: 500,
					close: function (event, ui) {
						jQuery(this).remove();	// Remove it completely on close
					}
				});
			},
			//shortand for the same, to remember easily
			message: function(message)
			{
				return PuvoxLibrary.dialog(message);
			},



			// make an element field to blink/animate
			blink_field : function (fieldObj)
			{
				fieldObj.animate({backgroundColor: '#00bb00'}, 'slow').animate({backgroundColor: '#FFFFFF'}, 'slow');
			},


			// hide content if chosen radio box not chosen  
			radiobox_onchange_hider : function (selector,desiredvalue, target_hidding_selector, SHOW_or_hide)
			{
				var SHOW_or_hide = SHOW_or_hide || false;
				if( typeof roh_dropdown_objs == 'undefined') { roh_dropdown_objs = {}; } 
				if( typeof roh_dropdown_objs[selector] == 'undefined' ){
					roh_dropdown_objs[selector] = true ; var funcname= arguments.callee.name;
					//jQuery(selector).change(function() { window[funcname](selector,desiredvalue, target_hidding_selector, SHOW_or_hide);	});
					jQuery(selector).change(function() { PuvoxLibrary.radiobox_onchange_hider(selector,desiredvalue, target_hidding_selector, SHOW_or_hide);	});
				}
				var x = jQuery(target_hidding_selector);
				if( jQuery(selector+':checked').val() == desiredvalue)	{ if(SHOW_or_hide)	x.show(); else x.hide(); } 
				else 													{ if(SHOW_or_hide)	x.hide(); else x.show(); }
			},

			// hide content if chosen radio box not chosen  
			checkbox_onchange_hider : function (selector, when_checked, destination_hidding_selector)
			{
				var x=function(target, destination){
					if(   (when_checked && jQuery(target).is(':checked'))  || (!when_checked && jQuery(target).not(':checked'))  ) {
						jQuery(destination).show();
					} else {
						jQuery(destination).hide();
					}
				};
				x(selector, destination_hidding_selector);
				jQuery(selector).click( function(e){ x(e.target, destination_hidding_selector); } ); 
			}
		};
		</script>
		<?php
	}
  } // class 
  #endregion









#----------------------------------------------------#
#----------------------------------------------------#
#region      [ functions for PRO plugins ]           #
#----------------------------------------------------#
#----------------------------------------------------#
class wp_plugin_pro extends wp_plugin
{

	public function addon_path(){ return WP_PLUGIN_DIR .'/_addons/'.$this->slug .'-addon/addon.php';	}
	public function addon_exists(){	return (file_exists($this->addon_path())); }
	public function license_keyname(){ return $this->plugin_slug_u ."_l_key"; }
	//move uploaded addon to it's folder : https://pastebin_com/enqb2GFh
	public function unregistered_pro() { return $this->static_settings['has_pro_version'] && !$this->is_pro_legal; }
	
	public function load_pro()
	{
		if ($this->is_pro){
			if ($this->is_pro_legal){
				$puvox_last_class = $this;
				$this->addon_exists() && include_once($this->addon_path());
			}
		}
	}

	public function get_license($key=false){
		$def_array = [
			'status' => false,
			'legal' => false,
			'key' => '',
			'last_error'=>''
		];
		$license_arr = get_site_option($this->license_keyname(), $def_array );
		return ($key ? $license_arr[$key] : $license_arr);
	}

	public function update_license($val, $val1=false){
		if(is_array($val)){
			$array = $val;
		}
		else{
			$array= $this->get_license();
			$array[$val]=$val1;
		}
		update_site_option( $this->license_keyname(), $array );
	}

	public function license_answer($key, $type="check/or/activate")
	{
		$this->info_arr	= ['key' => $key] + ['siteurl'=>home_url(), 'plugin_slug'=>$this->slug ] + $this->pluginvars() + $this->opts;
		$answer = wp_remote_retrieve_body( wp_remote_post($this->static_settings['purchase_check'].$type,
			[
				'method' => 'POST',
				'timeout' => 25,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => [],
				'body' => $this->info_arr,
				'cookies' => []
			]
		));
		return $answer;
	}

	public function license_status($license, $type="check/or/activate")
	{
		$key = sanitize_text_field($license);
		$answer = $this->license_answer($key, $type);

		if(!$this->helpers->is_JSON_string($answer)){
			$result = [];
			$result['error'] = $answer;
		}
		else{
			$result = json_decode($answer, true);
		}
		//
		if(isset($result['valid'])){
			if($result['valid']){
				$ar['status']= true;
				$ar['legal']= true;
				$ar['key']= $key;
				$ar['last_error']= '';
				$this->update_license($ar);
			}
			else { 
				// 
				$this->update_license( 'legal', false );
				$this->update_license( 'last_error', json_encode($result['response']) );
				$result['error'] = json_encode($result['response']);
			} 
		}
		else{
			$result['error'] = $answer;
			$this->helpers->log('Error while calling to vendor', $result['error']);
		}
		return json_encode($result);
	}
	public function pro_check_once_in_a_while( $time_length = 864000 )
	{
		$name= '`_last_license_check';
		$value= $this->get_transient_CHOSEN($name);
		if( !$value || time() - $value > $time_length )
		{
			$lic = $this->get_license();
			$res= $this->license_status($lic['key'], 'activate');
			$this->update_transient_CHOSEN($name, time() );
		}
	}

	public function admin_error_notice_pro(){ ?>
		<div class="notice notice-error is-dismissible">
			<p><?php  _e( sprintf('Notice: License for plugin <code><b>%s</b></code> is invalidated, so it\'s <b style="color:red;">PRO</b> functionality has been disabled.', $this->static_settings['Name']) );?> <a href="<?php echo $this->plugin_page_url;?>" target="_blank"><?php _e("Re-validate the key");?></a></p> 
		</div>
		<?php
	}

	public function pro_field($echo=true){
		if($this->unregistered_pro()){
			$res= 'data-pro-overlay="pro_overlay"';
			if($echo) echo $res;
			else return $res;
			//echo '<span class="pro_overlay overlay_lines"></span> ';
		}
	}

	public function purchase_pro_block(){
		if ( !$this->static_settings['has_pro_version'])  return;
		if ( $this->is_pro_legal  ) return;
		?>
		<div class="pro_block">
			<style>
			.get_pro_version { line-height: 1.2; z-index: 123; background: #ff1818;  text-align: center; border-radius: 100% 100% 0 0; display: inline-block;  position: fixed; bottom: 0px; right: 0; left: 0; padding: 10px 10px; max-width: 750px; margin: 0 auto; text-shadow: 0px 0px 6px white;  box-shadow: 0px 0px 52px black; }
			.get_pro_version .centered_div > span  { font-size: 1.5em; }
			.get_pro_version .centered_div .or_enter_key_phrase{ font-style: italic; font-size:1em; }
			.get_pro_version .centered_div > span  a { font-size: 1em; color: #7dff83;}
			.init_hidden{ display:none; }
			z#check_results{ display:inline; flex-direction:row; font-style:italic; }
			#check_results .correct{  background: #a8fba8;  }
			#check_results .incorrect{  background: pink;  }
			#check_results span{  padding:3px 5px;  }
			.myplugin .dialog_enter_key{ display:none; }
			.dialog_enter_key_content {  display: flex; flex-direction: column; align-items: center;  }
			.dialog_enter_key_content > *{  margin: 10px ;  }
			.myplugin .illegal_missing {font-size:12px; word-wrap:pre-wrap; }
			[data-pro-overlay=pro_overlay]{  pointer-events: none;  cursor: default;  position:relative;  min-height: 2em;  padding:5px; }
			[data-pro-overlay=pro_overlay]::before{   content:""; width: 100%; height: 100%; position: absolute; background: black; opacity: 0.3; z-index: 1;  top: 0;   left: 0;
				background: url("<?php echo $this->helpers->imageSvg('overlay-pro');?>");
			}
			[data-pro-overlay=pro_overlay]::after{ 
				white-space: pre; content: "<?php $str=__('Only available in FULL VERSION');  echo str_repeat($str.'\a\a\a\a\a\a\a\a\a\a\a\a\a\a\a\a\a\a\a', 4).$str;?>"; 
				text-shadow: 0px 0px 5px black; padding: 5px;  opacity:1;  text-align: center;  animation-name: blinking;  zzanimation-name: moving;  animation-duration: 6s;  animation-iteration-count: infinite;  overflow:hidden; display: flex; justify-content: center; align-items: center; position: absolute; top: 0; left: 0; bottom: 0; right: 0; z-index: 3; overflow: hidden; font-size: 2em; color: red;
			}
			@keyframes blinking { 0% {opacity: 0;} 50% {opacity: 1;} 100% {opacity: 0;} }
			@keyframes moving { 0% {left: 30%;} 40% {left: 100%;} 100% {left: 0%;} }
			</style>
			
			<div class="dialog_enter_key">
				<div class="dialog_enter_key_content" title="Enter the purchased license key">
					<input id="key_this" class="regular-text" type="text" value="<?php echo $this->get_license('key');?>"  />
					<button id="check_key" ><?php _e( 'Check key' );?></button>
					<span id="check_results">
						<span class="correct init_hidden"><?php _e( 'correct' );?></span>
						<span class="incorrect init_hidden"><?php _e( 'incorrect' );?></span>
					</span>
				</div>
			</div>

			<div class="get_pro_version">
				<div class="centered_div">
					<?php  $need_to_enter_key = false;

					if ( $this->is_pro ) { 
						if ( !$this->addon_exists() ) { ?>
							<span class="addon_missing">
							( <?php _e('Seems you have bought a PRO version, but the addon is not installed.');?> )
							</span>	
							<?php
						}
						elseif( !$this->is_pro_legal) {
							$need_to_enter_key=true;
							?>
							<span class="illegal_missing">
							( <?php _e('Seems you don\'t have a legal key');?>.  <span class="last_err_msg" style="white-space: pre-wrap;">( <?php _e( sprintf('Last error message: <code>%s</code> ',  $this->get_license('last_error') ) ); ?> )</span>  )
							</span>	
							<?php
						}
					} else {
						if (!$this->addon_exists()) {  ?>
							<span class="purchase_phrase">
								<a id="purchase_key" href="<?php echo esc_url($this->static_settings['purchase_url']);?>" target="_blank"><?php _e('GET FULL VERSION');?></a> <span class="price_amnt"><?php _e('only');?> <?php echo $this->static_settings['has_pro_version'];?>$</span>
							</span>
						<?php 
						}
						$need_to_enter_key=true;
					} 
					?>
					<?php
					
					if ($need_to_enter_key) { ?>
						<span class="or_enter_key_phrase">
						( <?php _e('After purchase');?> <a id="enter_key"  href=""><?php _e('Enter License Key');?></a> )
						</span>	
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		$this->plugin_scripts();
	}

	public function plugin_scripts(){ ?>
		<script>
		function main_tt()
		{ 
			var this_action_name = '<?php echo $this->plugin_slug_u;?>';

			(function ( $ ) {
				$(function () {
					//$("#purchase").on("click", function(e){ this_name_tt.open_license_dialog(); } );
					$("#enter_key").on("click", function(e){ return this_name_tt.enter_key_popup(); } );
					$("#check_key").off().on("click", function(e){ return this_name_tt.check_key(); } );
				});
			})( jQuery );

			// Create our namespace
			this_name_tt = {
 				//Method to check (using AJAX, which calls WP back-end) if inputed username is available
				enter_key_popup: function(e) {
					// Show jQuery dialog
					jQuery('.dialog_enter_key_content').dialog({
						modal: true,
						width: 500,
						close: function (event, ui) {
							//jQuery(this).remove();	// Remove it completely on close
						}
					});
					return false;
				},

				IsJsonString: function(str) {
					try { JSON.parse(str); } catch (e) { return false; }
					return true;
				},

				check_key : function(e) {
					var this1 = this;
					var inp_value = jQuery("#key_this").val();
					if (inp_value == ""){  return;  }
					PuvoxLibrary.backend_call(
						{
							'PRO_check_key': inp_value
						},

						// Function when request complete
						function (answer) {
							if(typeof window.ttdebug != "undefined"){  console.log(answer);  }
							if(this1.IsJsonString(answer)){
								var new_res=  JSON.parse(answer);
								if(new_res.hasOwnProperty('valid')){
									if(new_res.valid){
										this1.show_green();
									}
									else{
										var reponse1 = JSON.parse(new_res.response);
										this1.show_red(reponse1.message);
									}
								}
								else {
									this1.show_red(new_res);
								}
							}
							else{
								this1.show_red(answer);
							}
						}
					);
				},

				show_green : function(){
					jQuery("#check_results .correct").show();
					jQuery("#check_results .incorrect").hide();
					alert("<?php _e("Thanks! License is activated for this domain."); echo '\n\n\n\n'; _e("NOTE: Sharing or unauthorized use of the license will be ended with the suspension of the license code.") ;?>");
					PuvoxLibrary.reload_this_page();
					//this.save_results();
				},

				show_red : function(e){
					jQuery("#check_results .correct").hide();
					jQuery("#check_results .incorrect").show();
					jQuery("#check_results .incorrect").html(e);

					// Show jQuery dialog
					if (false)
					jQuery('<div>' + message + '</div>').dialog({ modal: true, width: 500,
						close: function (event, ui) {
							jQuery(this).remove();	// Remove it completely on close
						}
					});
				}

			};
		}
		main_tt();
		</script>
		<?php
	}
	  
  } // class
  #endregion  ---------------  [ PRO-parts ] --------------- #


} // #NAMESPACE
// ===================================================================
// ======================      ### WP codes     ======================
// ===================================================================
