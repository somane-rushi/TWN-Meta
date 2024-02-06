<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * PHP Version 5.4
 *
 * @category  MyClass
 * @package   Fb_Csv_Importer_Activator
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */
 
/**
 * Importer Actviation
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @category  MyClass
 * @package   Fb_Csv_Importer
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */



class Fb_Csv_Importer
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    fb_csv_importer_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $plugin_name    The string used to uniquely identify this plugin.
     */

    /**
     * The current version of the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('fb_CSV_IMPORTER_VERSION') ) {
            $this->version = fb_CSV_IMPORTER_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'fb_csv_importer';

        $this->_loaddependencies();
        $this->_setlocale();
        $this->_defineadminhooks();
        $this->_definepublichooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - fb_csv_importer_Loader. Orchestrates the hooks of the plugin.
     * - fb_csv_importer_i18n. Defines internationalization functionality.
     * - fb_csv_importer_Admin. Defines all hooks for the admin area.
     * - Fb_Csv_Importer_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function _loaddependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-fb_csv_importer-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-fb_csv_importer-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-fb_csv_importer-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'public/class-fb_csv_importer-public.php';

        $this->loader = new fb_csv_importer_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the fb_csv_importer_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function _setlocale()
    {

        $plugin_i18n = new fb_csv_importer_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function _defineadminhooks()
    {

        $plugin_admin = new fb_csv_importer_Admin($this->getpluginname(), $this->getversion());

        $this->loader->add_action('admin_enqueuescripts', $plugin_admin, 'enqueuestyles');
        $this->loader->add_action('admin_enqueuescripts', $plugin_admin, 'enqueuescripts');
        
        $this->loader->add_action('admin_menu', $plugin_admin, 'testpluginsetupmenu');
        $this->loader->add_action('init', $plugin_admin, 'cptuiregistermycpts');
        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'removeslugmetaboxes');
        //Remove Gutenberg Editor
        add_filter('use_block_editor_for_post', '__return_false', 10);
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function _definepublichooks()
    {

        $plugin_public = new Fb_Csv_Importer_Public($this->getpluginname(), $this->getversion());

        $this->loader->add_action('wp_enqueuescripts', $plugin_public, 'enqueuestyles');
        $this->loader->add_action('wp_enqueuescripts', $plugin_public, 'enqueuescripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since  1.0.0
     * @return string    The name of the plugin.
     */
    public function getpluginname()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since  1.0.0
     * @return fb_csv_importer_Loader    Orchestrates the hooks of the plugin.
     */
    public function getloader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since  1.0.0
     * @return string    The version number of the plugin.
     */
    public function getversion()
    {
        return $this->version;
    }

}
