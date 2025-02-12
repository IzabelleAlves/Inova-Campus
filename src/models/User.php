<?php 

require_once './src/models/Database.php';

class User {
    private $conn;
    private string $tabela = "inv_users"; 
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $tel;
    private string $function;

    public function __construct($db) {
        $this->setConn($db); 
    }

    public function check(): array | false {
        $tabela = $this->getTabela();
        $query = "SELECT * FROM {$tabela} WHERE usr_email = :email LIMIT 1";

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

    public function create() {
        $tabela = $this->getTabela();
    
        if ($this->check()) {
            return false;
        }

        $query = "INSERT INTO {$tabela} (usr_name, usr_email, usr_password, usr_phone, usr_function)
            VALUES (:name, :email, :password, :tel, :function)";
        $stmt = $this->conn->prepare($query);
        $senhaHash = password_hash($this->getPassword(), PASSWORD_DEFAULT);

        $dados = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $senhaHash, 
            'tel' => $this->getTel(),
            'function' => $this->getFunction()
        ];
        try {
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            // $_POST['error'] = $e->getMessage();
            error_log('Erro ao criar registro na tabela ' . $tabela . ': ' . $e->getMessage());
            return false;
        }
    }
    
    public function edit() {
        $tabela = $this->getTabela();
    
        // if ($this->check() && $_SESSION['user']['email'] === $_POST['email']) {
        //     return false;
        // }

        $query = "UPDATE {$tabela} SET usr_name = :name, usr_email = :email, usr_phone = :tel, usr_function = :function
            WHERE usr_id = :id";
        $stmt = $this->conn->prepare($query);

        $dados = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'tel' => $this->getTel(),
            'function' => $this->getFunction(),
            'id' => $this->getId()
        ];

        try {
            if ($stmt->execute($dados)) {
                $_SESSION['user'] = $dados;
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            // $_POST['error'] = $e->getMessage();
            error_log('Erro ao editar registro na tabela ' . $tabela . ': ' . $e->getMessage());
            return false;
        }
    }

    public function login(): bool {
        $user = $this->check();

        if (!$user) {
            return false;
        }

        if (password_verify($this->getPassword(), $user['usr_password'])) {
            $user = [
                'id' => $user['usr_id'],
                'email' => $user['usr_email'],
                'name' => $user['usr_name'],
                'tel' => $user['usr_phone'],
                'function' => $user['usr_function']
            ];
            $_SESSION['user'] = $user;
    
            return true;
        }
        return false;
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

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = strip_tags($name);
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = strip_tags($email);
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $senha): self {
        $this->password = strip_tags($senha);
        return $this;
    }

    public function getTel(): string {
        return $this->tel;
    }

    public function setTel(string $tel): self {
        $this->tel = strip_tags($tel);
        return $this;
    }

    public function getFunction(): string {
        return $this->function;
    }

    public function setFunction(string $function): self {
        $this->function = $function;
        return $this;
    }
}