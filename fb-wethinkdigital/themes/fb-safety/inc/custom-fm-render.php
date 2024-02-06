<?php
/**
 * Custom FIELD MANAGER RENDER
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class FieldManagerCustomRender {

  public function __construct() {}

  /**
   * Get meta data and display submodules
   *
   * @param $pid   - the post id from WordPress
   * @param $group - the name of the fieldmanager group
   * @param $lang  - current language code
   * @return template_part with sub_field data passed in args
   */
  public function display( $pid, $group, $lang ) {

    $fields = get_post_meta( $pid, $group );

    foreach ( $fields as $subs ) {

      $sid = 0;

      foreach ( $subs as $sub ) {

        $sid++;

        if ( isset($sub['which_subgroup']) && !empty($sub['which_subgroup']) ) {

          $gtp_args = array();

          // module id of this part
          $gtp_args['module_id'] = $pid;

          // sid --> part order
          $gtp_args['part_order'] = $sid;

          // get all the subgroups & subfields
          $which                  = $sub['which_subgroup'];
          $sub_fields             = $sub[$which];
          $template_name          = 'global-templates/submodules/' . $which;
          $gtp_args['sub_fields'] = $sub_fields;

          // don't display 'lesson' or 'resources' as a template part
          // each lesson displayed with /single-lesson.php
          // resources displayed with /single-module-child.php
          if ( ! in_array( $which, array('lesson', 'resources'), true ) ) {
            get_template_part( $template_name, null, $gtp_args );
          }

        }

      }

    }

  }
  
}
