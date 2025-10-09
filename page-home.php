<?php
/**
 * Template Name: Homepage
 */
get_header();

$textDiv = "w-[43%]";
$imageDiv = "w-[57%]";
?>


<?php function clinica_button($text, $url)
{
  return '
  <a href="' .
    esc_url($url) .
    '" class="relative group overflow-hidden border-2 border-blueLink text-blueLink px-8 py-1.5 inline-flex items-center rounded">
    <span class="absolute left-0 top-0 h-full w-0 bg-blueLink transition-all duration-300 group-hover:w-full"></span>
    <span class="relative z-10 flex items-center">
      <span class="text-lg transition-colors duration-300 group-hover:text-white">' .
    esc_html($text) .
    '</span>
      <span class="inline-block ml-2 mt-[1px] transition-colors duration-300 group-hover:text-white">></span>
    </span>
  </a>';
} ?>


<!-- Hero -->
<section class="min-h-[calc(100vh+80px)] flex items-center bg-cover bg-top -mt-[80px]"
  style="background-image: url('<?php echo esc_url(
    get_template_directory_uri(),
  ); ?>/images/TEMP_IMAGES/portrait.jpg');">
  <div class="container flex justify-end">
    <div class="w-[43%] pb-16">
      <h1 class="leading-none mb-8">
        <span class="block uppercase text-[27px] font-normal">CLÍNICA DENTÁRIA</span>
        <span class="block uppercase text-blueLink whitespace-nowrap">Noites Viegas</span>
      </h1>
      <p class="text-lg max-w-md">
        Localizada no coração de Lisboa, junto ao Saldanha, a Clínica Dentária Noites Viegas oferece um atendimento personalizado e de excelência em todas as áreas da medicina dentária.
      </p>
      <p class="mt-12">
        <?php echo clinica_button("Conhecer a Equipa", site_url("/equipa")); ?>
      </p>
    </div>
  </div>
</section>

<!-- Test section -->
<section>
  <div class="container flex items-center gap-10 pt-16 pb-28">
    <div class="<?php echo $textDiv; ?>">
      <h2 class="text-[60px] leading-none mb-8">Tratamentos</h2>
      <p class="text-lg max-w-md">
        Oferecemos uma ampla gama de tratamentos dentários, desde limpezas e branqueamentos até ortodontia, implantes, próteses e facetas estéticas. Cada serviço é realizado com tecnologia moderna e atenção ao detalhe, garantindo conforto, segurança e resultados duradouros em cada sorriso.
      </p>
      <p class="mt-12">
        <?php echo clinica_button("Ver Tratamentos", site_url("/tratamentos")); ?>
      </p>
    </div>
    <div class="<?php echo $imageDiv; ?>">
      <img
        src="<?php echo esc_url(
          get_template_directory_uri(),
        ); ?>/images/TEMP_IMAGES/the-humble-co-cADflhZzgyo-unsplash.jpg"
        alt="Clínica Dentária"
        class="w-full bg-white thickborder thickborder--egg-light"
      />
    </div>
  </div>
</section>

<!-- Test section -->
<section class="bg-ink text-egg-dark">
  <div class="container flex items-center gap-10 py-24">
    <div class="<?php echo $imageDiv; ?>">
      <img
        src="<?php echo esc_url(
          get_template_directory_uri(),
        ); ?>/images/TEMP_IMAGES/ozkan-guner-8DxcFmzlJ1Q-unsplash.jpg"
        alt="Clínica Dentária"
        class="w-full h-auto thickborder thickborder--ink-light"
      />
    </div>
    <div class="<?php echo $textDiv; ?>">
      <h2 class="text-[60px] leading-none mb-8">Clínica e Laboratório</h2>
      <p class="text-lg text-white max-w-md">
        Ter o nosso laboratório dentro da clínica permite criar próteses e coroas de forma mais rápida, precisa e personalizada. A comunicação direta entre dentista e técnico garante resultados estéticos e funcionais superiores — tudo num só lugar, sem esperas nem intermediários.
      </p>
      <p class="mt-12">
        <?php echo clinica_button("Contactos", site_url("/contactos")); ?>
      </p>
    </div>
  </div>
</section>

<!-- Test section -->
<section class="bg-egg-dark">
  <div class="container flex items-center gap-10 pt-16 pb-28">
    <div class="<?php echo $textDiv; ?>">
      <h2 class="text-[60px] leading-none mb-8">Casos Clínicos de sucesso</h2>
      <p class="text-lg max-w-md">
        Conheça alguns dos nossos casos clínicos de sucesso — transformações reais que refletem o cuidado, a experiência e a dedicação da nossa equipa. Cada sorriso recuperado é o resultado de um plano personalizado e de um compromisso com a excelência em estética e saúde oral.
      </p>
      <p class="mt-12">
        <?php echo clinica_button("Ver Casos", site_url("/casos-clinicos")); ?>
      </p>
    </div>
    <div class="<?php echo $imageDiv; ?>">
      <img
        src="<?php echo esc_url(
          get_template_directory_uri(),
        ); ?>/images/TEMP_IMAGES/before-after.jpg"
        alt="Clínica Dentária"
        class="w-full bg-white thickborder thickborder--egg-light"
      />
    </div>
  </div>
</section>

<?php get_footer(); ?>
