<?php

require_once "./src/model/Product.php";

class ProductController {
    private $db;
    private Product $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function create() {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->product->setNome($_POST["nome"])
                    ->setPreco($_POST["preco"])
                    ->setDescricao($_POST["descricao"])
                    ->setUser($_SESSION["id"]);

                if ($this->product->create()) {
                    header("Location: index.php?action=product-list");
                    exit;
                }
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar produto: " . $e->getMessage());
        }
        return ['view' => './src/views/product/create.php', 'data' => []];
    }

    public function list() {
        try {
            $productsList = $this->product->list();
            return [
                'view' => './src/views/product/list.php',
                'data' => compact('productsList')
            ]; 
            
        } catch (PDOException $e) {
            error_log("Erro ao encontrar os produtos: " . $e->getMessage());
            return [
                'view' => './src/views/error.php',
                'data' => ['error' => 'Erro ao buscar os produtos.']
            ];
        }
    }
}