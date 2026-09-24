<?php
/**
 * Funzioni di utilità: lettura campi ACF con fallback, formattazione telefono/whatsapp.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Legge un campo dalla pagina opzioni "Impostazioni Sito", con un valore
 * di default se ACF non è attivo o il campo non è stato ancora compilato.
 */
function ec_option($field_name, $default = '') {
    if (!function_exists('get_field') || !function_exists('ec_get_settings_page_id')) {
        return $default;
    }
    $value = get_field($field_name, ec_get_settings_page_id());
    if ($value === '' || $value === null || $value === false) {
        return $default;
    }
    return $value;
}

/**
 * Come ec_option() ma per un campo ripetitore (repeater): restituisce
 * sempre un array (vuoto se non compilato), mai il default scalare.
 */
function ec_option_repeater($field_name) {
    if (!function_exists('get_field') || !function_exists('ec_get_settings_page_id')) {
        return [];
    }
    $value = get_field($field_name, ec_get_settings_page_id());
    return is_array($value) ? $value : [];
}

/**
 * Come get_field() sul post corrente ma con fallback, per i campi dei Servizi.
 */
function ec_field($field_name, $default = '', $post_id = null) {
    if (!function_exists('get_field')) {
        return $default;
    }
    $value = get_field($field_name, $post_id);
    if ($value === '' || $value === null || $value === false) {
        return $default;
    }
    return $value;
}

function ec_field_repeater($field_name, $post_id = null) {
    if (!function_exists('get_field')) {
        return [];
    }
    $value = get_field($field_name, $post_id);
    return is_array($value) ? $value : [];
}

/**
 * Converte un numero italiano (es. "338 4444117") in href tel:+39...
 */
function ec_tel_href($numero) {
    $digits = preg_replace('/\D+/', '', (string) $numero);
    if ($digits === '') {
        return '';
    }
    if (substr($digits, 0, 2) !== '39') {
        $digits = '39' . $digits;
    }
    return 'tel:+' . $digits;
}

/**
 * Converte un numero italiano in link wa.me (senza spazi, senza +).
 */
function ec_whatsapp_href($numero) {
    $digits = preg_replace('/\D+/', '', (string) $numero);
    if ($digits === '') {
        return '';
    }
    if (substr($digits, 0, 2) !== '39') {
        $digits = '39' . $digits;
    }
    return 'https://wa.me/' . $digits;
}

/**
 * Trasforma un campo "area di testo, una voce per riga" in un array di
 * voci pulite (righe vuote scartate). Usato per badge ed elenchi puntati,
 * che nella versione gratuita di ACF non possono essere un Repeater.
 */
function ec_lines_to_list($text) {
    if (!is_string($text) || trim($text) === '') {
        return [];
    }
    $lines = preg_split('/\r\n|\r|\n/', $text);
    $lines = array_map('trim', $lines);
    return array_values(array_filter($lines, fn($line) => $line !== ''));
}

/**
 * Icone SVG (solo il contenuto del tag <path>) usate per i servizi nel menu
 * a tendina e nelle card homepage. Se il servizio non ha impostato un'icona
 * personalizzata nel campo ACF "icona_svg_path", si usa questa di default
 * in base allo slug, così il sito non mostra mai un'icona vuota.
 */
function ec_default_service_icon_path($slug) {
    $icons = [
        'impianti-elettrici' => 'M13 2 3 14h7l-1 8 11-14h-7l1-6z',
        'antifurti-videosorveglianza' => 'M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5l-8-3zm0 9.5 3-1.7-3-1.7-3 1.7 3 1.7z',
        'videocitofonia' => 'M4 4h16v13H7l-3 3V4zm3 4h10v2H7V8zm0 4h7v2H7v-2z',
        'automazioni-cancelli' => 'M3 11h4l3-7h4l3 7h4v2H3v-2zm2 4h14l-1.5 6h-11L5 15z',
        'antenne-reti-dati' => 'M12 2v20m-6-4 6-16 6 16M4 22h16',
    ];
    return $icons[$slug] ?? 'M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5l-8-3zm0 9.5 3-1.7-3-1.7-3 1.7 3 1.7z';
}

/**
 * URL dell'immagine del servizio: usa l'immagine in evidenza se il cliente
 * ne ha caricata una, altrimenti la foto originale del sito come fallback
 * (così il sito non mostra mai un riquadro vuoto).
 */
function ec_service_image_url($post_id, $slug, $size = 'ec-service-card') {
    if (has_post_thumbnail($post_id)) {
        $url = get_the_post_thumbnail_url($post_id, $size);
        if ($url) {
            return $url;
        }
    }
    $defaults = [
        'impianti-elettrici' => 'impianti-elettrici.webp',
        'antifurti-videosorveglianza' => 'videosorveglianza.webp',
        'videocitofonia' => 'videocitofonia.webp',
        'automazioni-cancelli' => 'automazione-cancelli.webp',
        'antenne-reti-dati' => 'antenne-reti-dati.webp',
    ];
    $file = $defaults[$slug] ?? 'impianti-elettrici.webp';
    return get_template_directory_uri() . '/assets/images/services/' . $file;
}
