<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Estética Automotiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">Estética Automotiva</a>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Olá, <b><?php echo $_SESSION['usuario_nome']; ?></b></span>
                <a href="index.php?acao=sair" class="btn btn-outline-danger btn-sm">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Novo Agendamento</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="index.php?acao=agendar">
                            <div class="mb-3">
                                <label for="cliente_nome" class="form-label">Nome do Cliente:</label>
                                <input type="text" id="cliente_nome" name="cliente_nome" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="veiculo" class="form-label">Veículo (Carro/Modelo):</label>
                                <input type="text" id="veiculo" name="veiculo" class="form-control" placeholder="Ex: Gol - ABC1D23" required>
                            </div>

                            <div class="mb-3">
                                <label for="servico" class="form-label">Serviço:</label>
                                <select id="servico" name="servico" class="form-select" required>
                                    <option value="Lavagem Simples">Lavagem Simples</option>
                                    <option value="Lavagem Detalhada">Lavagem Detalhada</option>
                                    <option value="Polimento Técnico">Polimento Técnico</option>
                                    <option value="Higienização Interna">Higienização Interna</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="data_agendamento" class="form-label">Data:</label>
                                <input type="date" id="data_agendamento" name="data_agendamento" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="horario" class="form-label">Horário:</label>
                                <input type="time" id="horario" name="horario" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Salvar Agendamento</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Agendamentos Salvos</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Veículo</th>
                                        <th>Serviço</th>
                                        <th>Data/Hora</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($agendamentos)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">Nenhum agendamento cadastrado.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($agendamentos as $item): ?>
                                            <tr>
                                                <td><?php echo $item['cliente_nome']; ?></td>
                                                <td><?php echo $item['veiculo']; ?></td>
                                                <td><span class="badge bg-info text-dark"><?php echo $item['servico']; ?></span></td>
                                                <td><?php echo date('d/m/Y', strtotime($item['data_agendamento'])) . ' às ' . $item['horario']; ?></td>
                                                <td class="text-center">
                                                    <a href="index.php?acao=excluir&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>