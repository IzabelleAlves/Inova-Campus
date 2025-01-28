<div class="container">
    <h2>Produtos cadastrados</h2>
    <table class="productTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($productsList) && is_array($productsList)): ?>
                <?php foreach ($productsList as $products): ?>
                    <tr>
                        <td><?=$products["PDT_ID"]?></td>
                        <td><?=$products["PDT_NOME"]?></td>
                        <td><?=$products["PDT_PRECO"]?></td>
                        <td><?=$products["PDT_DESCRICAO"]?></td>
                        <td>
                            <a href="">Editar</a>
                            <a href="">Ver</a>
                            <a href="">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td>Nenhum produto encontrado.</td>
                </tr>
            <?php endif ?>

            

        </tbody>
    </table>
</div>