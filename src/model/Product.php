<?php

class Product {
    private $conn;
    private string $tabela = "PRODUCTS"; 
    private string $tabela2 = "USERS"; 
    private int $id;
    private string $nome;
    private float $preco;
    private string $descricao;
    private int $user;

    public function __construct($db) {
        $this->setConn($db);

    }

    public function list(): mixed {
        $tabela = $this->getTabela();
        $query = "SELECT * FROM {$tabela} WHERE PDT_USER = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['id' => $_SESSION['id']]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        } catch (PDOException $e) {
            error_log('Erro ao verificar usuário no método ' . __METHOD__ . ': ' . $e->getMessage());
            return false;
        }
    }

    public function listAll(): mixed {
        $tabela = $this->getTabela();
        $tabela2 = $this->getTabela2();
        $query = "SELECT {$tabela}.*, {$tabela2}.USE_ID, {$tabela2}.USE_TELEFONE
                    FROM {$tabela}
                    LEFT JOIN {$tabela2}
                    ON {$tabela}.PDT_USER = {$tabela2}.USE_ID";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        } catch (PDOException $e) {
            error_log('Erro ao verificar usuário no método ' . __METHOD__ . ': ' . $e->getMessage());
            return false;
        }
    }

    public function listProduct(): mixed {
        $tabela = $this->getTabela();
        $tabela2 = $this->getTabela2();
        $id = $this->getId();
        $query = "SELECT 
                        {$tabela}.*, {$tabela2}.USE_ID, {$tabela2}.USE_NOME, {$tabela2}.USE_TELEFONE
                    FROM 
                        {$tabela}
                    LEFT JOIN 
                        {$tabela2}  
                    ON 
                        {$tabela}.PDT_USER = {$tabela2}.USE_ID
                    WHERE 
                        PDT_ID = {$id}";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        } catch (PDOException $e) {
            error_log('Erro ao verificar usuário no método ' . __METHOD__ . ': ' . $e->getMessage());
            return false;
        }
    }

    public function create(): bool {
        $tabela = $this->getTabela();
        
        $query = "INSERT INTO {$tabela} (PDT_NOME, PDT_PRECO, PDT_DESCRICAO, PDT_USER)
            VALUES (:nome, :preco, :descricao, :user)";
        $stmt = $this->conn->prepare($query);
    
        $dados = [
            'nome' => $this->getNome(),
            'preco' => $this->getPreco(),
            'descricao' => $this->getDescricao(),
            'user' => $this->getUser(),
        ];
    
        try {
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            error_log('Erro ao criar registro: ' . $e->getMessage());
            return false;
        }
    }

    public function edit() {
        $tabela = $this->getTabela();
        $query = "UPDATE {$tabela} SET PDT_NOME = :nome, PDT_PRECO = :preco, PDT_DESCRICAO = :descricao WHERE PDT_ID = :id";
        $stmt = $this->conn->prepare($query);

        $dados = [
            'id' => $_GET['id'],
            'nome' => $this->getNome(),
            'preco' => $this->getPreco(),
            'descricao' => $this->getDescricao()
        ];

        try {
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            error_log('Erro ao editar registro na tabela ' . $tabela . ': ' . $e->getMessage());
            return false;
        }
    }
    
    public function read(): bool {
        $tabela = $this->getTabela();
        $query = "SELECT * FROM {$tabela} WHERE PDT_ID = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute(['id' => $this->getId()]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->setId($row['PDT_ID'])
                ->setNome($row['PDT_NOME'])
                ->setPreco($row['PDT_PRECO'])
                ->setDescricao($row['PDT_DESCRICAO']);
            return true;
        }
        return false;
    }

    public function delete() {
        $tabela = $this->getTabela();
        $query = "DELETE FROM {$tabela} WHERE PDT_ID = :id";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt->execute(['id' => $this->getId()])) {
            return true;
        }
        return false;
    }
    
    
    public function getConn() {
        return $this->conn;
    }

    
    public function setConn($conn): self {
        $this->conn = $conn;

        return $this;
    }

    
    public function getTabela(): string {
        return $this->tabela;
    }

    
    public function setTabela(string $tabela): self {
        $this->tabela = $tabela;

        return $this;
    }
    public function getTabela2(): string {
        return $this->tabela2;
    }

    
    public function setTabela2(string $tabela2): self {
        $this->tabela2 = $tabela2;

        return $this;
    }

    
    public function getId(): int {
        return $this->id;
    }

    
    public function setId(int $id): self {
        $this->id = $id;

        return $this;
    }

    
    public function getNome(): string {
        return $this->nome;
    }

    
    public function setNome(string $nome): self {
        $this->nome = $nome;

        return $this;
    }

    
    public function getPreco(): float {
        return $this->preco;
    }

    
    public function setPreco(float $preco): self {
        $this->preco = $preco;

        return $this;
    }

    
    public function getDescricao(): string {
        return $this->descricao;
    }

    
    public function setDescricao(string $descricao): self {
        $this->descricao = $descricao;

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