<?php
/**
 * Template Name: Homepage
 */
get_header(); ?>

<div>

  <!-- Hero -->
  <section class="container flex items-center gap-10 py-16">
    <div class="w-1/2">
      <img
        src="<?php echo esc_url(get_template_directory_uri()); ?>/images/TEMP_IMAGES/room.jpg"
        alt="Clínica Dentária"
        class="w-full p-4 bg-white rounded-xl border-[16px] border-egg-light"
      />
    </div>

    <div class="w-1/2">
      <h1 class="leading-none mb-8">
        <span class="block uppercase text-[27px] font-normal">CLÍNICA DENTÁRIA</span>
        <span class="block uppercase">Noites Viegas</span>
      </h1>
      <p class="text-lg text-ink/70 max-w-md">
        <?php bloginfo("description"); ?>
      </p>
    </div>
  </section>

  <!-- Test section -->
  <section class="bg-ink text-egg-dark">
     <div class="container flex items-center gap-10 py-16">
      <div class="w-1/2">
        <h1 class="leading-none mb-8">Lorem Ipsum</h1>
        <p class="text-lg max-w-md">
          The 2025 ADHA Standards of Clinical Dental Hygiene Practice expand the role of the hygienist by emphasizing systemic health, risk assessment, and individualized care. This course highlights the key differences from the 2016 standards and shows how these updates transform everyday chairside conversations. Participants will learn how to align their practice with the new standards and confidently guide discussions that connect oral health to overall longevity and wellness.
        </p>
      </div>
      
      <div class="w-1/2">
        <img
          src="<?php echo esc_url(
            get_template_directory_uri(),
          ); ?>/images/TEMP_IMAGES/dentistry.jpg"
          alt="Clínica Dentária"
          class="w-full aspect-video bg-white rounded-xl border-[16px] border-egg-light"
        />
      </div>
     </div>
  </section>

  <!-- Test section -->
  <section class="bg-egg-dark">
     <div class="container flex items-center gap-10 pt-16 pb-28">
      <div class="w-1/2">
        <img
          src="<?php echo esc_url(
            get_template_directory_uri(),
          ); ?>/images/TEMP_IMAGES/the-humble-co-cADflhZzgyo-unsplash.jpg"
          alt="Clínica Dentária"
          class="w-full bg-white rounded-xl border-[16px] border-egg-light"
        />
      </div>
      <div class="w-1/2">
        <h1 class="leading-none mb-8">Escove os seus dentes</h1>
        <p class="text-lg max-w-md">
          The 2025 ADHA Standards of Clinical Dental Hygiene Practice expand the role of the hygienist by emphasizing systemic health, risk assessment, and individualized care. This course highlights the key differences from the 2016 standards and shows how these updates transform everyday chairside conversations. Participants will learn how to align their practice with the new standards and confidently guide discussions that connect oral health to overall longevity and wellness.
        </p>
      </div>
     </div>
  </section>

</div>

<?php get_footer(); ?>
