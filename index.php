<?php 
if (!isset($_SESSION)) {
    session_start();
}

require_once './src/models/UserController.php';
require_once './src/models/ProductController.php';

$UserController = new UserController();
$ProductController = new ProductController();
$action = $_GET['action'] ?? '';

$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] >= 0 
    ? (int) $_GET['id'] 
    : 0;

$offset = isset($_GET['offset']) && is_numeric($_GET['offset']) && $_GET['offset'] >= 0 
    ? (int) $_GET['offset'] 
    : 0;

$result = match ($action) {
    'home' => ['view' => './src/views/home.php', 'title' => 'Página Inicial'],
    'about' => ['view' => './src/views/about.php', 'title' => 'Sobre'],
    'login' => $UserController->login(),
    'user-create' => $UserController->create(),
    'user-edit' => $UserController->edit(),
    'product-create' => $ProductController->create(),
    'product-list' => $ProductController->list($offset),
    'product-edit' => $ProductController->edit($id),
    'product-read' => $ProductController->read($id),
    'user' => ['view' => './src/views/user/user.php', 'title' => 'Perfil'],
    'vendas' => $ProductController->listAll($offset),
    'logout' => ['view' => './src/config/logout.php', 'title' => 'Saindo'],
    'carrinho' => ['view' => './src/views/product/carrinho.php', 'title' => 'Carrinho'],
    'adicionar_carrinho' => ['view' => './src/views/product/adicionar_carrinho.php', 'title' => 'Carrinho'],
    default => ['view' => './src/views/home.php', 'title' => 'Página Inicial']
};

$view = $result['view'];
$title = $result['title'];
$products = $result['data'] ?? '';
$error = $result['error'] ?? '';

require './src/layout/layout.php';
