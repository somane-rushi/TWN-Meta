<?php

/**
 * The plugin bootstrap file
 *
 * PHP Version 5.4
 * Plugin Name:       FB CSV Importer WA
 * Plugin URI:        
 * Description:       Allows CSV file to be uploaded and added based off FB data CSV file for WA
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @category  MyClass
 * @package   Fb_Csv_WA_Importer
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */


set_time_limit(300);
 

// If this file is called directly, abort.
if (! defined('WPINC') ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FB_CSV_WA_IMPORTER_VERSION', '1.6.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fb_csv_importer-activator.php
 *
 * @return void
 */
function Activate_Fb_Csv_importer()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-fb_csv_importer-activator.php';
    fb_csv_importer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fb_csv_importer-deactivator.php
 *
 * @return void
 */
function Deactivate_Fb_Csv_importer()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-fb_csv_importer-deactivator.php';
    fb_csv_importer_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_fb_csv_importer');
register_deactivation_hook(__FILE__, 'deactivate_fb_csv_importer');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-fb_csv_importer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since  1.0.0
 * @return void
 */
function Run_Fb_Csv_importer()
{

    $plugin = new fb_csv_importer();
    $plugin->run();

}
Run_Fb_Csv_importer();
