<?php 
if (!isset($_SESSION)) {
    session_start();
}

require_once './src/models/UserController.php';

$UserController = new UserController();
$action = $_GET['action'] ?? '';

$result = match ($action) {
    'home' => ['view' => './src/views/home.php', 'title' => 'Página Inicial'],
    'about' => ['view' => './src/views/about.php', 'title' => 'Sobre'],
    'login' => $UserController->login(),
    'user-create' => $UserController->create(),
    default => ['view' => './src/views/home.php', 'title' => 'Página Inicial']
};

$view = $result['view'];
$title = $result['title'];

require './src/layout/layout.php';
