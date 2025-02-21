<?php
// Se o botão de resetar for pressionado, apaga o cookie e recarrega a página
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['resetar_carrinho'])) {
        setcookie('carrinho', '', time() - 3600, "/");
        header("Location: index.php?action=carrinho");
        exit;
    } elseif (isset($_POST['comprar_carrinho'])) {
        $compra['pedido'] = [
            'id' => 1,
            'id_cli' => $_SERVER['id'],
            'id_vnd' => $idem['vendedor'],
            'data' => 	date('d/m/Y H:i:s')
        ];

        $compra['detalhes'] = [
            'id' => 1,
            'produto' => $item['nome'],
            'preco' => $item['preco'],
            'quantidade' => $item['quantidade'],
            'status' => ''
        ];
        echo "<script>alert('Compra realizada com sucesso!');</script>";
    }
}

// Obtém o carrinho do cookie
$carrinho = isset($_COOKIE['carrinho']) ? json_decode($_COOKIE['carrinho'], true) : [];
?>

<h2>Seu Carrinho</h2>

<?php if (empty($carrinho)): ?>
    <p>Seu carrinho está vazio.</p>
<?php else: ?>
    <ul>
        <?php foreach ($carrinho as $item): ?>
            <li>
                <?= $item['nome'] ?> - R$ <?= number_format($item['preco'], 2, ',', '.') ?> 
                (Quantidade: <?= $item['quantidade'] ?>)
                Valor Total: R$ <?= number_format($item['valor_total'], 2, ',', '.') ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="index.php?action=vendas">Comprar mais</a>

<!-- Botão para resetar o carrinho -->
<form method="post">
    <button type="submit" name="resetar_carrinho">Resetar Carrinho</button>
    <button type="submit" name="comprar_carrinho">Comprar tudo</button>
</form>
<?= var_dump($carrinho) ?>
