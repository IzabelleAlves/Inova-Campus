<div class="container">
    <article class="user-menu">
        <h2><?= $product->getNome() ?></h2>
        <p><strong>Preço:</strong> R$ <?= $product->getPreco() ?></p>
        <p><strong>Descrição:</strong> <?= $product->getDescricao() ?></p>
        <a href="index.php?action=product-edit&id=<?= $product->getId() ?>" type="button" class="btn edit">Editar Produto</a>
        <a href="index.php?action=product-delete&id=<?= $product->getId() ?>" type="button" class="btn delete" onclick="return confirm('Você tem certeza que deseja deletar esse produto?')">Deletar Produto</a>
    </article>
</div>