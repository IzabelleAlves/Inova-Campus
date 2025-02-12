<div class="container">
    <form method="post" >
        <label for="email">
            Email:
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Digite seu email" 
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                
            />
            <?php if (!empty($error['email'])): ?>
                <span class="erro"><?= htmlspecialchars($error['email']) ?></span>
            <?php endif ?>
        </label>
        
        <label for="nome">
            Nome Completo:
            <input
                type="text" 
                id="nome" 
                name="name" 
                placeholder="Digite seu nome"
                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" 
                
            />
            <?php if (!empty($error['name'])): ?>
                <span class="erro"><?= htmlspecialchars($error['name']) ?></span>
            <?php endif ?>
        </label>
        
        <label for="senha">
            Senha:
            <input 
                type="password"    
                id="senha" 
                name="password" 
                placeholder="Digite sua senha"
                value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" 
                
            />
            <?php if (!empty($error['password'])): ?>
                <span class="erro"><?= htmlspecialchars($error['password']) ?></span>
            <?php endif ?>
        </label>
        
        <label for="confirmaSenha">
            Confirme a senha:
            <input 
                type="password" 
                id="confirmaSenha" 
                name="confirm"
                placeholder="Repita sua senha" 
                value="<?= htmlspecialchars($_POST['confirm'] ?? '') ?>" 
                
            />
            <?php if (!empty($error['confirm'])): ?>
                <span class="erro"><?= htmlspecialchars($error['confirm']) ?></span>
            <?php endif ?>
        </label>
        
        <label for="whatsapp">
            Número do WhatsApp:
            <input 
                type="tel" 
                id="whatsapp" 
                name="tel" 
                placeholder="Digite apenas números" 
                value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>" 
                
            />
            <?php if (!empty($error['tel'])): ?>
                <span class="erro"><?= htmlspecialchars($error['tel']) ?></span>
            <?php endif ?>
        </label>
        
        <p>Eu sou:</p>
        <div class="radio-group">
            <input type="radio" id="cliente" name="function" value="cliente" checked>
            <label for="cliente">Cliente</label>
            <input type="radio" id="vendedor" name="function" value="vendedor">
            <label for="vendedor">Vendedor</label>
        </div>
        
        <button type="submit" class="btn">Cadastrar</button>
    </form>
</div>