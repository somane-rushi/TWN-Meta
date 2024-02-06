<?php

class CNTRSPCH_CEI_filter {

  private $countryFields = array(
    'country_region' => array(
      'parent' => 'wp-country-region',
      'tag' => 'wp-config-country-region',
      'repeater' => false,
      'structure' => array(),
    ),
    'latitude_and_longitude' => array(
      'tag' => 'wp-latitude-and-longitude',
      'repeater' => false,
      'structure' => array(
        'country_code' => 'wp-latitude-and-longitude-country-code',
        'latitude' => 'wp-latitude-and-longitude-latitude',
        'longitude' => 'wp-latitude-and-longitude-longitude',
        'datapoint' => 'wp-latitude-and-longitude-datapoint',
        'datapoint_mustache' => 'wp-latitude-and-longitude-datapoint-mustache',
      ),
    ),
    'country_hero_title' => array(
      'parent' => 'wp-country-hero-title',
      'tag' => 'wp-config-country-hero-title',
      'repeater' => false,
      'structure' => array(),
    ),
    'intro_text_block' => array(
      'parent' => 'wp-intro-text-block',
      'tag' => 'wp-config-intro-text-block',
      'repeater' => false,
      'structure' => array(),
    ),
    'initiative_header_cta_copy' => array(
      'parent' => 'wp-initiative-header-cta-copy',
      'tag' => 'wp-config-initiative-header-cta-copy',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_sibling_gi' => array(
      'parent' => 'wp-country-sibling-gi',
      'tag' => 'wp-config-country-sibling-gi',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_featured_campaign_label' => array(
      'parent' => 'wp-country-featured-campaign-label',
      'tag' => 'wp-config-country-featured-campaign-label',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_resource_header' => array(
      'parent' => 'wp-country-resource-header',
      'tag' => 'wp-config-country-resource-header',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_resource_cta' => array(
      'parent' => 'wp-country-resource-cta',
      'tag' => 'wp-config-country-resource-cta',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_resource' => array(
      'parent' => 'wp-country-resource',
      'tag' => 'wp-config-country-resource',
      'no-translate' => true,
      'repeater' => false,
      'structure' => array(),
    ),
    'country_partners_header' => array(
      'parent' => 'wp-country-partners-header',
      'tag' => 'wp-config-country-partners-header',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_partner' => array(
      'parent' => 'wp-country-partner',
      'tag' => 'wp-config-country-partner',
      'repeater' => false,
      'structure' => array(),
    ),
    'country_contact_module' => array(
      'tag' => 'wp-country-contact-module',
      'repeater' => false,
      'structure' => array(
        'on_off' => 'wp-contact-module-on-off',
      ),
    ),
  );
  private $countryFieldsDNT = array(
    'wp-config-country-region',
    'wp-latitude-and-longitude-country-code',
    'wp-latitude-and-longitude-latitude',
    'wp-latitude-and-longitude-longitude',
    'wp-config-country-sibling-gi',
    'wp-config-country-resource',
    'wp-config-country-partner',
    'wp-contact-module-on-off',
  );

