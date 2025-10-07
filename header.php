<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class("min-h-screen flex flex-col font-poppins bg-egg text-ink"); ?>>
  <header class="py-6">
    <div class="container mx-auto flex items-center justify-between">
      <a href="<?php echo esc_url(home_url("/")); ?>" class="text-4xl font-bold">
        NOITES VIEGAS
      </a>

      <nav>
        <?php wp_nav_menu([
          "theme_location" => "main-menu",
          "container" => false,
          "menu_class" => "mainmenu flex gap-6 text-lg",
          "fallback_cb" => false,
        ]); ?>
      </nav>
    </div>
  
</header>
<main class="flex-grow container mx-auto py-16">