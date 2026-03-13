<?php
// php/calendario.php - Calendário de reservas

session_start();
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Buscar reservas aprovadas
$reservas = $pdo->query("SELECT r.*, s.nome AS sala_nome, u.nome AS usuario_nome FROM reservas r JOIN salas s ON r.sala_id = s.idsala JOIN usuarios u ON r.usuario_id = u.idusuarios WHERE r.status = 'aprovado' ORDER BY r.data_inicio")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calendário - Sistema de Reservas</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="reservar.php">Reservar</a>
        <a href="minhas_reservas.php">Minhas Reservas</a>
        <?php if (isAdmin()) echo '<a href="painel_gestor.php">Painel Gestor</a>'; ?>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Calendário de Reservas</h1>
        <div id="calendar"></div>
    </div>
    <script src="../js/calendar.js"></script>
    <script>
        const reservas = <?php echo json_encode($reservas); ?>;
        initCalendar(reservas);
    </script>
</body>
</html>