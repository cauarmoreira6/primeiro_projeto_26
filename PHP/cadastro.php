<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
    <div class="container-login">

        <h2>Criar Nova Conta</h2>

        <form id="formCadastro">
            <form action="salvar_usuario.php" method="POST">

            <label>Nome</label> 
            <input type="text" id="nome" placeholder="Digite seu nome" required>

            <label>Email</label>
            <input type="email" id="emailCadastro" placeholder="Digite seu email" required>

            <label>Senha</label>
            <input type="password" id="senhaCadastro" placeholder="Digite sua senha" required>

            <label>Confirmar Senha</label>
            <input type="password" id="confirmarSenha" placeholder="Confirme sua senha" required>

            <label>Tipo de Usuário</label>
            <select id="tipoUsuario" required>

                <!-- Menu para escolher tipo -->
                <option value="">Selecione</option>
                <option value="aluno">Aluno</option>
                <option value="gestor">Professor / CEO</option>
            </select>

            <button type="submit">Cadastrar</button>

        </form>

        <p id="mensagemCadastro"></p>
        <!-- Aqui vai aparecer mensagem de erro ou sucesso -->

        <p>Já tem conta? <a href="index.php">Fazer Login</a></p>
        <!-- Link para voltar ao login -->

    </div>

    <script src="../JS/script.js"></script>
</body>

</html>