<?php  
if (!isset($_SESSION)) {
    session_start();
}
require_once './protect.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Inova Campus</title>
    <link rel="stylesheet" href="../styles/usuario.css">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="logo">INOVA CAMPUS</div>
        </div>
    </header>

    <main>
        <div class="nav-container">
            <a href="#" class="back-link">Ir Para página inicial</a>
            <a href="./logout.php" class="logout-btn">Sair da conta</a>
        </div>
        <div class="profile">
            <img src="../assets/images/usuario.jpg" alt="Usuário" class="avatar">
            <span class="edit-icon">✏️</span>
            <p class="user-name"><?= $_SESSION['user']['name'] ?><span class="edit-icon">✏️</span></p>
            <p class="user-category">categoria: <?= $_SESSION['user']['function'] ?></p>
        </div>

        <h3><a href="./editarDados.php">Informações Básicas <span class="edit-icon">✏️</span></a></h3>

        <div class="info-box">
            <p><strong>E-mail:</strong> <?= $_SESSION['user']['email'] ?></p>
            <!-- <p><strong>Senha:</strong> ********</p> -->
            <p><strong>Número do Whatsapp:</strong> <?= $_SESSION['user']['tel'] ?></p>
        </div>

        <hr>
        <?php if ($_SESSION['user']['function'] === 'vendedor'): ?>
            <h3>Informações do Vendedor</h3>
            <ul>
                <li><a href="#">Número de vendas e avaliações</a></li>
                <li><a href="#">Adicionar ou remover produtos</a></li>
            </ul>
        <?php endif ?>
    </main>
</body>
</html>
