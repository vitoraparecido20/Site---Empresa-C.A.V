<?php require_once 'conexao.php'; 
// Busca funcionários para o campo de seleção
$stmt = $pdo->query("SELECT id, nome FROM funcionarios ORDER BY nome ASC");
$funcionarios = $stmt->fetchAll();
?>

<h2>💰 Lançar Novo Vale</h2>
<form action="salvar_vale.php" method="POST">
    <label>Funcionário:</label><br>
    <select name="funcionario_id" required>
        <option value="">Selecione o funcionário...</option>
        <?php foreach($funcionarios as $f): ?>
            <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Valor do Vale (R$):</label><br>
    <input type="number" step="0.01" name="valor" required><br><br>

    <label>Data:</label><br>
    <input type="date" name="data_vale" value="<?= date('Y-m-d') ?>" required><br><br>

    <label>Motivo/Descrição:</label><br>
    <input type="text" name="motivo" placeholder="Ex: Adiantamento quinzenal"><br><br>

    <button type="submit">Salvar Vale</button>
</form>