<?php


/**
 * The admin-specific functionality of the FB CSV Importer for WA.
 *
 * PHP Version 5.4
 *
 * @category  MyClass
 * @package   Fb_Csv_Importer
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */
 
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @category  MyClass
 * @package   Fb_Csv_Importe
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */



class Fb_Csv_Importer_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $_plugin_name    The ID of this plugin.
     */
    private $_plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $_version    The current version of this plugin.
     */
    private $_version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $_plugin_name The name of this plugin.
     * @param string $_version     The version of this plugin.
     *
     * @since 1.0.0
     */
    public function __construct( $_plugin_name, $_version )
    {

        $this->plugin_name = $_plugin_name;
        $this->version = $_version;

    }

    /**
     * Register the stylesheets for the admin area.
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
        wp_enqueue_style($this->plugin_name.'Data-Table', 'https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/fb_csv_importer-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
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
/*        wp_enqueue_script($this->plugin_name."data-table",  'https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false);*/
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/fb_csv_importer-admin.js', array( 'jquery' ), $this->version, false);
        

    }

    /**
     * Register Admin Page for CSV
     *
     * @since  1.0.0
     * @return void
     */
    public function testpluginsetupmenu()
    {
        add_menu_page('CSV Importer', 'CSV Importer', 'manage_options', 'fb_csv_importer_menu', 'fb_csv_importer', 'dashicons-chart-pie');
    }
     
    /**
     * Register Account Assets Post Type
     *
     * @since  1.0.0
     * @return void
     */
    public function cptuiregistermycpts()
    {
    
        $labels = [
        "name" => __("Account Assets", "fb_csv_importer"),
        "singular_name" => __("Account Assets", "fb_csv_importer"),
        ];
    
        $args = [
        "label" => __("Account Assets", "fb_csv_importer"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "fb_assets_wa", "with_front" => true ],
        "query_var" => true,
        "menu_icon" => "dashicons-lock",
        "supports" => [ "title", "editor", "thumbnail", "custom-fields" ], //"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
        ];
    
        register_post_type("fb_assets_wa", $args);
    }
 
    /**
     * Remove Slug Meta Box
     *
     * @since  1.0.0
     * @return void
     */
    public function removeslugmetaboxes()
    {
        remove_meta_box('slugdiv', 'fb_assets_wa', 'normal');
    }
        

}

    /**
     * Admin Page Content Function
     *
     * @since  1.0.0
     * @return void
     */
