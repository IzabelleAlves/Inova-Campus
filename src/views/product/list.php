<div class="container">
    <a href="#" class="back-link">Voltar</a>
    <div class="profile">
        <img src="./src/assets/img/usuario.jpg" alt="Usuário" class="perfil" />
        <p class="user-name"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></p>
    </div>
    <h1 class="titulo">Editar Produtos</h1>
    <p class="legenda">Meus Produtos:</p>
    </div>


    <div class="grid-products">
        <?php foreach ($products as $p): ?>
        <div class="produtos">
            <img src="./src/assets/img/platinha.png" alt="Foto do produto" class="produto" />
            <p class="preço"><?= $p['pdt_unit_price'] ?></p>
            <p class="nomeP"><?= $p['pdt_name'] ?></p>
            <a href="index.php?action=product-edit&id=<?= $p['pdt_id'] ?>">
                <button class="editar">Editar</button>
            </a>
        </div>
        <?php endforeach ?>
    </div>
    <button class="adicionarP"><a href="index.php?action=product-create">Adicionar Produtos</a></button>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
body {
    
    font-family: 'Poppins', sans-serif;
    background-color: #f8f8f8;
    text-align: center;
}

.header {
    background-color: green;
    color: white;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    text-align: left;
}

.back-link {
    display: block; 
    text-align: left; 
    margin: 15px; 
    color: #333;
    text-decoration: none;
    font-size: 14px;
    padding-left: 15px; 
    text-decoration: underline;
}
.profile {
    display: flex;
    flex-direction:row;
    align-items: center;
    gap: 10px;
    margin-top: 30px;
    position: relative;
}

.perfil {
    width: 33px;
    height: 33px;
    border-radius: 50%;
    object-fit: cover;
    border: none;
    margin-left: 20px;
}

.user-name {
    font-size: 16px;
    margin: 0;
}

.titulo {
    font-size: 23px;
    margin-top: 30px;
} 

.legenda {
    text-align: left; 
    margin-top: 40px; 
    font-size: 16px;
    padding-left: 30px; 
}

.produtos {
    width: 120px; 
    background: rgb(223, 222, 222);
    padding: 10px;
    margin-left: 30px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
}

.produto {
    width: 100%;
    height: 90px;
    object-fit: cover; 
}

.preço {
    font-size: 13px;
    text-align: left;
    margin-top: -1px;
    font-weight:bold;
}

.grid-products {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem 0;
}

.nomeP {
    font-size: 12px;
    margin-top: -10px;
    text-align: left;
}

.editar {
    margin-top: 20px; /* Espaço entre a legenda e o botão */
    padding: 5px 10px;
    background-color:white; /* Cor de fundo */
    color: red;
    border: 1px solid red;
    font-size: 12px;
    text-transform: uppercase;
}

.adicionarP {
    padding: 15px 20px;
    background-color: green; /* Cor de fundo */
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 12px;
    text-transform: uppercase; /* Deixa o texto em caixa alta */
    bottom: 20px;
    margin-top: 70px;
}

a {
    color: white;
    text-decoration: none;
}
</style>