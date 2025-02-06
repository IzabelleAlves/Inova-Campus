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
    <div class="container">
        <h2>Editar Informações Básicas <i class="fa-solid fa-pen"></i>
        </h2>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" placeholder="Digite seu e-mail aqui...">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" placeholder="Digite a nova senha aqui...">
        </div>
        <div class="form-group">
            <label for="whatsapp">Whatsapp:</label>
            <input type="tel" id="whatsapp" placeholder="(XX) XXXXX-XXXX">
        </div>
        <div class="form-group">
            <label for="tipo-conta">Tipo de conta:</label>
            <input type="text" id="tipo-conta" placeholder="Informe o tipo de conta">
        </div>
        
        <p class="info-text">Informações não alteradas não requerem atualização</p>
        
        <div class="buttons">
            <button class="btn cancel" onclick="descartarAlteracoes()">Descartar Alterações</button>
            <button class="btn save" onclick="salvarAlteracoes()">Salvar Alterações</button>
        </div>
    </div>
    
    <script src="../js/editarDados.js"></script>
</body>
</html>
