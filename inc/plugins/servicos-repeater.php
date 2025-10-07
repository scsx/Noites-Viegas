<?php
/**
 * Plugin: Serviços Repeater (Tema Clínica)
 * Description: Campo repetível simples (Título + Texto) visível apenas no template page-servicos.php.
 * Author: Tu
 */

add_action("add_meta_boxes", function () {
  global $post;

  if (!$post) {
    return;
  }

  $template = get_page_template_slug($post->ID);

  // Mostra apenas se o template for "page-servicos.php"
  if ($template !== "page-servicos.php") {
    return;
  }

  add_meta_box(
    "servicos_repeater",
    "Serviços",
    "clinica_servicos_box",
    "page",
    "normal",
    "default",
  );
});

function clinica_servicos_box($post)
{
  $servicos = get_post_meta($post->ID, "_servicos_repeater", true) ?: [];
  wp_nonce_field("servicos_repeater_nonce", "servicos_repeater_nonce_field");
  ?>
  <div id="servicos-repeater-wrapper">
    <?php foreach ($servicos as $i => $servico): ?>
      <div class="servico-item" style="margin-bottom:15px;border:1px solid #ddd;padding:10px;border-radius:6px;">
        <label><strong>Título</strong></label>
        <input type="text" name="servicos_repeater[<?php echo $i; ?>][titulo]" value="<?php echo esc_attr(
  $servico["titulo"] ?? "",
); ?>" style="width:100%;margin-bottom:6px;">
        <label><strong>Texto</strong></label>
        <textarea name="servicos_repeater[<?php echo $i; ?>][texto]" rows="3" style="width:100%;margin-bottom:6px;"><?php echo esc_textarea(
  $servico["texto"] ?? "",
); ?></textarea>
        <button type="button" class="button remove-servico">Remover</button>
      </div>
    <?php endforeach; ?>
  </div>
  <button type="button" class="button" id="add-servico">Adicionar Serviço</button>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const wrapper = document.querySelector('#servicos-repeater-wrapper');
      const addBtn = document.querySelector('#add-servico');

      addBtn.addEventListener('click', () => {
        const index = wrapper.querySelectorAll('.servico-item').length;
        const div = document.createElement('div');
        div.className = 'servico-item';
        div.style = 'margin-bottom:15px;border:1px solid #ddd;padding:10px;border-radius:6px;';
        div.innerHTML = `
          <label><strong>Título</strong></label>
          <input type="text" name="servicos_repeater[${index}][titulo]" style="width:100%;margin-bottom:6px;">
          <label><strong>Texto</strong></label>
          <textarea name="servicos_repeater[${index}][texto]" rows="3" style="width:100%;margin-bottom:6px;"></textarea>
          <button type="button" class="button remove-servico">Remover</button>
        `;
        wrapper.appendChild(div);
      });

      wrapper.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-servico')) {
          e.target.closest('.servico-item').remove();
        }
      });
    });
  </script>
  <?php
}

add_action("save_post", function ($post_id) {
  if (
    !isset($_POST["servicos_repeater_nonce_field"]) ||
    !wp_verify_nonce($_POST["servicos_repeater_nonce_field"], "servicos_repeater_nonce")
  ) {
    return;
  }

  if (!isset($_POST["servicos_repeater"])) {
    delete_post_meta($post_id, "_servicos_repeater");
    return;
  }

  $servicos = array_values(
    array_filter($_POST["servicos_repeater"], function ($item) {
      return !empty($item["titulo"]) || !empty($item["texto"]);
    }),
  );

  update_post_meta($post_id, "_servicos_repeater", $servicos);
});
