<div class="container">
    <h2>Login</h2>
    <form action="index.php?action=login" method="post">
    <label for="email">
            Email:
            <input
                type="text"
                id="email"
                name="email"
                class="input required"
                placeholder="Digite seu E-mail"
                title="Exemplo: exemple@email.com"
                required
            />
            <span class="span-required" style="display: none;">Digite um email válido!</span>
        </label>
        <label for="senha">
            Senha:
            <input
                type="password"
                id="senha"
                name="senha"
                class="input required"
                placeholder="Digite uma senha"
                title="DIgite sua senha"
                minlength="8"
                required
            />
            <span class="span-required" style="display: none;">Digite uma senha válida!</span>
        </label>
        <input type="submit" class="enviar" value="Enviar">
    </form>
</div>