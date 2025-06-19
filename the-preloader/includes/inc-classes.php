<?php

if ( !defined('ABSPATH') ) {
    exit; // Exit if accessed directly
}

// Load Output class if not exists
if ( !class_exists('The_Preloader_Output') ) {
    require_once THE_PRELOADER_PLUGIN_PATH . 'includes/class-output.php';
}

// Load Settings class if not exists
if ( !class_exists('The_Preloader_Settings') ) {
    require_once THE_PRELOADER_PLUGIN_PATH . 'includes/class-settings.php';
}

// Load Core class - No need to check if exists since we already checked in plugins_loaded hook (in preloader.php file)
// and this file is included only after that check
require_once THE_PRELOADER_PLUGIN_PATH . 'includes/class-core.php';