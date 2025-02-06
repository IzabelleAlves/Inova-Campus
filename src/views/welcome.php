<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inova Campus</title>
    <link rel="stylesheet" href="../styles/welcome.css">
</head>
<body>
    <header>
        <h1>INOVA CAMPUS</h1>
    </header>
    <main>
        <div class="welcome-card">
            <button class="close-btn">✖</button>
            <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['user']['name']) ?>! 🎉</h2>
            <p>
                Que bom ter você por aqui! Este é o momento perfeito para deixar seu perfil com a sua cara: 
                Adicione uma foto de perfil e personalize suas preferências.
            </p>
            <button class="update-btn">Atualize seu perfil</button>
        </div>
    </main>
</body>
</html>
