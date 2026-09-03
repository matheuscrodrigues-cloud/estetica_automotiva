<?php

class Conexao {
    private static $instancia = null;

    public static function getConexao() {
        if (self::$instancia === null) {
            try {
                // 1. Conecta ao MySQL server para verificar/criar o Banco de Dados
                $pdoConfig = new PDO("mysql:host=localhost", "root", "", [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);

                $pdoConfig->exec("CREATE DATABASE IF NOT EXISTS `estetica_automotiva` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

                // 2. Conecta diretamente no banco estetica_automotiva
                self::$instancia = new PDO("mysql:host=localhost;dbname=estetica_automotiva;charset=utf8mb4", "root", "", [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);

                // 3. Garante a criação automática das tabelas necessárias
                self::criarTabelas();

            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }

    private static function criarTabelas() {
        // Tabela de Usuários
        self::$instancia->exec("
            CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                senha VARCHAR(255) NOT NULL,
                criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB;
        ");

        // Tabela de Agendamentos
        self::$instancia->exec("
            CREATE TABLE IF NOT EXISTS agendamentos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                usuario_id INT NOT NULL,
                servico VARCHAR(100) NOT NULL,
                veiculo VARCHAR(100) NOT NULL,
                data_agendamento DATETIME NOT NULL,
                status VARCHAR(50) DEFAULT 'Pendente',
                criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ");
    }
}