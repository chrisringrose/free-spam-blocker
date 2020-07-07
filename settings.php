<?php
/**
Author:            Chris Ringrose
Author URI:        https://chrisringrose.com
License:           GPL v3 or later
License URI:       https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:       free-spam-blocker
 
Add custom settings to WordPress.

*/


function fsb_settings_init() {
    // register a new setting for "reading" page
    register_setting('reading', 'fsb_setting_name');
 
    // register a new section in the "reading" page
    add_settings_section(
        'fsb_settings_section',
        'FSB Settings Section',
        'fsb_settings_section_cb',
        'reading'
    );
 
    // register a new field in the "fsb_settings_section" section, inside the "reading" page
    add_settings_field(
        'fsb_settings_field',
        'FSB Setting',
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
    echo '<p>Free Spam Blocking Section Introduction.</p>';
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