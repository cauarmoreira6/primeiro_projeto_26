<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Sala - Sistemas de Reservas</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
    <div class="container-login">

        <h2>Reservar Sala</h2>

        <form id="formReserva">

            <label>Sala</label>
            <select id="sala" required>
                <option value="">Selecione a sala</option>
                <option value="lab1">Laboratório 1</option>
                <option value="lab2">Laboratório 2</option>
                <option value="sala1">Sala 101</option>
                <option value="sala2">Sala 102</option>
            </select>

            <label>Data</label>
            <input type="date" id="data" required>

            <label>Hora Início</label>
            <input type="time" id="horaInicio" required>

            <label>Hora Fim</label>
            <input type="time" id="horaFim" required>

            <button type="submit">Reservar</button>

        </form>

        <p id="mensagemReserva"></p>

        <p><a href="dashboard.php">Voltar ao Dashboard</a></p>

    </div>

    <script src="../js/script.js"></script>
</body>

</html>