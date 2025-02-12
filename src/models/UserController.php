<?php

require_once "./src/models/User.php";

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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->user->setName($_POST['name'])
                    ->setEmail($_POST['email'])
                    ->setTel($_POST['tel'])
                    ->setPassword($_POST['password'])
                    ->setFunction($_POST['function']);

                if ($this->user->create()) {
                    header("Location: index.php?action=login");
                    exit;
                }
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
        }
        return [
            'view' => './src/views/user/create.php',
            'title' => 'Cadastre-se'
        ];
    }

    public function edit() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->user->setName($_POST['name'])
                        ->setEmail($_POST['email'])
                        ->setTel($_POST['tel'])
                        ->setFunction($_POST['function'])
                        ->setID($_SESSION['user']['id']);

                    if ($this->user->edit()) {
                        header("Location: index.php?action=user");
                        exit;
                    }
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
        }
        return [
            'view' => './src/views/user/edit.php',
            'title' => 'Perfil'
        ];
    }

    public function login(): array {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->user->setEmail($_POST["email"])
                    ->setPassword($_POST["password"]);
                
                if ($this->user->login()) {
                    header("Location: index.php?action=vendas");
                    exit;
                }
            }
        } catch (PDOException $e) {
            error_log('Erro ao autenticar registro: ' . $e->getMessage());
        }
        return [
            'view' => './src/views/login.php',
            'title' => 'Entrar'
        ];
    }
}