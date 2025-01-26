<?php

require_once "./src/model/User.php";

class Controller {
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
                    ->setVendedor($_POST["vendedor"]);

                if ($this->user->create()) {
                    header("Location: index.php?action=login");
                    exit;
                }
            }
        } catch (Exception $e) {

        }
        return ['view' => './src/views/user/login.php'];
    }

}