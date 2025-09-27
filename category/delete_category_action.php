<?php
require_once("../settings/core.php");
require_once("../controllers/category_controller.php");

if (!is_logged_in() || !is_admin()) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$cat_id = intval($_POST['id'] ?? 0);

if ($cat_id === 0) {
    echo json_encode(["success" => false, "message" => "Invalid category"]);
    exit();
}

if (delete_category_ctr($cat_id, $user_id)) {
    echo json_encode(["success" => true, "message" => "Category deleted"]);
} else {
    echo json_encode(["success" => false, "message" => "Delete failed"]);
}
?>