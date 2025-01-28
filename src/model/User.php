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
    private int $tipo;

    public function __construct($db) {
        $this->setConn($db); 
    }

    public function check(): array | false {
        $tabela = $this->getTabela();
        $query = "SELECT * FROM {$tabela} WHERE USE_EMAIL = :email LIMIT 1";

        try {
            $stmt = $this->conn->prepare($query);
            $email = $this->getEmail();
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        } catch (PDOException $e) {
            error_log('Erro ao verificar usuário no método ' . __METHOD__ . ': ' . $e->getMessage());
        }
        return false;
    }

    public function create(): bool {
        $tabela = $this->getTabela();
    
        // Verifica se o usuário já existe
        if ($this->check()) {
            return false;
        }
    
        // Validação do e-mail
        if (!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
            error_log('E-mail inválido: ' . $this->getEmail());
            return false;
        }
    
        $query = "INSERT INTO {$tabela} (USE_NOME, USE_EMAIL, USE_SENHA, USE_TELEFONE, USE_VENDEDOR)
            VALUES (:nome, :email, :senha, :telefone, :vendedor)";
        $stmt = $this->conn->prepare($query);
    
        $senhaHash = password_hash($this->getSenha(), PASSWORD_DEFAULT);

        $dados = [
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'senha' => $senhaHash, 
            'telefone' => $this->getTelefone(),
            'vendedor' => $this->getTipo()
        ];
    
        try {
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            error_log('Erro ao criar registro na tabela ' . $tabela . ': ' . $e->getMessage());
            return false;
        }
    }

    public function login(): bool {
        $user = $this->check();

        if (!$user) {
            return false;
        }

        if (password_verify($this->getSenha(), $user['USE_SENHA'])) {
            $_SESSION['id'] = $user['USE_ID'];
            $_SESSION['email'] = $user['USE_EMAIL'];
            $_SESSION['nome'] = $user['USE_NOME'];
            $_SESSION['telefone'] = $user['USE_TELEFONE'];
            $_SESSION['tipo'] = $user['USE_VENDEDOR'];
    
            return true;
        }
        return false;
    }

    public function edit() {
        $tabela = $this->getTabela();
        
        $user = $this->check();

        if (!$user) {
            return false;
        }

        $query = "UPDATE {$tabela}
            SET USE_NOME = :nome, USE_EMAIL = :email, USE_SENHA = :senha, USE_TELEFONE = :telefone, USE_VENDEDOR = :vendedor
            WHERE USE_ID = :id";

        $stmt = $this->conn->prepare($query);
        $dados = [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'senha' => $this->getSenha(),
            'telefone' => $this->getTelefone(),
            'vendedor' => $this->getTipo()
        ];

        try {
             if ($stmt->execute($dados)) {
                $_SESSION["id"] = $dados["id"];
                $_SESSION["nome"] = $dados["nome"];
                $_SESSION["email"] = $dados["email"];
                $_SESSION["telefone"] = $dados["telefone"];
                $_SESSION["tipo"] = $dados["vendedor"];
                return true;
            }
        } catch (PDOException $e) {
            error_log('Erro ao atualizar registro: ' . $e->getMessage());
            return false;
        }
    }

    public function delete(): bool {
        $tabela = $this->getTabela();
        
        $user = $this->check();

        if (!$user) {
            return false;
        }

        $query = "DELETE FROM {$tabela} WHERE USE_EMAIL = :email";
        $stmt = $this->conn->prepare($query);

         try {
            return $stmt->execute(['email' => $this->getEmail()]);
        } catch (PDOException $e) {
            error_log('Erro ao excluir registro: ' . $e->getMessage());
            return false;
        }
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

    public function getTipo(): int {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self {
        $this->tipo = $tipo;
        return $this;
    }
}