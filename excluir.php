<?php
include 'conexao.php';

// Verifica se o ID foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "ID inválido.";
  exit;
}

$id = intval($_GET['id']);

// Se o formulário com a senha foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $senha = $_POST['senha'] ?? '';

  if ($senha === '123') {
    // Senha correta, executa a exclusão
    $sql = "DELETE FROM vendas WHERE id = $id";

    if ($conexao->query($sql) === TRUE) {
      header("Location: index.php");
      exit;
    } else {
      echo "Erro ao excluir: " . $conexao->error;
    }
  } else {
    echo "<p style='color: red;'>Senha incorreta.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Confirmar Exclusão</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 2em;
    }
    form {
      max-width: 300px;
      margin: 0 auto;
    }
    input[type="password"], button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <h2>Confirmação de Exclusão</h2>
  <p>Para excluir o registro <strong>#<?php echo $id; ?></strong>, digite a senha:</p>
  <form method="POST">
    <input type="password" name="senha" placeholder="Digite a senha" required />
    <button type="submit">Confirmar Exclusão</button>
  </form>
</body>
</html>
