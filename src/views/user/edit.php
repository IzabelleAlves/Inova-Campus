<div class="container">
    <h2>Editar</h2>
    <form id="form" action="index.php?action=user-edit" method="post" >
        <label for="email">
            Email:
            <input
                type="text"
                id="email"
                name="email"
                class="input required"
                placeholder="Digite seu E-mail"
                title="Exemplo: exemple@email.com"
                value="<?=$_SESSION['email']?>"
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
                value="<?=$_SESSION['nome']?>"
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
                value="<?=$_SESSION['telefone']?>"
                required
            />
            <span class="span-required" style="display: none;">Digite um número válido!</span>
        </label>
        <fieldset class="selecao">
            <legend>Função:</legend>
            <label for="cliente" class="tipo-selecao">
                <input 
                    type="radio" 
                    name="tipo" 
                    id="cliente" 
                    value="0" 
                    <?=$_SESSION['tipo'] === 0 ? "checked" : ""?> 
                    hidden 
                    required
                />
                <span class="radio-style"></span>
                Cliente
            </label>
            <label for="vendedor" class="tipo-selecao">
                <input 
                    type="radio" 
                    name="tipo" 
                    id="vendedor" 
                    value="1" 
                    <?=$_SESSION['tipo'] === 1 ? "checked" : ""?> 
                    hidden 
                    required
                />
                <span class="radio-style"></span>
                Vendedor
            </label>
        </fieldset>
        <input type="submit" class="btn enviar" value="Atualizar"/>
    </form>
    <script defer src="./assets/js/user/create.js"></script>
</div>

