<h2>Cadastre-se</h2>
<form class="quadrado-container">
    <label>
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
    <label>
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
    <label>
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
    <label>
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
    <label>
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
    <div class="selecao">
        <label for="cliente" class="tipo-selecao">
            <input type="radio" name="tipo" id="cliente" value="cliente"  required />
            <span class="radio-indicator"></span>
            Cliente
        </label>
        <label for="vendedor" class="tipo-selecao">
            <input type="radio" name="tipo" id="vendedor" value="vendedor"  required/>
            <span class="radio-indicator"></span>
            Vendedor
        </label>
    </div>
    <button class="botaocadastrar">CADASTRAR</button>
</form>
<input 
    type="tel" 
    id="telefone" 
    placeholder="(XX)XXXXX-XXXX" 
    maxlength="15" 
    required 
/>

<script>
    <?php include "./src/assets/js/createUser.js" ?>
</script>
