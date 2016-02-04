<?php
/*
Plugin Name: Custom Options Plus
Plugin URI: https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus
Description: The easiest way to add your custom variables as a Settings Page for your Theme. Even with no expertise in PHP.
You can for example, register the address and phone numbers of your company to leave in the header of your site. So, if someday relocate, you do not need to change your theme. Just change administratively.
You can also enter the login of your social networks. How to login twitter, Facebook, Youtube, contact email and more.
Version: 1.6
Author: Leo Caseiro
Author URI: http://leocaseiro.com.br/
*/

/*  Copyright 2011-2014 Leo Caseiro (http://leocaseiro.com.br/)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


define( 'COP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'COP_PLUGIN_NAME', trim( dirname( COP_PLUGIN_BASENAME ), '/' ) );
define( 'COP_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . COP_PLUGIN_NAME );
define( 'COP_PLUGIN_URL', WP_PLUGIN_URL . '/' . COP_PLUGIN_NAME );

//Added on 1.5
define( 'COP_OPTIONS_PREFIX', 'cop_' );
define( 'COP_PLUGIN_VERSION', '1.5' );

global $wpdb, $COP_TABLE;
define( 'COP_TABLE',  $wpdb->prefix . 'custom_options_plus' );

//Added on 1.5 as GLOBAL
$COP_TABLE = COP_TABLE;

//Create a table in MySQL database when activate plugin
function cop_setup() {
	global $wpdb, $COP_TABLE;

	$sql = "CREATE TABLE IF NOT EXISTS $COP_TABLE (
		  `id` int(5) NOT NULL AUTO_INCREMENT,
		  `label` varchar(100) NOT NULL,
		  `name` varchar(80) NOT NULL,
		  `value` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);


    update_option(COP_OPTIONS_PREFIX . 'version', COP_PLUGIN_VERSION);
}

register_activation_hook( __FILE__, 'cop_setup' );


//Create a Menu Custom Options Plus in Settings
add_action('admin_menu', 'cop_add_menu');
function cop_add_menu() {

 	global $my_plugin_hook;
 	$my_plugin_hook = add_options_page('Custom Options Plus', 'Custom Options Plus', 'manage_options', 'custom_options_plus', 'custom_options_plus_adm');

}

function cop_load_js_and_css() {
	wp_register_script( 'functions.js', COP_PLUGIN_DIR . 'functions.js', array('jquery'), COP_PLUGIN_VERSION );
	wp_register_script( 'jquery.stringToSlug.min.js', COP_PLUGIN_DIR . 'jquery.stringToSlug.min.js', array('jquery'), COP_PLUGIN_VERSION );
}


function cop_insert() {
	global $wpdb;

	$_POST['label'] = stripslashes_deep(filter_var($_POST['label'], FILTER_SANITIZE_SPECIAL_CHARS));
	$_POST['name'] 	= stripslashes_deep(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
	$_POST['value'] = stripslashes_deep(filter_var($_POST['value'], FILTER_UNSAFE_RAW));

	return $wpdb->insert(
		COP_TABLE,
		array(
			'label' => $_POST['label'],
			'name' => $_POST['name'],
			'value' => stripslashes($_POST['value'])
		),
		array('%s','%s','%s')
	);
}

function cop_update() {
	global $wpdb;

	$_POST['id'] 	= filter_var($_POST['id'], FILTER_VALIDATE_INT);
	$_POST['label'] = stripslashes_deep(filter_var($_POST['label'], FILTER_SANITIZE_SPECIAL_CHARS));
	$_POST['name'] 	= stripslashes_deep(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
	$_POST['value'] = stripslashes_deep(filter_var($_POST['value'], FILTER_UNSAFE_RAW));


	return $wpdb->update(
		COP_TABLE,
		array(
			'label' => $_POST['label'],
			'name' 	=> $_POST['name'],
			'value' => stripslashes($_POST['value'])
		),
		array ('id' => $_POST['id']),
		array('%s','%s','%s'),
		array('%d')
	);

}

function cop_delete( $id ) {
	global $wpdb, $COP_TABLE;
	return $wpdb->query($wpdb->prepare("DELETE FROM $COP_TABLE WHERE id = %d ", $id) );
}

function cop_get_options() {
	global $wpdb, $COP_TABLE;
	return $wpdb->get_results("SELECT id, label, name, value FROM $COP_TABLE ORDER BY label ASC");
}

function cop_get_option( $id ) {
	global $wpdb, $COP_TABLE;
	return $wpdb->get_row($wpdb->prepare("SELECT id, label, name, value FROM $COP_TABLE WHERE id = %d",  $id ));
}





//Panel Admin
function custom_options_plus_adm() {
	global $wpdb, $my_plugin_hook;

	wp_enqueue_script( 'stringToSlug', COP_PLUGIN_URL . '/js/jquery.stringToSlug.min.js', array('jquery'), '2.5.9' );
	wp_enqueue_script( 'copFunctions', COP_PLUGIN_URL . '/js/functions.js', array('stringToSlug') );


	$id 	= '';
	$label 	= '';
	$name 	= '';
	$value 	= '';

	$message = '';

	if ( isset($_GET['del']) && $_GET['del'] > 0 ) :
		if ( cop_delete( $_GET['del'] ) ) :
			$message = '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		endif;


	elseif ( isset($_POST['id']) ) :

		if ($_POST['id'] == '') :
			cop_insert();
			$message = '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';

		elseif ($_POST['id'] > 0) :
			cop_update();
			$message = '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';

		endif;


	elseif ( isset($_GET['id']) && $_GET['id'] > 0 ) :

		$option = cop_get_option( $_GET['id'] );

		$id 	= $option->id;
		$label 	= $option->label;
		$name 	= $option->name;
		$value 	= $option->value;

	endif;

	$options = cop_get_options();
?>

	<div class="wrap">
		<div id="icon-tools" class="icon32"></div><h2>Custom Options Plus <a href="<?php echo preg_replace('/\\&.*/', '', $_SERVER['REQUEST_URI']); ?>#new-custom-option" class="add-new-h2">Add New</a></h2>

		<?php echo $message; ?>
		<br />
		<?php if ( count($options) > 0 ) : ?>
			<div class="wpbody-content">
				<table class="wp-list-table widefat" cellspacing="0">
					<thead>
						<tr>
							<th scope="col" class="manage-column " style="min-width: 100px">Label</th>
							<th scope="col" class="manage-column column-title">Name</th>
							<th scope="col" class="manage-column column-title">Value</th>
						</tr>
					</thead>
                    <tfoot>
						<tr>
							<th scope="col" class="manage-column column-title">Label</th>
							<th scope="col" class="manage-column column-title">Name</th>
							<th scope="col" class="manage-column column-title">Value</th>
						</tr>
					</tfoot>
					<tbody id="the-list">
						<?php $trclass = 'class="alternate"';
						foreach ($options as $option ) :
						?>
						<tr <?php echo $trclass; ?> rowspan="2">
							<td>
                            	<?php echo $option->label; ?>
                                <div class="row-actions">
                                	<span class="edit"><a href="<?php echo preg_replace('/\\&.*/', '', $_SERVER['REQUEST_URI']); ?>&amp;id=<?php echo $option->id; ?>#new-custom-option">Edit</a> | </span>
                                    <span class="delete"><a onclick="return confirm('Are you sure want to delete item?')" class="submitdelete" title="Delete <?php echo $option->label; ?>" href="<?php echo preg_replace('/\\&.*/', '', $_SERVER['REQUEST_URI']); ?>&del=<?php echo $option->id; ?>">Delete</a></span>
                                </div>
                            </td>
                            <td>
                            	<textarea style="font-size:12px;" type="text" onclick="this.select();" onfocus="this.select();" readonly="readonly" class="shortcode-in-list-table wp-ui-text-highlight code"><?php echo $option->name; ?></textarea>
                            </td>
							<td><div style="overflow:auto; min-height:99%; width:99%; margin:2px; padding:2px; background-color:#eee; clear:both;"><?php echo $option->value; ?></div></td>
						</tr>
						<?php
						$trclass = $trclass == 'class="alternate"' ? '' : 'class="alternate"';
						endforeach; ?>
					</tbody>
				</table>
			</div>
		<br />
		<?php endif; ?>

		<form method="post" action="<?php echo preg_replace('/\\&.*/', '', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<h3 id="new-custom-option">Add new Custom Option</h3>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="label">Label:</label>
						</td>
						<td>
							<input name="label" required="required" type="text" id="label" value="<?php echo $label; ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="name">*Name:</label>
						</td>
						<td>
							<input name="name" required="required" type="text" id="name" value="<?php echo $name; ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="value">Value:</label>
						</td>
						<td>
							<textarea required="required" name="value" rows="7" cols="40" type="text" id="value" class="regular-text code"><?php echo $value; ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes'); ?>"></p>
		</form>

	</div>