function Fb_Csv_importer()
{


    /* If user clicks on Delete button */
    $deleteoldrecord =  isset($_POST['delete']);

    if ( $deleteoldrecord && current_user_can( 'manage_options') ){
        

          if (! isset( $_POST['delete_field'] ) || ! wp_verify_nonce( $_POST['delete_field'], 'delete_action' ) ) {
             
                    die( 'Failed security check' );
             
            } 


        // Delete old records
        $allposts = get_posts( array( 'post_type'=>'fb_assets_wa', 'fields' => 'ids', 'posts_per_page'=> '200' ) );

        foreach ($allposts as $eachpost) {
            wp_delete_post($eachpost, true);


        }

        $delete_flag = true;
        
        
    }

    if ($_FILES && isset($_FILES['fileCSV'])) {
   

        
            if (! isset( $_POST['add_field'] ) || ! wp_verify_nonce( $_POST['add_field'], 'add_action' ) ) {
             
                    die( 'Failed security check' );
             
            } 


        /* Only CSV files are allowed */
        $allowed = array('csv');
        $fileName = ${'_FILES'}["fileCSV"]["name"];
        
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
   


        if (in_array($ext, $allowed)) {

            $count_posts = wp_count_posts( 'fb_assets_wa' )->publish;

            $fileName = ${'_FILES'}["fileCSV"]["tmp_name"];
            $file = fopen($fileName, "r");
            $countColumn = 0 ;
            $number = 0;
            $skip_record = 0;
            echo '<h1>CSV Importer - Results</h1>';


             $field_array = array(
                        "6"=>"One Pager Onepager", 
                        "7"=>"Report", 
                        "8"=>"Case Study casestudy", 
                        "9"=>"presentation powerpoint keynote ppt pptx",
                        "10"=>"presentation template powerpoint keynote ppt pptx",
                        "11"=>"presentation template powerpoint keynote ppt pptx",
                        "12"=>"brochure leaflet handout", 
                        "13"=>"video mp4 mov", 
                        "14"=>"case study video mp4 mov", 
                        "15"=>"case study written",
                        "16"=>"case study micro business", 
                        "17"=>"case study small business", 
                        "18"=>"case study women entrepreneur",
                        "19"=>"narrative key messaging", 
                        "20"=>"image jpg jpeg png", 
                        "21"=>"audio mp3", 
                        "23"=>"language", 
                        "24"=>"Finsafety FinInc", 
                        "25"=>"Safety & Misinformation",
                        "26"=>"Economic Opportunity", 
                        "27"=>"Privacy / E2EE ", 
                        "28"=>"Training Resource", 
                        "29"=>"other project", 



                        "30"=>"policy audience", 
                        "31"=>"media",  
                        "32"=>"general public", 
                        "33"=>"Small medium Businesses", 
                        "34"=>"community leaders", 
                        "35"=>"educators", 
                        "36"=>"Health Profession" 
                 );

            

            while (($column = fgetcsv($file, 10000, ",")) !== false) {
                $countColumn ++ ;


                if ($countColumn !== 1 && $column[1] !== '') {
                    // print_r($column);

      
                    // If the user has an asset URL, it can be added
                    if ($column[38]) {
                        $skip_record++;

                        if ( $skip_record > $count_posts ) {
                            $number++;



                             $post_content ="";

                                for($i=1;$i<41;$i++ ){

                                   

                                    if($column[$i] == 'TRUE'){

                                        $post_content .= sanitize_text_field($field_array["$i"]) . " ";
                                    }
                                }
                              
                                   $author = sanitize_text_field($column[4]);
                                   $country =  sanitize_text_field($column[5]);
                                   $post_content .=" $author $country";

                                $register_integrtion_post = array(
                                'post_title'  => sanitize_text_field($column[2]),
                                'post_content'=> "$post_content",
                                'post_status' => 'publish',
                                'post_type'   => 'fb_assets_wa',
                                'post_author' => 1,
                                );
                                $the_post_id = wp_insert_post($register_integrtion_post);
        
                                //Clear for next asset
                                $post_content ="";

                                $dateString = sanitize_text_field($column[3]);
                                $timestamp = strtotime(str_replace("/", "-", $dateString));
                                $visualdate = str_replace("-", "/", $dateString);

                                 // Skip this record if there's been an error inserting the post
                                if ( empty( $the_post_id ) || is_wp_error( $the_post_id ) ) {
                                      continue;
                                }

        
                        update_post_meta($the_post_id, 'last_modified_date_visual', $visualdate);
                        update_post_meta($the_post_id, 'last_modified_date_timestamp', $timestamp);
                        update_post_meta($the_post_id, 'author', sanitize_text_field($column[4]));
                        update_post_meta($the_post_id, 'country', sanitize_text_field($column[5]));
                        update_post_meta($the_post_id, 'one_pager', sanitize_text_field($column[6]));
                        update_post_meta($the_post_id, 'report', sanitize_text_field($column[7]));
                        update_post_meta($the_post_id, 'case_study', sanitize_text_field($column[8]));
                        update_post_meta($the_post_id, 'presentation', sanitize_text_field($column[9]));
                        update_post_meta($the_post_id, 'presentation_template', sanitize_text_field($column[10]));
                        update_post_meta($the_post_id, 'logobrand_guidelines', sanitize_text_field($column[11]));
                        update_post_meta($the_post_id, 'brochure', sanitize_text_field($column[12]));
                        update_post_meta($the_post_id, 'video', sanitize_text_field($column[13]));
                        update_post_meta($the_post_id, 'case_study_video', sanitize_text_field($column[14]));
                        update_post_meta($the_post_id, 'case_study_written', sanitize_text_field($column[15]));
                        update_post_meta($the_post_id, 'case_study_micro_business', sanitize_text_field($column[16]));
                        update_post_meta($the_post_id, 'case_study_small_business', sanitize_text_field($column[17]));
                        update_post_meta($the_post_id, 'case_study_women_entrepreneur', sanitize_text_field($column[18]));
                        update_post_meta($the_post_id, 'narrative_key_messaging', sanitize_text_field($column[19]));
                        update_post_meta($the_post_id, 'image', sanitize_text_field($column[20]));
                        update_post_meta($the_post_id, 'audio', sanitize_text_field($column[21]));
                        update_post_meta($the_post_id, 'other_asset', sanitize_text_field($column[22]));
                        update_post_meta($the_post_id, 'asset_language', sanitize_text_field($column[23]));
                        update_post_meta($the_post_id, 'finsafety', sanitize_text_field($column[24]));
                        update_post_meta($the_post_id, 'safety_misinfo', sanitize_text_field($column[25]));
                        update_post_meta($the_post_id, 'economic_recovery', sanitize_text_field($column[26]));
                        update_post_meta($the_post_id, 'privacy', sanitize_text_field($column[27]));
                        update_post_meta($the_post_id, 'training_resource', sanitize_text_field($column[28]));                
                        update_post_meta($the_post_id, 'other_topic', sanitize_text_field($column[29]));


                        update_post_meta($the_post_id, 'policy_audience', sanitize_text_field($column[30]));
                        update_post_meta($the_post_id, 'media', sanitize_text_field($column[31]));
                        update_post_meta($the_post_id, 'general_public', sanitize_text_field($column[32]));
                        update_post_meta($the_post_id, 'small_medium_business', sanitize_text_field($column[33]));
                        update_post_meta($the_post_id, 'community_leaders', sanitize_text_field($column[34]));
                        update_post_meta($the_post_id, 'educators', sanitize_text_field($column[35]));
                        update_post_meta($the_post_id, 'health_profession', sanitize_text_field($column[36]));


                        update_post_meta($the_post_id, 'permission_given', sanitize_text_field($column[37]));

                        update_post_meta($the_post_id, 'asset_url', sanitize_text_field($column[38]));

                    
                                if($number ==250){

                                    print "250 Assets have been added";
                                    break;

                                    
                                }
                        }
                    


                    }
                }
                    
            }
            //echo '</tbody></table></div>';
              print "<BR>Total Assets Imported:" . intval($number);
        }
    } else {



       
        echo '<h1>CSV WhatsApp Asset Importer</h1>';
        echo '<div class="row"><BR><h2>Upload Data</h2>
                <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                    <div class="input-row">
                        <label class="col-md-4 control-label">Choose CSV File</label> <input type="file" name="fileCSV" id="file" accept=".csv">
                 

           '.   wp_nonce_field('add_action','add_field') .'

                        <button type="submit" id="submit" name="import" class="btn-submit">Upload CSV File</button><br />
                    </div><BR>File: <a href="/wp-content/plugins/fb_csv_importer/sample_file.csv" target="_blank">Sample CSV File</a><BR><BR>
                    <B>Note: Last Modified Date Column should be in format: DD-MM-YYYY<BR>
                    Only 250 assets will be uploaded at a time<BR><BR>Uploading a CSV will delete all current current data and replace it with the data from the CSV file.<BR>Process takes between 30 seconds to 2 minutes.
                </form>';




         echo '       <BR><BR><h2>Delete Data</h2>
                <form class="form-horizontal" action="" method="post" name="frmCSVImportDel" id="frmCSVImportDel">
                    <div class="input-row">
                '.   wp_nonce_field('delete_action','delete_field') .'
                        <button type="submit" id="submit" name="delete" class="btn-submit" onclick="return confirm(\'Are you sure you want to delete the WhatsApp Account Assets?\');">Delete Old Data</button><br />
                    </div><BR><B>Note: Click above button to delete old data.<br><br>';

                    if($delete_flag) {
                        echo '<div class="data-deleted"><font color=red>The latest 200 APAC Policy Resource Hub assets has been deleted successfully.<BR> If there are more then 200 assets, please keep using this feature until all are deleted.</font></div>';
                    }

               echo '</form>

            </div>';
    }

        

}
