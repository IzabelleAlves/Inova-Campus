<div class="container">
    <h2>Cadastre seu Produto</h2>
    <form action="index.php?action=product-create" method="post">
        <label for="nome">
            Nome
            <input type="text" name="nome" id="nome">
            <span></span>
        </label for="preco">
        <label>
            Preço
            <input type="number" name="preco" id="preco">
            <span></span>
        </label>
        <label for="descricao">
            Descreva seu produto
            <textarea name="descricao" id="descricao" class="textarea"></textarea>
            <span></span>
        </label>
        <input type="submit" value="Cadastrar" class="enviar">
        <?= $_SESSION["id"]?>
        <?= $_POST["nome"]?>
        <?= $_POST["preco"]?>
        <?= $_POST["descricao"]?>
    </form>
</div>