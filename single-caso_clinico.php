<?php get_header(); ?>

<div class="pagewrapper">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>
      <article>

        <div class="flex gap-x-8">
          <h1 class="w-2/3 leading-none mb-4">
            <?php
            $raw_title = get_the_title();
            $clean_title = preg_replace('/\xC2\xA0/', " ", $raw_title);
            echo esc_html(trim($clean_title));
            ?>
          </h1>

          <!-- <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url(
              "large",
            ); ?>" alt="<?php the_title(); ?>" class="w-1/3 rounded-lg">
          <?php endif; ?> -->
        </div>

        <div class="flex gap-x-8 mt-12">
          <div class="prose w-2/3">
            <?php the_content(); ?>
          </div>
          <div class="w-1/3">
            <?php
            $meta_value = get_post_meta(get_the_ID(), "_caso_galeria", true);
            $galeria = is_array($meta_value) ? $meta_value : [];

            if (has_post_thumbnail()) {
              $featured_id = get_post_thumbnail_id();
              array_unshift($galeria, $featured_id);
            }

            if (!empty($galeria)):

              $count = count($galeria);
              $cols = $count >= 3 ? 3 : $count;
              ?>
              <div class="grid gap-4 <?php echo "grid-cols-" . $cols; ?>">
                <?php foreach ($galeria as $id):
                  $full = wp_get_attachment_image_url($id, "large");
                  $thumb = wp_get_attachment_image($id, "medium", false, [
                    "class" =>
                      "w-full aspect-square object-cover rounded-lg cursor-pointer gallery-thumb",
                    "data-full" => $full,
                  ]);
                  echo $thumb;
                endforeach; ?>
              </div>

              <div id="lightbox" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
                <img id="lightbox-img" src="" class="max-h-[90%] max-w-[90%] rounded-lg" alt="">
              </div>

              <script>
                document.addEventListener('click', e => {
                  const t = e.target;
                  if (t.classList.contains('gallery-thumb')) {
                    document.getElementById('lightbox-img').src = t.dataset.full;
                    document.getElementById('lightbox').classList.remove('hidden');
                  }
                  if (t.id === 'lightbox') t.classList.add('hidden');
                });
              </script>
            <?php
            endif;
            ?>
          </div>
          
        </div>

        <div class="mt-10">
          <a href="<?php echo get_post_type_archive_link(
            "caso_clinico",
          ); ?>" class="text-blue-600 hover:underline">
            ← Voltar a casos clínicos
          </a>
        </div>
      </article>
  <?php
    endwhile;
  endif; ?>
</div>

<?php get_footer(); ?>
