<div class="container">
    <article class="user-menu">
        <h2><?= "Olá " . $_SESSION['nome'] ?></h2>
        <button type="buttom" class="btn enviar">
            <a href="index.php?action=product-create">Criar Produtos</a>
        </button>
        <button type="buttom" class="btn edit">
            <a href="index.php?action=user-edit"">Editar Perfil</a>
        </button>
        <button type="button" class="btn delete">
            <a href="index.php?action=user-delete" onclick="return confirm('Você tem certeza que deseja deletar sua conta?')">Deletar Perfil</a>
        </button>
    </article>
</div>