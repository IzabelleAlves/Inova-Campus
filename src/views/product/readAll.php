<div class="container">
    <article class="user-menu">
        <h2><?= $read[0]['PDT_NOME'] ?></h2>
        <p><strong>Vendedor:</strong> <?= $read[0]['USE_NOME'] ?></p>
        <p><strong>Contato:</strong> <?= $read[0]['USE_TELEFONE'] ?></p>
        <p><strong>Preço:</strong> R$ <?= $read[0]['PDT_PRECO'] ?></p>
        <p><strong>Descrição:</strong> <?= $read[0]['PDT_DESCRICAO'] ?></p>
        <a href="index.php?action=product-carrinho&id=<?= $read[0]['PDT_ID'] ?>" type="button" class="btn enviar">Adicionar ao carrinho</a>
    </article>
</div>