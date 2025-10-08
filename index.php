<?php get_header(); ?>

<main class="pagewrapper">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>
    <article <?php post_class("mb-12"); ?>>
      <h1 class="mb-4"><?php the_title(); ?></h1>

      <div class="prose max-w-none">
        <?php the_content(); ?>
      </div>
    </article>
  <?php
    endwhile;
  else:
     ?>
    <p>Não há conteúdo disponível.</p>
  <?php
  endif; ?>
</main>

<?php get_footer(); ?>
