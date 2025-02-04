<div class="container">
    <h2>Cadastro de Produtos</h2>
    <form action="index.php" method="post" id="form">
        <label>
            Nome do Produto:
            <input type="text" id="nome" class="required" name="nome" placeholder="Digite o nome..." required/>
            <span class="span-required">Digite o nome ao produto</span>
        </label>
        <label>
            Quantidade:
            <input type="number" id="quantidade" class="required" name="quantidade"placeholder="Digite a quantidade..." required/>
            <span class="span-required">Digite a quantidade ao produto</span>
        </label>
        <label for="categoria">
            Tipo:
            <input type="text" id="categoria" class="required" list="sugestoes" placeholder="Digite a categoria..." required/>
            <span class="span-required">Digite ou selecione um categoria</span>
            <datalist id="sugestoes">
                <option value="Lanche"></option>
                <option value="Almoço"></option>
                <option value="Artesanato"></option>
                <option value="Plantinhas"></option>
            </datalist>
        </label>
        <label id="drop-label" for="file-input">
            <p id="drop-text">Arraste uma imagem aqui ou clique para selecionar</p>
            <input type="file" name="file-input" id="file-input" accept="image/*" hidden>
            <img src="" alt="Pré visualização da imagem" id="preview" style="display: none">
            <button type="button" id="remove-btn" style="display: none">Remover imagem</button>
            <span class="span-required">Escolha uma imagem</span>
        </label>
        <input type="submit" class="enviar" value="Cadastrar">
    </form>
</div>
<script>
    <?php include './assets/js/products/create.js' ?>
</script>