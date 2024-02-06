<?php

//register story post type
require get_template_directory() . '/custom-posts/global-initiatives/cpt.php';
require get_template_directory() . '/custom-posts/global-initiatives/admin-permissions.php';
require get_template_directory() . '/custom-posts/global-initiatives/admin-view.php';
require get_template_directory() . '/custom-posts/global-initiatives/meta-controller.php';

require get_template_directory() . '/custom-posts/countries/cpt.php';
require get_template_directory() . '/custom-posts/countries/admin-permissions.php';
require get_template_directory() . '/custom-posts/countries/admin-view.php';
require get_template_directory() . '/custom-posts/countries/meta-controller.php';

require get_template_directory() . '/custom-posts/campaigns/cpt.php';
require get_template_directory() . '/custom-posts/campaigns/admin-permissions.php';
require get_template_directory() . '/custom-posts/campaigns/admin-view.php';
require get_template_directory() . '/custom-posts/campaigns/meta-controller.php';

require get_template_directory() . '/custom-posts/resources/cpt.php';
require get_template_directory() . '/custom-posts/resources/admin-permissions.php';
require get_template_directory() . '/custom-posts/resources/admin-view.php';
require get_template_directory() . '/custom-posts/resources/meta-controller.php';

require get_template_directory() . '/custom-posts/partners/cpt.php';
require get_template_directory() . '/custom-posts/partners/admin-permissions.php';
require get_template_directory() . '/custom-posts/partners/admin-view.php';
require get_template_directory() . '/custom-posts/partners/meta-controller.php';
