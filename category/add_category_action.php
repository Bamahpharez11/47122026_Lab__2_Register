<?php
require_once("../settings/core.php");
require_once("../controllers/category_controller.php");

if (!is_logged_in() || !is_admin()) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$name = trim($_POST['name'] ?? '');

if ($name === '') {
    echo json_encode(["success" => false, "message" => "Category name required"]);
    exit();
}

if (add_category_ctr($user_id, $name)) {
    echo json_encode(["success" => true, "message" => "Category added"]);
} else {
    echo json_encode(["success" => false, "message" => "Category name must be unique"]);
}
?>