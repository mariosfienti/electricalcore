<?php
/**
 * Footer del sito, con contatti letti dalle Impostazioni Sito.
 */

if (!defined('ABSPATH')) {
    exit;
}

$ec_is_home = is_front_page();
$ec_anchor = fn($hash) => $ec_is_home ? $hash : home_url('/' . $hash);

$ec_tel1 = ec_option('telefono_principale', '338 4444117');
$ec_email = ec_option('email', 'info@electricalcore.it');
$ec_indirizzo_completo = trim(ec_option('indirizzo', 'Frazione Bardella 34') . ', ' . ec_option('cap', '14022') . ' ' . ec_option('comune', 'Castelnuovo Don Bosco') . ' (' . ec_option('provincia_sigla', 'AT') . ')');
$ec_privacy_url = get_permalink(get_page_by_path('privacy')) ?: home_url('/privacy/');
?>
</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-footer.webp'); ?>" alt="Electrical Core SNC" class="footer-logo">
        <p class="footer-tagline"><?php echo esc_html(ec_option('footer_tagline', 'Impianti elettrici, sicurezza e connettività per casa e impresa, nelle province di Asti, Torino e Cuneo.')); ?></p>
      </div>
      <div class="footer-col">
        <h3>Collegamenti</h3>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url($ec_anchor('#servizi')); ?>">Servizi</a></li>
          <li><a href="<?php echo esc_url($ec_anchor('#chi-siamo')); ?>">Chi siamo</a></li>
          <li><a href="<?php echo esc_url($ec_anchor('#dove-siamo')); ?>">Dove siamo</a></li>
          <li><a href="<?php echo esc_url($ec_anchor('#contatti')); ?>">Contatti</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Contatti</h3>
        <ul class="footer-contact-list">
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 3a2 2 0 0 1-.4 2.1L8 10.3a16 16 0 0 0 5.7 5.7l1.5-1.4a2 2 0 0 1 2.1-.4c1 .4 2 .6 3 .7a2 2 0 0 1 1.7 2Z"/></svg>
            <a href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>"><?php echo esc_html($ec_tel1); ?></a>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.44 1.34 4.94L2 22l5.24-1.37a9.9 9.9 0 0 0 4.8 1.22h.01c5.5 0 9.96-4.46 9.96-9.96C22 6.46 17.55 2 12.04 2Zm5.8 14.15c-.24.68-1.4 1.3-1.93 1.36-.5.06-1.02.29-3.43-.72-2.9-1.2-4.77-4.15-4.92-4.34-.14-.2-1.17-1.56-1.17-2.97 0-1.41.74-2.1 1-2.39.27-.29.58-.36.77-.36.2 0 .39 0 .56.01.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.14.12.31.02.5-.1.2-.15.31-.3.48-.14.17-.3.37-.43.5-.14.14-.29.29-.13.57.17.29.75 1.24 1.6 2 1.11.99 2.04 1.3 2.33 1.44.29.14.46.12.63-.07.17-.2.72-.84.92-1.13.19-.29.39-.24.65-.14.27.1 1.68.79 1.97.94.29.14.48.21.55.33.07.12.07.7-.17 1.38Z"/></svg>
            <a href="<?php echo esc_url(ec_whatsapp_href($ec_tel1)); ?>" target="_blank" rel="noopener">Scrivi su WhatsApp</a>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 6 9 6 9-6"/><rect x="3" y="5" width="18" height="14" rx="2"/></svg>
            <a href="mailto:<?php echo esc_attr($ec_email); ?>"><?php echo esc_html($ec_email); ?></a>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <span><?php echo esc_html($ec_indirizzo_completo); ?></span>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="footer-legal"><?php echo esc_html(ec_option('ragione_sociale_legale', 'Electrical Core S.N.C.')); ?> &middot; P.IVA <?php echo esc_html(ec_option('piva', '01767090051')); ?></p>
      <p>&copy; <span id="year"><?php echo esc_html(date('Y')); ?></span> Electrical Core SNC</p>
      <p><a href="<?php echo esc_url($ec_privacy_url); ?>">Informativa Privacy</a> &middot; <a href="#" class="cookie-prefs-link">Preferenze cookie</a></p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
