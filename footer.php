  </main>

  <footer class="mt-auto bg-egg-dark py-8">
    <div class="container mx-auto flex items-center justify-between">
      
      <p class="text-left text-sm">
        © <?php echo date("Y"); ?> Clínica Dentária Noites Viegas. Todos os direitos reservados.
      </p>
      
      <?php wp_nav_menu([
        "theme_location" => "secondary-menu",
        "container" => false,
        "menu_class" => "secondarymenu flex gap-6 text-ink/70 [&_a:hover]:text-ink transition-colors",
        "fallback_cb" => false,
      ]); ?>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
