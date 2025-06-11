<?php
include 'conexao.php';

// Pega as vendas do banco
$vendas = $conexao->query("SELECT * FROM vendas ORDER BY id DESC");

if (!$vendas) {
    die("Erro ao buscar vendas: " . $conexao->error);
}

// Totais
$total_dia = 0;
$total_vendas = 0;
$total_dinheiro = 0;
$total_cartao_pix = 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Controle de Vendas</title>
  <link rel="stylesheet" href="./style.css" />
</head>
<body>
  <div class="container">
    <header class="header">
      <h1>Controle de Vendas</h1>
      <span class="date"><?php echo date('d/m/Y'); ?></span>
    </header>

    <section class="nova-venda">
      <h2>Nova Venda</h2>
      <form class="form-venda" action="salvar_venda.php" method="POST">
        <select class="ux" name="produto" required>
          <option value="" disabled selected>Selecione o produto</option>
          <option value="Alpargata">Alpargata</option>
          <option value="Chinelo">Chinelo</option>
          <option value="Perfume">Perfume</option>
          <option value="Bucket">Bucket</option>
          <option value="Bone">Boné</option>
          <option value="Carteira">Carteira</option>
          <option value="Relogio">Relogio</option>
          <option value="Pulseira">Pulseira</option>
          <option value="Corrente">Corrente</option>
          <option value="Pingente">Pingente</option>
          <option value="cx">Caixa de Relogio</option>
          <option value="oculos">Óculos</option>    
        </select>

        <input type="number" name="quantidade" placeholder="Quantidade" required />
        <input type="number" name="preco" placeholder="Preço" step="0.01" required />

        <select class="ux" name="forma_pagamento" required>
          <option value="" disabled selected>Forma de pagamento</option>
          <option value="Dinheiro">Dinheiro</option>
          <option value="Cartão">Crédito/Débito</option>
          <option value="Pix">Pix</option>
        </select> 

        <button type="submit">Adicionar Venda</button>
      </form>
    </section>

    <section class="vendas-realizadas">
      <h2>Vendas Realizadas</h2>
      <table>
        <thead>
          <tr>
            <th>Produto</th>
            <th>Qtde</th>
            <th>Preço Unitário</th>
            <th>Forma de Pagamento</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
        <?php while($v = $vendas->fetch_assoc()): 
          $subtotal = $v['quantidade'] * $v['preco_unitario'];
          $total_dia += $subtotal;
          $total_vendas++;
          if ($v['forma_pagamento'] === 'Dinheiro') {
            $total_dinheiro += $subtotal;
          } else {
            $total_cartao_pix += $subtotal;
          }
        ?>
          <tr>
            <td><?php echo $v['produto']; ?></td>
            <td><?php echo $v['quantidade']; ?></td>
            <td>R$ <?php echo number_format($v['preco_unitario'], 2, ',', '.'); ?></td>
            <td><?php echo $v['forma_pagamento']; ?></td>
            <td>
              <a href="editar.php?id=<?php echo $v['id']; ?>">✏️</a>
              <a href="excluir.php?id=<?php echo $v['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta venda?');">🗑️</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </section>

    <section class="resumo">
      <div>Total do dia: <strong>R$ <?php echo number_format($total_dia, 2, ',', '.'); ?></strong></div>
      <div>Total de vendas: <strong><?php echo $total_vendas; ?></strong></div>
      <div>Total Dinheiro: <strong>R$ <?php echo number_format($total_dinheiro, 2, ',', '.'); ?></strong></div>
      <div>Total Pix/Cartão: <strong>R$ <?php echo number_format($total_cartao_pix, 2, ',', '.'); ?></strong></div>
    </section>
  </div>
</body>
</html>
