<?php
/**
 * Template Name: Serviços
 */
get_header(); ?>

<main class="pagewrapper">
  <h1><?php the_title(); ?></h1>

  <?php
  $servicos = get_post_meta(get_the_ID(), "_servicos_repeater", true);

  if ($servicos): ?>
  <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($servicos as $s): ?>
      <div class="thickborder thickborder--egg-light bg-egg-light">
        <div class="rounded-lg bg-white p-6 flex flex-col justify-between h-full">
          <div class="relative pb-8 h-full">
            <?php if (!empty($s["titulo"])): ?>
              <h2 class="text-3xl font-semibold mb-[16px]"><?php echo esc_html(
                $s["titulo"],
              ); ?></h2>
            <?php endif; ?>
            <?php if (!empty($s["texto"])): ?>
              <p class="text-sm leading-relaxed"><?php echo esc_html($s["texto"]); ?></p>
            <?php endif; ?>
            <div class="absolute bottom-0 w-1/3 h-[5px] bg-egg-dark"></div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="thickborder thickborder--egg-light bg-egg-light">
        <div class="rounded-lg bg-white p-6 flex flex-col justify-between h-full">
          <div class="relative pb-8 h-full">
            <?php if (!empty($s["titulo"])): ?>
              <h2 class="text-3xl font-semibold mb-[16px] text-blueLink">Comece o seu tratamento</h2>
            <?php endif; ?>
            <?php if (!empty($s["texto"])): ?>
              <p class="leading-relaxed">Consulte os nossos <a class="font-semibold text-blueLink hover:text-blueLink-dark" href="<?php echo site_url(
                "/contactos",
              ); ?>">contactos</a> e marque uma visita.</p>
            <?php endif; ?>
            <div class="absolute bottom-0 w-1/3 h-[5px] bg-blueLink"></div>
          </div>
        </div>
      </div>
  </div>
<?php else: ?>
  <p class="text-ink/50">Nenhum serviço definido ainda.</p>
<?php endif;
  ?>

</main>

<?php get_footer(); ?>
