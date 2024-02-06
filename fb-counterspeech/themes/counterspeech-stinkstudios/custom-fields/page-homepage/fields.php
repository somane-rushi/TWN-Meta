<?php
add_action('fm_post_page', function () use ($cf_functions) {
    $thisPage = 'homepage';
	//Hero Module
	$HomeHeroModule = new Fieldmanager_Group(array(
        'name' => 'home_hero_module',
        'label' => '',
        'children' => array(
            'hero_title' => new Fieldmanager_TextField(__('Hero Title', 'counterspeech-stinkstudios'),
                  array(
                      'attributes' => array('style' => 'width:100%'),
                  )
              ),
			'hero_caption' => new Fieldmanager_TextArea(__('Hero Caption', 'counterspeech-stinkstudios'),
                  array(
                      'attributes' => array('style' => 'width:100%'),
                  )
              ),
			'hero_image_new' => new Fieldmanager_Media(
                  __('Hero Image', 'counterspeech-stinkstudios')
              ),
      'hero_btn_text' => new Fieldmanager_TextField(__('CTA label', 'counterspeech-stinkstudios'),
                  array(
                      'attributes' => array('style' => 'width:100%'),
                  )
              ),
        
			'hero_btn_link' => new Fieldmanager_TextField(__('Button Link', 'counterspeech-stinkstudios'),
                  array(
                      'attributes' => array('style' => 'width:100%'),
                  )
              )
        )
    ));
	
    $HomeHeroModule->add_meta_box('Hero Module', 'page', 'normal');
    $cf_functions::showOnPage($HomeHeroModule->name, $thisPage);
	
	//Content Area
	$HomeBasicModule = new Fieldmanager_Group(array(
        'name' => 'home_basic_text',
        'label' => '',
        'children' => array(
            'home_content' => new Fieldmanager_RichTextArea(__('Content', 'counterspeech-stinkstudios'),
                  array(
                      'attributes' => array('style' => 'width:100%'),
                  )
              )
			
        )
    ));
	
    $HomeBasicModule->add_meta_box('Basic Text Module', 'page', 'normal');
    $cf_functions::showOnPage($HomeBasicModule->name, $thisPage);

    
    $args = array(
       'public'   => true,
       '_builtin' => false
    );

  $output = 'names'; // names or objects, note names is the default
  $operator = 'and'; // 'and' or 'or'
  $post_types = get_post_types( $args, $output, $operator ); 
  $postName = array();
  $postSlug = array();

  foreach ( $post_types  as $post_type ) {
     $postSlug[] = $post_type;
     $obj = get_post_type_object( $post_type );
     $postName[] = $obj->labels->singular_name;
  }

  $c = array_combine($postSlug, $postName);

  $HomePostModule = new Fieldmanager_Group(array(
        'name' => 'home_post_module',
        'label' => '',
        'children' => array(
            'home_post_block' => new Fieldmanager_Select(__('Select Post', 'counterspeech-stinkstudios'),
                  array(
                      'first_empty' => true,
                      'attributes' => array('style' => 'width:100%'),
                      'options' => $c
                  )
              )
      
        )
    ));
  
    $HomePostModule->add_meta_box('Post Module', 'page', 'normal');
    $cf_functions::showOnPage($HomePostModule->name, $thisPage);

    //Bottom Block
    $HomePostBackgroundModule = new Fieldmanager_Group(array(
        'name' => 'home_bottom_background_module',
        'label' => '',
        'children' => array(
                'background_color'       => new Fieldmanager_TextField('Background Color (#Hex Color)'),
                'header_text'       => new Fieldmanager_TextField('Header'),
                'section_copy'      => new Fieldmanager_TextArea('Description'),
                'resources_cta_label'     => new Fieldmanager_TextField('CTA Label'),
                'resources_cta_link'     => new Fieldmanager_TextField('CTA Link'),
                'resources_image'   => new Fieldmanager_Media('Image')
            )
    ));
  
    $HomePostBackgroundModule->add_meta_box('Bottom Block', 'page', 'normal');
    $cf_functions::showOnPage($HomePostBackgroundModule->name, $thisPage);
});