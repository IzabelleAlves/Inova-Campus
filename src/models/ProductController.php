<?php

require_once './src/models/Product.php';

class ProductController {
    private $db;
    private Product $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function create() {
        $error = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->product->setName($_POST['name'])
                ->setPrice($_POST['price'])
                ->setUnits($_POST['units'])
                ->setDescription($_POST['description'])
                ->setUser($_SESSION['user']['id']);

            try {
                if ($this->product->create()) {
                    header('Location: index.php?action=product-list');
                    exit;
                } else {
                    $error['query'] = 'Error:  ao cadastrar produto';
                }
            } catch (PDOException $e) {
                $error['query'] = 'Error:  ' . $e->getMessage();
            }
        }

        return[
            'view' => './src/views/product/create.php',
            'title' => 'Criar produto',
            'error' => $error
        ];
    }

    public function read($id) {
        $products = $this->product->read($id);
        return[
            'view' => './src/views/product/read.php',
            'title' => 'Produto',
            'data' => $products
        ];
    }

    public function list($offset = 0) {
        $products = $this->product->list($offset);
        return[
            'view' => './src/views/product/list.php',
            'title' => 'Meus produtos',
            'data' => $products
        ];
    }

    public function listAll($offset = 0) {
        $products = $this->product->listAll($offset);
        return[
            'view' => './src/views/vendas.php',
            'title' => 'Meus produtos',
            'data' => $products
        ];
    }

    public function edit($id) {
        $error = [];
        $product = $this->product->read($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->product->setName($_POST['name'])
                ->setPrice($_POST['price'])
                ->setUnits($_POST['units'])
                ->setDescription($_POST['description'])
                ->setId($id);

            try {
                if ($this->product->edit()) {
                    header('Location: index.php?action=product-list');
                    exit;
                } else {
                    $error['query'] = 'Error:  ao editar produto';
                }
            } catch (PDOException $e) {
                $error['query'] = 'Error:  ' . $e->getMessage();
            }
        }

        return[
            'view' => './src/views/product/edit.php',
            'title' => 'Editar produto',
            'error' => $error,
            'data' => $product
        ];
    }
}