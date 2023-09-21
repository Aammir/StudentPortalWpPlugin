<?php
/*
Plugin Name: Student Portal
Description: Just a simple Student Portal.
Version: 1.0
Author: Aammir Hussain
Version Date: 19 September, 2023
*/

// Define plugin constants
define('SP_DIR', plugin_dir_path(__FILE__));
define('SP_URL', plugin_dir_url(__FILE__));

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'student_portal_activate');
register_deactivation_hook(__FILE__, 'student_portal_deactivate');

// Activation callback
function student_portal_activate() {
    ob_start();?>
    <script>
(function ($) {
    $(document).ready(function() {	
        console.log('student portal activated');
    });
})(jQuery);	
    </script>
    <?php $html = ob_get_clean();
}

// Deactivation callback
function student_portal_deactivate() {
    ob_start();?>
    <script>
(function ($) {
    $(document).ready(function() {	
        console.log('student portal deactivated');
    });
})(jQuery);	
    </script>
    <?php $html = ob_get_clean();
}

// Add your plugin's functionality here

// Example: Add a shortcode
require_once(SP_DIR . '/inc/student.php');


// Example: Create an admin menu
function student_portal_menu() {
    add_menu_page(
        'Student Portal Settings',
        'Student Portal',
        'manage_options',
        'student-portal-settings',
        'student_portal_settings_page',
        'dashicons-media-document'
    );
}
//admin page
add_action('admin_menu', 'student_portal_menu');

// Example: Create an admin settings page
function student_portal_settings_page() {
    // Your settings page HTML and logic here
    require_once(SP_DIR . '/inc/admin.php');
}

// Include additional files if needed
// require_once(SP_DIR . 'includes/your-file.php');

// Add any hooks and filters
// add_action('hook_name', 'your_function_name');
// add_filter('filter_name', 'your_function_name');
