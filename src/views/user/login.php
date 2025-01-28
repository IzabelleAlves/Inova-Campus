<div class="container">
    <h2>Login</h2>
    <form action="index.php?action=login" method="post">
        E-mail
        <label for="email">
            <input 
                type="email"
                id="email"
                name="email"
                class="input"
                required
            />
        </label>
        <label for="senha">
            Senha
            <input 
                type="password"
                id="senha"
                name="senha"
                class="input"
                required
            />
        </label>
        <input type="submit" class="btn enviar" value="Enviar">
    </form>
</div>