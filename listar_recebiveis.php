<?php
require_once 'conexao.php';

// Busca os recebíveis ordenados pela data de vencimento
$stmt = $pdo->query("SELECT * FROM recebiveis ORDER BY data_vencimento ASC");
$recebiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Vencimento</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($recebiveis as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['cliente']) ?></td>
            <td><?= htmlspecialchars($r['descricao']) ?></td>
            <td>R$ <?= number_format($r['valor'], 2, ',', '.') ?></td>
            <td><?= date('d/m/Y', strtotime($r['data_vencimento'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>