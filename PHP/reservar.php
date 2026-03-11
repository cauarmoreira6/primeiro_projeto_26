<?php
// php/reservar.php - Página de reserva

session_start();
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$salas = $pdo->query("SELECT * FROM salas")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sala_id = (int)$_POST['sala_id'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    if (checkConflict($sala_id, $data_inicio, $data_fim)) {
        $error = "Conflito de horário detectado.";
    } elseif (checkUserLimit($_SESSION['user_id'])) {
        $error = "Limite de reservas atingido.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO reservas (usuario_id, sala_id, data_inicio, data_fim) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $sala_id, $data_inicio, $data_fim]);
        $success = "Reserva solicitada com sucesso.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Reservar Sala - Sistema de Reservas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="calendario.php">Calendário</a>
        <a href="minhas_reservas.php">Minhas Reservas</a>
        <?php if (isAdmin()) echo '<a href="painel_gestor.php">Painel Gestor</a>'; ?>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Reservar Sala</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="post">
            <select name="sala_id" required>
                <option value="">Selecione uma sala</option>
                <?php foreach ($salas as $sala): ?>
                    <option value="<?php echo $sala['id']; ?>"><?php echo $sala['nome']; ?> (Capacidade: <?php echo $sala['capacidade']; ?>)</option>
                <?php endforeach; ?>
            </select>
            <input type="datetime-local" name="data_inicio" required>
            <input type="datetime-local" name="data_fim" required>
            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>