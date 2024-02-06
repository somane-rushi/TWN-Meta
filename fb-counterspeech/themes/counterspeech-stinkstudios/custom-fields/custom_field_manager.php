<?php
define('CF_DIR', __DIR__);
require CF_DIR . '/custom_fields_functions.php';
    $cf_functions = new CNTRSPCH_CF_Functions();

// autoload our modules
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/modules/' . $class . '.php';
    if (file_exists($file)) {
        include __DIR__ . '/modules/' . $class . '.php';
    }
   
});

// Require page template fields
//require CF_DIR . '/page-homepage-archive/fields.php';
require CF_DIR . '/page-resources/fields.php';
require CF_DIR . '/page-about/fields.php';
require CF_DIR . '/page-contact/fields.php';
require CF_DIR . '/page-fourohfour/fields.php';

// Require custom post fields
require CF_DIR . '/post-campaign/fields.php';
require CF_DIR . '/post-country/fields.php';
require CF_DIR . '/post-gi/fields.php';
require CF_DIR . '/post-partner/fields.php';
require CF_DIR . '/post-resource/fields.php';

// Require custom term fields
require CF_DIR . '/term-region/fields.php';

//require global fields
require CF_DIR . '/globals/fields.php';

require CF_DIR . '/page-homepage/fields.php';