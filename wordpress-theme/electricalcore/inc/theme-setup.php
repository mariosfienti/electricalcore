<?php
/**
 * Impostazioni base del tema: supporto WP, script/style, dimensioni immagini.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ec_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('automatic-feed-links');

    add_image_size('ec-service-card', 400, 250, true);
    add_image_size('ec-service-hero', 600, 450, true);
}
add_action('after_setup_theme', 'ec_theme_setup');

function ec_enqueue_assets() {
    wp_enqueue_style(
        'ec-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'ec-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        EC_THEME_VERSION
    );

    wp_enqueue_script(
        'ec-script',
        get_template_directory_uri() . '/assets/js/script.js',
        [],
        EC_THEME_VERSION,
        true
    );

    $ec_privacy_page = get_page_by_path('privacy');
    wp_localize_script('ec-script', 'ecSettings', [
        'ajaxUrl'    => admin_url('admin-post.php'),
        'nonce'      => wp_create_nonce('ec_contact_form'),
        'telefono'   => ec_option('telefono_principale', '338 4444117'),
        'email'      => ec_option('email', 'info@electricalcore.it'),
        'privacyUrl' => $ec_privacy_page ? get_permalink($ec_privacy_page) : home_url('/privacy/'),
    ]);
}
add_action('wp_enqueue_scripts', 'ec_enqueue_assets');

/**
 * Avvisa in admin se il plugin ACF (necessario per gestire i contenuti) non è attivo.
 */
function ec_admin_notice_missing_acf() {
    if (!function_exists('get_field')) {
        echo '<div class="notice notice-error"><p><strong>Tema Electrical Core:</strong> installa e attiva il plugin gratuito <em>Advanced Custom Fields</em> per poter modificare i contenuti del sito (telefono, servizi, testi, ecc.).</p></div>';
    }
}
add_action('admin_notices', 'ec_admin_notice_missing_acf');
