<?php

require_once "./src/model/User.php";

class UserController {
    private $db;
    private User $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function create() {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->user->setNome($_POST["nome"])
                    ->setEmail($_POST["email"])
                    ->setSenha($_POST["senha"])
                    ->setTelefone($_POST["telefone"])
                    ->setTipo($_POST["tipo"]);

                if ($this->user->create()) {
                    header("Location: index.php?action=login");
                    exit;
                }
            }
        } catch (Exception $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            echo "Ocorreu um erro inesperado. Tente novamente mais tarde.";
        }
        return ['view' => './src/views/user/create.php', 'data' => $this->user];
    }

    public function login() {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->user->setEmail($_POST["email"])
                    ->setSenha($_POST["senha"]);
                
                if ($this->user->login()) {
                    header("Location: index.php?action=home");
                    exit;
                }
            }
        } catch (PDOException $e) {
            error_log('Erro ao autenticar registro: ' . $e->getMessage());
            return false;
        }
        return ['view' => './src/views/user/login.php', 'data' => $this->user];
    }

    public function edit() {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->user->setId($_SESSION["id"])
                    ->setNome($_POST["nome"])
                    ->setEmail($_POST["email"])
                    ->setSenha($_POST["senha"])
                    ->setTelefone($_POST["telefone"])
                    ->setTipo($_POST["tipo"]);

                if ($this->user->edit()) {
                    header("Location: index.php?action=home");
                    exit;
                }
            }
        } catch (Exception $e) {
            error_log("Erro ao editar usuário: " . $e->getMessage());
            echo "Ocorreu um erro inesperado. Tente novamente mais tarde.";
        }
        return ['view' => './src/views/user/edit.php', 'data' => $this->user];
    }
}