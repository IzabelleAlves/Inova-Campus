<?php
$action = $_GET['action'] ?? '';
$result = ['view' => ''];

switch($action) { 
    case 'home':
        $result = ['view' => './src/views/home.php'];
        break;
    case 'product-create':
        $result = ['view' => './src/views/product/create.php'];
        break;
    case 'user-create':
        $result = ['view' => './src/views/user/create.php'];
        break;
    default:
        $result = ['view' => './src/views/home.php'];
        break;
}

$view = $result['view'];

require './src/layout/layout.php';
