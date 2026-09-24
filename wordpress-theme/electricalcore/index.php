<?php
/**
 * Template di fallback richiesto da WordPress. Il sito è una one-page
 * (front-page.php) più le pagine Servizio (single-servizio.php) e le
 * pagine normali (page.php): questo file copre solo casi non previsti
 * (es. una ricerca o un URL non esistente).
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="service-section">
  <div class="container">
    <?php if (have_posts()): ?>
      <?php while (have_posts()): the_post(); ?>
        <article <?php post_class(); ?>>
          <h1><?php the_title(); ?></h1>
          <div><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <h1>Pagina non trovata</h1>
      <p><a href="<?php echo esc_url(home_url('/')); ?>">Torna alla home</a></p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
