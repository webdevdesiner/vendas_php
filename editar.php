<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
  echo "ID não fornecido.";
  exit;
}

$id = intval($_GET['id']);
$result = $conexao->query("SELECT * FROM vendas WHERE id = $id");
$venda = $result->fetch_assoc();

if (!$venda) {
  echo "Venda não encontrada.";
  exit;
}

// Lista de produtos e formas de pagamento
$produtos = ["Alpargata", "Chinelo", "Perfume", "Bucket", "Bone", "Carteira", "Relogio", "Pulseira", "Corrente", "Pingente", "cx", "oculos"];
$formas = ["Dinheiro", "Cartão", "Pix"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Editar Venda</title>
  <link rel="stylesheet" href="./style.css" />
</head>
<body>
  <div class="container">
    <header class="header">
      <h1>Editar Venda</h1>
      <a href="index.php">← Voltar</a>
    </header>

    <section class="nova-venda">
      <form class="form-venda" action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $venda['id']; ?>">

        <select class="ux" name="produto" required>
          <option value="" disabled>Selecione o produto</option>
          <?php foreach ($produtos as $p): ?>
            <option value="<?php echo $p; ?>" <?php if ($venda['produto'] == $p) echo 'selected'; ?>>
              <?php echo ucfirst($p); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <input type="number" name="quantidade" placeholder="Quantidade" value="<?php echo $venda['quantidade']; ?>" required />
        <input type="number" name="preco" placeholder="Preço" step="0.01" value="<?php echo $venda['preco_unitario']; ?>" required />

        <select class="ux" name="forma_pagamento" required>
          <option value="" disabled>Forma de pagamento</option>
          <?php foreach ($formas as $f): ?>
            <option value="<?php echo $f; ?>" <?php if ($venda['forma_pagamento'] == $f) echo 'selected'; ?>>
              <?php echo $f; ?>
            </option>
          <?php endforeach; ?>
        </select>

        <button type="submit">Salvar Alterações</button>
      </form>
    </section>
  </div>
</body>
</html>
