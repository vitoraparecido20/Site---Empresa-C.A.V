<?php
require_once 'conexao.php';

// Busca vales juntando com a tabela de funcionários para pegar o nome
$sql = "SELECT v.*, f.nome as nome_funcionario 
        FROM vales v 
        INNER JOIN funcionarios f ON v.funcionario_id = f.id 
        ORDER BY v.data_vale DESC";

$stmt = $pdo->query($sql);
$vales = $stmt->fetchAll();
?>

<h2>📋 Histórico de Vales / Adiantamentos</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f4f4f4;">
            <th>Funcionário</th>
            <th>Data</th>
            <th>Valor</th>
            <th>Motivo</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vales as $v): ?>
        <tr>
            <td><?= htmlspecialchars($v['nome_funcionario']) ?></td>
            <td><?= date('d/m/Y', strtotime($v['data_vale'])) ?></td>
            <td>R$ <?= number_format($v['valor'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($v['motivo']) ?></td>
            <td><strong><?= $v['status'] ?></strong></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<a href="cadastrar_vale.php">Lançar Novo Vale</a>