  private $aboutFields = array(
    'about_masthead_image' => array(
      'parent' => 'wp-about-masthead-image',
      'tag' => 'wp-config-about-masthead-image',
      'no-translate' => true,
      'repeater' => false,
      'structure' => array(),
    ),
    'about_masthead_text' => array(
      'parent' => 'wp-about-masthead-text',
      'tag' => 'wp-config-about-masthead-text',
      'repeater' => false,
      'structure' => array(),
    ),
    'about_masthead_caption' => array(
      'parent' => 'wp-about-masthead-caption',
      'tag' => 'wp-config-about-masthead-caption',
      'repeater' => false,
      'structure' => array(),
    ),
    'about_content_blocks' => array(
      'tag' => 'wp-about-content-blocks',
      'repeater' => true,
      'inner' => true,
      'structure' => array(
        'display_if_triggers' => 'wp-about-content-block-display-if-triggers',
        'header' => 'wp-about-content-block-header',
        'paragraph' => 'wp-about-content-block-paragraph',
        'image' => 'wp-about-content-block-image',
        'list' => array(
          'parent' => 'wp-about-content-block-list',
          'tag' => 'wp-about-content-block-list',
          'repeater' => true,
          'structure' => array(
            'list_item' => 'wp-about-content-block-list-item',
          ),
        ),
        'cta' => array(
          'parent' => 'wp-about-content-block-cta',
          'tag' => 'wp-about-content-block-cta',
          'repeater' => false,
          'structure' => array(
            'cta_copy' => 'wp-about-content-block-cta-copy',
            'cta_link' => 'wp-about-content-block-cta-link',
          ),
        ),
      ),
    ),
    'about_contact_module' => array(
      'tag' => 'wp-about-contact-module',
      'repeater' => false,
      'no-translate' => true,
      'structure' => array(
        'on_off' => 'wp-about-contact-module-on-off',
      ),
    ),
  );

  private $aboutFieldsDNT = array(
    'wp-config-about-masthead-image',
    'wp-about-content-block-display-if-triggers',
    'wp-about-content-block-image',
    'wp-about-content-block-cta-link',
    'wp-about-contact-module-on-off',
  );

  private $metaFields = array(
    'meta_tags' => array(
      'tag' => 'wp-meta-tags',
      'repeater' => false,
      'structure' => array(
        'title' => 'wp-meta-tags-title',
        'description' => 'wp-meta-tags-description',
        'image' => 'wp-meta-tags-image',
      ),
    ),
  );
  private $metaFieldsDNT = array(
    'wp-meta-tags-image',
  );

  private $campaignFields = array(
    'campaign_parent_gi' => array(
      'parent' => 'wp-campaign-parent-gi',
      'tag' => 'wp-config-campaign-parent-gi',
      'repeater' => false,
      'structure' => array(),
    ),
    'campaign_parent_country' => array(
      'parent' => 'wp-campaign-parent-country',
      'tag' => 'wp-config-campaign-parent-country',
      'repeater' => false,
      'structure' => array(),
    ),
    'campaign_locale' => array(
      'parent' => 'wp-campaign-locale',
      'tag' => 'wp-config-campaign-locale',
      'repeater' => false,
      'structure' => array(),
    ),
    'campaign_image' => array(
      'tag' => 'wp-campaign-image',
      'repeater' => false,
      'structure' => array(
        'image' => 'wp-campaign-image-image',
        'caption' => 'wp-campaign-image-caption',
      ),
    ),
    'campaign_video' => array(
      'parent' => 'wp-campaign-video',
      'tag' => 'wp-config-campaign-video',
      'repeater' => false,
      'structure' => array(),
    ),
    'campaign_description' => array(
      'tag' => 'wp-campaign-description',
      'repeater' => true,
      'structure' => array(
        'display_if_triggers' => 'wp-campaign-description-display-if-triggers',
        'header' => 'wp-campaign-description-header',
        'paragraph' => 'wp-campaign-description-paragraph',
        'image' => 'wp-about-content-block-image',
      ),
    ),
    'campaign_mobile_cta_description' => array(
      'parent' => 'wp-mobile-cta-description',
      'tag' => 'wp-config-mobile-cta-description',
      'repeater' => false,
      'structure' => array(),
    ),
    'campaign_cta' => array(
      'tag' => 'wp-campaign-cta',
      'repeater' => false,
      'structure' => array(
        'cta_copy' => 'wp-campaign-cta-copy',
        'cta_link' => 'wp-campaign-cta-link',
      ),
    ),
    'campaign_data_points' => array(
      'tag' => 'wp-campaign-data-points',
      'repeater' => true,
      'structure' => array(
        'data_point' => 'wp-campaign-data-points-data-point',
        'data_label' => 'wp-campaign-data-points-data-label',
      ),
    ),
  );
  private $campaignFieldsDNT = array(
    'wp-config-campaign-parent-gi',
    'wp-config-campaign-parent-country',
    'wp-campaign-image-image',
    'wp-config-campaign-video',
    'wp-campaign-description-display-if-triggers',
    'wp-about-content-block-image',
    'wp-campaign-cta-link',
  );

