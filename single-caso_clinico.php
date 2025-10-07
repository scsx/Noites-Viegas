<?php get_header(); ?>

<main class="pagewrapper">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>
    <article class="mx-auto">
      <h1 class="leading-none"><?php the_title(); ?></h1>
      
      <?php if (has_post_thumbnail()): ?>
        <img src="<?php the_post_thumbnail_url(
          "large",
        ); ?>" alt="<?php the_title(); ?>" class="w-full rounded-lg mb-6">
      <?php endif; ?>

      <div class="prose max-w-none">
        <?php the_content(); ?>
      </div>

      <div class="mt-10">
        <a href="<?php echo get_post_type_archive_link(
          "caso_clinico",
        ); ?>" class="text-blue-600 hover:underline">
          ← Voltar aos casos clínicos
        </a>
      </div>
    </article>
  <?php
    endwhile;
  endif; ?>
</main>

<?php get_footer(); ?>
