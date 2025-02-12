<div class="container">
    <a href="index.php" class="voltar">Voltar</a>

    <div class="user-info">
        <img src="../assets/figma/fotodeUsuario.jpg" alt="Usuário" class="user-img">
        <span class="user">Usuário</span>
    </div>

    <h2>Comece a empreender</h2>
    <p>Cadastre os seus produtos</p>

    <form method="post">
        <label for="nome">Nome do Produto:</label>
        <input 
            type="text" 
            name="name" 
            id="nome" placeholder="Digite o nome do produto"
            value="<?= $_POST['name'] ?? '' ?>"
        />

        <label for="valor">Valor:</label>
        <input 
            type="number" 
            name="price" 
            id="valor" step="0.01" min="0"  placeholder="Digite valor do produto"
            value="<?= $_POST['price'] ?? 0 ?>"
        />

        <label for="quantidade">Quantidade:</label>
        <input 
            type="text" 
            name="units" 
            id="quantidade" 
            placeholder="Digite a quantidade do produto"
            value="<?= $_POST['units'] ?? 0 ?>"
        />

        <label for="description">Description:</label>
        <textarea name="description" id="description">
        <?= $_POST['description'] ?? '' ?>
        </textarea>
        <!-- <label for="imagem">Upload de Imagem:</label>
        <input type="file" id="imagem"> -->

        <button type="submit">Cadastrar</button>
    </form>
    <div class="erros">
        <?php if (isset($error['query'])): ?>
            <span class="erro"><?= htmlspecialchars($error['query']) ?></span>
            <?php $error = [] ?>
        <?php endif ?>
    </div>
</div>