<?php
}



//get your single option
function get_custom( $name ) {
	global $wpdb, $COP_TABLE;

	if ( '' != $name ) :
		return $wpdb->get_var( $wpdb->prepare( "SELECT value FROM $COP_TABLE WHERE name = %s LIMIT 1", $name ) );
	else :
		return false;
	endif;
}

//get your array options
function get_customs( $name ) {
	global $wpdb, $COP_TABLE;
	if ( '' != $name ) :
		$list = $wpdb->get_results( $wpdb->prepare( "SELECT value FROM $COP_TABLE WHERE name = %s ", $name ) , ARRAY_A);
		$array = array();
		foreach ( $list as $key => $name ) :
			$array[] = $name['value'];
		endforeach;
		return $array;
	else :
		return false;
	endif;
}


//Tutorial on Help Button
function cop_plugin_help($contextual_help, $screen_id, $screen) {

	global $my_plugin_hook;
	if ($screen_id == $my_plugin_hook) {

		$contextual_help = '<br>Use <br /><em>' . htmlentities('<?php echo get_custom(\'name\') ; ?>') . '</em><br /><br /> or <br><em>' . htmlentities('<?php foreach ( get_customs(\'name\') as $name ) : ') . '<br />    echo $name; <br /> ' . htmlentities('endforeach; ?>') . '</em> <br /> in your theme.';
	}
	return $contextual_help;
}

add_filter('contextual_help', 'cop_plugin_help', 10, 3);
