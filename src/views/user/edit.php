<div class="container">
    <form method="post" >
        <label for="email">
            Email:
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Digite seu email" 
                value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" 
                
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
                value="<?= htmlspecialchars($_SESSION['user']['name']) ?>" 
                
            />
            <?php if (!empty($error['name'])): ?>
                <span class="erro"><?= htmlspecialchars($error['name']) ?></span>
            <?php endif ?>
        </label>
        
        <label for="whatsapp">
            Número do WhatsApp:
            <input 
                type="tel" 
                id="whatsapp" 
                name="tel" 
                placeholder="Digite apenas números" 
                value="<?= htmlspecialchars($_SESSION['user']['tel']) ?>"                 
            />
            <?php if (!empty($error['tel'])): ?>
                <span class="erro"><?= htmlspecialchars($error['tel']) ?></span>
            <?php endif ?>
        </label>
        
        <p>Eu sou:</p>
        <div class="radio-group">
            <input type="radio" id="cliente" name="function" value="cliente" <?= $_SESSION['user']['function'] === 'cliente' ? 'checked' : '' ?>/>
            <label for="cliente">Cliente</label>
            <input type="radio" id="vendedor" name="function" value="vendedor" <?= $_SESSION['user']['function'] === 'vendedor' ? 'checked' : '' ?> />
            <label for="vendedor">Vendedor</label>
        </div>
        <button type="reset" class="btn cancel">Descartar Alterações</button>
        <button type="submit" class="btn">Atualizar</button>
    </form>
</div>