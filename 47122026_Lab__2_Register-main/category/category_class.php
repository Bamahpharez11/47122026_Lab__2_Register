<?php
require_once("../settings/db_class.php");

class Category extends db_connection {
    // Add a new category
    public function add($user_id, $name) {
        $sql = "INSERT INTO categories (user_id, name) VALUES (?, ?)";
        return $this->db_query($sql, [$user_id, $name]);
    }

    // Get all categories by user
    public function get_by_user($user_id) {
        $sql = "SELECT * FROM categories WHERE user_id = ?";
        return $this->db_fetch_all($sql, [$user_id]);
    }

    // Update category name
    public function update($cat_id, $user_id, $name) {
        $sql = "UPDATE categories SET name = ? WHERE id = ? AND user_id = ?";
        return $this->db_query($sql, [$name, $cat_id, $user_id]);
    }

    // Delete category
    public function delete($cat_id, $user_id) {
        $sql = "DELETE FROM categories WHERE id = ? AND user_id = ?";
        return $this->db_query($sql, [$cat_id, $user_id]);
    }

    // Check if category name exists for user
    public function name_exists($user_id, $name) {
        $sql = "SELECT id FROM categories WHERE user_id = ? AND name = ?";
        return $this->db_fetch_one($sql, [$user_id, $name]);
    }
}
?>