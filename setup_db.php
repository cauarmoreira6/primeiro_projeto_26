<?php
// setup_db.php - Script para configurar o banco de dados

require_once 'includes/config.php';

try {
    // Criar banco se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS sistema_reservas");
    $pdo->exec("USE sistema_reservas");

    // Ler e executar o arquivo SQL
    $sql = file_get_contents('database.sql');
    $pdo->exec($sql);

    echo "Banco de dados configurado com sucesso!";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>