<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Estética Automotiva</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 50px; }
        .box { background: #fff; padding: 20px; width: 300px; margin: 0 auto; border: 1px solid #ccc; }
        h2 { text-align: center; }
        input { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: green; color: white; border: none; cursor: pointer; }
        a { display: block; text-align: center; margin-top: 10px; color: blue; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Criar Conta</h2>
        <form method="POST" action="../../index.php?acao=cadastrar">
            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>E-mail:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
        <a href="../../index.php">Já tenho conta (Voltar)</a>
    </div>
</body>
</html>