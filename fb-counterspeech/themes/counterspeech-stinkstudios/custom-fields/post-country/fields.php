<?php

add_action('fm_post_cntrspch_country', function () {
    // grab and display regions
    $countryRegionDataSource = get_terms(array(
        'taxonomy' => 'cntrspch_region',
        'hide_empty' => false,
    ));
    $countryRegion = new Fieldmanager_Select(null, array(
        'name'          => 'country_region',
        'options' => array_map(function ($term) {
            return array($term->name => $term->slug);
        }, $countryRegionDataSource),
        'attributes' => array('style' => 'width:100%'),
    ));

    $countryRegion->add_meta_box('Region', 'cntrspch_country', 'side');

    // -------- custom main fields --------
    $latitudeAndLongitude = new Fieldmanager_Group(array(
        'name' => 'latitude_and_longitude',
        'label' => 'Coordinates for map point',
        'children' => array(
            'country_code' => new Fieldmanager_Select(array(
                'label' => 'Select the three-letter country code for this country',
                'first_empty' => true,
                'options' => array('ABW' => 'Aruba (ABW)','AFG' => 'Afghanistan (AFG)','AGO' => 'Angola (AGO)','AIA' => 'Anguilla (AIA)','ALA' => 'Åland Islands (ALA)','ALB' => 'Albania (ALB)','AND' => 'Andorra (AND)','ARE' => 'United Arab Emirates (ARE)','ARG' => 'Argentina (ARG)','ARM' => 'Armenia (ARM)','ASM' => 'American Samoa (ASM)','ATA' => 'Antarctica (ATA)','ATF' => 'French Southern Territories (ATF)','ATG' => 'Antigua and Barbuda (ATG)','AUS' => 'Australia (AUS)','AUT' => 'Austria (AUT)','AZE' => 'Azerbaijan (AZE)','BDI' => 'Burundi (BDI)','BEL' => 'Belgium (BEL)','BEN' => 'Benin (BEN)','BES' => 'Bonaire, Sint Eustatius and Saba (BES)','BFA' => 'Burkina Faso (BFA)','BGD' => 'Bangladesh (BGD)','BGR' => 'Bulgaria (BGR)','BHR' => 'Bahrain (BHR)','BHS' => 'Bahamas (BHS)','BIH' => 'Bosnia and Herzegovina (BIH)','BLM' => 'Saint Barthélemy (BLM)','BLR' => 'Belarus (BLR)','BLZ' => 'Belize (BLZ)','BMU' => 'Bermuda (BMU)','BOL' => 'Bolivia, Plurinational State of (BOL)','BRA' => 'Brazil (BRA)','BRB' => 'Barbados (BRB)','BRN' => 'Brunei Darussalam (BRN)','BTN' => 'Bhutan (BTN)','BVT' => 'Bouvet Island (BVT)','BWA' => 'Botswana (BWA)','CAF' => 'Central African Republic (CAF)','CAN' => 'Canada (CAN)','CCK' => 'Cocos (Keeling) Islands (CCK)','CHE' => 'Switzerland (CHE)','CHL' => 'Chile (CHL)','CHN' => 'China (CHN)','CIV' => 'Côte d\'Ivoire (CIV)','CMR' => 'Cameroon (CMR)','COD' => 'Congo, the Democratic Republic of the (COD)','COG' => 'Congo (COG)','COK' => 'Cook Islands (COK)','COL' => 'Colombia (COL)','COM' => 'Comoros (COM)','CPV' => 'Cabo Verde (CPV)','CRI' => 'Costa Rica (CRI)','CUB' => 'Cuba (CUB)','CUW' => 'Curaçao (CUW)','CXR' => 'Christmas Island (CXR)','CYM' => 'Cayman Islands (CYM)','CYP' => 'Cyprus (CYP)','CZE' => 'Czechia (CZE)','DEU' => 'Germany (DEU)','DJI' => 'Djibouti (DJI)','DMA' => 'Dominica (DMA)','DNK' => 'Denmark (DNK)','DOM' => 'Dominican Republic (DOM)','DZA' => 'Algeria (DZA)','ECU' => 'Ecuador (ECU)','EGY' => 'Egypt (EGY)','ERI' => 'Eritrea (ERI)','ESH' => 'Western Sahara (ESH)','ESP' => 'Spain (ESP)','EST' => 'Estonia (EST)','ETH' => 'Ethiopia (ETH)','FIN' => 'Finland (FIN)','FJI' => 'Fiji (FJI)','FLK' => 'Falkland Islands (Malvinas) (FLK)','FRA' => 'France (FRA)','FRO' => 'Faroe Islands (FRO)','FSM' => 'Micronesia, Federated States of (FSM)','GAB' => 'Gabon (GAB)','GBR' => 'United Kingdom (GBR)','GEO' => 'Georgia (GEO)','GGY' => 'Guernsey (GGY)','GHA' => 'Ghana (GHA)','GIB' => 'Gibraltar (GIB)','GIN' => 'Guinea (GIN)','GLP' => 'Guadeloupe (GLP)','GMB' => 'Gambia (GMB)','GNB' => 'Guinea-Bissau (GNB)','GNQ' => 'Equatorial Guinea (GNQ)','GRC' => 'Greece (GRC)','GRD' => 'Grenada (GRD)','GRL' => 'Greenland (GRL)','GTM' => 'Guatemala (GTM)','GUF' => 'French Guiana (GUF)','GUM' => 'Guam (GUM)','GUY' => 'Guyana (GUY)','HKG' => 'Hong Kong (HKG)','HMD' => 'Heard Island and McDonald Islands (HMD)','HND' => 'Honduras (HND)','HRV' => 'Croatia (HRV)','HTI' => 'Haiti (HTI)','HUN' => 'Hungary (HUN)','IDN' => 'Indonesia (IDN)','IMN' => 'Isle of Man (IMN)','IND' => 'India (IND)','IOT' => 'British Indian Ocean Territory (IOT)','IRL' => 'Ireland (IRL)','IRN' => 'Iran, Islamic Republic of (IRN)','IRQ' => 'Iraq (IRQ)','ISL' => 'Iceland (ISL)','ISR' => 'Israel (ISR)','ITA' => 'Italy (ITA)','JAM' => 'Jamaica (JAM)','JEY' => 'Jersey (JEY)','JOR' => 'Jordan (JOR)','JPN' => 'Japan (JPN)','KAZ' => 'Kazakhstan (KAZ)','KEN' => 'Kenya (KEN)','KGZ' => 'Kyrgyzstan (KGZ)','KHM' => 'Cambodia (KHM)','KIR' => 'Kiribati (KIR)','KNA' => 'Saint Kitts and Nevis (KNA)','KOR' => 'Korea, Republic of (KOR)','KWT' => 'Kuwait (KWT)','LAO' => 'Lao People\'s Democratic Republic (LAO)','LBN' => 'Lebanon (LBN)','LBR' => 'Liberia (LBR)','LBY' => 'Libya (LBY)','LCA' => 'Saint Lucia (LCA)','LIE' => 'Liechtenstein (LIE)','LKA' => 'Sri Lanka (LKA)','LSO' => 'Lesotho (LSO)','LTU' => 'Lithuania (LTU)','LUX' => 'Luxembourg (LUX)','LVA' => 'Latvia (LVA)','MAC' => 'Macao (MAC)','MAF' => 'Saint Martin (French part) (MAF)','MAR' => 'Morocco (MAR)','MCO' => 'Monaco (MCO)','MDA' => 'Moldova, Republic of (MDA)','MDG' => 'Madagascar (MDG)','MDV' => 'Maldives (MDV)','MEX' => 'Mexico (MEX)','MHL' => 'Marshall Islands (MHL)','MKD' => 'Macedonia, the former Yugoslav Republic of (MKD)','MLI' => 'Mali (MLI)','MLT' => 'Malta (MLT)','MMR' => 'Myanmar (MMR)','MNE' => 'Montenegro (MNE)','MNG' => 'Mongolia (MNG)','MNP' => 'Northern Mariana Islands (MNP)','MOZ' => 'Mozambique (MOZ)','MRT' => 'Mauritania (MRT)','MSR' => 'Montserrat (MSR)','MTQ' => 'Martinique (MTQ)','MUS' => 'Mauritius (MUS)','MWI' => 'Malawi (MWI)','MYS' => 'Malaysia (MYS)','MYT' => 'Mayotte (MYT)','NAM' => 'Namibia (NAM)','NCL' => 'New Caledonia (NCL)','NER' => 'Niger (NER)','NFK' => 'Norfolk Island (NFK)','NGA' => 'Nigeria (NGA)','NIC' => 'Nicaragua (NIC)','NIU' => 'Niue (NIU)','NLD' => 'Netherlands (NLD)','NOR' => 'Norway (NOR)','NPL' => 'Nepal (NPL)','NRU' => 'Nauru (NRU)','NZL' => 'New Zealand (NZL)','OMN' => 'Oman (OMN)','PAK' => 'Pakistan (PAK)','PAN' => 'Panama (PAN)','PCN' => 'Pitcairn (PCN)','PER' => 'Peru (PER)','PHL' => 'Philippines (PHL)','PLW' => 'Palau (PLW)','PNG' => 'Papua New Guinea (PNG)','POL' => 'Poland (POL)','PRI' => 'Puerto Rico (PRI)','PRK' => 'Korea, Democratic People\'s Republic of (PRK)','PRT' => 'Portugal (PRT)','PRY' => 'Paraguay (PRY)','PSE' => 'Palestine, State of (PSE)','PYF' => 'French Polynesia (PYF)','QAT' => 'Qatar (QAT)','REU' => 'Réunion (REU)','ROU' => 'Romania (ROU)','RUS' => 'Russian Federation (RUS)','RWA' => 'Rwanda (RWA)','SAU' => 'Saudi Arabia (SAU)','SDN' => 'Sudan (SDN)','SEN' => 'Senegal (SEN)','SGP' => 'Singapore (SGP)','SGS' => 'South Georgia and the South Sandwich Islands (SGS)','SHN' => 'Saint Helena, Ascension and Tristan da Cunha (SHN)','SJM' => 'Svalbard and Jan Mayen (SJM)','SLB' => 'Solomon Islands (SLB)','SLE' => 'Sierra Leone (SLE)','SLV' => 'El Salvador (SLV)','SMR' => 'San Marino (SMR)','SOM' => 'Somalia (SOM)','SPM' => 'Saint Pierre and Miquelon (SPM)','SRB' => 'Serbia (SRB)','SSD' => 'South Sudan (SSD)','STP' => 'Sao Tome and Principe (STP)','SUR' => 'Suriname (SUR)','SVK' => 'Slovakia (SVK)','SVN' => 'Slovenia (SVN)','SWE' => 'Sweden (SWE)','SWZ' => 'Swaziland (SWZ)','SXM' => 'Sint Maarten (Dutch part) (SXM)','SYC' => 'Seychelles (SYC)','SYR' => 'Syrian Arab Republic (SYR)','TCA' => 'Turks and Caicos Islands (TCA)','TCD' => 'Chad (TCD)','TGO' => 'Togo (TGO)','THA' => 'Thailand (THA)','TJK' => 'Tajikistan (TJK)','TKL' => 'Tokelau (TKL)','TKM' => 'Turkmenistan (TKM)','TLS' => 'Timor-Leste (TLS)','TON' => 'Tonga (TON)','TTO' => 'Trinidad and Tobago (TTO)','TUN' => 'Tunisia (TUN)','TUR' => 'Turkey (TUR)','TUV' => 'Tuvalu (TUV)','TWN' => 'Taiwan, Province of China (TWN)','TZA' => 'Tanzania, United Republic of (TZA)','UGA' => 'Uganda (UGA)','UKR' => 'Ukraine (UKR)','UMI' => 'United States Minor Outlying Islands (UMI)','URY' => 'Uruguay (URY)','USA' => 'United States of America (USA)','UZB' => 'Uzbekistan (UZB)','VAT' => 'Holy See (VAT)','VCT' => 'Saint Vincent and the Grenadines (VCT)','VEN' => 'Venezuela, Bolivarian Republic of (VEN)','VGB' => 'Virgin Islands, British (VGB)','VIR' => 'Virgin Islands, U.S. (VIR)','VNM' => 'Viet Nam (VNM)','VUT' => 'Vanuatu (VUT)','WLF' => 'Wallis and Futuna (WLF)','WSM' => 'Samoa (WSM)','YEM' => 'Yemen (YEM)','ZAF' => 'South Africa (ZAF)','ZMB' => 'Zambia (ZMB)','ZWE' => 'Zimbabwe (ZWE)'),
            )),
            'latitude' => new Fieldmanager_TextField(array(
                'label' => 'Latitude',
                'description' => 'Be sure to include only positive or negative decimal numbers with no accompany N/S. i.e. "-5.298856" for 5°17\'55.9"S or "38.979058" for 38°58\'44.6"N  (Make sure to have at least four digits past the decimal point, otherwise there isn\'t enough specificity to achieve accurate coordinates',
            )),
            'longitude' => new Fieldmanager_TextField(array(
                'label' => 'Longitude',
                'description' => 'Be sure to include only positive or negative decimal numbers with no accompany W/E. i.e. "-98.397957" for 98°23\'52.6"W or "2.570765" for 2°34\'14.8"E  (Make sure to have at least four digits past the decimal point, otherwise there isn\'t enough specificity to achieve accurate coordinates',
            )),
            'datapoint' => new Fieldmanager_TextField('Data Point'),
            'datapoint_mustache' => new Fieldmanager_TextField('Data point caption')
        )
    ));
    $latitudeAndLongitude->add_meta_box('Coordinates', 'cntrspch_country', 'normal');

    $heroTitle = new Fieldmanager_TextField(array(
        'name' => 'country_hero_title',
        'label' => 'If you place text in this field it will appear on the hero module for this page, otherwise the page will just display the country name',
        'attributes' => array('style' => 'width:80%')
    ));
    $heroTitle->add_meta_box('Hero Title', 'cntrspch_country', 'normal');

    // first unformatted text block
    $topUnformattedText = new Fieldmanager_TextArea(array(
        'name' => 'intro_text_block',
        'label' => 'Text block underneath the hero image',
        'attributes' => array('style' => 'width:80%'),
    ));
    $topUnformattedText->add_meta_box('Intro text block', 'cntrspch_country', 'normal');

    $initiativeHeaderCta = new Fieldmanager_TextField(array(
        'name' => 'initiative_header_cta_copy',
        'label' => 'Text to display in the CTA for the global initiatives, i.e. "Learn More"'
    ));
    $initiativeHeaderCta->add_meta_box('Initative CTA Copy', 'cntrspch_country', 'normal');

    // sibling global initiatives by fm-zone
    $countryGISibling = new Fieldmanager_Zone_Field(array(
        'name' => 'country_sibling_gi',
        'label' => 'Add and reorder your initiatives',
        'query_args' => array(
            'post_type' => 'cntrspch_gi',
            'posts_per_page' => 200,
        )
    ));
    $countryGISibling->add_meta_box('Associated Initiatives', 'cntrspch_country', 'normal');

    $featuredCampaignLabels = new Fieldmanager_TextField(array(
        'name' => 'country_featured_campaign_label',
        'label' => 'The "Featured Case Study" tag to place next to each Case Study icon'
    ));
    $featuredCampaignLabels->add_meta_box('Featured Case Study Label', 'cntrspch_country', 'normal');

    $countryResourceHeader = new Fieldmanager_TextField(array(
        'name' => 'country_resource_header',
        'label' => 'The heading just before the "Resources" section',
    ));
    $countryResourceHeader->add_meta_box('Country Resource Header', 'cntrspch_country', 'normal');

    $countryResourceCta = new Fieldmanager_TextField(array(
        'name' => 'country_resource_cta',
        'label' => 'The text to display on the download button for each resource, i.e. "Download"',
    ));
    $countryResourceCta->add_meta_box('Resource CTA', 'cntrspch_country', 'normal');

    // sibling global initiatives by fm-zone
    $countryResource = new Fieldmanager_Zone_Field(array(
        'name' => 'country_resource',
        'label' => 'Add and reorder your resources',
        'query_args' => array(
            'post_type' => 'cntrspch_resource',
            'posts_per_page' => 200,
        )
    ));
    $countryResource->add_meta_box('Associated Resources', 'cntrspch_country', 'normal');

    $countryPartnersHeader = new Fieldmanager_TextField(array(
        'name' => 'country_partners_header',
        'label' => 'The heading just before the "Partners" section',
    ));
    $countryPartnersHeader->add_meta_box('Country Partners Header', 'cntrspch_country', 'normal');

    $countryPartners = new Fieldmanager_Zone_Field(array(
        'name' => 'country_partner',
        'label' => 'Add and reorder your partners',
        'query_args' => array(
            'post_type' => 'cntrspch_partner',
            'posts_per_page' => 200,
        )
    ));
    $countryPartners->add_meta_box('Associated Partners', 'cntrspch_country', 'normal');

    $countryContactModule = new Fieldmanager_Group(array(
        'name' => 'country_contact_module',
        'label' => 'The CTA module at the bottom of the page',
        'children' => array(
            'on_off' => new Fieldmanager_Radios(array(
                'label' => 'Should the Contact CTA display on this page?',
                'default_value' => 'yes',
                'options' => array('yes','no')
            )),
        )
    ));
    $countryContactModule->add_meta_box('Contact Module', 'cntrspch_country', 'normal');
});

// remove standard region metabox since we're replacing it above
add_action('admin_menu', function () {
    remove_meta_box('tagsdiv-cntrspch_region', 'cntrspch_country', 'side');
});
