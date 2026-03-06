<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Reservas</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
    <div class="container-login"> 

        <h2>Login do Sistema</h2>

        <img src="../imagens/img_logo.png">

        <form id="formLogin"> 

            <label>Email</label> 
            <input type="email" id="email" placeholder="Digite seu email" required>

            <label>Senha</label> 
            <input type="password" id="senha" placeholder="Digite sua senha" required>

            <button type="submit">Entrar</button>

            <br><br>
            <p>Não tem conta? <a href="cadastro.php">Criar conta</a></p>
        </form>

        <p id="mensagemErro"></p>
        <!-- Aqui vai aparecer mensagem de erro se o login falhar -->

    </div>

    <script src="../JS/script.js"></script>
</body>

</html>