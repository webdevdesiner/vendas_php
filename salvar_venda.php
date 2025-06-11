<?php
include 'conexao.php';

$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$preco = $_POST['preco'];
$forma = $_POST['forma_pagamento'];

$sql = "INSERT INTO vendas (produto, quantidade, preco_unitario, forma_pagamento)
        VALUES ('$produto', $quantidade, $preco, '$forma')";

if ($conexao->query($sql) === TRUE) {
  header("Location: index.php");
} else {
  echo "Erro: " . $conexao->error;
}
?>
