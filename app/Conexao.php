<?php

class Conexao {
    private static $instance;

    public static function getConexao() {
        if (!isset(self::$instance)) {
            try {
                $host = 'localhost';
                $db   = 'estetica_automotiva';
                $user = 'root';
                $pass = ''; // Altere aqui se o seu MySQL tiver senha

                // Conexão com o servidor MySQL
                self::$instance = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // Cria o banco de dados se não existir
                self::$instance->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
                self::$instance->exec("USE `$db`;");

                // Cria tabela de usuários
                self::$instance->exec("CREATE TABLE IF NOT EXISTS usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(100) NOT NULL,
                    email VARCHAR(100) UNIQUE NOT NULL,
                    senha VARCHAR(255) NOT NULL
                )");

                // Cria tabela de agendamentos com TODAS as colunas necessárias
                self::$instance->exec("CREATE TABLE IF NOT EXISTS agendamentos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    usuario_id INT,
                    cliente_nome VARCHAR(100) NOT NULL,
                    veiculo VARCHAR(100) NOT NULL,
                    servico VARCHAR(100) NOT NULL,
                    data_agendamento DATE NOT NULL,
                    horario TIME NOT NULL,
                    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
                )");

            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados MySQL: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}