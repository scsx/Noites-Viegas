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

// ----------------------------------------------------
// Add Gallery Meta Box
// ----------------------------------------------------
add_action("add_meta_boxes", function () {
  add_meta_box(
    "caso_galeria",
    "Galeria de Imagens",
    "caso_galeria_callback",
    "caso_clinico",
    "normal",
    "high",
  );
});

function caso_galeria_callback($post)
{
  $images = get_post_meta($post->ID, "_caso_galeria", true) ?: [];
  wp_nonce_field("caso_galeria_nonce", "caso_galeria_nonce_field");
  ?>
  <div id="caso-galeria-wrapper">
    <button type="button" class="button select-images">Selecionar Imagens</button>

    <ul class="gallery-preview" style="display:flex;gap:8px;flex-wrap:wrap;margin-top:10px;">
      <?php foreach ($images as $id): ?>
        <li data-id="<?php echo esc_attr($id); ?>" style="position:relative;">
          <img src="<?php echo esc_url(
            wp_get_attachment_thumb_url($id),
          ); ?>" style="width:120px;height:120px;object-fit:cover;border-radius:4px;">
          <button type="button" class="remove-image" style="position:absolute;top:-6px;right:-6px;background:#dc2626;color:#fff;border:none;border-radius:50%;width:18px;height:18px;cursor:pointer;">
            <span style="position:absolute;top:-1px;left:6px;color:#fff;">x</span>
          </button>
        </li>
      <?php endforeach; ?>
    </ul>

    <input type="hidden" name="caso_galeria_ids" value="<?php echo esc_attr(
      implode(",", $images),
    ); ?>">
  </div>

  <script>
    jQuery(function($){
      const $input = $('input[name="caso_galeria_ids"]');
      const $preview = $('.gallery-preview');

      function renderPreview(ids) {
        $preview.empty();
        ids.forEach(id => {
          wp.media.attachment(id).fetch().then(att => {
            const thumb = att.attributes.sizes.thumbnail?.url || att.attributes.icon;
            const item = $(`
              <li data-id="${id}" style="position:relative;">
                <img src="${thumb}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;">
                <button type="button" class="remove-image" style="position:absolute;top:-6px;right:-6px;background:#dc2626;color:#fff;border:none;border-radius:50%;width:18px;height:18px;cursor:pointer;">×</button>
              </li>
            `);
            $preview.append(item);
          });
        });
      }

      function openMediaFrame() {
        const frame = wp.media({ multiple:true });

        frame.on('select', function() {
          const ids = frame.state().get('selection').map(img => img.id);
          const existing = $input.val() ? $input.val().split(',').map(Number) : [];
          const all = [...new Set([...existing, ...ids])];
          $input.val(all.join(','));
          renderPreview(all);
        });

        frame.open();
      }

      $('.select-images').on('click', e => {
        e.preventDefault();
        openMediaFrame();
      });

      $preview.on('click', '.remove-image', function(){
        const id = $(this).parent().data('id').toString();
        const ids = $input.val().split(',').filter(i => i && i !== id);
        $input.val(ids.join(','));
        $(this).parent().remove();
      });
    });
    </script>


  <?php
}

// Save selected images
add_action("save_post_caso_clinico", function ($post_id) {
  if (
    !isset($_POST["caso_galeria_nonce_field"]) ||
    !wp_verify_nonce($_POST["caso_galeria_nonce_field"], "caso_galeria_nonce")
  ) {
    return;
  }
  $ids = array_filter(array_map("intval", explode(",", $_POST["caso_galeria_ids"] ?? "")));
  update_post_meta($post_id, "_caso_galeria", $ids);
});

// Ensure WordPress media scripts are loaded
add_action("admin_enqueue_scripts", function () {
  wp_enqueue_media();
});
