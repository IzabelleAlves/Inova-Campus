<div class="container">
    <h2>Cadastre seu Produto</h2>
    <form action="index.php?action=product-edit&id=<?= $product->getId() ?>" method="post">
        <label for="nome">
            Nome
            <input type="text" name="nome" id="nome" value="<?= $product->getNome() ?>" required">
            <span></span>
        </label for="preco">
        <label>
            Preço
            <input type="number" name="preco" id="preco" value="<?= $product->getPreco() ?>" required>
            <span></span>
        </label>
        <label for="descricao">
            Descreva seu produto
            <textarea name="descricao" id="descricao" class="textarea" required><?= $product->getDescricao() ?></textarea>
            <span></span>
        </label>
        <input type="submit" value="Atualizar" class="enviar">
    </form>
</div>