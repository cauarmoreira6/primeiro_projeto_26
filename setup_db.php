<?php
// setup_db.php - Script para configurar o banco de dados

require_once 'includes/config.php';

try {
    // Dropar tabelas existentes se existirem
    $pdo->exec("DROP TABLE IF EXISTS reservas");
    $pdo->exec("DROP TABLE IF EXISTS salas_recursos");
    $pdo->exec("DROP TABLE IF EXISTS recursos");
    $pdo->exec("DROP TABLE IF EXISTS salas");
    $pdo->exec("DROP TABLE IF EXISTS usuarios");

    // Criar tabelas
    $sql = "
    CREATE TABLE usuarios (
        idusuarios INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        senha VARCHAR(255) NOT NULL,
        tipo ENUM('aluno', 'professor', 'admin') NOT NULL,
        limite_reservas INT DEFAULT 5
    );

    CREATE TABLE salas (
        idsala INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        capacidade INT NOT NULL,
        descricao TEXT
    );

    CREATE TABLE recursos (
        idrecurso INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL
    );

    CREATE TABLE salas_recursos (
        sala_id INT,
        recurso_id INT,
        PRIMARY KEY (sala_id, recurso_id),
        FOREIGN KEY (sala_id) REFERENCES salas(idsala) ON DELETE CASCADE,
        FOREIGN KEY (recurso_id) REFERENCES recursos(idrecurso) ON DELETE CASCADE
    );

    CREATE TABLE reservas (
        idreserva INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        sala_id INT NOT NULL,
        data_inicio DATETIME NOT NULL,
        data_fim DATETIME NOT NULL,
        status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'pendente',
        motivo TEXT,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(idusuarios) ON DELETE CASCADE,
        FOREIGN KEY (sala_id) REFERENCES salas(idsala) ON DELETE CASCADE
    );
    ";

    $pdo->exec($sql);

    // Inserir dados iniciais
    $pdo->exec("INSERT INTO recursos (nome) VALUES ('Projetor'), ('PCs'), ('Quadro Branco')");

    // Hash da senha para 'admin'
    $senha_hash = password_hash('admin', PASSWORD_DEFAULT);

    $pdo->exec("INSERT INTO usuarios (nome, email, senha, tipo) VALUES
    ('Admin', 'admin@example.com', '$senha_hash', 'admin'),
    ('Professor João', 'joao@example.com', '$senha_hash', 'professor'),
    ('Aluno Maria', 'maria@example.com', '$senha_hash', 'aluno')");

    $pdo->exec("INSERT INTO salas (nome, capacidade, descricao) VALUES
    ('Laboratório 1', 30, 'Laboratório de Informática'),
    ('Sala de Reuniões', 10, 'Sala para reuniões'),
    ('Auditório', 100, 'Espaço para palestras')");

    echo "Banco de dados configurado com sucesso!";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>