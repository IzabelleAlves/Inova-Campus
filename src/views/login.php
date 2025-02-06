<?php 
session_start();
// Armazena os erros
$error = [];

// Inclui a conexão com o banco
include '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['email'])) {
        $error['email'] = 'O campo email é obrigatório';
    // Verifica se o 'email' é válido
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email inválido';
    }

    // Verifica se a 'senha' foi enviado
    if (empty($_POST['password'])) $error['password'] = 'O campo senha é obrigatório';

    if (empty($error)) {
        $email = strip_tags($_POST['email'] ?? '');
        $password = strip_tags($_POST['password'] ?? '');
        $data = [
            'email' => $email,
            'password' => $password
        ];

        $query = "SELECT usr_email, usr_password, usr_id, usr_name, usr_phone, usr_function FROM inv_users WHERE usr_email = :email";
        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $row['usr_password'])) {
                    $user = [
                        'id' => $row['usr_id'],
                        'email' => $row['usr_email'],
                        'name' => $row['usr_name'],
                        'tel' => $row['usr_phone'],
                        'function' => $row['usr_function']
                    ];
                    $_SESSION['user'] = $user;
                    header("Location: ./welcome.php");
                    exit();
                } else {
                    $error['user'] = 'Email ou senha inválidos';
                }
            } else {
                $error['user'] = 'Email ou senha inválidos';
            }
        } catch (PDOException $e) {
            // Erro na consulta
            $error['query'] = 'Erro: ' . $e->getMessage();
            // Resgistra o erro
            error_log("Erro de login: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Inova Campus</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <div class="container">
        <header class="header">
            INOVA CAMPUS
        </header>
        <div class="content">
            <h2>Faça negócios no Inova Campus</h2>
            <p class="subtitulo">Onde vendedores e clientes encontram as melhores oportunidades para comprar e vender</p>
            <form method="post">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    placeholder="Digite aqui ..." 
                    value="<?= $_POST['email'] ?? ''?>"  
                    required
                />
                <?php if (!empty($error['user'])): ?>
                    <span class="erro"><?= htmlspecialchars($error['user']) ?></span>
                <?php endif ?>

                <label for="senha">Senha:</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="password"
                    placeholder="Digite aqui ..." 
                    required
                />
                <a href="#" class="esqueceu">Esqueceu a senha?</a>

                <!-- <div class="selecionar-tipo">
                    <span>Eu sou:</span>
                    <div class="radio-group">
                    <label><input type="radio" name="tipo" value="cliente"> Cliente</label>
                    <label><input type="radio" name="tipo" value="vendedor"> Vendedor</label>
                </div>
                </div> -->

                <button type="submit" class="btn entrar">Entrar</button>
                <a href="./CadastroLogin.php" class="btn cadastrar">Não possui conta?</a>
                <!-- <button type="button" class="btn cadastrar">Cadastrar</button> -->
            </form>
            <div class="erros">
            <?php if (isset($error['query'])): ?>
                <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
                <?php $error = [] ?>
            <?php endif ?>
        </div>
        </div>
    </div>
</body>
</html>
