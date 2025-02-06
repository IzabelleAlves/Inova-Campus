<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once './protect.php';


// Inclui a conexão com o banco
include '../database/connection.php';

$query = "DELETE FROM inv_users where usr_id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $_SESSION['user']['id']]);

header('Location: ./logout.php');
exit();