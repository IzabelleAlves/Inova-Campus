<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once './protect.php';

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
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $tel = strip_tags($_POST['tel']);

        try {
            $query = "SELECT usr_email FROM inv_users where usr_email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['email' => $email]);


            if ($_SESSION['user']['email'] === $email || $stmt->rowCount() === 0) {
                $hasth = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE inv_users SET  usr_email = :email, usr_password = :password, usr_phone = :tel";
                $stmt = $pdo->prepare($query);
                $data = [
                    'email' => $email,
                    'password' => $hasth,
                    'tel' => $tel,
                ];
                if ($stmt->execute($data)) {
                    header("Location: ./usuario.php");
                    exit();
                } else {
                    // Erro na execução da consulta
                    $error['query'] = 'Erro ao registrar o usuário, tente novamente mais tarde.';
                    // Registrar o erro no log para debug
                    error_log("Erro ao inserir o usuário: " . implode(", ", $stmt->errorInfo()));
                }
            } else {
                $error['email'] = 'Email já cadastrado';
            }
        } catch (PDOException $e) {
            // Erro na consulta
            $error['query'] = 'Erro: ' . $e->getMessage();
            // Resgistra o erro
            error_log("Erro na edição: " . $e->getMessage());
        }

    } 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informações</title>
    <link rel="stylesheet" href="../styles/editarDados.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
</head>
<body>
    <div class="header">INOVA CAMPUS</div>
    <form method="post" class="container">
        <h2>Editar Informações Básicas <i class="fa-solid fa-pen"></i>
        </h2>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input 
                type="email" 
                id="email" 
                name="email"
                placeholder="Digite seu e-mail aqui..."
                value="<?= htmlspecialchars($_SESSION['user']['email']) ?>"
            />
            <?php if (!empty($error['email'])): ?>
                <span class="erro"><?= htmlspecialchars($error['email']) ?></span>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input 
                type="password" 
                id="senha" 
                name="password"
                placeholder="Digite a nova senha aqui..."
                value="<?= htmlspecialchars($_POST['passsword'] ?? '') ?>" 
            />
            <?php if (!empty($error['password'])): ?>
                <span class="erro"><?= htmlspecialchars($error['password']) ?></span>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label for="senha">Confirmar:</label>
            <input 
                type="password" 
                id="senha" 
                name="confirm"
                placeholder="Confirme a nova senha aqui..."
                value="<?= htmlspecialchars($_POST['confirm'] ?? '') ?>" 
            />
            <?php if (!empty($error['confirm'])): ?>
                <span class="erro"><?= htmlspecialchars($error['confirm']) ?></span>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label for="whatsapp">Whatsapp:</label>
            <input 
                type="tel" 
                id="whatsapp" 
                name="tel"
                placeholder="(XX) XXXXX-XXXX"
                value="<?= htmlspecialchars($_SESSION['user']['tel']) ?>"
            />
            <?php if (!empty($error['tel'])): ?>
                <span class="erro"><?= htmlspecialchars($error['tel']) ?></span>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label for="tipo-conta">Tipo de conta:</label>
        
        <p class="info-text">Informações não alteradas não requerem atualização</p>
        
        <div class="buttons">
            <!-- <button class="btn cancel" onclick="descartarAlteracoes()">Descartar Alterações</button>
            <button class="btn save" onclick="salvarAlteracoes()">Salvar Alterações</button> -->
            <button type="reset" class="btn cancel">Descartar Alterações</button>
            <button type="submit" class="btn save">Salvar Alterações</button>
            <a href="./delete.php" type="submit" class="btn">Apagar Conta</a>
        </div>
    </form>
    <div class="erros">
        <?php if (isset($error['query'])): ?>
            <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
            <?php $error = [] ?>
        <?php endif ?>
    </div>
    
    <script src="../js/editarDados.js"></script>
</body>
</html>
