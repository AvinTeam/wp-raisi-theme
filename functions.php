<?php

(defined('ABSPATH')) || exit;

date_default_timezone_set('Asia/Tehran');

define('RAISI_VERSION', '0.0.3');

define('RAISI_PATH', get_template_directory() . "/");
define('RAISI_INCLUDES', RAISI_PATH . 'includes/');
define('RAISI_CLASS', RAISI_PATH . 'classes/');
define('RAISI_CORE', RAISI_PATH . 'core/');
define('RAISI_VIEWS', RAISI_PATH . 'views/');
define('RAISI_COMPONENTS', RAISI_PATH . 'components/');

define('RAISI_URL', get_template_directory_uri() . "/");
define('RAISI_ASSETS', RAISI_URL . 'assets/');
define('RAISI_CSS', RAISI_ASSETS . 'css/');
define('RAISI_JS', RAISI_ASSETS . 'js/');
define('RAISI_IMAGE', RAISI_ASSETS . 'image/');
define('RAISI_VENDOR', RAISI_ASSETS . 'vendor/');

require_once RAISI_CORE . '/accesses.php';

require_once RAISI_INCLUDES . '/init.php';
require_once RAISI_INCLUDES . '/styles.php';
require_once RAISI_INCLUDES . '/theme_filter.php';
require_once RAISI_INCLUDES . '/theme-function.php';
require_once RAISI_INCLUDES . '/jdf.php';
require_once RAISI_INCLUDES . '/taxonomy_image.php';
require_once RAISI_INCLUDES . '/meta_boxs.php';
require_once RAISI_INCLUDES . '/shortcode.php';

if (is_admin()) {
    require_once RAISI_INCLUDES . '/install.php';

}
