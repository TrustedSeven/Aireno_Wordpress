<?php

function gaaf_google_autocomplete_tab() {
    add_submenu_page(
        'options-general.php',
        'Google Address Autocomplete',
		'Google Autocomplete',
        'manage_options',
        'google_autocomplete',
		'gaaf_google_autocomplete_settings_tab'
	);
		
}
add_action( 'admin_menu', 'gaaf_google_autocomplete_tab' );
	
function gaaf_google_autocomplete_settings_tab(){
	
	if(isset($_POST['gaaf_google_autocomplete_setting'])){
		update_option('gaaf_field_name',esc_attr(str_replace(' ','',$_POST['gaaf_field_name'])));
		update_option('gaaf_field_id',esc_attr(str_replace(' ','',$_POST['gaaf_field_id'])));
		update_option('gaaf_field_class',esc_attr(str_replace(' ','',$_POST['gaaf_field_class'])));
		update_option('gaaf_field_api_key',esc_attr(str_replace(' ','',$_POST['gaaf_field_api_key'])));
	}
?>
	

    <div>
    	<h3>Google Address Autocomplete Settings</h3>
    	<form method="post">
            <table>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
            		<td><strong>Google Place Api Key</strong></td>
            	</tr>
            	<tr>  
            		<td><div id="titlediv">
            				<div id="titlewrap"><input type="text" class="large-text code" name="gaaf_field_api_key" id="google_api_key" value="<?php echo get_option('gaaf_field_api_key');?>"/><br>
           					</div>
						</div>
                    </td>
            	</tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
	                <td><strong>Name</strong></td>
                </tr>
                <tr>  
                	<td><div id="titlediv">
                            <div id="titlewrap">
                                <textarea name="gaaf_field_name" class="large-text code" id="google_autocomplete_name" ><?php echo stripslashes(get_option('gaaf_field_name'));?></textarea><br>
                                <b>Note:</b> Pick the name of textbox from markup &lt;input type="text" name="field1" /> and enter them in above field as comma separated. e.g. field1, field2 etc.
                            </div>
                        </div>
                	</td>
                </tr>
            	<tr>
            		<td>&nbsp;</td>
            	</tr>
            	<tr>
            		<td><strong>Class</strong></td>
            	</tr>
            	<tr>  
                    <td><div id="titlediv">
                            <div id="titlewrap">
                                <textarea name="gaaf_field_class" class="large-text code" id="google_autocomplete_class" ><?php echo stripslashes(get_option('gaaf_field_class'));?></textarea><br>
                                <b>Note:</b> Pick the class of textbox from markup &lt;input type="text" class="field1" /> and enter them in above field as comma separated. e.g. field1, field2 etc.
                            </div>
                        </div>
                    </td>
				</tr>
	            <tr>
    		        <td>&nbsp;</td>
            	</tr>
	            <tr>
    		        <td><strong>ID</strong></td>
            	</tr>
            	<tr>  
            		<td><div id="titlediv">
            				<div id="titlewrap">
                            	<textarea name="gaaf_field_id" class="large-text code" id="google_autocomplete_id"><?php echo stripslashes(get_option('gaaf_field_id'));?></textarea><br>
            					<b>Note:</b> Pick the id of textbox from markup &lt;input type="text" id="field1" /> and enter them in above field as comma separated. e.g. field1, field2 etc.
            				</div>
						</div>
            		</td>
				</tr>
	            <tr>
    		        <td>&nbsp;</td>
            	</tr>
            	<tr>
            		<td><input class="button button-primary button-large" type="submit" name="gaaf_google_autocomplete_setting" value="Save"/> </td>
            	</tr>
            </table>
    	</form>
    </div>

<?php
}
?>