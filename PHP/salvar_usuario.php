<?php
include("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios (nome,email,senha) VALUES ('$nome','$email','$senha')";

mysqli_query($conexao, $sql);

echo "Usuário cadastrado com sucesso!";
?>