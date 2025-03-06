<div class="container">
    <h2>Produtos cadastrados</h2>
    <table class="productTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Contato</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productsList) && is_array($productsList)): ?>
                <?php foreach ($productsList as $products): ?>
                    <tr>
                        <td><?= htmlspecialchars($products["PDT_ID"]) ?></td>
                        <td><?= htmlspecialchars($products["PDT_NOME"]) ?></td>
                        <td>R$ <?= number_format($products["PDT_PRECO"], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($products["USE_TELEFONE"]) ?></td>
                        <td><?= htmlspecialchars($products["PDT_DESCRICAO"]) ?></td>
                        <td>
                            <?php if ($_SESSION['id'] === $products['USE_ID']): ?>
                                <a href="index.php?action=product-edit&id=<?= $products["PDT_ID"] ?>">Editar</a>
                                <a href="index.php?action=product-read&id=<?= $products["PDT_ID"] ?>">Ver</a>
                                <a href="index.php?action=product-delete&id=<?= $products["PDT_ID"] ?>" onclick="return confirm('Você tem certeza que deseja deletar este produto?')">Excluir</a>
                            <?php else: ?>
                                <a href="index.php?action=product-readAll&id=<?= $products["PDT_ID"] ?>">Ver</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum produto encontrado.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