  private $contactFields = array(
    'contact_content_blocks' => array(
      'tag' => 'wp-contact-content-blocks',
      'repeater' => true,
      'inner' => true,
      'structure' => array(
        'display_if_triggers' => 'wp-contact-content-block-display-if-triggers',
        'header' => 'wp-contact-content-block-header',
        'paragraph' => 'wp-campaign-data-point-paragraph',
        'image' => 'wp-campaign-data-point-image',
        'list' => array(
          'parent' => 'wp-contact-content-block-list',
          'tag' => 'wp-contact-content-block-list',
          'repeater' => true,
          'structure' => array(
            'list_item' => 'wp-contact-content-block-list-item',
          ),
        ),
        'cta' => array(
          'tag' => 'wp-contact-content-block-header-cta',
          'parent' => 'wp-contact-content-block-header-cta',
          'repeater' => false,
          'structure' => array(
            'cta_copy' => 'wp-contact-content-block-header-cta-copy',
            'cta_link' => 'wp-contact-content-block-header-cta-link',
          ),
        ),
      ),
    ),
    'contact_modal_content_blocks' => array(
      'tag' => 'wp-contact-modal-content-blocks',
      'repeater' => false,
      'structure' => array(
        'intro_copy' => 'wp-contact-modal-content-block-intro-copy',
        'button_copy' => 'wp-contact-modal-content-block-button-copy',
        'header' => 'wp-contact-modal-content-block-header',
        'text' => 'wp-contact-modal-content-block-text',
        'success' => 'wp-contact-modal-content-block-success'
      ),
    ),
    'contact_contact_form' => array(
      'parent' => 'wp-contact-contact-form',
      'tag' => 'wp-config-contact-contact-form',
      'repeater' => false,
      'structure' => array(),
    ),
  );
  private $contactFieldsDNT = array(
    'wp-contact-content-block-display-if-triggers',
    'wp-campaign-data-point-image',
    'wp-contact-content-block-header-cta-link',
  );

