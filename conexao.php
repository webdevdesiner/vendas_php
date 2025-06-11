<?php
$host = "localhost";
$usuario = "u937729098_root";
$senha = "LPYTVB965l#";
$banco = "u937729098_controle_venda";

$conexao = new mysqli($host, $usuario, $senha, $banco);
if ($conexao->connect_error) {
  die("Erro na conexão: " . $conexao->connect_error);
}
?>
