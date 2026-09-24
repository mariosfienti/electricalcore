<?php
/**
 * Form di contatto riutilizzato in homepage e nelle pagine servizio.
 * L'invio è gestito via JS (assets/js/script.js) che chiama
 * admin-post.php?action=ec_contact_form (vedi inc/contact-form.php).
 *
 * @var array $args ['servizio' => 'Nome servizio da precompilare']
 */

if (!defined('ABSPATH')) {
    exit;
}

$ec_servizio_default = $args['servizio'] ?? 'Generale';
$ec_privacy_url = get_permalink(get_page_by_path('privacy')) ?: home_url('/privacy/');
?>
<form class="contact-form reveal" id="contactForm" novalidate>
  <div class="hp-field" aria-hidden="true">
    <label for="hp-website">Non compilare questo campo</label>
    <input type="text" id="hp-website" name="hp_website" tabindex="-1" autocomplete="off">
  </div>
  <input type="hidden" id="servizio" value="<?php echo esc_attr($ec_servizio_default); ?>">
  <div class="form-row">
    <label for="nome">Nome e cognome</label>
    <input type="text" id="nome" name="nome" autocomplete="name" required>
  </div>
  <div class="form-row">
    <label for="telefono">Telefono</label>
    <input type="tel" id="telefono" name="telefono" autocomplete="tel" required>
  </div>
  <div class="form-row">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" autocomplete="email">
  </div>
  <div class="form-row">
    <label for="messaggio">Descrivi il tuo progetto o la tua richiesta</label>
    <textarea id="messaggio" name="messaggio" rows="4" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-lg">Invia richiesta</button>
  <p class="form-privacy-note">Inviando la richiesta accetti il trattamento dei tuoi dati secondo la nostra <a href="<?php echo esc_url($ec_privacy_url); ?>">informativa privacy</a>.</p>
  <p class="form-note" id="formNote" role="status" aria-live="polite"></p>
</form>
