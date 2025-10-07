<?php
/**
 * Template Name: Contacts Page
 */

get_header();

$line1 = get_post_meta(get_the_ID(), "Address Line 1", true);
$line2 = get_post_meta(get_the_ID(), "Address Line 2", true);
$telefone = get_post_meta(get_the_ID(), "Telefone 1", true);
?>

<main class="container mx-auto py-16">
  <h1><?php the_title(); ?></h1>

  <div class="space-y-2 text-lg">
    <?php if ($line1): ?>
      <p><?php echo esc_html($line1); ?></p>
    <?php endif; ?>

    <?php if ($line2): ?>
      <p><?php echo esc_html($line2); ?></p>
    <?php endif; ?>

    <?php if ($telefone): ?>
      <p>📞 <?php echo esc_html($telefone); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
