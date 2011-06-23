<?php
/**
 * @package MimeTypeLinkImages
 * @version 1.0.7
 */
/*
Plugin Name: Mime Type Link Images
Plugin URI: http://blog.eagerterrier.co.uk/2010/10/holy-cow-ive-gone-and-made-a-mime-type-wordpress-plugin/
Description: This will add file type icons next to links automatically
Author: Toby Cox
Version: 1.0.7
Author URI: http://eagerterrier.co.uk
*/


// constants
define('mtli_version', '1.0.8', true);

$mtli_options = get_option('mimetype_link_icon_options'); 

global $mtli_available_sizes;
global $mtli_available_image_types;
global $mtli_available_mime_types;
global $add_attachment_style;
global $mtli_css;

$mtli_available_sizes = array(24,48, 64,128);
$mtli_available_image_types = array('gif', 'png');
$mtli_available_mime_types = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'zip', 'ppt', 'pptx', 'dwg', 'dwf', 'skp', 'jpg');


function mtli_set_option($option_name, $option_value) {
	// first get the existing options in the database
	$mtli_options = get_option('mimetype_link_icon_options');
	// set the value
	$mtli_options[$option_name] = $option_value;
	// write the new options to the database
	update_option('mimetype_link_icon_options', $mtli_options);
}


// get an Ultimate GA option from the WordPress options database table
// if the option does not exist (yet), the default value is returned
function mtli_get_option($option_name) {

  // get options from the database
  $mtli_options = get_option('mimetype_link_icon_options'); 

  
  if (!$mtli_options || !array_key_exists($option_name, $mtli_options)) {
    // no options in database yet, or not this specific option 
    // create default options array

    $mtli_default_options=array();
    $mtli_default_options['internal_domains']  = $_SERVER['SERVER_NAME'];
    if (preg_match('@www\.(.*)@i', $mtli_default_options['internal_domains'], $parts)>=1) {
      $mtli_default_options['internal_domains'] .= ','.$parts[1];
    }
    $mtli_default_options['image_size']             = '48';  
    $mtli_default_options['image_type']     	    = 'gif'; 
    $mtli_default_options['show_file_size']         = false;
    $mtli_default_options['enable_pdf']     	    = true; 
    $mtli_default_options['enable_doc']     	    = false; 
    $mtli_default_options['enable_docx']     	    = false; 
    $mtli_default_options['enable_xls']     	    = false; 
    $mtli_default_options['enable_xlsx']     	    = false; 
    $mtli_default_options['enable_csv']     	    = false;  
    $mtli_default_options['enable_zip']     	    = false;  
    $mtli_default_options['enable_ppt']     	    = false;  
    $mtli_default_options['enable_pptx']     	    = false;  
    $mtli_default_options['enable_dwg']     	    = false;  
    $mtli_default_options['enable_dwf']     	    = false;  
    $mtli_default_options['enable_skp']     	    = false;  
    $mtli_default_options['enable_jpg']     	    = false;  
    $mtli_default_options['enable_async']     	    = false;  

    // add default options to the database (if options already exist, 
    // add_option does nothing
    add_option('mimetype_link_icon_options', $mtli_default_options, 
               'Settings for MimeType Link Icon plugin');

    // return default option if option is not in the array in the database
    // this can happen if a new option was added to the array in an upgrade
    // and the options haven't been changed/saved to the database yet
    $result = $mtli_default_options[$option_name];

  } else {
    // option found in database
    $result = $mtli_options[$option_name];
  }
  

  return $result;
}

function mtli_admin() {

  if (function_exists('add_options_page')) {

    add_options_page('MimeType Link Icons' /* page title */, 
                     'MimeType Icons' /* menu title */, 
                     8 /* min. user level */, 
                     basename(__FILE__) /* php file */ , 
                     'mtli_options' /* function for subpanel */);
  }

}

function mtli_get_wp_path(){
	if ( version_compare( get_bloginfo( 'version' ) , '3.0' , '<' ) && is_ssl() ) {
		 $wp_content_url = str_replace( 'http://' , 'https://' , get_option( 'siteurl' ) );
	} else {
		 $wp_content_url = get_option( 'siteurl' );
	}
	$wp_content_url .= '/wp-content';
	return $wp_content_url;
}

