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

    public function edit($id) {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->product->setNome($_POST["nome"])
                    ->setPreco($_POST["preco"])
                    ->setDescricao($_POST["descricao"])
                    ->setUser($_SESSION["id"]);

                if ($this->product->edit()) {
                    header("Location: index.php?action=product-list");
                    exit;
                }
            } else {
                $this->product->setId($id)
                    ->read();
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar produto: " . $e->getMessage());
        }
        return ['view' => './src/views/product/edit.php', 'data' => ['product' => $this->product]];
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
    public function read($id) {
        try {

            $this->product->setId($id)
            ->read();
            return [
                "view" => "./src/views/product/read.php", 
                "data" => ["product" => $this->product
            ]];
        } catch (PDOException $e) {
            error_log("Erro ao encontrar os produtos: " . $e->getMessage());
            return [
                'view' => './src/views/error.php',
                'data' => ['error' => 'Erro ao ler o produto.']
            ];
        }
    }

    public function delete($id) {
        try {

            $this->product->setId($id);
            
            if ($this->product->delete()) {
                header("Location: index.php?action=product-list");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Erro ao encontrar os produtos: " . $e->getMessage());
            return [
                'view' => './src/views/error.php',
                'data' => ['error' => 'Erro ao ler o produto.']
            ];
        }
    }
}