<?php
/**
 * Template generico per le pagine "normali" (es. Informativa Privacy):
 * il contenuto è quello scritto nell'editor di WordPress.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()):
  the_post();
?>

<section class="legal-page">
  <div class="container legal-container">
    <nav class="breadcrumb" aria-label="Percorso di navigazione">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-current" aria-current="page"><?php the_title(); ?></span>
    </nav>

    <p class="eyebrow"><?php bloginfo('name'); ?></p>
    <h1><?php the_title(); ?></h1>
    <p class="legal-updated">Ultimo aggiornamento: <?php echo esc_html(get_the_modified_date()); ?></p>

    <?php the_content(); ?>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