  private $giFields = array(
    'gi_icon' => array(
      'parent' => 'wp-gi-icon',
      'tag' => 'wp-config-gi-icon',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_illustration' => array(
      'parent' => 'wp-gi-illustration',
      'tag' => 'wp-config-gi-illustration',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_global_local' => array(
      'parent' => 'wp-gi-global-local',
      'tag' => 'wp-config-gi-global-local',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_homepage_image' => array(
      'parent' => 'wp-gi-homepage-image',
      'tag' => 'wp-config-gi-homepage-image',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_hero' => array(
      'tag' => 'wp-gi-hero',
      'repeater' => false,
      'structure' => array(
        'image' => 'wp-gi-hero-image',
        'caption' => 'wp-gi-hero-caption',
      ),
    ),
    'intro_text' => array(
      'parent' => 'wp-intro-text',
      'tag' => 'wp-config-intro-text',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_body_copy' => array(
      'tag' => 'wp-gi-body-copy',
      'repeater' => true,
      'inner' => true,
      'structure' => array(
        'display_if_triggers' => 'wp-gi-body-copy-display-if-triggers',
        'paragraph' => 'wp-gi-body-copy-paragraph',
        'list' => array(
          'parent' => 'wp-gi-body-copy-paragraph-list',
          'tag' => 'wp-gi-body-copy-paragraph-list',
          'repeater' => true,
          'structure' => array(
            'list_item' => 'wp-gi-body-copy-paragraph-list-item',
          ),
        ),
      ),
    ),
    'gi_featured_campaign_label' => array(
      'parent' => 'wp-gi-featured-campaign-label',
      'tag' => 'wp-config-gi-featured-campaign-label',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_partners_header' => array(
      'parent' => 'wp-gi-partners-header',
      'tag' => 'wp-config-gi-partners-header',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_partner' => array(
      'parent' => 'wp-config-gi-partner',
      'tag' => 'wp-gi-partner',
      'repeater' => false,
      'structure' => array(),
    ),
    'gi_contact_module' => array(
      'tag' => 'wp-gi-contact-module',
      'repeater' => false,
      'structure' => array(
        'on_off' => 'wp-gi-contact-module-on-off'
      ),
    ),
    'medium_description' => array(
      'tag' => 'wp-gi-medium-description',
      'repeater' => true,
      'structure' => array(
        'paragraph' => 'wp-gi-medium-description-paragraph',
      ),
    ),
    'gi_localized_descriptions' => array(
      'tag' => 'wp-gi-localized-descriptions',
      'repeater' => true,
      'structure' => array(
        'country_localization' => array(
          'parent' => 'wp-gi-localized-descriptions-country-localization',
          'tag' => 'wp-gi-localized-descriptions-country-localization',
          'repeater' => false,
          'inner' => true,
          'structure' => array(
            'country' => 'wp-gi-localized-descriptions-country',
            'description' => array(
              'parent' => 'wp-gi-localized-descriptions-description',
              'tag' => 'wp-gi-localized-descriptions-description',
              'repeater' => true,
              'structure' => array(
                'paragraph' => 'wp-gi-localized-descriptions-description-paragraph',
              ),
            ),
          ),
        ),
      ),
    ),
    'gi_featured_campaigns' => array(
      'parent' => 'wp-gi-featured-campaigns',
      'tag' => 'wp-config-gi-featured-campaigns',
      'repeater' => false,
      'structure' => array(),
    ),
  );
  private $giFieldsDNT = array(
    'wp-config-gi-icon',
    'wp-config-gi-illustration',
    'wp-config-gi-global-local',
    'wp-config-gi-homepage-image',
    'wp-config-gi-hero',
    'wp-gi-body-copy-display-if-triggers',
    'wp-gi-partner',
    'wp-gi-contact-module-on-off',
    'wp-gi-localized-descriptions-country',
    'wp-config-gi-featured-campaigns',
  );

  private $homeFields = array(
    'hero_repeater_with_text' => array(
      'tag' => 'wp-hero-repeater-with-text',
      'repeater' => false,
      'inner' => true,
      'structure' => array(
        'hero_banner_text' => 'wp-hero-repeater-with-text-hero-banner-text',
        'images' => array(
          'parent' => 'wp-hero-repeater-with-text-image',
          'tag' => 'wp-hero-repeater-with-text-image',
          'repeater' => true,
          'structure' => array(
            'hero_image' => 'wp-hero-repeater-with-text-hero-image',
            'hero_subtext' => 'wp-hero-repeater-with-text-hero-subtext',
          ),
        ),
      ),
    ),
    'home_intro_text' => array(
      'tag' => 'wp-home-intro-text',
      'repeater' => true,
      'structure' => array(
        'text' => 'wp-home-intro-text',
      ),
    ),
    'home_map' => array(
      'tag' => 'wp-home-map',
      'repeater' => false,
      'structure' => array(
        'intro_text' => 'wp-home-map-intro-text',
        'explainer_text' => 'wp-home-map-explainer-text',
        'mobile_carousel_header' => 'wp-home-map-mobile-carousel-header',
        'mobile_countries' => 'wp-home-map-mobile-countries',
      ),
    ),
    'home_header_text' => array(
      'tag' => 'wp-home-header-text',
      'repeater' => false,
      'structure' => array(
        'heading_text' => 'wp-home-header-text-heading-text',
        'text' => 'wp-home-header-text-text',
      ),
    ),
    'home_initiatives' => array(
      'parent' => 'wp-home-initiatives',
      'tag' => 'wp-config-home-initiatives',
      'repeater' => false,
      'structure' => array(),
    ),
    'initiative_cta' => array(
      'parent' => 'wp-initiative-cta',
      'tag' => 'wp-config-initiative-cta',
      'repeater' => false,
      'structure' => array(),
    ),
    'home_resources' => array(
      'tag' => 'wp-home-resources',
      'repeater' => false,
      'structure' => array(
        'header_text' => 'wp-home-resources-header-text',
        'section_copy' => 'wp-home-resources-section-copy',
        'resources_cta' => 'wp-home-resources-cta',
        'resources_image' => 'wp-home-resources-image',
      ),
    ),
    'homepage_contact_module' => array(
      'tag' => 'wp-homepage-contact-module',
      'repeater' => false,
      'structure' => array(
        'on_off' => 'wp-homepage-contact-module-on-off'
      ),
    ),
  );
  private $homeFieldsDNT = array(
    'wp-hero-repeater-with-text-hero-image',
    'wp-home-map-mobile-countries',
    'wp-config-home-initiatives',
    'wp-home-resources-image',
    'wp-homepage-contact-module-on-off'
  );

