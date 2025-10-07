<?php
/**
 * Template Name: Privacidade
 */
get_header(); ?>

<main class="pagewrapper">
  <h1><?php the_title(); ?></h1>

  <div class="prose max-w-none">
    <?php while (have_posts()):
      the_post();
      the_content();
    endwhile; ?>
  </div>
</main>

<?php get_footer(); ?>
