<?php
// includes/functions.php - Funções auxiliares

require_once 'config.php';

// Função para verificar login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Função para verificar se é admin
function isAdmin() {
    return isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin';
}

// Função para verificar conflito de horário
function checkConflict($sala_id, $data_inicio, $data_fim) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservas WHERE sala_id = ? AND status = 'aprovado' AND ((data_inicio < ? AND data_fim > ?) OR (data_inicio < ? AND data_fim > ?))");
    $stmt->execute([$sala_id, $data_fim, $data_inicio, $data_inicio, $data_fim]);
    return $stmt->fetchColumn() > 0;
}

// Função para verificar limite de reservas por usuário (ex: 5 por semana)
function checkUserLimit($usuario_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservas WHERE usuario_id = ? AND data_inicio >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
    $stmt->execute([$usuario_id]);
    $count = $stmt->fetchColumn();
    $stmt2 = $pdo->prepare("SELECT limite_reservas FROM usuarios WHERE id = ?");
    $stmt2->execute([$usuario_id]);
    $limite = $stmt2->fetchColumn();
    return $count >= $limite;
}

// Função para sanitizar entrada
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>