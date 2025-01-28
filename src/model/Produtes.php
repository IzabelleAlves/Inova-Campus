<?php

class Products {
    private $conn;
    private string $tabela = "PRODUCTS"; 
    private int $id;
    private string $nome;
    private float $preco;
    private string $descricao;
    private int $user;

    public function __construct($db) {
        $this->setConn($db);

    }

    public function create(): bool {
        $tabela = $this->getTabela();
        
        if ($this->check()) {
            return false;
        }
        
        $query = "INSERT INTO {$tabela} (USE_NOME, USE_PRECO, USE_DESCRICAO, USE_USER)
            VALUES (:nome, :preco, :descricao, :user)";
        $stmt = $this->conn->prepare($query);

        $dados = [
            'nome' => $this->getNome(),
            'preço' => $this->getPreco(),
            'descrição' => $this->getDescricao(),
            'user' => $this->getUser(),
        ];

        try {
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            error_log('Erro ao criar registro: ' . $e->getMessage());
            return false;
        }
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