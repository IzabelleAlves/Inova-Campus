<div class="container">
    <h3><?= $products['pdt_name'] ?></h3>
    <img src="./src/assets/img/platinha.png" alt="Foto do produto" class="produto" />
    <p><strong>Preço: R$ </strong> <?= $products['pdt_unit_price'] ?> </p>
    <p><strong>Quantidade </strong> <?= $products['pdt_units'] ?> </p>
    <p><strong>Descrição </strong> <?= $products['pdt_description'] ?> </p>

    <form method="post" action="index.php?action=adicionar_carrinho">
        <input type="hidden" name="pdt_id" value="<?= $products['pdt_id'] ?>">
        <input type="hidden" name="pdt_name" value="<?= $products['pdt_name'] ?>">
        <input type="hidden" name="pdt_unit_price" value="<?= $products['pdt_unit_price'] ?>">
        <input type="number" name="pdt_units" value="<?= $products['pdt_units'] ?>">
        <input type="hidden" name="pdt_user" value="<?= $products['pdt_user'] ?>">
        <button type="submit">Adicionar ao carrinho</button>
    </form>
</div>

