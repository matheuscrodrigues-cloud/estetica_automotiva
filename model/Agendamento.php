<?php

class Agendamento {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function listarPorUsuario($usuarioId) {
        $stmt = $this->pdo->prepare("SELECT * FROM agendamentos WHERE usuario_id = :usuario_id ORDER BY data_agendamento DESC");
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll();
    }

    public function criar($usuarioId, $servico, $veiculo, $data) {
        $stmt = $this->pdo->prepare("INSERT INTO agendamentos (usuario_id, servico, veiculo, data_agendamento) VALUES (:usuario_id, :servico, :veiculo, :data)");
        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':servico'    => $servico,
            ':veiculo'    => $veiculo,
            ':data'       => $data
        ]);
    }
}