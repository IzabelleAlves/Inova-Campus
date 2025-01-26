<?php

require_once "./src/model/Database.php";

class User {
    private $conn;
    private string $tabela = "USERS"; 
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $telefone;
    private int $vendedor;

    public function __construct($db) {
        $this->setConn($db);
    }

    public function check() {
        $tabela = $this->getTabela();
        $query = "SELECT * FROM {$tabela} WHERE USE_EMAIL = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $email = $this->getEmail();
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function create(): bool {
        $tabela = $this->getTabela();
        
        if ($this->check()) {
            return false;
        }
        
        $query = "INSERT INTO {$tabela} (USE_NOME, USE_EMAIL, USE_SENHA, USE_TELEFONE, USE_VENDEDOR)
            VALUES (:nome, :email, :senha, :telefone, :vendedor)";
        $stmt = $this->conn->prepare($query);

        $nome = $this->getNome();
        $email = $this->getEmail();
        $senha = $this->getSenha();
        $telefone = $this->getTelefone();
        $vendedor = $this->getVendedor();

        $success = $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'telefone' => $telefone,
            'vendedor' => $vendedor
        ]);
        return $success;
    }

    public function getConn(): mixed {
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
        $this->nome = htmlspecialchars(strip_tags($nome));
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = htmlspecialchars(strip_tags($email));
        return $this;
    }

    public function getSenha(): string {
        return $this->senha;
    }

    public function setSenha(string $senha): self {
        $this->senha = htmlspecialchars(strip_tags($senha));
        return $this;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self {
        $this->telefone = htmlspecialchars(strip_tags($telefone));
        return $this;
    }

    public function getVendedor(): int {
        return $this->vendedor;
    }

    public function setVendedor(int $vendedor): self {
        $this->vendedor = $vendedor;
        return $this;
    }
}