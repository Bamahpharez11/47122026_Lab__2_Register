<?php
require_once("../settings/core.php");
require_once("../controllers/category_controller.php");

if (!is_logged_in()) {
    echo json_encode([]);
    exit();
}
$user_id = $_SESSION['user_id'];
$categories = get_categories_ctr($user_id);
echo json_encode($categories);
?>