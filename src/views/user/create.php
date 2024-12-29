<div class="container">
    <h2>Cadastre-se</h2>
    <form id="form" action="" method="post" >
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
        <label for="nome">
            Nome completo:
            <input
                type="text"
                id="nome"
                name="nome"
                class="input required"
                placeholder="Digite seu nome completo"
                title="Exemplo: José da Silva Santos"
                required
            />
            <span class="span-required" style="display: none;">Digite um nome válido!</span>
        </label>
        <label for="senha">
            Senha:
            <input
                type="password"
                id="senha"
                name="senha"
                class="input required"
                placeholder="Digite uma senha com 8 digitos"
                title="Cire uma senha com letras e números"
                minlength="8"
                required
            />
            <span class="span-required" style="display: none;">Digite uma senha válida!</span>
        </label>
        <label for="confirme">
            Confirme a senha:
            <input
                type="password"
                id="confirme"
                name="confirme"
                class="input required"
                placeholder="Confirme sua senha"
                title="Digite sua senha novamente"
                required
            />
            <span class="span-required" style="display: none;">Senhas diferentes!</span>
        </label>
        <label for="telefone" >
            Telefone:
            <input
                type="tel"
                id="telefone"
                name="telefone"
                class="input required"
                placeholder="Digite seu telefone"
                title="Exemplo: (XX)XXXXX-XXXX"
                pattern="\(\d{2}\)\d{4,5}-\d{4}"
                maxlength="15"
                required
            />
            <span class="span-required" style="display: none;">Digite um número válido!</span>
        </label>
        <fieldset class="selecao">
            <legend>Função:</legend>
            <label for="cliente" class="tipo-selecao">
                <input type="radio" name="tipo" id="cliente" value="cliente" checked hidden required/>
                <span class="radio-style"></span>
                Cliente
            </label>
            <label for="vendedor" class="tipo-selecao">
                <input type="radio" name="tipo" id="vendedor" value="vendedor" hidden required/>
                <span class="radio-style"></span>
                Vendedor
            </label>
        </fieldset>
        <input type="submit" class="enviar" value="Cadastrar"/>
    </form>
</div>

<script>
    <?php include "./assets/js/createUser.js" ?>
</script>
