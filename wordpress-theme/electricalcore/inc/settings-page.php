<?php
/**
 * Contenitore per i campi globali del sito (contatti, hero, chi siamo,
 * dove siamo, footer): una normale Pagina di WordPress, non pubblicata nei
 * menu, a cui è agganciato il gruppo di campi ACF "Impostazioni Sito".
 *
 * Le "Pagine opzioni" di ACF (Options Page) sono una funzione a pagamento
 * di ACF PRO: per restare sulla versione gratuita del plugin, usiamo al
 * loro posto questa pagina "privata" come contenitore dei campi globali.
 * Il cliente la modifica da Pagine -> Impostazioni Sito, esattamente come
 * modificherebbe qualsiasi altra pagina.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ec_get_settings_page_id() {
    static $page_id = null;
    if ($page_id !== null) {
        return $page_id;
    }

    $existing = get_posts([
        'post_type' => 'page',
        'name' => 'impostazioni-sito',
        'post_status' => ['publish', 'private', 'draft'],
        'posts_per_page' => 1,
        'no_found_rows' => true,
    ]);

    if ($existing) {
        $page_id = $existing[0]->ID;
        return $page_id;
    }

    $page_id = wp_insert_post([
        'post_type' => 'page',
        'post_title' => 'Impostazioni Sito',
        'post_name' => 'impostazioni-sito',
        'post_status' => 'private',
        'post_content' => '',
    ]);

    return $page_id;
}
add_action('after_switch_theme', 'ec_get_settings_page_id');
