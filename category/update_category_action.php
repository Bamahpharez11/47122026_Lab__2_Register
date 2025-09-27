<?php
require_once("../settings/core.php");
require_once("../controllers/category_controller.php");

if (!is_logged_in() || !is_admin()) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$cat_id = intval($_POST['id'] ?? 0);
$name = trim($_POST['name'] ?? '');

if ($cat_id === 0 || $name === '') {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit();
}

if (update_category_ctr($cat_id, $user_id, $name)) {
    echo json_encode(["success" => true, "message" => "Category updated"]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed"]);
}
?>