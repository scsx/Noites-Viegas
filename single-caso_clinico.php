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
            <div class="w-1/3 h-[10px] bg-egg-dark mt-8"></div>
          </h1>
        </div>

        <div class="flex gap-x-8 pt-8">
          <div class="w-2/3">
            <div class="prose prose-a:no-underline hover:prose-a:underline max-w-none">
              <?php the_content(); ?>
            </div>
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
              $colsClass =
                $count >= 3 ? "grid-cols-3" : ($count === 2 ? "grid-cols-2" : "grid-cols-1");
              ?>

              <div class="pt-2 grid gap-4 <?php echo $colsClass; ?>">
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
                <button id="prev-btn" class="arrow-btn left-6 rotate-180"></button>
                <img id="lightbox-img" src="" class="max-h-[90%] max-w-[90%] rounded-lg" alt="">
                <button id="next-btn" class="arrow-btn right-6"></button>
                <button id="close-btn" class="close-btn top-6 right-6"></button>
              </div>

              <script>
                document.addEventListener('DOMContentLoaded', () => {
                  const thumbs = [...document.querySelectorAll('.gallery-thumb')];
                  const lightbox = document.getElementById('lightbox');
                  const img = document.getElementById('lightbox-img');
                  let current = 0;

                  function show(i) {
                    current = (i + thumbs.length) % thumbs.length;
                    img.src = thumbs[current].dataset.full;
                    lightbox.classList.remove('hidden');
                  }

                  thumbs.forEach((t, i) => t.addEventListener('click', () => show(i)));

                  document.getElementById('prev-btn').addEventListener('click', e => {
                    e.stopPropagation();
                    show(current - 1);
                  });

                  document.getElementById('next-btn').addEventListener('click', e => {
                    e.stopPropagation();
                    show(current + 1);
                  });

                  // 🔹 fecha com o botão da cruz
                  document.getElementById('close-btn').addEventListener('click', e => {
                    e.stopPropagation();
                    lightbox.classList.add('hidden');
                  });

                  document.addEventListener('keydown', e => {
                    if (lightbox.classList.contains('hidden')) return;
                    if (e.key === 'ArrowLeft') show(current - 1);
                    if (e.key === 'ArrowRight') show(current + 1);
                    if (e.key === 'Escape') lightbox.classList.add('hidden');
                  });

                  lightbox.addEventListener('click', e => {
                    if (e.target === lightbox) lightbox.classList.add('hidden');
                  });
                });
                </script>
            <?php
            endif;
            ?>
          </div>
          
        </div>

        <div class="mt-10">
          <a class="simplelink" href="<?php echo get_post_type_archive_link("caso_clinico"); ?>">
            ← Voltar a casos clínicos
          </a>
        </div>
      </article>
  <?php
    endwhile;
  endif; ?>
</div>

<?php get_footer(); ?>
