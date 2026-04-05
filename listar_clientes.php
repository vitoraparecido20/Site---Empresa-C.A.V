<?php
require_once 'conexao.php';

try {
    $stmt = $pdo->query("SELECT * FROM clientes ORDER BY nome_social ASC");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $clientes = [];
}
?>

<h2>📋 Lista de Clientes</h2>
<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f4f4f4;">
            <th>Razão Social</th>
            <th>CNPJ/CPF</th>
            <th>Telefone</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['nome_social']) ?></td>
            <td><?= htmlspecialchars($c['cnpj_cpf']) ?></td>
            <td><?= htmlspecialchars($c['telefone']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<a href="cadastrar_cliente.php">Cadastrar Novo Cliente</a>