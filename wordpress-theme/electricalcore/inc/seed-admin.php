<?php
/**
 * Pagina in bacheca per lanciare con un clic l'importazione dei contenuti
 * di esempio (vedi seed/seed-content.php), senza bisogno di accesso
 * SSH/WP-CLI: comodo per chi usa un hosting condiviso come Aruba/Register.
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/seed/seed-content.php';

function ec_seed_admin_menu() {
    add_submenu_page(
        'ec-impostazioni-sito',
        'Importa contenuti demo',
        'Importa contenuti demo',
        'manage_options',
        'ec-importa-contenuti',
        'ec_seed_admin_page'
    );
}
add_action('admin_menu', 'ec_seed_admin_menu', 20);

function ec_seed_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    $notice = isset($_GET['ec_seed_done']) ? sanitize_text_field(wp_unslash($_GET['ec_seed_done'])) : '';
    ?>
    <div class="wrap">
      <h1>Importa contenuti demo</h1>
      <?php if ($notice === '1'): ?>
        <div class="notice notice-success"><p>Importazione completata: Impostazioni Sito, i 5 Servizi e la pagina Privacy sono stati popolati con i contenuti reali del sito Electrical Core.</p></div>
      <?php elseif ($notice === '0'): ?>
        <div class="notice notice-error"><p>Importazione non riuscita: verifica che il plugin Advanced Custom Fields sia attivo e riprova.</p></div>
      <?php endif; ?>
      <p>Questo pulsante compila automaticamente il sito con gli stessi contenuti (testi, servizi, contatti) del sito statico originale, così puoi vedere subito il tema funzionante e poi modificare quello che vuoi da qui in bacheca.</p>
      <p>È sicuro premerlo più volte: aggiorna i contenuti esistenti invece di duplicarli.</p>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('ec_seed_content'); ?>
        <input type="hidden" name="action" value="ec_seed_content">
        <?php submit_button('Importa contenuti di esempio'); ?>
      </form>
    </div>
    <?php
}

function ec_handle_seed_admin_post() {
    if (!current_user_can('manage_options') || !check_admin_referer('ec_seed_content')) {
        wp_die('Richiesta non autorizzata.');
    }

    $result = ec_run_seed_content();

    wp_safe_redirect(add_query_arg(
        'ec_seed_done',
        $result['ok'] ? '1' : '0',
        admin_url('admin.php?page=ec-importa-contenuti')
    ));
    exit;
}
add_action('admin_post_ec_seed_content', 'ec_handle_seed_admin_post');
