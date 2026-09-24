<?php
/**
 * Electrical Core theme bootstrap.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('EC_THEME_VERSION', '1.0.0');

require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/cpt-servizi.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/contact-form.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/seed-admin.php';
