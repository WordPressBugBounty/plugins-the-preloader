<?php
/**
 * Plugin Name: Preloader
 * Version: 2.0.1
 * Description: The ultimate Preloader plugin for WordPress. Smart, flexible, and made for easy control. Add a preloader to your website easily in only 3 steps.
 * Author: Alobaidi
 * Author URI: https://wp-plugins.in/PreloaderPlugin
 * Plugin URI: https://wp-plugins.in/PreloaderPlugin
 * Text Domain: the-preloader
 * Domain Path: /languages
 * Requires at least: 5.3.0
 * Requires PHP: 7.4
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( !defined('ABSPATH') ) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('THE_PRELOADER_PLUGIN_ID', 'the_preloader');
define('THE_PRELOADER_PLUGIN_VERSION', '2.0.1');
define('THE_PRELOADER_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('THE_PRELOADER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('THE_PRELOADER_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Add custom link to plugin meta row.
function the_preloader_plugin_row_meta($links, $file) {
    if ( strpos( $file, 'preloader.php' ) !== false ) {
        $custom_link = array(
            sprintf(
                // translators: %1$s and %2$s are link tags
                esc_html__('%1$sPlugin Reference%2$s', 'the-preloader'),
                '<a href="https://wp-plugins.in/PreloaderPlugin" target="_blank">',
                '</a>'
            )
        );
        $links = array_merge($links, $custom_link);
    }
    return $links;
}
add_filter('plugin_row_meta', 'the_preloader_plugin_row_meta', 10, 2);

// Add settings link before activate/deactivate plugin links.
function the_preloader_plugin_action_links($actions, $plugin_file){
    static $plugin;

    if ( !isset($plugin) ){
        $plugin = plugin_basename(__FILE__);
    }
        
    if ($plugin == $plugin_file) {
        $custom_link = '<a href="' . admin_url('admin.php?page=' . THE_PRELOADER_PLUGIN_ID) . '">'.esc_html__('Settings', 'the-preloader').'</a>';
        $actions = array_merge(array($custom_link), $actions);
    }

    return $actions;
}
add_filter('plugin_action_links', 'the_preloader_plugin_action_links', 10, 5);

// Plugin initialization
function the_preloader_init() {
    if ( !class_exists('The_Preloader_Core') ) {
        // Load main class file first
        require_once THE_PRELOADER_PLUGIN_PATH . 'includes/inc-classes.php';
    
        // Initialize main plugin class
        $The_Preloader_Main = The_Preloader_Core::get_instance();
        $The_Preloader_Main->initialize();
    }
}
add_action('plugins_loaded', 'the_preloader_init');