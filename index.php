<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "./src/model/ControllerUser.php";

$Controller = new ControllerUser();
$action = $_GET['action'] ?? '';
$result = ['view' => ''];

// $result = match ($action) {
//     'home' => ['view' => './src/views/home.php'],
//     'product-create' => ['view' => './src/views/product/create.php'],
//     'login' => $Controller->login(),
//     'user-create' => $Controller->create(),
//     'user-edit' => ['view' => './src/views/user/edit.php'],
//     'logout' => ['view' => './src/config/logout.php'],
//     default => ['view' => './src/views/home.php'],
// };

$result = empty($_SESSION["id"])
    ? match ($action) {
        'login' => $Controller->login(),
        'user-create' => $Controller->create(),
        default => ['view' => './src/views/login.php'],
    }
    : match ($action) {
        'home' => ['view' => './src/views/home.php'],
        'product-create' => ['view' => './src/views/product/create.php'],
        'user-edit' => ['view' => './src/views/user/edit.php'],
        'logout' => ['view' => './src/config/logout.php'],
        default => ['view' => './src/views/home.php'],
    };

$view = $result['view'];

require './src/layout/layout.php';

