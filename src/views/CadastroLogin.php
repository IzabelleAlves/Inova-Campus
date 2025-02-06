<?php
// Armazena os erros do usuário
$error = [];

// Inclui a conexão com o banco
include '../database/connection.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o 'email' foi enviado
    if (empty($_POST['email'])) {
        $error['email'] = 'O campo email é obrigatório';
    // Verifica se o 'email' é válido
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email inválido';
    }

    // Verifica se o 'nome' foi enviado
    if (empty($_POST['name'])) $error['name'] = 'O campo nome é obrigatório';

    // Verifica se a 'senha' foi enviado
    if (empty($_POST['password'])) $error['password'] = 'O campo senha é obrigatório';
    
    // Verifica se as 'senhas' são iguais
    if ($_POST['password'] !== $_POST['confirm']) {
        $error['confirm'] = 'Senhas diferentes';
    }

    // Verifica se o 'telefone' foi enviado
    if (empty($_POST['tel'])) {
        $error['tel'] = 'O campo telefone é obrigatório';
    } elseif (!preg_match('/^\d{10,11}$/', $_POST['tel'])) {
        $error['tel'] = 'Telefone inválido';
    }

    if (empty($error)) {
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $tel = strip_tags($_POST['tel']);
        $function = strip_tags($_POST['function']);

        $query = "SELECT usr_email FROM inv_users where usr_email = :email";
        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute(['email' => $email]);

            if ($stmt->rowCount() > 0) {
                $error['email'] = 'Email já cadastrado';
            } else {
                $hasth = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO inv_users (usr_name, usr_email, usr_password, usr_phone, usr_function) VALUES (:name, :email, :password, :tel, :function)";
                $stmt = $pdo->prepare($query);
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $hasth,
                    'tel' => $tel,
                    'function' => $function,
                ];
                if ($stmt->execute($data)) {
                    header("Location: ./login.php");
                    exit();
                } else {
                    // Erro na execução da consulta
                    $error['query'] = 'Erro ao registrar o usuário, tente novamente mais tarde.';
                    // Registrar o erro no log para debug
                    error_log("Erro ao inserir o usuário: " . implode(", ", $stmt->errorInfo()));
                }
            }
        } catch (PDOException $e) {
            // Erro na consulta
            $error['query'] = 'Erro: ' . $e->getMessage();
            // Resgistra o erro
            error_log("Erro de consulta: " . $e->getMessage());
        }

    } 
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Inova Campus</title>
    <link rel="stylesheet" href="../styles/CadastroLogin.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>INOVA CAMPUS</h1>
        </header>
        <p>Você está em <a href="#">Login</a> &gt; <a href="#">Cadastro</a></p>
        <h2>Falta pouco para vender ou comprar!</h2>
        <form method="post" >
            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Digite aqui ..." 
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
            />
            <?php if (!empty($error['email'])): ?>
                <span class="erro"><?= htmlspecialchars($error['email']) ?></span>
            <?php endif ?>
            
            <label for="nome">Nome Completo:</label>
            <input
                type="text" 
                id="nome" 
                name="name" 
                placeholder="Digite aqui ..."
                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" 
            />
            <?php if (!empty($error['name'])): ?>
                <span class="erro"><?= htmlspecialchars($error['name']) ?></span>
            <?php endif ?>
            
            <label for="senha">Senha:</label>
            <input 
                type="password"    
                id="senha" 
                name="password" 
                placeholder="Digite aqui ..."
                value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" 
            />
            <?php if (!empty($error['password'])): ?>
                <span class="erro"><?= htmlspecialchars($error['password']) ?></span>
            <?php endif ?>
            
            <label for="confirmaSenha">Confirme a senha:</label>
            <input 
                type="password" 
                id="confirmaSenha" 
                name="confirm"
                placeholder="Digite aqui ..." 
                value="<?= htmlspecialchars($_POST['confirm'] ?? '') ?>" 
            />
            <?php if (!empty($error['confirm'])): ?>
                <span class="erro"><?= htmlspecialchars($error['confirm']) ?></span>
            <?php endif ?>
            
            <label for="whatsapp">Número do WhatsApp:</label>
            <input 
                type="tel" 
                id="whatsapp" 
                name="tel" 
                placeholder="( ) _____-____" 
                value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>" 
            />
            <?php if (!empty($error['tel'])): ?>
                <span class="erro"><?= htmlspecialchars($error['tel']) ?></span>
            <?php endif ?>
            
            <p>Eu sou:</p>
            <div class="radio-group">
                <input type="radio" id="cliente" name="function" value="cliente" checked>
                <label for="cliente">Cliente</label>
                <input type="radio" id="vendedor" name="function" value="vendedor">
                <label for="vendedor">Vendedor</label>
            </div>
            
            <button type="submit" class="btn">Cadastrar</button>
        </form>
        <div class="erros">
            <?php if (isset($error['connection']) || isset($error['query'])): ?>
                <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
                <?php $error = [] ?>
            <?php endif ?>
        </div>
    </div>
</body>
</html>