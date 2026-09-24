<?php
/**
 * Intestazione del sito: topbar, header con logo, menu con dropdown
 * "Servizi" generato dinamicamente dai post del CPT servizio.
 */

if (!defined('ABSPATH')) {
    exit;
}

$ec_is_home = is_front_page();
$ec_anchor = fn($hash) => $ec_is_home ? $hash : home_url('/' . $hash);

$ec_tel1 = ec_option('telefono_principale', '338 4444117');
$ec_tel2 = ec_option('telefono_secondario', '327 5669119');
$ec_email = ec_option('email', 'info@electricalcore.it');
$ec_servizi_nav = ec_get_servizi();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#D9382B">
<?php if (!has_site_icon()): ?>
<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.png'); ?>">
<?php endif; ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ElectricalContractor",
  "name": "Electrical Core SNC",
  "slogan": "Ti connettiamo al futuro",
  "email": "<?php echo esc_js($ec_email); ?>",
  "telephone": ["+39 <?php echo esc_js($ec_tel1); ?>", "+39 <?php echo esc_js($ec_tel2); ?>"],
  "vatID": "<?php echo esc_js(ec_option('piva', '01767090051')); ?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?php echo esc_js(ec_option('indirizzo', 'Frazione Bardella 34')); ?>",
    "postalCode": "<?php echo esc_js(ec_option('cap', '14022')); ?>",
    "addressLocality": "<?php echo esc_js(ec_option('comune', 'Castelnuovo Don Bosco')); ?>",
    "addressRegion": "<?php echo esc_js(ec_option('provincia_sigla', 'AT')); ?>",
    "addressCountry": "IT"
  },
  "areaServed": ["Asti", "Torino", "Cuneo", "Piemonte"],
  "url": "<?php echo esc_url(home_url('/')); ?>"
}
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ($ec_is_home): ?><div id="top"></div><?php endif; ?>
<a class="skip-link" href="#main">Vai al contenuto</a>

<div class="topbar">
  <div class="container topbar-inner">
    <a class="topbar-item" href="mailto:<?php echo esc_attr($ec_email); ?>">
      <svg viewBox="0 0 24 24"><path d="m3 6 9 6 9-6"/><rect x="3" y="5" width="18" height="14" rx="2"/></svg>
      <?php echo esc_html($ec_email); ?>
    </a>
    <span class="topbar-right">
      <a class="topbar-phone" href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 3a2 2 0 0 1-.4 2.1L8 10.3a16 16 0 0 0 5.7 5.7l1.5-1.4a2 2 0 0 1 2.1-.4c1 .4 2 .6 3 .7a2 2 0 0 1 1.7 2Z"/></svg><?php echo esc_html($ec_tel1); ?></a>
    </span>
  </div>
</div>

<header class="site-header"<?php echo $ec_is_home ? '' : ' id="top"'; ?>>
  <div class="container header-inner">
    <a class="brand" href="<?php echo esc_url($ec_is_home ? '#top' : home_url('/')); ?>" aria-label="Electrical Core - Home">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-header.webp'); ?>" alt="Electrical Core" class="brand-logo">
    </a>

    <button class="nav-toggle" id="navToggle" aria-expanded="false" aria-controls="primaryNav" aria-label="Apri il menu">
      <span></span><span></span><span></span>
    </button>

    <nav class="primary-nav" id="primaryNav">
      <div class="nav-dropdown" id="servicesDropdown">
        <a href="<?php echo esc_url($ec_anchor('#servizi')); ?>" class="nav-dropdown-toggle" id="servicesToggle" aria-expanded="false" aria-haspopup="true" aria-controls="servicesMenu">
          <span>Servizi</span>
          <svg class="dropdown-chevron" viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path d="M7 10l5 5 5-5z" fill="currentColor"/></svg>
        </a>
        <div class="nav-dropdown-menu" id="servicesMenu" role="menu" aria-label="Elenco servizi">
          <?php foreach ($ec_servizi_nav as $ec_s):
            $ec_current = is_singular('servizio') && get_the_ID() === $ec_s->ID;
          ?>
          <a href="<?php echo esc_url(get_permalink($ec_s)); ?>" class="dropdown-item" role="menuitem" <?php echo $ec_current ? 'style="background:#F8FAFC;"' : ''; ?>>
            <span class="dropdown-item-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="<?php echo esc_attr(ec_field('icona_svg_path', ec_default_service_icon_path($ec_s->post_name), $ec_s->ID)); ?>"/></svg>
            </span>
            <span class="dropdown-item-info">
              <span class="dropdown-item-title" <?php echo $ec_current ? 'style="color:var(--color-red);"' : ''; ?>><?php echo esc_html(get_the_title($ec_s)); ?></span>
              <span class="dropdown-item-desc"><?php echo esc_html(ec_field('sottotitolo_breve', '', $ec_s->ID)); ?></span>
            </span>
          </a>
          <?php endforeach; ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo esc_url($ec_anchor('#servizi')); ?>" class="dropdown-all-link" role="menuitem">
            <span>Panoramica tutti i servizi</span>
            <span aria-hidden="true">&rarr;</span>
          </a>
        </div>
      </div>
      <a href="<?php echo esc_url($ec_anchor('#chi-siamo')); ?>">Chi siamo</a>
      <a href="<?php echo esc_url($ec_anchor('#dove-siamo')); ?>">Dove siamo</a>
      <a href="<?php echo esc_url($ec_anchor('#contatti')); ?>">Contatti</a>
      <a class="btn btn-primary nav-cta" href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>">Chiama ora</a>
    </nav>
  </div>
</header>

<main id="main">
