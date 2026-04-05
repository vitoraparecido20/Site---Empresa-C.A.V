<?php
require_once 'conexao.php';

$tipo = $_GET['tipo'] ?? 'funcionarios';
$resultados = [];

try {
    if ($tipo == 'funcionarios') {
        $sql = "SELECT nome as coluna1, cpf as coluna2, valor_hora as coluna3 FROM funcionarios";
        $titulo = ["Nome", "CPF", "Valor/Hora"];
    } elseif ($tipo == 'clientes') {
        $sql = "SELECT nome_social as coluna1, cnpj_cpf as coluna2, telefone as coluna3 FROM clientes";
        $titulo = ["Razão Social", "CNPJ/CPF", "Telefone"];
    } elseif ($tipo == 'recebiveis') {
        $sql = "SELECT cliente as coluna1, valor as coluna2, data_vencimento as coluna3 FROM recebiveis";
        $titulo = ["Cliente", "Valor", "Vencimento"];
    }

    $stmt = $pdo->query($sql);
    $resultados = $stmt->fetchAll();
} catch (Exception $e) {
    $resultados = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatórios do Sistema</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f0f2f5; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        select, button { padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #007bff; color: white; }
        .btn-csv { background: #28a745; color: white; border: none; padding: 10px; cursor: pointer; float: right; }
    </style>
</head>
<body>

<div class="card">
    <h2>📊 Gerar Relatórios</h2>

    <form method="GET">
        <label>Tipo de Relatório:</label>
        <select name="tipo">
            <option value="funcionarios" <?= $tipo == 'funcionarios' ? 'selected' : '' ?>>Funcionários Ativos</option>
            <option value="clientes" <?= $tipo == 'clientes' ? 'selected' : '' ?>>Clientes Cadastrados</option>
            <option value="recebiveis" <?= $tipo == 'recebiveis' ? 'selected' : '' ?>>Recebíveis Pendentes</option>
        </select>
        <button type="submit">Gerar</button>
        <button type="button" class="btn-csv" onclick="exportarCSV()">📥 Baixar CSV</button>
    </form>

    <table id="tabelaRelatorio">
        <thead>
            <tr>
                <th><?= $titulo[0] ?></th>
                <th><?= $titulo[1] ?></th>
                <th><?= $titulo[2] ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $linha): ?>
            <tr>
                <td><?= htmlspecialchars($linha['coluna1']) ?></td>
                <td><?= htmlspecialchars($linha['coluna2']) ?></td>
                <td><?= $tipo == 'recebiveis' ? 'R$ ' . number_format($linha['coluna3'], 2, ',', '.') : htmlspecialchars($linha['coluna3']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function exportarCSV() {
    let csv = [];
    let rows = document.querySelectorAll("table tr");
    for (let i = 0; i < rows.length; i++) {
        let row = [], cols = rows[i].querySelectorAll("td, th");
        for (let j = 0; j < cols.length; j++) row.push(cols[j].innerText);
        csv.push(row.join(";"));
    }
    let csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
    let downloadLink = document.createElement("a");
    downloadLink.download = "relatorio.csv";
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.click();
}
</script>

</body>
</html>