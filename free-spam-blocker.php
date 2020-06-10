<?php
/**
Plugin Name:       Free Spam Blocker
Plugin URI:        https://gavamedia.com
Description:       Simple and free spam blocking
Version:           1.0.0
Requires at least: 5.2
Requires PHP:      7.0
Author:            GAVAMEDIA
Author URI:        https://gavamedia.com
License:           GPL v2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       free-spam-blocker
 
Free Spam Blocker is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Free Spam Blocker is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Free Spam Blocker.

*/




add_action('plugins_loaded', 'fsb_plugins_loaded', 30);

function fsb_plugins_loaded() {
	require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'initialize.php';
}




// https://developer.wordpress.org/plugins/intro/
defined('ABSPATH') or die('No script kiddies please!');
define('WP_DEBUG', true);



define('FSB_INVISIBLE_CHAR', ' ‌');
define('FSB_REPLY_TO_HEADER', 'Reply-To: ');

define('FSB_JS_FILE_PATH', plugin_dir_path( __FILE__ ) . 'free-spam-blocker.js');
define('FSB_JS_URL', plugins_url('free-spam-blocker.js', __FILE__));





// Cache based on date modified
$fsb_js_ver = date('Ymd-Gis', filemtime(FSB_JS_FILE_PATH));
wp_enqueue_script('fsb_js', FSB_JS_URL, array(), $fsb_js_ver);





function fsb_str_contains($haystack, $needle) {
	return strpos($haystack, $needle) !== false;
}




function fsb_mail_filter($args) {
	$subject = $args['subject'];
	
	
	// Only check for spam emails that contain "reply-to"
	if (fsb_str_contains($args['headers'], FSB_REPLY_TO_HEADER)) {
				
		$subject = 'New message from your Gavamedia website';
		
		// No invisible char used - should have been set by JavaScript
		if (!fsb_str_contains($args['message'], FSB_INVISIBLE_CHAR))
			$subject = 'Possible spam from your website';
		
	}
		
	$new_wp_mail = array(
		'to'          => $args['to'],
		'subject'     => $subject,
		'message'     => $args['message'],
		'headers'     => $args['headers'],
		'attachments' => $args['attachments']
	);

	return $new_wp_mail;
}

add_filter('wp_mail', 'fsb_mail_filter');
