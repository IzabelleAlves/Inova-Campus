<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <header>
        <h1>Inova Campus</h1>
    </header>
    <main>
        <?php
            if (!empty($view)) {
                include $view;
            } else {
                echo "<p>View não encontrada.</p>";
            }
        ?>
    </main>
</body>
</html>