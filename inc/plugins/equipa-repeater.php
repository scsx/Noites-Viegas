<?php
/**
 * Plugin: Equipa Repeater (Tema Clínica)
 * Description: Campos repetíveis (Nome, Cargo, Bio, Foto, URL) visíveis apenas no template page-equipa.php.
 * Author: Tu
 */

add_action("add_meta_boxes", function () {
  global $post;
  if (!$post) {
    return;
  }

  $template = get_page_template_slug($post->ID);
  if ($template !== "page-equipa.php") {
    return;
  }

  add_meta_box("equipa_repeater", "Equipa", "clinica_equipa_box", "page", "normal", "default");
});

function clinica_equipa_box($post)
{
  $equipa = get_post_meta($post->ID, "_equipa_repeater", true) ?: [];
  wp_nonce_field("equipa_repeater_nonce", "equipa_repeater_nonce_field");
  wp_enqueue_media();
  ?>
  <div id="equipa-repeater-wrapper">
    <?php foreach ($equipa as $i => $membro): ?>
      <div class="membro-item" style="margin-bottom:15px;border:1px solid #ddd;padding:10px;border-radius:6px;">
        <label><strong>Nome</strong></label>
        <input type="text" name="equipa_repeater[<?php echo $i; ?>][nome]" value="<?php echo esc_attr(
  $membro["nome"] ?? "",
); ?>" style="width:100%;margin-bottom:6px;">

        <label><strong>Cargo</strong></label>
        <input type="text" name="equipa_repeater[<?php echo $i; ?>][cargo]" value="<?php echo esc_attr(
  $membro["cargo"] ?? "",
); ?>" style="width:100%;margin-bottom:6px;">

        <label><strong>Bio</strong></label>
        <textarea name="equipa_repeater[<?php echo $i; ?>][bio]" rows="3" style="width:100%;margin-bottom:6px;"><?php echo esc_textarea(
  $membro["bio"] ?? "",
); ?></textarea>

        <label><strong>URL</strong> <small>(ex: LinkedIn, site, etc.)</small></label>
        <input type="url" name="equipa_repeater[<?php echo $i; ?>][url]" value="<?php echo esc_attr(
  $membro["url"] ?? "",
); ?>" style="width:100%;margin-bottom:6px;">

        <label><strong>Foto</strong></label><br>
        <?php $img = $membro["foto"] ?? ""; ?>
        <input type="hidden" name="equipa_repeater[<?php echo $i; ?>][foto]" value="<?php echo esc_attr(
  $img,
); ?>">
        <button type="button" class="button select-image">Selecionar Imagem</button>
        <div class="preview" style="margin-top:8px;">
          <?php if ($img): ?>
            <img src="<?php echo esc_url($img); ?>" style="max-width:100px;border-radius:6px;">
          <?php endif; ?>
        </div>

        <button type="button" class="button remove-membro" style="margin-top:8px;">Remover</button>
      </div>
    <?php endforeach; ?>
  </div>

  <button type="button" class="button" id="add-membro">Adicionar Membro</button>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const wrapper = document.querySelector('#equipa-repeater-wrapper');
      const addBtn = document.querySelector('#add-membro');

      addBtn.addEventListener('click', () => {
        const index = wrapper.querySelectorAll('.membro-item').length;
        const div = document.createElement('div');
        div.className = 'membro-item';
        div.style = 'margin-bottom:15px;border:1px solid #ddd;padding:10px;border-radius:6px;';
        div.innerHTML = `
          <label><strong>Nome</strong></label>
          <input type="text" name="equipa_repeater[${index}][nome]" style="width:100%;margin-bottom:6px;">
          <label><strong>Cargo</strong></label>
          <input type="text" name="equipa_repeater[${index}][cargo]" style="width:100%;margin-bottom:6px;">
          <label><strong>Bio</strong></label>
          <textarea name="equipa_repeater[${index}][bio]" rows="3" style="width:100%;margin-bottom:6px;"></textarea>
          <label><strong>URL</strong> <small>(ex: LinkedIn, site, etc.)</small></label>
          <input type="url" name="equipa_repeater[${index}][url]" style="width:100%;margin-bottom:6px;">
          <label><strong>Foto</strong></label><br>
          <input type="hidden" name="equipa_repeater[${index}][foto]">
          <button type="button" class="button select-image">Selecionar Imagem</button>
          <div class="preview" style="margin-top:8px;"></div>
          <button type="button" class="button remove-membro" style="margin-top:8px;">Remover</button>
        `;
        wrapper.appendChild(div);
      });

      wrapper.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-membro')) {
          e.target.closest('.membro-item').remove();
        }
        if (e.target.classList.contains('select-image')) {
          const button = e.target;
          const input = button.previousElementSibling;
          const preview = button.nextElementSibling;
          const frame = wp.media({
            title: 'Selecionar imagem',
            button: { text: 'Usar esta imagem' },
            multiple: false
          });
          frame.on('select', () => {
            const attachment = frame.state().get('selection').first().toJSON();
            input.value = attachment.url;
            preview.innerHTML = `<img src="${attachment.url}" style="max-width:100px;border-radius:6px;">`;
          });
          frame.open();
        }
      });
    });
  </script>
  <?php
}

add_action("save_post", function ($post_id) {
  if (
    !isset($_POST["equipa_repeater_nonce_field"]) ||
    !wp_verify_nonce($_POST["equipa_repeater_nonce_field"], "equipa_repeater_nonce")
  ) {
    return;
  }

  if (!isset($_POST["equipa_repeater"])) {
    delete_post_meta($post_id, "_equipa_repeater");
    return;
  }

  $equipa = array_values(
    array_filter($_POST["equipa_repeater"], function ($item) {
      return !empty($item["nome"]) ||
        !empty($item["cargo"]) ||
        !empty($item["bio"]) ||
        !empty($item["foto"]) ||
        !empty($item["url"]);
    }),
  );

  update_post_meta($post_id, "_equipa_repeater", $equipa);
});
