<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; max-width: 400px; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>➕ Cadastrar Novo Cliente</h2>

    <form action="salvar_cliente.php" method="POST">
        <div class="form-group">
            <label>Nome / Razão Social:</label>
            <input type="text" name="nome_social" required>
        </div>

        <div class="form-group">
            <label>CNPJ / CPF:</label>
            <input type="text" name="cnpj_cpf">
        </div>

        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>

        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email">
        </div>

        <button type="submit">Salvar Cliente</button>
        <a href="listar_clientes.php">Ver Lista de Clientes</a>
    </form>

</body>
</html>