<?php
/**
 * Template Name: Contacts
 */
get_header();

/* CONTACT FORM */
// --- Ler os campos personalizados ---
$mostrar_form = get_post_meta(get_the_ID(), "mostrar_form", true);
$email_form = get_post_meta(get_the_ID(), "email_form", true);

// --- Processar o formulário ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && $mostrar_form) {
  $nome = sanitize_text_field($_POST["nome"]);
  $email = sanitize_email($_POST["email"]);
  $mensagem = sanitize_textarea_field($_POST["mensagem"]);

  // Usa o email definido no campo; se estiver vazio, usa o admin
  $to = $email_form ?: get_option("admin_email");
  $subject = "Nova marcação de consulta de $nome";
  $body = "Nome: $nome\nEmail: $email\nMensagem:\n$mensagem";
  $headers = ["Content-Type: text/plain; charset=UTF-8"];

  if (wp_mail($to, $subject, $body, $headers)) {
    echo '<p class="text-green-600 mb-4">Pedido enviado com sucesso!</p>';
  } else {
    echo '<p class="text-red-600 mb-4">Ocorreu um erro ao enviar. Tenta mais tarde.</p>';
  }
}
?>


<main class="pagewrapper">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>
    <h1 class="mb-8"><?php the_title(); ?></h1>

    <div class="flex gap-x-16">
      <div class="w-1/2">
        <div class="prose prose-a:no-underline hover:prose-a:underline max-w-none">
          <?php the_content(); ?>
        </div>
      </div>

      <div class="w-1/2">
        <!-- FORM -->
        <?php if ($mostrar_form): ?>

          <h3 class="text-ink font-semibold text-[1.25em] mt-0 mb-0 leading-[1.6]">Marcações</h3>
          <form method="post" class="p-6 thickborder thickborder--egg-light bg-white space-y-4 mt-4">
            <div>
              <label for="nome" class="block">Nome</label>
              <input type="text" id="nome" name="nome" required class="w-full border-b-2 border-egg-dark p-2 pb-1">
            </div>

            <div>
              <label for="email" class="block">Email</label>
              <input type="email" id="email" name="email" required class="w-full border-b-2 border-egg-dark p-2 pb-1">
            </div>

            <div>
              <label for="mensagem" class="block">Mensagem</label>
              <textarea id="mensagem" name="mensagem" rows="2" required class="w-full border-b-2 border-egg-dark p-2 pb-1 resize-y"></textarea>
            </div>

            <div class="flex items-center gap-x-4">
              <button type="submit" class="relative group overflow-hidden border-2 border-blueLink text-blueLink px-8 py-1 flex items-center">
                <span class="absolute left-0 top-0 h-full w-0 bg-blueLink transition-all duration-300 group-hover:w-full"></span>
                <span class="relative z-10 flex items-center">
                  <span class="transition-colors duration-300 group-hover:text-white">Enviar</span>
                  <span class="inline-block ml-2 mt-1 transition-colors duration-300 group-hover:text-white">></span>
                </span>
              </button>

              <?php
              $mensagem = get_post_meta(get_the_ID(), "mensagem_form", true);
              if ($mensagem): ?>
                <p class="text-sm italic text-ink/50"><?php echo esc_html($mensagem); ?></p>
              <?php endif;
              ?>
            </div>
            

          </form>
        <?php endif; ?>
        
      </div>
    </div>

    <div class="aspect-video mt-16">
      <div class="rounded-xl thickborder thickborder--egg-light bg-egg-light h-full">
        <iframe
          src="https://maps.google.com/maps?q=38.733220,-9.143780&z=15&output=embed"
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen
          loading="lazy"
          class="rounded-xl aspect-square"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  <?php
    endwhile;
  endif; ?>
</main>

<?php get_footer(); ?>
