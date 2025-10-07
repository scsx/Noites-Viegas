<?php get_header(); ?>

<main class="pagewrapper">
  <h1>Casos Clínicos</h1>

  <?php if (have_posts()): ?>
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
      <?php while (have_posts()):
        the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="block rounded-xl border-[16px] border-egg-light bg-white hover:shadow-md transition">
          <?php if (has_post_thumbnail()): ?>
            <div class="bg-egg-light">
              <img src="<?php the_post_thumbnail_url(
                "medium",
              ); ?>" alt="<?php the_title(); ?>" class="w-full aspect-square object-cover rounded-t-lg mb-4">
            </div>
          <?php endif; ?>
          
          <div class="p-6">
            <h3 class="mb-4 leading-tight">
              <?php
              $clean_title = preg_replace('/\xC2\xA0/', " ", get_the_title());
              echo esc_html(trim($clean_title));
              ?>
            </h3>

            <p class="text-[14px]"><?php the_excerpt(); ?></p>
          </div>
        </a>
      <?php
      endwhile; ?>
    </div>
  <?php else: ?>
    <p>Nenhum caso clínico disponível.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
