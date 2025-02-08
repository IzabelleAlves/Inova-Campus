<div class="container">
    <h2>Faça negócios no Inova Campus</h2>
    <h3 class="subtitulo">Onde vendedores e clientes encontram as melhores oportunidades para comprar e vender</h3>
    <form method="post">
        <label for="email">Email:</label>
        <input 
            type="email" 
            id="email" 
            name="email"
            placeholder="Digite aqui ..." 
            value="<?= $_POST['email'] ?? ''?>"  
            required
        />

        <label for="senha">Senha:</label>
        <input 
            type="password" 
            id="senha" 
            name="password"
            placeholder="Digite aqui ..." 
            required
        />
        <a href="#" class="esqueceu">Esqueceu a senha?</a>

        <button type="submit" class="btn entrar">Entrar</button>
        <a href="index.php?action=user-create" class="btn cadastrar">Não possui conta?</a>
    </form>
</div>