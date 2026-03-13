<?php
// includes/config.php - Configuração da conexão PDO com MySQL

$host = 'localhost';
$dbname = 'sistema_reservas';
$username = 'root'; // Usuário padrão do XAMPP
$password = 'mysql'; // Senha vazia por padrão no XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>