<?php

header('Content-Type: application/json');
session_start();

$response = array();

if (isset($_SESSION['user_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'You are already logged in';
    echo json_encode($response);
    exit();
}

require_once '../controllers/user_controller.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    $response['status'] = 'error';
    $response['message'] = 'Please fill in all fields';
    echo json_encode($response);
    exit();
}

$user = get_user_by_email_ctr($email);

if ($user && password_verify($password, $user['customer_pass'])) {
    $_SESSION['user_id'] = $user['customer_id'];
    $_SESSION['user_name'] = $user['customer_name'];
    $_SESSION['user_role'] = $user['user_role'];
    
    $response['status'] = 'success';
    $response['message'] = 'Login successful';
    $response['redirect'] = '../index.php';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid email or password';
}

echo json_encode($response);
