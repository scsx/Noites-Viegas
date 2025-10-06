<?php
// Enqueue Tailwind CSS build (dist/style.css) so it loads on every page
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('clinica-style', get_template_directory_uri() . '/dist/style.css', [], null);
});