<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "./src/model/UserController.php";
require_once "./src/model/ProductController.php";

$UserController = new UserController();
$ProductController = new ProductController();
$action = $_GET['action'] ?? '';


// $result = match ($action) {
//     'home' => ['view' => './src/views/home.php'],
//     'product-create' => ['view' => './src/views/product/create.php'],
//     'login' => $UserController->login(),
//     'user-create' => $UserController->create(),
//     'user-edit' => ['view' => './src/views/user/edit.php'],
//     'logout' => ['view' => './src/config/logout.php'],
//     default => ['view' => './src/views/home.php'],
// };

$result = empty($_SESSION["id"])
    ? match ($action) {
        'login' => $UserController->login(),
        'user-create' => $UserController->create(),
        default => ['view' => './src/views/user/login.php', 'data' => []],
    }
    : match ($action) {
        'home' => ['view' => './src/views/home.php', 'data' => []],
        'product-create' => $ProductController->create(),
        'user-edit' => $UserController->edit(),
        'user-delete' => $UserController->delete(),
        'logout' => ['view' => './src/config/logout.php', 'data' => []],
        default => ['view' => './src/views/home.php', 'data' => []],
    };

$view = $result['view'];
$data = $result['data'];

require './src/layout/layout.php';

