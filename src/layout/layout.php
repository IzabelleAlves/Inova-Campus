<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <link rel="stylesheet" href="./assets/styles/products.css">
    <script defer src="./assets/js/script.js"></script>
    <title>Inova Campus</title>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="/" class="logo">Inova Campus</a>
            <button class="hamburger"></button>
            <ul class="nav-list" >
                <?php if (empty($_SESSION["id"])): ?>
                    <li><a href="index.php?action=user-create">Cadastre-se</a></li>
                    <li><a href="index.php?action=login">Login</a></li>
                <?php elseif ($_SESSION["tipo"] === 1): ?>
                    <li><a href="index.php?action=home">Home</a></li>
                    <li><a href="index.php?action=product-create">Produtos</a></li>
                    <li><a href="index.php?action=logout">Sair</a></li>
                <?php else: ?>
                    <li><a href="index.php?action=logout">Sair</a></li>
                <?php endif ?>
            </ul>
        </nav>
    </header>
    <main>
        

     <?php 
    if (!empty($view)) {
        // extract($data);
        
        if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif;

        include $view; 
    } else {
        echo "<p>View não encontrada.</p>";
    }
    ?>


    </main>
    <footer><p>&copy;Todos os Direitos Reservados</p></footer>
</body>
</html>