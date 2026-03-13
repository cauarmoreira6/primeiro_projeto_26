<?php
// php/painel_gestor.php - Painel do gestor (admin)

session_start();
require_once '../includes/functions.php';

if (!isAdmin()) {
    header('Location: ../index.php');
    exit;
}

// Aprovar/rejeitar reservas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    $reserva_id = (int)$_POST['reserva_id'];
    $acao = $_POST['acao'];
    $status = $acao == 'aprovar' ? 'aprovado' : 'rejeitado';
    $stmt = $pdo->prepare("UPDATE reservas SET status = ? WHERE idreserva = ?");
    $stmt->execute([$status, $reserva_id]);
    header('Location: painel_gestor.php');
    exit;
}

$reservas_pendentes = $pdo->query("SELECT r.*, s.nome AS sala_nome, u.nome AS usuario_nome FROM reservas r JOIN salas s ON r.sala_id = s.idsala JOIN usuarios u ON r.usuario_id = u.idusuarios WHERE r.status = 'pendente' ORDER BY r.data_inicio")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Gestor - Sistema de Reservas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="calendario.php">Calendário</a>
        <a href="reservar.php">Reservar</a>
        <a href="minhas_reservas.php">Minhas Reservas</a>
        <a href="salas.php">Salas</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Painel Gestor</h1>
        <h2>Reservas Pendentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Sala</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas_pendentes as $reserva): ?>
                    <tr>
                        <td><?php echo $reserva['usuario_nome']; ?></td>
                        <td><?php echo $reserva['sala_nome']; ?></td>
                        <td><?php echo $reserva['data_inicio']; ?></td>
                        <td><?php echo $reserva['data_fim']; ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva['idreserva']; ?>">
                                <button type="submit" name="acao" value="aprovar">Aprovar</button>
                                <button type="submit" name="acao" value="rejeitar">Rejeitar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>