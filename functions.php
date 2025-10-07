<?php
/**
 * Tema Clínica Dentária
 * Funções principais
 */

// ----------------------------------------------------
// 🧩 Custom plugins (repeater fields)
// ----------------------------------------------------
require_once get_template_directory() . "/inc/plugins/servicos-repeater.php";
require_once get_template_directory() . "/inc/plugins/equipa-repeater.php";

// ----------------------------------------------------
// 🧩 Custom posts
// ----------------------------------------------------
require_once get_template_directory() . "/inc/custom-posts/casos-clinicos.php";

// ----------------------------------------------------
// 🧩 Enqueue CSS e fontes
// ----------------------------------------------------
add_action("wp_enqueue_scripts", function () {
  // Google Fonts
  wp_enqueue_style(
    "clinica-fonts",
    "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap",
    [],
    null,
  );

  // Tailwind build (dist/style.css)
  wp_enqueue_style(
    "clinica-style",
    get_template_directory_uri() . "/dist/style.css",
    ["clinica-fonts"],
    null,
  );
});

// ----------------------------------------------------
// 🧩 Registar menus, thumbnails
// ----------------------------------------------------
add_action("after_setup_theme", function () {
  register_nav_menus([
    "main-menu" => __("Main Menu", "clinica-theme"),
    "secondary-menu" => __("Menu secundário", "clinica-theme"),
  ]);

  add_theme_support("post-thumbnails");
});

// ----------------------------------------------------
// 🧩 Esconder “Campos Personalizados” nativos
// (excepto em templates específicos, ex. page-contact.php)
// ----------------------------------------------------
add_action("do_meta_boxes", function () {
  global $post;
  if (!$post) {
    return;
  }

  $template = get_page_template_slug($post->ID);

  // Só mantém os campos nativos no template Contactos
  if ($template !== "page-contact.php") {
    remove_meta_box("postcustom", "page", "normal");
  }
});
