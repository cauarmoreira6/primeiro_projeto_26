<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
    <header>

        <h1>Sistema de Reservas</h1>

        <nav>
            <ul class="nav-list">
                <li><a href="dashboard.php">Início</a></li>
                <li><a href="reservar.php">Reservar Sala</a></li>
                <li class="dropdown">
                    <button class="dropbtn" aria-haspopup="true" aria-expanded="false">Minhas Reservas ▾</button>
                    <ul class="dropdown-content" aria-label="submenu">
                        <li><a href="#">Ver Reservas</a></li>
                        <li><a href="#">Cancelar Reserva</a></li>
                    </ul>
                </li>
                <li><a href="index.php">Sair</a></li>
            </ul>
        </nav>

    </header>

    <section class="conteudo"> 

        <h2>Bem-vindo ao Sistema</h2>
        <p>Aqui você pode gerenciar suas reservas.</p> 

    </section>

    <script src="../JS/script.js"></script> 

</body>

</html>