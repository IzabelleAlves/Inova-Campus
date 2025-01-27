<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "./src/model/Controller.php";

$Controller = new Controller();
$action = $_GET['action'] ?? '';
$result = ['view' => ''];

$result = match ($action) {
    'home' => ['view' => './src/views/home.php'],
    'product-create' => ['view' => './src/views/product/create.php'],
    'login' => $Controller->login(),
    'user-create' => $Controller->create(),
    'logout' => ['view' => './src/config/logout.php'],
    default => ['view' => './src/views/home.php'],
};

$view = (empty($_SESSION["id"])) ? './src/views/user/login.php' :  $result['view'];

require './src/layout/layout.php';

