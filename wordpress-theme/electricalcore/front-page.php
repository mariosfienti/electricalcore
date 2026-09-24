<?php
/**
 * Homepage one-page: hero, servizi, chi siamo, dove siamo, contatti.
 * Tutti i testi vengono da "Impostazioni Sito" (ACF Options), i servizi
 * dal custom post type "servizio".
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$ec_tel1 = ec_option('telefono_principale', '338 4444117');
$ec_tel2 = ec_option('telefono_secondario', '327 5669119');
$ec_email = ec_option('email', 'info@electricalcore.it');
$ec_indirizzo_completo = trim(ec_option('indirizzo', 'Frazione Bardella 34') . ', ' . ec_option('cap', '14022') . ' ' . ec_option('comune', 'Castelnuovo Don Bosco') . ' (' . ec_option('provincia_sigla', 'AT') . ')');
$ec_hero_img = ec_option('hero_immagine');
$ec_hero_img_url = is_array($ec_hero_img) ? $ec_hero_img['url'] : get_template_directory_uri() . '/assets/images/hero-van.webp';
$ec_chi_siamo_img = ec_option('chi_siamo_immagine');
$ec_chi_siamo_img_url = is_array($ec_chi_siamo_img) ? $ec_chi_siamo_img['url'] : get_template_directory_uri() . '/assets/images/services/chi-siamo.webp';
$ec_servizi = ec_get_servizi();
?>

<section class="hero">
  <div class="container hero-inner">
    <div class="hero-copy reveal reveal-onload">
      <p class="eyebrow"><?php echo esc_html(ec_option('hero_eyebrow', 'Impianti elettrici civili e industriali')); ?></p>
      <h1><?php echo esc_html(ec_option('hero_titolo', 'Sicurezza, tecnologia e affidabilità per la tua casa e la tua impresa')); ?></h1>
      <p class="hero-lead"><?php echo esc_html(ec_option('hero_testo', 'Electrical Core SNC progetta e installa impianti elettrici, sistemi antifurto, videosorveglianza, videocitofonia, automazioni per cancelli e reti dati con sede a Castelnuovo Don Bosco e operatività nelle province di Asti, Torino e Cuneo.')); ?></p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#contatti">Richiedi un preventivo gratuito</a>
        <a class="btn btn-ghost btn-lg" href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>">
          <svg viewBox="0 0 24 24" class="icon" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.4.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.3 21 3 13.7 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/></svg>
          <?php echo esc_html($ec_tel1); ?>
        </a>
      </div>
      <?php $ec_badges = ec_lines_to_list(ec_option('hero_badges', "Preventivi gratuiti\nInterventi civili e industriali\nAsti, Torino e Cuneo")); ?>
      <?php if ($ec_badges): ?>
      <ul class="hero-badges">
        <?php foreach ($ec_badges as $ec_badge): ?><li><?php echo esc_html($ec_badge); ?></li><?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
    <div class="hero-visual reveal reveal-zoom reveal-onload">
      <img src="<?php echo esc_url($ec_hero_img_url); ?>" alt="Furgone aziendale Electrical Core SNC, Torino" class="hero-photo" width="900" height="600" loading="eager">
    </div>
  </div>
</section>

<div class="container contact-strip">
  <div class="contact-strip-card reveal reveal-bounce">
    <div class="col">
      <p class="eyebrow" style="color:#ff8a7c;margin:0;">Preventivo in 24 ore</p>
      <h3>Sopralluogo e preventivo gratuiti, senza impegno</h3>
      <span class="cs-label">Rispondiamo dal lunedì al sabato</span>
    </div>
    <div class="col">
      <span class="cs-label">Chiama subito</span>
      <a class="cs-phone" href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 3a2 2 0 0 1-.4 2.1L8 10.3a16 16 0 0 0 5.7 5.7l1.5-1.4a2 2 0 0 1 2.1-.4c1 .4 2 .6 3 .7a2 2 0 0 1 1.7 2Z"/></svg>
        <?php echo esc_html($ec_tel1); ?>
      </a>
    </div>
    <div class="col cs-whatsapp-col">
      <span class="cs-label">O scrivici su WhatsApp</span>
      <a class="cs-whatsapp" href="<?php echo esc_url(ec_whatsapp_href($ec_tel1)); ?>" target="_blank" rel="noopener">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/whatsapp-qr.svg'); ?>" alt="QR code WhatsApp Electrical Core" width="90" height="90" loading="lazy">
        <span class="cs-phone" style="font-size:1rem;">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.44 1.34 4.94L2 22l5.24-1.37a9.9 9.9 0 0 0 4.8 1.22h.01c5.5 0 9.96-4.46 9.96-9.96C22 6.46 17.55 2 12.04 2Zm5.8 14.15c-.24.68-1.4 1.3-1.93 1.36-.5.06-1.02.29-3.43-.72-2.9-1.2-4.77-4.15-4.92-4.34-.14-.2-1.17-1.56-1.17-2.97 0-1.41.74-2.1 1-2.39.27-.29.58-.36.77-.36.2 0 .39 0 .56.01.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.14.12.31.02.5-.1.2-.15.31-.3.48-.14.17-.3.37-.43.5-.14.14-.29.29-.13.57.17.29.75 1.24 1.6 2 1.11.99 2.04 1.3 2.33 1.44.29.14.46.12.63-.07.17-.2.72-.84.92-1.13.19-.29.39-.24.65-.14.27.1 1.68.79 1.97.94.29.14.48.21.55.33.07.12.07.7-.17 1.38Z"/></svg>
          <?php echo esc_html($ec_tel1); ?>
        </span>
      </a>
    </div>
  </div>
</div>

<section class="services" id="servizi">
  <div class="container">
    <p class="eyebrow center">Cosa facciamo</p>
    <h2 class="section-title center">I nostri servizi</h2>
    <p class="section-lead center">Un unico interlocutore per impianti elettrici, sicurezza e connettività: dal progetto alla manutenzione.</p>

    <div class="service-grid reveal-stagger">
      <?php foreach ($ec_servizi as $ec_s):
        $ec_slug = $ec_s->post_name;
        $ec_img_url = ec_service_image_url($ec_s->ID, $ec_slug, 'ec-service-card');
        $ec_link = get_permalink($ec_s);
        $ec_excerpt = has_excerpt($ec_s) ? get_the_excerpt($ec_s) : wp_trim_words(strip_tags($ec_s->post_content), 24);
      ?>
      <article class="service-card" id="service-<?php echo esc_attr($ec_slug); ?>">
        <div class="service-media">
          <a href="<?php echo esc_url($ec_link); ?>" aria-label="Approfondisci <?php echo esc_attr(get_the_title($ec_s)); ?>">
            <img src="<?php echo esc_url($ec_img_url); ?>" alt="<?php echo esc_attr(get_the_title($ec_s)); ?>" class="service-img" loading="lazy" width="400" height="250">
          </a>
          <span class="service-badge-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="<?php echo esc_attr(ec_field('icona_svg_path', ec_default_service_icon_path($ec_slug), $ec_s->ID)); ?>"/></svg>
          </span>
        </div>
        <div class="service-content">
          <h3><a href="<?php echo esc_url($ec_link); ?>" class="service-card-anchor"><?php echo esc_html(get_the_title($ec_s)); ?></a></h3>
          <p><?php echo esc_html($ec_excerpt); ?></p>
          <a href="<?php echo esc_url($ec_link); ?>" class="service-link">
            Scopri dettagli
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="about" id="chi-siamo">
  <div class="container about-inner">
    <div class="about-copy reveal">
      <p class="eyebrow"><?php echo esc_html(ec_option('chi_siamo_eyebrow', 'Chi siamo')); ?></p>
      <h2><?php echo esc_html(ec_option('chi_siamo_titolo', "Esperienza elettrotecnica al servizio di casa e impresa")); ?></h2>
      <p><?php echo esc_html(ec_option('chi_siamo_testo_1', "Electrical Core SNC è un'impresa elettrotecnica con sede a Castelnuovo Don Bosco, in provincia di Asti. Seguiamo i nostri clienti dal sopralluogo al collaudo, con impianti a norma e soluzioni pensate per durare nel tempo.")); ?></p>
      <p><?php echo esc_html(ec_option('chi_siamo_testo_2', 'Lavoriamo con privati, professionisti e aziende su tutto il territorio delle province di Asti, Torino, Cuneo e del Piemonte, offrendo un servizio diretto e senza intermediari: preventivo chiaro, tempi certi e assistenza anche dopo la fine dei lavori.')); ?></p>

      <ul class="feature-list">
        <?php for ($ec_i = 1; $ec_i <= 3; $ec_i++):
          $ec_pt = ec_option("punto{$ec_i}_titolo");
          $ec_pd = ec_option("punto{$ec_i}_desc");
          if (!$ec_pt && !$ec_pd) continue;
        ?>
        <li>
          <div class="feature-text">
            <strong><?php echo esc_html($ec_pt); ?></strong>
            <span><?php echo esc_html($ec_pd); ?></span>
          </div>
        </li>
        <?php endfor; ?>
      </ul>
    </div>

    <div class="about-media reveal reveal-zoom">
      <img id="img-chi-siamo" src="<?php echo esc_url($ec_chi_siamo_img_url); ?>" alt="Tecnico Electrical Core SNC al lavoro" class="about-img" loading="lazy" width="600" height="450">
      <div class="about-media-caption">Tecnici specializzati Electrical Core: sicurezza e impianti a regola d'arte</div>
    </div>
  </div>
</section>

<section class="area" id="dove-siamo">
  <div class="container area-inner">
    <div class="area-copy reveal">
      <p class="eyebrow">Dove siamo</p>
      <h2>Sede a <?php echo esc_html(ec_option('comune', 'Castelnuovo Don Bosco')); ?>, attivi nelle province di Asti, Torino e Cuneo</h2>
      <p><?php echo esc_html(ec_option('dove_siamo_testo', 'La nostra sede operativa si trova in ' . ec_option('indirizzo', 'Frazione Bardella 34') . ', a ' . ec_option('comune', 'Castelnuovo Don Bosco') . ' (' . ec_option('provincia_sigla', 'AT') . '). Dalla nostra posizione centrale e strategica, interveniamo con rapidità ed efficienza su tutto il territorio circostante per qualsiasi esigenza civile e industriale.')); ?></p>

      <div class="province-cards reveal-stagger">
        <?php for ($ec_i = 1; $ec_i <= 3; $ec_i++):
          $ec_pn = ec_option("provincia{$ec_i}_nome");
          $ec_pc = ec_option("provincia{$ec_i}_comuni");
          if (!$ec_pn) continue;
        ?>
        <div class="province-pill">
          <strong><?php echo esc_html($ec_pn); ?></strong>
          <span><?php echo esc_html($ec_pc); ?></span>
        </div>
        <?php endfor; ?>
      </div>

      <address class="area-address">
        <svg viewBox="0 0 24 24" class="icon" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
        <span><?php echo esc_html($ec_indirizzo_completo); ?></span>
      </address>
    </div>
    <div class="area-map reveal" id="mapContainer" data-map-src="https://www.google.com/maps?q=<?php echo rawurlencode(ec_option('google_maps_query', $ec_indirizzo_completo)); ?>&output=embed">
      <div class="map-placeholder">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C7.6 2 4 5.6 4 10c0 5.4 6.7 11.1 7.3 11.6.4.3 1 .3 1.4 0C13.3 21.1 20 15.4 20 10c0-4.4-3.6-8-8-8zm0 11c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3z"/></svg>
        <p>Per visualizzare la mappa di Google Maps è necessario accettare i cookie di terze parti.</p>
        <button type="button" class="btn btn-primary" id="loadMapBtn">Mostra la mappa</button>
      </div>
    </div>
  </div>
</section>

<section class="contact" id="contatti">
  <div class="container contact-inner">
    <div class="contact-copy reveal">
      <p class="eyebrow">Contatti</p>
      <h2>Parliamo del tuo progetto</h2>
      <p>Scrivici o chiamaci per un sopralluogo e un preventivo gratuito: rispondiamo il prima possibile.</p>

      <ul class="contact-list">
        <li>
          <span class="contact-label">Telefono</span>
          <a href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>"><?php echo esc_html($ec_tel1); ?></a>
          <?php if ($ec_tel2): ?><a href="<?php echo esc_attr(ec_tel_href($ec_tel2)); ?>"><?php echo esc_html($ec_tel2); ?></a><?php endif; ?>
        </li>
        <li>
          <span class="contact-label">WhatsApp</span>
          <a class="contact-whatsapp" href="<?php echo esc_url(ec_whatsapp_href($ec_tel1)); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.44 1.34 4.94L2 22l5.24-1.37a9.9 9.9 0 0 0 4.8 1.22h.01c5.5 0 9.96-4.46 9.96-9.96C22 6.46 17.55 2 12.04 2Zm5.8 14.15c-.24.68-1.4 1.3-1.93 1.36-.5.06-1.02.29-3.43-.72-2.9-1.2-4.77-4.15-4.92-4.34-.14-.2-1.17-1.56-1.17-2.97 0-1.41.74-2.1 1-2.39.27-.29.58-.36.77-.36.2 0 .39 0 .56.01.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.14.12.31.02.5-.1.2-.15.31-.3.48-.14.17-.3.37-.43.5-.14.14-.29.29-.13.57.17.29.75 1.24 1.6 2 1.11.99 2.04 1.3 2.33 1.44.29.14.46.12.63-.07.17-.2.72-.84.92-1.13.19-.29.39-.24.65-.14.27.1 1.68.79 1.97.94.29.14.48.21.55.33.07.12.07.7-.17 1.38Z"/></svg>
            Scrivi su WhatsApp
          </a>
        </li>
        <li>
          <span class="contact-label">Sede</span>
          <span><?php echo esc_html($ec_indirizzo_completo); ?></span>
        </li>
        <li>
          <span class="contact-label">P.IVA</span>
          <span><?php echo esc_html(ec_option('piva', '01767090051')); ?></span>
        </li>
      </ul>
    </div>

    <?php get_template_part('template-parts/contact-form', null, ['servizio' => 'Generale']); ?>
  </div>
</section>

<?php get_footer(); ?>