  private $fourOhFourFields = array(
    'four_oh_four_content_blocks' => array(
      'tag' => 'wp-four-oh-four-content-blocks',
      'repeater' => true,
      'inner' => true,
      'structure' => array(
        'display_if_triggers' => 'wp-four-oh-four-content-block-display-if-triggers',
        'header' => 'wp-four-oh-four-content-block-header',
        'paragraph' => 'wp-four-oh-four-paragraph',
        'image' => 'wp-four-oh-four-image',
        'list' => array(
          'parent' => 'wp-four-oh-four-content-block-list',
          'tag' => 'wp-four-oh-four-content-block-list',
          'repeater' => true,
          'structure' => array(
            'list_item' => 'wp-four-oh-four-content-block-list-item',
          ),
        ),
        'cta' => array(
          'tag' => 'wp-four-oh-four-content-block-cta',
          'repeater' => false,
          'parent' => 'wp-four-oh-four-content-block-cta',
          'structure' => array(
            'cta_copy' => 'wp-four-oh-four-content-block-cta-copy',
            'cta_link' => 'wp-four-oh-four-content-block-cta-link',
          ),
        ),
      ),
    ),
    'four_oh_four_cta' => array(
      'parent' => 'wp-four-oh-four-cta',
      'tag' => 'wp-config-four-oh-four-cta',
      'repeater' => false,
      'structure' => array(),
    )
  );
  private $fourOhFourFieldsDNT = array(
    'wp-four-oh-four-content-block-display-if-triggers',
    'wp-four-oh-four-image',
    'wp-four-oh-four-content-block-cta-link',
  );

  private $partnerFields = array(
    'partner_logo' => array(
      'parent' => 'wp-partner-logo',
      'tag' => 'wp-config-partner-logo',
      'repeater' => false,
      'structure' => array(),
    ),
    'partner_url' => array(
      'parent' => 'wp-partner-url',
      'tag' => 'wp-config-partner-url',
      'repeater' => false,
      'structure' => array(),
    ),
  );
  private $partnerFieldsDNT = array(
    'wp-config-partner-logo',
    'wp-config-partner-url',
  );

