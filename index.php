<?php
require_once "./src/model/Controller.php";

$Controller = new Controller();
$action = $_GET['action'] ?? '';
$result = ['view' => ''];

$result = match ($action) {
    'home' => ['view' => './src/views/home.php'],
    'product-create' => ['view' => './src/views/product/create.php'],
    'login' => $Controller->create(),
    'user-create' => ['view' => './src/views/user/create.php'],
    default => ['view' => './src/views/home.php'],
};

$view = $result['view'];

require './src/layout/layout.php';

