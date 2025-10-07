<?php
// Enqueue Tailwind CSS build (dist/style.css) so it loads on every page
add_action("wp_enqueue_scripts", function () {
  wp_enqueue_style("clinica-style", get_template_directory_uri() . "/dist/style.css", [], null);
});

// Register navigation menus
add_action("after_setup_theme", function () {
  register_nav_menus([
    "main-menu" => __("Main Menu", "clinica-theme"),
  ]);
});

add_action("wp_enqueue_scripts", function () {
  // Google Fonts
  wp_enqueue_style(
    "clinica-fonts",
    "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap",
    [],
    null,
  );

  // Tailwind build
  wp_enqueue_style("clinica-style", get_template_directory_uri() . "/dist/style.css", [], null);
});
