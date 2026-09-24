<?php
/**
 * Gestione del form contatti lato server: sostituisce Formspree con
 * wp_mail() nativo di WordPress, così l'invio non dipende più da un
 * servizio esterno di terze parti. L'endpoint è admin-post.php, chiamato
 * via fetch() da assets/js/script.js.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ec_handle_contact_form() {
    if (!check_ajax_referer('ec_contact_form', 'nonce', false)) {
        wp_send_json_error(['message' => 'Richiesta non valida, ricarica la pagina e riprova.'], 403);
    }

    // Honeypot: se compilato, è quasi certamente un bot. Fingiamo un invio
    // riuscito senza inviare nessuna email, così il bot non capisce nulla.
    if (!empty($_POST['hp_website'])) {
        wp_send_json_success(['message' => 'Richiesta inviata! Ti risponderemo il prima possibile.']);
    }

    $nome = sanitize_text_field(wp_unslash($_POST['nome'] ?? ''));
    $telefono = sanitize_text_field(wp_unslash($_POST['telefono'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $servizio = sanitize_text_field(wp_unslash($_POST['servizio'] ?? 'Generale'));
    $messaggio = sanitize_textarea_field(wp_unslash($_POST['messaggio'] ?? ''));

    if ($nome === '' || $telefono === '' || $messaggio === '') {
        wp_send_json_error(['message' => 'Compila tutti i campi obbligatori.'], 400);
    }

    $destinatario = ec_option('email', get_option('admin_email'));

    $oggetto = sprintf('Richiesta preventivo [%s] - %s', $servizio, $nome);

    $corpo = "Nuova richiesta dal sito web:\n\n"
        . "Nome: {$nome}\n"
        . "Telefono: {$telefono}\n"
        . 'Email: ' . ($email ?: 'non indicata') . "\n"
        . "Servizio di interesse: {$servizio}\n\n"
        . "Messaggio:\n{$messaggio}\n";

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    if ($email) {
        $headers[] = "Reply-To: {$nome} <{$email}>";
    }

    $inviata = wp_mail($destinatario, $oggetto, $corpo, $headers);

    if ($inviata) {
        wp_send_json_success(['message' => 'Richiesta inviata! Ti risponderemo il prima possibile.']);
    }

    $telefono_contatto = ec_option('telefono_principale', '338 4444117');
    wp_send_json_error([
        'message' => "Invio non riuscito (il server potrebbe non essere configurato per inviare email). Chiamaci al {$telefono_contatto} oppure scrivici su WhatsApp.",
    ], 500);
}
add_action('admin_post_ec_contact_form', 'ec_handle_contact_form');
add_action('admin_post_nopriv_ec_contact_form', 'ec_handle_contact_form');
