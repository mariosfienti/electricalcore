<?php
/**
 * Custom post type "Servizio": una voce per ciascun servizio offerto
 * (Impianti elettrici, Antifurti, Videocitofonia, Automazioni cancelli,
 * Antenne e reti dati). Sostituisce le 5 pagine HTML duplicate del sito
 * statico con un solo template pilotato dai contenuti in admin.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ec_register_cpt_servizio() {
    register_post_type('servizio', [
        'labels' => [
            'name' => 'Servizi',
            'singular_name' => 'Servizio',
            'add_new_item' => 'Aggiungi nuovo servizio',
            'edit_item' => 'Modifica servizio',
            'all_items' => 'Tutti i servizi',
            'menu_name' => 'Servizi',
        ],
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => ['slug' => 'servizi'],
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
        'menu_position' => 5,
    ]);
}
add_action('init', 'ec_register_cpt_servizio');

/**
 * Ordina i servizi per "menu_order" (l'ordine impostato in admin, campo
 * "Ordine" nella colonna Attributi pagina) così il cliente può decidere
 * la sequenza con cui compaiono nel menu e nella griglia homepage.
 */
function ec_get_servizi($limit = -1, $exclude_id = 0) {
    return get_posts([
        'post_type' => 'servizio',
        'posts_per_page' => $limit,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post__not_in' => $exclude_id ? [$exclude_id] : [],
        'no_found_rows' => true,
    ]);
}
