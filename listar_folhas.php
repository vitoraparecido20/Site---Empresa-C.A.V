<?php
require_once 'conexao.php';
$folhas = $pdo->query("SELECT fp.*, f.nome FROM folha_pagamento fp JOIN funcionarios f ON fp.funcionario_id = f.id ORDER BY id DESC")->fetchAll();
?>

<h2>📚 Histórico de Pagamentos</h2>
<table border="1" style="width:100%; border-collapse: collapse;">
    <tr style="background: #ccc;">
        <th>Funcionário</th>
        <th>Mês/Ano</th>
        <th>Bruto</th>
        <th>Descontos</th>
        <th>Líquido</th>
    </tr>
    <?php foreach($folhas as $folha): ?>
    <tr>
        <td><?= $folha['nome'] ?></td>
        <td><?= $folha['mes_referencia'] ?>/<?= $folha['ano_referencia'] ?></td>
        <td>R$ <?= number_format($folha['salario_bruto'], 2, ',', '.') ?></td>
        <td>R$ <?= number_format($folha['total_vales'], 2, ',', '.') ?></td>
        <td><strong>R$ <?= number_format($folha['salario_liquido'], 2, ',', '.') ?></strong></td>
    </tr>
    <?php endforeach; ?>
</table>