  private $resourceFields = array(
    'resource_display_on_resources' => array(
      'parent' => 'wp-resource-display-on-resources',
      'tag' => 'wp-config-resource-display-on-resources',
      'repeater' => false,
      'structure' => array(),
    ),
    'resource_type' => array(
      'parent' => 'wp-resource-type',
      'tag' => 'wp-config-resource-type',
      'repeater' => false,
      'structure' => array(),
    ),
    'short_description' => array(
      'parent' => 'wp-short-description',
      'tag' => 'wp-config-short-description',
      'repeater' => false,
      'structure' => array(),
    ),
    'resource_uploads' => array(
      'tag' => 'wp-resource-uploads',
      'repeater' => true,
      'structure' => array(
        'lang_options' => 'wp-resource-uploads-lang-options',
        'resource_file' => 'wp-resource-uploads-resource-file',
      ),
    ),
    'resource_masthead_image' => array(
      'parent' => 'wp-resource-masthead-image',
      'tag' => 'wp-config-resource-masthead-image',
      'repeater' => false,
      'structure' => array(),
    ),
    'resource_masthead_text' => array(
      'parent' => 'wp-config-resource-masthead-text',
      'tag' => 'wp-resource-masthead-text',
      'repeater' => false,
      'structure' => array(),
    ),
    'resource_masthead_caption' => array(
      'parent' => 'wp-resource-masthead-caption',
      'tag' => 'wp-config-resource-masthead-caption',
      'repeater' => false,
      'structure' => array(),
    ),
    'resources_intro_text' => array(
      'parent' => 'wp-resources-intro-text',
      'tag' => 'wp-config-resources-intro-text',
      'repeater' => false,
      'structure' => array(),
    ),
    'resource_section_title' => array(
      'parent' => 'wp-resource-section-title',
      'tag' => 'wp-config-resource-section-title',
      'repeater' => false,
      'structure' => array(),
    ),
    'resource_section_content_blocks' => array(
      'tag' => 'wp-resource-section-content-blocks',
      'repeater' => true,
      'structure' => array(
        'paragraph' => 'wp-resource-section-content-block-paragraph',
      ),
    ),
    'download_cta' => array(
      'parent' => 'wp-download-cta',
      'tag' => 'wp-config-download-cta',
      'repeater' => false,
      'structure' => array(),
    ),
    'resources_contact_module' => array(
      'tag' => 'wp-resources-contact-module',
      'repeater' => false,
      'structure' => array(
        'on_off' => 'wp-resources-contact-module-on-off',
      ),
    ),
    'research_section_title' => array(
      'parent' => 'wp-research-section-title',
      'tag' => 'wp-config-research-section-title',
      'repeater' => false,
      'structure' => array(),
    ),
    'research_section_content_blocks' => array(
      'tag' => 'wp-research-section-content-blocks',
      'repeater' => true,
      'structure' => array(
        'paragraph' => 'wp-research-section-content-block-paragraph',
      ),
    ),
  );
  private $resourceFieldsDNT = array(
    'wp-config-resource-display-on-resources',
    'wp-config-resource-type',
    'wp-resource-uploads-lang-options',
    'wp-resource-uploads-resource-file',
    'wp-config-resource-masthead-image',
    'wp-resources-contact-module-on-off',
    'wp-gi-hero-image'
  );

  private $videoFields = array(
    'video' => array(
      'tag' => 'wp-video',
      'repeater' => false,
      'structure' => array(
        'facebook_url' => 'wp-video-facebook-url',
        'cover_image' => 'wp-video-cover-image',
      ),
    ),
  );
  private $videoFieldsDNT = array(
    'wp-video-facebook-url',
    'wp-video-cover-image',
  );

  public function customFieldsArray() {
    return array_merge(
      $this->countryFields,
      $this->metaFields,
      $this->aboutFields,
      $this->campaignFields,
      $this->contactFields,
      $this->giFields,
      $this->homeFields,
      $this->partnerFields,
      $this->resourceFields,
      $this->videoFields,
      $this->fourOhFourFields
    );
  }
  
  public function noTranslateFieldsArray() {
    return array_merge(
      $this->countryFieldsDNT,
      $this->metaFieldsDNT,
      $this->aboutFieldsDNT,
      $this->campaignFieldsDNT,
      $this->contactFieldsDNT,
      $this->giFieldsDNT,
      $this->homeFieldsDNT,
      $this->partnerFieldsDNT,
      $this->resourceFieldsDNT,
      $this->videoFieldsDNT,
      $this->fourOhFourFieldsDNT
    );
  }
}