function mtli_options() {
	global $mtli_available_sizes;
	global $mtli_available_image_types;
	global $mtli_available_mime_types;
  
	if (isset($_POST['info_update'])) {

		?><div class="updated"><p><strong><?php 
		
		// process submitted form
		$mtli_options = get_option('mimetype_link_icon_options');
		$mtli_options['image_size']		= $_POST['image_size'];
		$mtli_options['image_type']		= $_POST['image_type'];
		$mtli_options['show_file_size']	= ($_POST['show_file_size']=="true"	? true : false);
		$mtli_options['enable_pdf']		= ($_POST['enable_pdf']=="true"		? true : false);
		$mtli_options['enable_doc']		= ($_POST['enable_doc']=="true"		? true : false);
		$mtli_options['enable_docx']	= ($_POST['enable_docx']=="true"	? true : false);
		$mtli_options['enable_xls']		= ($_POST['enable_xls']=="true"		? true : false);
		$mtli_options['enable_xlsx']	= ($_POST['enable_xlsx']=="true"	? true : false);
		$mtli_options['enable_csv']		= ($_POST['enable_csv']=="true"		? true : false);
		$mtli_options['enable_zip']		= ($_POST['enable_zip']=="true"		? true : false);
		$mtli_options['enable_ppt']		= ($_POST['enable_ppt']=="true"		? true : false);
		$mtli_options['enable_pptx']	= ($_POST['enable_pptx']=="true"	? true : false);
		$mtli_options['enable_dwg']		= ($_POST['enable_dwg']=="true"		? true : false);
		$mtli_options['enable_dwf']		= ($_POST['enable_dwf']=="true"		? true : false);
		$mtli_options['enable_skp']		= ($_POST['enable_skp']=="true"		? true : false);
		$mtli_options['enable_jpg']		= ($_POST['enable_jpg']=="true"		? true : false);
		$mtli_options['enable_async']	= ($_POST['enable_async']=="true"	? true : false);
		update_option('mimetype_link_icon_options', $mtli_options);

		_e('Options saved', 'mtli')
		?></strong></p></div><?php
	} 
	?>
	<div class="wrap">
		<form method="post">
			<h2>MimeTypes Link Icons</h2> 
				
			<div class="whitebg">
			<fieldset class="options" name="general">
				<legend><?php _e('General settings', 'mtli') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<tr>
						<th nowrap valign="top" width="33%">
							<?php _e('Image Size', 'mtli') ?>
						</th>
						<td>
							<select name="image_size" id="image_size"> 
								<? foreach($mtli_available_sizes as $k=> $v){ ?>
									<option value="<?php echo $v; ?>" <?php if(mtli_get_option('image_size')==$v) echo ' selected'; ?>><?php echo $v."x".$v; ?></option>
								<? } ?>
							</select>
							<br />
						</td>
					</tr>
					<tr>
						<th nowrap valign="top" width="33%">
							<?php _e('Image Type', 'mtli') ?>
						</th>
						<td>
							<select name="image_type" id="image_type"> 
								<? foreach($mtli_available_image_types as $k=>$v){ ?>
									<option value="<?php echo $v;?>" <?php if($v==mtli_get_option('image_type')) echo ' selected';?>><?php echo $v;?></option>
								<? } ?>
							</select>
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset class="options" name="general">
				<legend><?php _e('Image settings', 'mtli') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<? foreach($mtli_available_mime_types as $k=>$mime_type){ ?> 
					<tr>
						<th nowrap valign="top" width="33%">
							<?php _e('Add images to '.$mime_type.' uploads', 'mtli') ?>
						</th>
						<td>
							<input type="checkbox" name="enable_<?php echo $mime_type;?>" id="enable_<?php echo $mime_type;?>" value="true" <?php if (mtli_get_option('enable_'.$mime_type)) echo "checked"; ?> /> 
							<br />
						</td>
					</tr>
					<? } ?>
				</table>
			</fieldset>
			<fieldset class="options" name="general">
				<legend><?php _e('Show file size of attachment?', 'mtli') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<tr>
						<td>If you want to have the file size of the attachment written in brackets next to the file size, tick this box</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="show_file_size" id="show_file_size" value="true" <?php if (mtli_get_option('show_file_size')) echo "checked"; ?> /> </td>
					</tr>
				</table>
			</fieldset>
			<fieldset class="options" name="general">
				<legend><?php _e('Enable Asynchronous Replacement?', 'mtli') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<tr>
						<td>Some themes or plugins may conflict with this plugin. If you find you are having trouble, you can switch on asynchronous replacement, which uses JavaScript rather than PHP to find your PHP links.</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="enable_async" id="enable_async" value="true" <?php if (mtli_get_option('enable_async')) echo "checked"; ?> /> </td>
					</tr>
				</table>
			</fieldset>
			<div class="submit">
				<input type="submit" name="info_update" value="<?php _e('Update options', 'mtli') ?>" /> 
			</div>
			</div>
		</form>
	</div>
<?php

}


// Hook function for init action to do some initialization
function mtli_init() {
	// load texts for localization
	load_plugin_textdomain('mtli');
}


