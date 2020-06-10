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


function fsb_settings_init() {
    // register a new setting for "reading" page
    register_setting('reading', 'fsb_setting_name');
 
    // register a new section in the "reading" page
    add_settings_section(
        'fsb_settings_section',
        'WPOrg Settings Section',
        'fsb_settings_section_cb',
        'reading'
    );
 
    // register a new field in the "fsb_settings_section" section, inside the "reading" page
    add_settings_field(
        'fsb_settings_field',
        'WPOrg Setting',
        'fsb_settings_field_cb',
        'reading',
        'fsb_settings_section'
    );
}
 
/**
 * register fsb_settings_init to the admin_init action hook
 */
add_action('admin_init', 'fsb_settings_init');



/**
 * callback functions
 */
 
// section content cb
function fsb_settings_section_cb() {
    echo '<p>WPOrg Section Introduction.</p>';
}
 
// field content cb
function fsb_settings_field_cb() {
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('fsb_setting_name');
    // output the field
    ?>
    <input type="text" name="fsb_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}