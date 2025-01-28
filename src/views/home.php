<div class="container">
    <article class="user-menu">
        <h2><?= "Olá " . $_SESSION['nome'] ?></h2>
        <a href="index.php?action=product-create" type="button" class="btn create">Criar Produtos</a>        
        <a href="index.php?action=user-edit" type="button" class="btn edit">Editar Perfil</a>        
        <a href="index.php?action=user-delete" type="button" class="btn delete" onclick="return confirm('Você tem certeza que deseja deletar sua conta?')">Deletar Perfil</a>    
    </article>
</div>