// This just echoes the chosen line, we'll position it later
function mimetype_to_icon($content) {
	global $mtli_available_sizes;
	global $mtli_available_image_types;
	global $mtli_available_mime_types;
	global $add_attachment_style;
	global $mtli_css;
	if ( ! function_exists( 'is_ssl' ) ) {
		function is_ssl() {
			if ( isset($_SERVER['HTTPS']) ) {
				if ( 'on' == strtolower($_SERVER['HTTPS']) )
					return true;
				if ( '1' == $_SERVER['HTTPS'] )
					return true;
			} elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
				return true;
			}
			return false;
		}
	}
	
	$wp_content_url = mtli_get_wp_path();
	
	$mtli_css = '';
	foreach($mtli_available_mime_types as $k=>$mime_type){
		if(mtli_get_option('enable_'.$mime_type)){
			//if($content = preg_replace('/href="([^"]+\.pdf)"/','href="\1"  class="mtli_attachment mtli_'.$mime_type.'"',$content, -1, $howmany))
			if(mtli_get_option('show_file_size')===true){
				$extrabit = ' getfilesize';
			} else {
				$extrabit = '';
			}
			if(strpos($content, '.'.$mime_type.'"')!==false){
				$howmany=0;
				$content = preg_replace('/href="([^"#]+\.'.$mime_type.')#?[^" ]*"/','href="\\1"  class="mtli_attachment mtli_'.$mime_type.'"',$content, -1, $howmany);
				if($howmany>0){
					$add_attachment_style = true;
					$mtli_css .= '.mtli_'.$mime_type.' { background-image: url('.$wp_content_url.'/plugins/mimetypes-link-icons/images/'.$mime_type.'-icon-'.mtli_get_option('image_size').'x'.mtli_get_option('image_size').'.'.mtli_get_option('image_type').'); }';
				}
			} elseif(strpos($content, '.'.$mime_type.'\'')!==false){
				$howmany=0;
				$content = preg_replace("/href='([^'#]+\.".$mime_type.")#?[^' ]*'/","href='\\1'  class='mtli_attachment mtli_".$mime_type."'",$content, -1, $howmany);
				if($howmany>0){
					$add_attachment_style = true;
					$mtli_css .= '.mtli_'.$mime_type.' { background-image: url('.$wp_content_url.'/plugins/mimetypes-link-icons/images/'.$mime_type.'-icon-'.mtli_get_option('image_size').'x'.mtli_get_option('image_size').'.'.mtli_get_option('image_type').'); }';
				}
			}
		}
		
	}
	
	return $content;
}

function mtli_get_size($filePath){
	if(!$filePath){
		return false;
	}
	$internal_domains = mtli_get_option('internal_domains');
	
	$fileSize = filesize();
	return $fileSize;
}

// Now we set that function up to execute when the the_content action is called

//add_action('load_template', 'mimetype_to_icon');


function mtli_add_jquery(){
	wp_enqueue_script('jquery');
}

function mtli_display_css($content){
	global $mtli_available_mime_types;
	global $add_attachment_style;
	$mtli_css = "<style type='text/css'> .mtli_attachment {  display:inline-block;  height:".mtli_get_option('image_size')."px;  background-position: top left; background-attachment: scroll; background-repeat: no-repeat; padding-left: ".(mtli_get_option('image_size')*1.2)."px; }";
	$wp_content_url = mtli_get_wp_path();
	foreach($mtli_available_mime_types as $k=>$mime_type){ 
		if(mtli_get_option('enable_'.$mime_type)){
			$mtli_css .= '.mtli_'.$mime_type.' { background-image: url('.$wp_content_url.'/plugins/mimetypes-link-icons/images/'.$mime_type.'-icon-'.mtli_get_option('image_size').'x'.mtli_get_option('image_size').'.'.mtli_get_option('image_type').'); }';
		}
	}
	$mtli_css.="</style>";
	if($add_attachment_style===true || mtli_get_option('enable_async')){
		return $content.$mtli_css;
	} else {
		return $content;
	}
}

function mtli_add_async_replace($content){
	$wp_content_url = mtli_get_wp_path();
	$mtli_js_array = 'var mtli_js_array = new Array(';
	global $mtli_available_mime_types;
	foreach($mtli_available_mime_types as $k=>$mime_type){ 
		if(mtli_get_option('enable_'.$mime_type)){
			$mtli_js_array .= "'".$mime_type."',";
		}
	}
	$mtli_js_array = substr($mtli_js_array,0,-1).');';
	echo '<script type="text/javascript">'.$mtli_js_array.'</script>';
	echo '<script type="text/javascript" src="'.$wp_content_url.'/plugins/mimetypes-link-icons/js/mtli_str_replace.js"></script>';
}

add_action('the_content', 'mtli_display_css');

if(mtli_get_option('enable_async')){
	add_action('get_header', 'mtli_add_jquery');
	add_action('get_footer', 'mtli_add_async_replace');
} else {
	add_action('the_content', 'mimetype_to_icon');
}

// Adding Admin CSS
function mtli_admin_css() {
	echo "
	<style type='text/css'>
	.form-table				{ margin-bottom: 0 !important; }
	.form-table th			{ font-size: 11px; min-width: 200px; }
	.form-table .largetext	{ font-size: 12px; }
	.form-table td			{ max-width: 500px; }
	.form-table tr:last-child	{ border-bottom: 1px solid #DEDEDE; }
	.form-table tr:last-child td { padding-bottom: 20px; }
	.form-table select		{ width: 275px; }
	</style>
	";
}

add_action('admin_head', 'mtli_admin_css');






// **************
// initialization




// assume both header and footer are not hooked
global $mtli_header_hooked;
global $mtli_footer_hooked;
$mtli_header_hooked=false;
$mtli_footer_hooked=false;

// add UGA Options page to the Option menu
add_action('admin_menu', 'mtli_admin');


add_action('init', 'mtli_init');



?>
