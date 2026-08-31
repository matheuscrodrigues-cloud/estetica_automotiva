
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel - Estética Automotiva</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .header { background: #333; color: #fff; padding: 15px; display: flex; justify-content: space-between; align-items: center; border-radius: 5px; }
        .header a { color: #ff4d4d; text-decoration: none; font-weight: bold; }
        .container { display: flex; gap: 20px; margin-top: 20px; }
        .box { background: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; flex: 1; }
        input, select { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: green; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        .btn-excluir { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Painel de Agendamentos</h2>
        <span>Olá, <b><?php echo $_SESSION['usuario_nome']; ?></b> | <a href="index.php?acao=sair">Sair</a></span>
    </div>

    <div class="container">
        <!-- Formulario -->
        <div class="box">
            <h3>Novo Agendamento</h3>
            <form method="POST" action="index.php?acao=agendar">
                <label>Nome do Cliente:</label>
                <input type="text" name="cliente_nome" required>

                <label>Veículo (Carro/Modelo):</label>
                <input type="text" name="veiculo" placeholder="Ex: Gol - ABC1D23" required>

                <label>Serviço:</label>
                <select name="servico" required>
                    <option value="Lavagem Simples">Lavagem Simples</option>
                    <option value="Lavagem Detalhada">Lavagem Detalhada</option>
                    <option value="Polimento Técnico">Polimento Técnico</option>
                    <option value="Higienização Interna">Higienização Interna</option>
                </select>

                <label>Data:</label>
                <input type="date" name="data_agendamento" required>

                <label>Horário:</label>
                <input type="time" name="horario" required>

                <button type="submit">Salvar Agendamento</button>
            </form>
        </div>

        <!-- Tabela -->
        <div class="box">
            <h3>Agendamentos Salvos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Veículo</th>
                        <th>Serviço</th>
                        <th>Data/Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($agendamentos)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Nenhum agendamento cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($agendamentos as $item): ?>
                            <tr>
                                <td><?php echo $item['cliente_nome']; ?></td>
                                <td><?php echo $item['veiculo']; ?></td>
                                <td><?php echo $item['servico']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($item['data_agendamento'])) . ' às ' . $item['horario']; ?></td>
                                <td>
                                    <a href="index.php?acao=excluir&id=<?php echo $item['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>