<?php
$host = 'localhost';
$database = 'inova_campus';
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Registrar erro no log
    error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
}

