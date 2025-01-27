<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "./src/model/UserController.php";

$UserController = new UserController();
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
        default => ['view' => './src/views/use/login.php', 'data' => []],
    }
    : match ($action) {
        'home' => ['view' => './src/views/home.php', 'data' => []],
        'product-create' => ['view' => './src/views/product/create.php'],
        'user-edit' => $UserController->edit(),
        'logout' => ['view' => './src/config/logout.php', 'data' => []],
        default => ['view' => './src/views/home.php', 'data' => []],
    };

$view = $result['view'];
$data = $result['data'];

require './src/layout/layout.php';

