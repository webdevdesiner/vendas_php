<?php
include 'conexao.php';

if (isset($_POST['id'])) {
  $id = intval($_POST['id']);
  $produto = $_POST['produto'];
  $quantidade = intval($_POST['quantidade']);
  $preco = floatval($_POST['preco']);
  $forma_pagamento = $_POST['forma_pagamento'];

  $sql = "UPDATE vendas SET 
            produto = '$produto',
            quantidade = $quantidade,
            preco_unitario = $preco,
            forma_pagamento = '$forma_pagamento'
          WHERE id = $id";

  if ($conexao->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
  } else {
    echo "Erro ao atualizar: " . $conexao->error;
  }
}
?>
