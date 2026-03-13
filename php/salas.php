<?php
// php/salas.php - CRUD de Salas (apenas admin)

session_start();
require_once '../includes/functions.php';

if (!isAdmin()) {
    header('Location: ../index.php');
    exit;
}

$salas = $pdo->query("SELECT * FROM salas")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $nome = sanitize($_POST['nome']);
        $capacidade = (int)$_POST['capacidade'];
        $descricao = sanitize($_POST['descricao']);
        $stmt = $pdo->prepare("INSERT INTO salas (nome, capacidade, descricao) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $capacidade, $descricao]);
    } elseif (isset($_POST['update'])) {
        $id = (int)$_POST['id'];
        $nome = sanitize($_POST['nome']);
        $capacidade = (int)$_POST['capacidade'];
        $descricao = sanitize($_POST['descricao']);
        $stmt = $pdo->prepare("UPDATE salas SET nome = ?, capacidade = ?, descricao = ? WHERE idsala = ?");
        $stmt->execute([$nome, $capacidade, $descricao, $id]);
    } elseif (isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM salas WHERE idsala = ?");
        $stmt->execute([$id]);
    }
    header('Location: salas.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Salas - Sistema de Reservas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="calendario.php">Calendário</a>
        <a href="reservar.php">Reservar</a>
        <a href="minhas_reservas.php">Minhas Reservas</a>
        <a href="painel_gestor.php">Painel Gestor</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Gerenciar Salas</h1>
        <h2>Criar Nova Sala</h2>
        <form method="post">
            <input type="text" name="nome" placeholder="Nome da Sala" required>
            <input type="number" name="capacidade" placeholder="Capacidade" required>
            <textarea name="descricao" placeholder="Descrição"></textarea>
            <button type="submit" name="create">Criar</button>
        </form>
        <h2>Salas Existentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Capacidade</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salas as $sala): ?>
                    <tr>
                        <td><?php echo $sala['nome']; ?></td>
                        <td><?php echo $sala['capacidade']; ?></td>
                        <td><?php echo $sala['descricao']; ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $sala['idsala']; ?>">
                                <input type="text" name="nome" value="<?php echo $sala['nome']; ?>" required>
                                <input type="number" name="capacidade" value="<?php echo $sala['capacidade']; ?>" required>
                                <textarea name="descricao"><?php echo $sala['descricao']; ?></textarea>
                                <button type="submit" name="update">Atualizar</button>
                                <button type="submit" name="delete" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>