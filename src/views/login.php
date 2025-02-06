<?php 
if ($_SERVER['REQUEST_METHOD' === 'POST']) {
    
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
                <input type="email" id="email" placeholder="Digite aqui ..." value="<?= $_POST['email'] ?? ''?>"  required/>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" placeholder="Digite aqui ..." required>
                <a href="#" class="esqueceu">Esqueceu a senha?</a>

                <div class="selecionar-tipo">
                    <span>Eu sou:</span>
                    <div class="radio-group">
                    <label><input type="radio" name="tipo" value="cliente"> Cliente</label>
                    <label><input type="radio" name="tipo" value="vendedor"> Vendedor</label>
                </div>
                </div>

                <button type="submit" class="btn entrar">Entrar</button>
                <button type="button" class="btn cadastrar">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>
