<?php
// index.php - Página inicial

session_start();
require_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas de Salas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <?php if (isLoggedIn()): ?>
            <a href="php/calendario.php">Calendário</a>
            <a href="php/reservar.php">Reservar</a>
            <a href="php/minhas_reservas.php">Minhas Reservas</a>
            <?php if (isAdmin()): ?>
                <a href="php/painel_gestor.php">Painel Gestor</a>
                <a href="php/salas.php">Salas</a>
            <?php endif; ?>
            <a href="php/logout.php">Logout</a>
        <?php else: ?>
            <a href="php/login.php">Login</a>
        <?php endif; ?>
    </nav>
    <div class="container">
        <h1>Bem-vindo ao Sistema de Reservas de Salas/Laboratórios</h1>
        <?php if (isLoggedIn()): ?>
            <p>Olá, <?php echo $_SESSION['user_name']; ?>!</p>
        <?php else: ?>
            <p>Faça login para acessar o sistema.</p>
        <?php endif; ?>
    </div>
</body>
</html>
