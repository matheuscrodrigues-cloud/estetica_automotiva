<?php

class Conexao {
    private static $pdo = null;

    public static function getConexao() {
        if (self::$pdo === null) {
            try {
                $host = 'localhost';
                $db   = 'estetica_automotiva';
                $user = 'root';
                $pass = '';

                self::$pdo = new PDO("mysql:host=$host", $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                self::$pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
                self::$pdo->exec("USE `$db`;");

                self::$pdo->exec("
                    CREATE TABLE IF NOT EXISTS usuarios (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nome VARCHAR(100) NOT NULL,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        senha VARCHAR(255) NOT NULL,
                        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    );
                    CREATE TABLE IF NOT EXISTS agendamentos (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        usuario_id INT NOT NULL,
                        cliente_nome VARCHAR(100) NOT NULL,
                        veiculo VARCHAR(100) NOT NULL,
                        servico VARCHAR(100) NOT NULL,
                        data_agendamento DATE NOT NULL,
                        horario VARCHAR(10) NOT NULL,
                        status VARCHAR(20) DEFAULT 'Pendente',
                        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
                    );
                ");
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados MySQL: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}