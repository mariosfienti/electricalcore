<?php
/**
 * Template per la pagina di dettaglio di un singolo Servizio.
 * Un solo file sostituisce le 5 pagine HTML duplicate del sito statico:
 * i contenuti vengono dai campi ACF del post (vedi inc/acf-fields.php).
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()):
  the_post();
  $ec_id = get_the_ID();
  $ec_slug = get_post_field('post_name', $ec_id);
  $ec_tel1 = ec_option('telefono_principale', '338 4444117');
  $ec_tel2 = ec_option('telefono_secondario', '327 5669119');
  $ec_hero_img_url = ec_service_image_url($ec_id, $ec_slug, 'ec-service-hero');
  $ec_badges = ec_lines_to_list(ec_field('hero_badges', ''));
?>

<section class="service-page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Percorso di navigazione">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span class="breadcrumb-sep">/</span>
      <a href="<?php echo esc_url(home_url('/#servizi')); ?>">Servizi</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-current" aria-current="page"><?php the_title(); ?></span>
    </nav>

    <div class="service-page-hero-grid">
      <div class="service-hero-copy reveal reveal-onload">
        <p class="eyebrow"><?php echo esc_html(ec_field('hero_eyebrow', '')); ?></p>
        <h1><?php the_title(); ?></h1>
        <p class="hero-lead"><?php echo esc_html(ec_field('hero_lead', get_the_excerpt())); ?></p>
        <div class="hero-actions">
          <a class="btn btn-primary btn-lg" href="#richiesta">Richiedi preventivo gratuito</a>
          <a class="btn btn-ghost btn-lg" href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>">
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.4.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.3 21 3 13.7 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/></svg>
            <?php echo esc_html($ec_tel1); ?>
          </a>
        </div>
        <?php if ($ec_badges): ?>
        <div class="spec-badges-list">
          <?php foreach ($ec_badges as $ec_b): ?>
          <span class="spec-badge-item">
            <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            <?php echo esc_html($ec_b); ?>
          </span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="service-hero-media reveal reveal-zoom reveal-onload">
        <img src="<?php echo esc_url($ec_hero_img_url); ?>" alt="<?php the_title_attribute(); ?>" class="service-hero-img" width="600" height="450">
      </div>
    </div>
  </div>
</section>

<?php
  $ec_has_pillars = ec_field('pillar1_titolo', '') || ec_field('pillar2_titolo', '') || ec_field('pillar3_titolo', '');
  if ($ec_has_pillars):
?>
<section class="service-section">
  <div class="container">
    <p class="eyebrow center"><?php echo esc_html(ec_field('ambiti_eyebrow', 'Ambiti di intervento')); ?></p>
    <h2 class="section-title center"><?php echo esc_html(ec_field('ambiti_titolo', 'Soluzioni complete per ogni esigenza')); ?></h2>
    <?php if (ec_field('ambiti_testo', '')): ?><p class="section-lead center"><?php echo esc_html(ec_field('ambiti_testo', '')); ?></p><?php endif; ?>

    <div class="pillar-grid reveal-stagger">
      <?php for ($ec_i = 1; $ec_i <= 3; $ec_i++):
        $ec_pt = ec_field("pillar{$ec_i}_titolo", '');
        $ec_pd = ec_field("pillar{$ec_i}_desc", '');
        $ec_pl = ec_lines_to_list(ec_field("pillar{$ec_i}_elenco", ''));
        if (!$ec_pt) continue;
      ?>
      <div class="pillar-card">
        <div class="pillar-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24"><path d="<?php echo esc_attr(ec_field('icona_svg_path', ec_default_service_icon_path($ec_slug))); ?>"/></svg>
        </div>
        <h3><?php echo esc_html($ec_pt); ?></h3>
        <?php if ($ec_pd): ?><p><?php echo esc_html($ec_pd); ?></p><?php endif; ?>
        <?php if ($ec_pl): ?>
        <ul>
          <?php foreach ($ec_pl as $ec_voce): ?><li><?php echo esc_html($ec_voce); ?></li><?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
  $ec_has_steps = ec_field('step1_titolo', '') || ec_field('step2_titolo', '') || ec_field('step3_titolo', '') || ec_field('step4_titolo', '');
  if ($ec_has_steps):
?>
<section class="service-section alt-bg">
  <div class="container">
    <p class="eyebrow center"><?php echo esc_html(ec_field('workflow_eyebrow', 'Come lavoriamo')); ?></p>
    <h2 class="section-title center"><?php echo esc_html(ec_field('workflow_titolo', "Dall'idea al collaudo finale")); ?></h2>
    <?php if (ec_field('workflow_testo', '')): ?><p class="section-lead center"><?php echo esc_html(ec_field('workflow_testo', '')); ?></p><?php endif; ?>

    <div class="workflow-grid reveal-stagger">
      <?php for ($ec_i = 1; $ec_i <= 4; $ec_i++):
        $ec_st = ec_field("step{$ec_i}_titolo", '');
        $ec_sd = ec_field("step{$ec_i}_desc", '');
        if (!$ec_st) continue;
      ?>
      <div class="workflow-step">
        <span class="step-num"><?php echo (int) $ec_i; ?></span>
        <h4><?php echo esc_html($ec_st); ?></h4>
        <?php if ($ec_sd): ?><p><?php echo esc_html($ec_sd); ?></p><?php endif; ?>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
  $ec_has_faq = ec_field('faq1_domanda', '') || ec_field('faq2_domanda', '') || ec_field('faq3_domanda', '') || ec_field('faq4_domanda', '');
  if ($ec_has_faq):
?>
<section class="service-section">
  <div class="container">
    <p class="eyebrow center">FAQ</p>
    <h2 class="section-title center">Domande frequenti</h2>

    <div class="faq-grid reveal-stagger">
      <?php for ($ec_i = 1; $ec_i <= 4; $ec_i++):
        $ec_fd = ec_field("faq{$ec_i}_domanda", '');
        $ec_fr = ec_field("faq{$ec_i}_risposta", '');
        if (!$ec_fd) continue;
      ?>
      <div class="faq-item">
        <h4><?php echo esc_html($ec_fd); ?></h4>
        <?php if ($ec_fr): ?><p><?php echo esc_html($ec_fr); ?></p><?php endif; ?>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (get_the_content()): ?>
<section class="service-section">
  <div class="container legal-container">
    <?php the_content(); ?>
  </div>
</section>
<?php endif; ?>

<section class="contact" id="richiesta">
  <div class="container">
    <div class="contact-inner">
      <div class="contact-info reveal">
        <p class="eyebrow">Preventivo gratuito</p>
        <h2>Richiedi informazioni su <?php the_title(); ?></h2>
        <p>Contattaci senza impegno: studieremo la soluzione più adatta alle tue esigenze e ti forniremo un preventivo trasparente.</p>

        <ul class="contact-details">
          <li>
            <strong>Telefono:</strong>
            <a href="<?php echo esc_attr(ec_tel_href($ec_tel1)); ?>"><?php echo esc_html($ec_tel1); ?></a><?php if ($ec_tel2): ?> / <a href="<?php echo esc_attr(ec_tel_href($ec_tel2)); ?>"><?php echo esc_html($ec_tel2); ?></a><?php endif; ?>
          </li>
          <li>
            <strong>WhatsApp:</strong>
            <a class="contact-whatsapp" href="<?php echo esc_url(ec_whatsapp_href($ec_tel1)); ?>" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.44 1.34 4.94L2 22l5.24-1.37a9.9 9.9 0 0 0 4.8 1.22h.01c5.5 0 9.96-4.46 9.96-9.96C22 6.46 17.55 2 12.04 2Zm5.8 14.15c-.24.68-1.4 1.3-1.93 1.36-.5.06-1.02.29-3.43-.72-2.9-1.2-4.77-4.15-4.92-4.34-.14-.2-1.17-1.56-1.17-2.97 0-1.41.74-2.1 1-2.39.27-.29.58-.36.77-.36.2 0 .39 0 .56.01.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.14.12.31.02.5-.1.2-.15.31-.3.48-.14.17-.3.37-.43.5-.14.14-.29.29-.13.57.17.29.75 1.24 1.6 2 1.11.99 2.04 1.3 2.33 1.44.29.14.46.12.63-.07.17-.2.72-.84.92-1.13.19-.29.39-.24.65-.14.27.1 1.68.79 1.97.94.29.14.48.21.55.33.07.12.07.7-.17 1.38Z"/></svg>
              Scrivi su WhatsApp
            </a>
          </li>
          <li>
            <strong>Sede:</strong>
            <?php echo esc_html(trim(ec_option('indirizzo', 'Frazione Bardella 34') . ', ' . ec_option('cap', '14022') . ' ' . ec_option('comune', 'Castelnuovo Don Bosco') . ' (' . ec_option('provincia_sigla', 'AT') . ')')); ?>
          </li>
        </ul>
      </div>

      <?php get_template_part('template-parts/contact-form', null, ['servizio' => get_the_title()]); ?>
    </div>
  </div>
</section>

<?php
  $ec_related = ec_get_servizi(4, $ec_id);
  if ($ec_related):
?>
<section class="service-section alt-bg">
  <div class="container">
    <p class="eyebrow center">Competenza a 360°</p>
    <h2 class="section-title center">Esplora gli altri servizi Electrical Core</h2>

    <div class="related-services-grid reveal-stagger">
      <?php foreach ($ec_related as $ec_r): ?>
      <a href="<?php echo esc_url(get_permalink($ec_r)); ?>" class="related-service-card">
        <strong><?php echo esc_html(get_the_title($ec_r)); ?></strong>
        <p style="font-size:0.84rem;color:var(--color-text-muted);margin:0;"><?php echo esc_html(ec_field('sottotitolo_breve', '', $ec_r->ID)); ?></p>
        <span>Scopri il servizio &rarr;</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
