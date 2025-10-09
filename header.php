<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class("min-h-screen flex flex-col font-poppins bg-egg text-ink"); ?>>

<header class="py-4 sticky top-0 z-50 transition-colors duration-300 <?php echo is_front_page()
  ? "bg-transparent home-header"
  : "bg-egg"; ?>">
  <div class="container mx-auto flex items-end justify-between">
    <a href="<?php echo esc_url(
      home_url("/"),
    ); ?>" class="flex flex-col transition-opacity duration-300 logo <?php echo is_front_page()
  ? "opacity-0"
  : "opacity-100"; ?>">
      <span class="text-[12px] font-normal uppercase">Cliníca Dentária</span>
      <span class="text-3xl font-bold -mt-2">NOITES VIEGAS</span>
    </a>

    <nav class="w-[43%]">
      <?php wp_nav_menu([
        "theme_location" => "main-menu",
        "container" => false,
        "menu_class" => "mainmenu flex justify-between text-lg [&_.current-menu-item>a]:text-blueLink",
        "fallback_cb" => false,
      ]); ?>
    </nav>
  </div>

  <?php if (is_front_page()): ?>
  <!-- Script is here for convenience -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const header = document.querySelector('.home-header');
        const logo = document.querySelector('.home-header .logo');
        if (!header || !logo) return;

        window.addEventListener('scroll', () => {
          if (window.scrollY > 50) {
            header.classList.remove('bg-transparent');
            header.classList.add('bg-egg');
            logo.classList.remove('opacity-0');
            logo.classList.add('opacity-100');
          } else {
            header.classList.add('bg-transparent');
            header.classList.remove('bg-egg');
            logo.classList.add('opacity-0');
            logo.classList.remove('opacity-100');
          }
        });
      });
    </script>
  <?php endif; ?>
</header>
<main class="flex-grow <?php echo is_front_page() ? "" : "container mx-auto py-16"; ?>">
