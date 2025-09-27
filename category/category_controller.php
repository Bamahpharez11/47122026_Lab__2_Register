<?php
require_once("../classes/category_class.php");

function add_category_ctr($user_id, $name) {
    $cat = new Category();
    if ($cat->name_exists($user_id, $name)) {
        return false; // Name already exists
    }
    return $cat->add($user_id, $name);
}

function get_categories_ctr($user_id) {
    $cat = new Category();
    return $cat->get_by_user($user_id);
}

function update_category_ctr($cat_id, $user_id, $name) {
    $cat = new Category();
    return $cat->update($cat_id, $user_id, $name);
}

function delete_category_ctr($cat_id, $user_id) {
    $cat = new Category();
    return $cat->delete($cat_id, $user_id);
}
?>
