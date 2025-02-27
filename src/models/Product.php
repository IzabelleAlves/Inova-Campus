<?php

require_once './src/models/Database.php';

class Product {
    private $conn;
    public $table = 'inv_products';
    private int $id;
    private string $name;
    private float $price;
    private int $units;
    private string $description;
    private int  $user;

    public function __construct($db) {
        $this->setConn($db); 
    }

    public function create() {
        $table = $this->table;

        $query = "INSERT INTO {$table} (pdt_name, pdt_unit_price, pdt_units, pdt_description, pdt_user)
            VALUES (:name, :price, :units, :description, :user)";
        $stmt = $this->conn->prepare($query);
        $data = [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'units' => $this->getUnits(),
            'description' => $this->getDescription(),
            'user' => $this->getUser()
        ];
        return $stmt->execute($data);
    }

    public function read($id) {
        $table = $this->table;
    
        $query = "SELECT * FROM {$table} WHERE pdt_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function list($offset = 0) {
        $table = $this->table;
    
        $query = "SELECT * FROM {$table} WHERE pdt_user = :id ORDER BY pdt_name ASC LIMIT 20 OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
    
    public function listAll($offset = 0) {
        $table = $this->table;
    
        $query = "SELECT * FROM {$table} ORDER BY pdt_name ASC LIMIT 20 OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function edit() {
        $table = $this->table;
        $id = $this->getId();

        if (!$this->read($id)) return false;

        $query = "UPDATE {$table} SET pdt_name = :name, pdt_unit_price = :price, pdt_units = :units, pdt_description = :description
            WHERE pdt_id = :id";
        $stmt = $this->conn->prepare($query);

        $data = [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'units' => $this->getUnits(),
            'description' => $this->getDescription(),
            'id' => $id
        ];

        return $stmt->execute($data);
    }

    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn): self {
        $this->conn = $conn;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = strip_tags($name);
        return $this;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): self {
        $this->price = $price;
        return $this;
    }

    public function getUnits(): int {
        return $this->units;
    }

    public function setUnits(int $units): self {
        $this->units = $units;
        return $this;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = strip_tags($description);
        return $this;
    }

    public function getUser(): int {
        return $this->user;
    }

    public function setUser(int $user): self {
        $this->user = $user;
        return $this;
    }
}