<?php
session_start();
require_once __DIR__ . '/app/Conexao.php';

$db = Conexao::getConexao();
$acao = $_GET['acao'] ?? 'login';

// Cadastro de usuario
if ($acao === 'cadastrar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $senha]);
        echo "<script>alert('Conta criada com sucesso!'); window.location.href='index.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Erro: E-mail ja cadastrado!'); window.location.href='index.php?acao=tela_cadastro';</script>";
        exit;
    }
}

// Login
if ($acao === 'logar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: index.php?acao=dashboard");
        exit;
    } else {
        echo "<script>alert('E-mail ou senha incorretos!'); window.location.href='index.php';</script>";
        exit;
    }
}

// Salvar Agendamento
if ($acao === 'agendar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php");
        exit;
    }

    $stmt = $db->prepare("INSERT INTO agendamentos (usuario_id, cliente_nome, veiculo, servico, data_agendamento, horario) VALUES (:usuario_id, :cliente_nome, :veiculo, :servico, :data_agendamento, :horario)");
    $stmt->execute([
        ':usuario_id' => $_SESSION['usuario_id'],
        ':cliente_nome' => $_POST['cliente_nome'],
        ':veiculo' => $_POST['veiculo'],
        ':servico' => $_POST['servico'],
        ':data_agendamento' => $_POST['data_agendamento'],
        ':horario' => $_POST['horario']
    ]);

    header("Location: index.php?acao=dashboard");
    exit;
}

// Excluir Agendamento
if ($acao === 'excluir') {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php");
        exit;
    }

    $id = $_GET['id'] ?? 0;
    $stmt = $db->prepare("DELETE FROM agendamentos WHERE id = :id AND usuario_id = :usuario_id");
    $stmt->execute([
        ':id' => $id,
        ':usuario_id' => $_SESSION['usuario_id']
    ]);

    header("Location: index.php?acao=dashboard");
    exit;
}

// Deslogar
if ($acao === 'sair') {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Renderizacao das Views
if ($acao === 'dashboard') {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php");
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM agendamentos WHERE usuario_id = :usuario_id ORDER BY data_agendamento ASC");
    $stmt->execute([':usuario_id' => $_SESSION['usuario_id']]);
    $agendamentos = $stmt->fetchAll();

    require_once __DIR__ . '/app/views/dashboard.php';
} elseif ($acao === 'tela_cadastro') {
    require_once __DIR__ . '/app/views/cadastro.php';
} else {
    require_once __DIR__ . '/app/views/login.php';
}