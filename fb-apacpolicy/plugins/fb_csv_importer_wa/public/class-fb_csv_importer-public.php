<?php

/**
 * The public-facing functionality of the plugin.
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
 * Activate Importer
 *
 * @category  MyClass
 * @package   Fb_Csv_Importer_Activator
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */




class Fb_Csv_Importer_Public
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $_plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $_version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     *
     * @since 1.0.0
     */
    public function __construct( $plugin_name, $version )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since  1.0.0
     * @return void
     */
    public function enqueuestyles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in fb_csv_importer_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The fb_csv_importer_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/fb_csv_importer-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since  1.0.0
     * @return void
     */
    public function enqueuescripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in fb_csv_importer_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The fb_csv_importer_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        //wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fb_csv_importer-public.js', array( 'jquery' ), $this->version, false );

    }

}
