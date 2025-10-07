<?php
// Register Custom Post Type: Casos Clínicos
add_action("init", function () {
  $labels = [
    "name" => "Casos Clínicos",
    "singular_name" => "Caso Clínico",
    "menu_name" => "Casos Clínicos",
    "name_admin_bar" => "Casos Clínicos",
    "add_new" => "Adicionar Novo",
    "add_new_item" => "Adicionar Novo Caso",
    "edit_item" => "Editar Caso",
    "new_item" => "Novo Caso",
    "view_item" => "Ver Caso",
    "view_items" => "Ver Casos",
    "search_items" => "Procurar Casos",
    "not_found" => "Nenhum caso encontrado",
    "not_found_in_trash" => "Nenhum caso na reciclagem",
  ];

  $args = [
    "labels" => $labels,
    "public" => true,
    "has_archive" => true,
    "rewrite" => ["slug" => "casos-clinicos"],
    "menu_icon" => "dashicons-smiley",
    "supports" => ["title", "editor", "thumbnail", "excerpt"],
    "show_in_rest" => true,
  ];

  register_post_type("caso_clinico", $args);
});
