<?php
/**
Plugin Name: Address Autocomplete Using Google Place API
Plugin URI: 
Description: This plugin allows you to enable google place address autocompletion on any text field  by using it's name, id or class attribute value in admin backend setting.
Version: 1.0.0
Author: Webnware
Author URI: 
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/*

*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'GAAF_VERSION', '1.0.0' );
define( 'GAAF__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GAAF__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

add_action( 'wp_enqueue_scripts', 'gaaf_google_enqueue_scripts' );
function gaaf_google_enqueue_scripts() {
	$google_api_key = get_option('gaaf_field_api_key');
	wp_enqueue_script('gaaf-custom',GAAF__PLUGIN_URL.'/js/custom.js',array('jquery-core','jquery'),'',true);
	wp_enqueue_script('google-maps','https://maps.googleapis.com/maps/api/js?key='.(!empty($google_api_key) ? $google_api_key : 'AIzaSyB16sGmIekuGIvYOfNoW9T44377IU2d2Es').'&libraries=places',array('jquery-core','jquery','gaaf-custom'),'',true);
		
}
add_action('wp_head','gaaf_set_google_autocomplete');
function gaaf_set_google_autocomplete(){
	
	$search_fields = array();
	$gaaf_names = get_option('gaaf_field_name');
	if(!empty($gaaf_names)){
		$check_hash = explode(',', $gaaf_names);
		foreach($check_hash as $key){
			if(!empty($key)){
				$search_fields[] = ' [name="'.trim($key).'"]';
			}
		}
	}
	$gaaf_ids = get_option('gaaf_field_id'); 
	if(!empty($gaaf_ids)){
		$check_hash = explode(',', $gaaf_ids);
		foreach($check_hash as $key){
			if(!empty($key)){
				$findhash = '#';
				if(strpos($key, $findhash) === false){
					$search_fields[] = ' #'.trim($key);
				}else{
					$search_fields[] = trim($key);
				}
			}
		}
	}
	$gaaf_class = get_option('gaaf_field_class');
	if(!empty($gaaf_class)){
		$check_dot = explode(',', $gaaf_class);
		foreach($check_dot as $key){
			if(!empty($key)){
				$finddot = '.';
				if(strpos($key, $finddot) === false){
					$search_fields[] = ' .'.trim($key);
				}else{
					$search_fields[] = trim($key);
				}
			}
		}
	}
	if(count($search_fields) == 0){
		$search_fields[] =' .google_autocomplete';
	}
	
	

?>

	<script>
	var gaaf_fields = '<?php echo implode(',' , $search_fields);?>';
	</script>
<?php }
if(is_admin()){
	include_once('admin_settings.php');
}
