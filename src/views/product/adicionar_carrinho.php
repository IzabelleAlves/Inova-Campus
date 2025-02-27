<?php
// Inicia a sessão para garantir persistência
session_start();

// Verifica se existe o cookie 'carrinho', caso contrário, inicializa um array
$carrinho = isset($_COOKIE['carrinho']) ? json_decode($_COOKIE['carrinho'], true) : [];

// Obtém os dados do formulário
$pdt_id = $_POST['pdt_id'];
$pdt_name = $_POST['pdt_name'];
$pdt_unit_price = $_POST['pdt_unit_price'];
$pdt_units = $_POST['pdt_units'];
$pdt_user = $_POST['pdt_user'];

// Verifica se o produto já está no carrinho
$produtoExiste = false;
foreach ($carrinho as &$item) { // Adicionado "&" para referenciar o item no array
    if ($item['id'] == $pdt_id) {
        $item['quantidade'] += $pdt_units; // Incrementa a quantidade
        $item['valor_total'] = $item['quantidade'] * $item['preco']; // Atualiza o valor total
        $item['vendedor'] = $pdt_user; // Vendedor do produto
        $produtoExiste = true;
        break;
    }
}
unset($item); // Remove a referência para evitar efeitos colaterais

// Se o produto não estiver no carrinho, adiciona
if (!$produtoExiste) {
    $carrinho[] = [
        'id' => $pdt_id,
        'nome' => $pdt_name,
        'preco' => $pdt_unit_price,
        'quantidade' => $pdt_units,
        'valor_total' => $pdt_units * $pdt_unit_price,
        'vendedor' => $pdt_user
    ];
}


// Atualiza o cookie com os novos dados (expira em 7 dias)
setcookie('carrinho', json_encode($carrinho), time() + (86400 * 7), "/");

// Redireciona para a página do carrinho ou de produtos
header("Location: index.php?action=carrinho");
exit;

