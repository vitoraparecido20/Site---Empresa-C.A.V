<?php
// Garante que o arquivo de conexão existe antes de continuar
if (!file_exists('conexao.php')) {
    die("Erro: O arquivo conexao.php não foi encontrado.");
}

require_once 'conexao.php';

// Verifica se a variável $pdo realmente existe e não é nula
if (!isset($pdo) || $pdo === null) {
    die("Erro: A conexão com o banco de dados ($pdo) não foi inicializada corretamente no arquivo conexao.php.");
}

try {
    // 1. Busca todos os funcionários ordenados pelo nome
    $sql = "SELECT * FROM funcionarios ORDER BY nome ASC";
    $stmt = $pdo->query($sql);

    // 2. Busca os dados
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Se a tabela não existir ainda, este erro será capturado aqui
    $funcionarios = []; 
    $erro_msg = "Erro ao buscar dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .erro { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Funcionários Cadastrados</h2>

    <?php if (isset($erro_msg)): ?>
        <p class="erro"><?php echo $erro_msg; ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Valor Hora</th>
                <th>Horas Trab.</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($funcionarios)): ?>
                <?php foreach ($funcionarios as $f): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($f['nome'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($f['cpf'] ?? ''); ?></td>
                        <td>R$ <?php echo number_format($f['valor_hora'] ?? 0, 2, ',', '.'); ?></td>
                        <td><?php echo $f['horas_trabalhadas'] ?? 0; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum funcionário cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="funcionario.html">Voltar ao Cadastro</a>

</body>
</html>