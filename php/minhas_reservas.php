<?php
// php/minhas_reservas.php - Minhas reservas

session_start();
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT r.*, s.nome AS sala_nome FROM reservas r JOIN salas s ON r.sala_id = s.idsala WHERE r.usuario_id = ? ORDER BY r.data_inicio DESC");
$stmt->execute([$_SESSION['user_id']]);
$reservas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas Reservas - Sistema de Reservas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="calendario.php">Calendário</a>
        <a href="reservar.php">Reservar</a>
        <?php if (isAdmin()) echo '<a href="painel_gestor.php">Painel Gestor</a>'; ?>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Minhas Reservas</h1>
        <table>
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?php echo $reserva['sala_nome']; ?></td>
                        <td><?php echo $reserva['data_inicio']; ?></td>
                        <td><?php echo $reserva['data_fim']; ?></td>
                        <td><?php echo ucfirst($reserva['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>