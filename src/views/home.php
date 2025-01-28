<div class="container">
    <h2><?= "Olá " . $_SESSION['nome'] ?></h2>
    <p><a href="index.php?action=user-edit" class="btn edit">Editar</a></p>
    <p><a href="index.php?action=user-delete" class="btn delete" onclick="return confirm('Você tem certeza que deseja deletar sua conta?')">Deletar</a></p>
</div>