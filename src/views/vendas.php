<div class="user-info">
    <div class="user-container">
        <img
            src="./src/assets/img/usuario.jpg"
            alt="Usuário"
            class="user-img" />
        <span class="user"><a href="index.php?action=user"><?= $_SESSION['user']['name'] ?></a></span>
    </div>

    <div>
        <button class="logout"><a href="index.php?logout.php">Sair da conta</a></button>
    </div>
</div>

<section class="categorias">
    <h2>Categorias</h2>
    <div class="icons">
        <div class="categoria item">
            <img src="./src/assets/img/lanche.png" alt="Lanches" />
            <p>Lanches</p>
        </div>
        <div class="categoria item">
            <img src="./src/assets/img/artesanato.jpg" alt="Artesanato" />
            <p>Artesanato</p>
        </div>
        <div class="categoria item">
            <img src="./src/assets/img/platinha.png" alt="Plantinhas" />
            <p>Plantinhas</p>
        </div>
        <div class="categoria item">
            <img src="./src/assets/img/cupcake.png" alt="Doces" />
            <p>Doces</p>
        </div>
    </div>
</section>

<section class="mais-vendidos">
    <h2>Mais vendidos da semana</h2>
    <?php foreach($products as $p): ?>
    <div class="produto">
        <img src="./src/assets/img/empada.jpg" alt="Empada do Borges" />
        <div class="info">
            <h3><?= $p['pdt_name'] ?></h3>
            <p class="preco"><?= $p['pdt_unit_price'] ?></p>
            <button class="btn"><a href="index.php?action=product-read&id=<?= $p['pdt_id'] ?>">Comprar</a></button>
        </div>
    </div>
    <?php endforeach ?>
</section>

<style>
* {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  box-sizing: border-box;
}

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

body {
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  background-color: #ffffff;
  overflow-x: hidden;
}

.header {
  background-color: #2e7d32;
  color: white;
  padding: 15px;
  text-align: left;
  font-size: small;
}

.user-info {
  display: flex;
  align-items: center; /* Corrigido */
  justify-content: space-between; /* Aplica espaçamento entre os elementos */
  gap: 10px;
  margin: 10px 0;
  padding: 30px;
}

.user-img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.user-container {
  display: flex;
  align-items: center;
  gap: 10px;
}

a {
  text-decoration: none;
}

.logout {
  /* background-color: #c90c0f; */
  border: 1px solid #c90c0f;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

.logout a {
  color: #c90c0f;
}

.categorias {
  text-align: center;
  padding: 15px;
}

.categorias .item {
  border: 1px solid black;
  padding: 10px;
  border-radius: 10px;
}

.categorias .item p {
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

.icons {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-top: 10px;
}

.categoria img {
  width: 50px;
  height: 50px;
}

.mais-vendidos {
  padding: 30px;
}

.mais-vendidos h2 {
  font-weight: 600;
}

.produto {
  display: flex;
  align-items: center;
  background: #f8f8f8;
  padding: 10px;
  margin-top: 15px;
  border-radius: 8px;
  border: 1px solid #dadada;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

.produto img {
  width: 100px;
  height: 100px;
  border-radius: 10px;
}

.info {
  margin-left: 10px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  align-items: flex-start;
}

.info h3 {
  font-weight: 400;
  margin-bottom: 5px;
}

.preco {
  font-size: 1.2em;
  font-weight: bold;
}

.btn {
  background-color: #c90c0f;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: auto; /* Empurra o botão para o final */
  align-self: flex-end; /* Alinha o botão à direita */
}

</style>