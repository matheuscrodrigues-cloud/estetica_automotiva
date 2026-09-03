<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Estética Automotiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4 text-primary">Login</h2>
        
        <form method="POST" action="<?= $_SERVER['SCRIPT_NAME'] ?>?acao=logar">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="seu@email.com">
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required placeholder="Sua senha">
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
        </form>
        
        <div class="text-center">
            <a href="<?= $_SERVER['SCRIPT_NAME'] ?>?acao=tela_cadastro" class="text-decoration-none">Criar uma conta</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>