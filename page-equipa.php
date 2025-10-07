<?php
/**
 * Template Name: Equipa
 */
get_header(); ?>

<main class="pagewrapper">
  <h1><?php the_title(); ?></h1>

  <?php
  $equipa = get_post_meta(get_the_ID(), "_equipa_repeater", true);
  if ($equipa): ?>
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($equipa as $m): ?>
        <div class="relative pb-16 flex flex-col items-center rounded-xl border-[16px] border-egg-light p-6 bg-white">
          <?php if (!empty($m["foto"])): ?>
            <img src="<?php echo esc_url(
              $m["foto"],
            ); ?>" alt="" class="w-64 h-64 object-cover rounded-full mb-8">
          <?php endif; ?>

          <?php if (!empty($m["nome"])): ?>
            <h2 class="mb-1"><?php echo esc_html($m["nome"]); ?></h2>
          <?php endif; ?>

          <?php if (!empty($m["cargo"])): ?>
            <p class="text-sm text-ink/60 mb-3"><?php echo esc_html($m["cargo"]); ?></p>
          <?php endif; ?>

          <?php if (!empty($m["bio"])): ?>
            <p class="text-[14px] text-ink leading-normal mt-4"><?php echo esc_html($m["bio"]); ?></p>
          <?php endif; ?>
          
          <?php if (!empty($m["url"])): ?>
          <?php
          $parsed = parse_url($m["url"]);
          $display = $parsed["host"] ?? $m["url"];
          if (!empty($parsed["path"])) {
            $display .= $parsed["path"];
          }
          $display = preg_replace("/^www\./", "", $display);
          ?>
          <a
            href="<?php echo esc_url($m["url"]); ?>"
            target="_blank"
            rel="noopener noreferrer"
            title="<?php echo esc_attr($m["url"]); ?>"
            class="block absolute bottom-6 left-6 text-sm text-blue-600 hover:underline max-w-[190px] overflow-hidden text-ellipsis whitespace-nowrap [overflow-wrap:normal] [word-break:normal] [hyphens:none]"
          >
            <?php echo esc_html($display); ?>
          </a>
        <?php endif; ?>

        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-ink/50">Nenhum membro definido ainda.</p>
  <?php endif;
  ?>
</main>

<?php get_footer(); ?>
