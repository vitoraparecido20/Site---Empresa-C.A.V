<?php
require_once 'conexao.php';

// Busca funcionários para o select
$funcionarios = $pdo->query("SELECT * FROM funcionarios")->fetchAll();

$dados_folha = null;
if (isset($_GET['funcionario_id'])) {
    $f_id = $_GET['funcionario_id'];

    // 1. Busca dados do funcionário
    $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id = ?");
    $stmt->execute([$f_id]);
    $f = $stmt->fetch();

    // 2. Soma os vales desse funcionário que ainda não foram descontados
    $stmt = $pdo->prepare("SELECT SUM(valor) as total FROM vales WHERE funcionario_id = ? AND status = 'A descontar'");
    $stmt->execute([$f_id]);
    $vales = $stmt->fetch();

    $salario_bruto = $f['valor_hora'] * $f['horas_trabalhadas'];
    $total_vales = $vales['total'] ?? 0;
    $salario_liquido = $salario_bruto - $total_vales;
}
?>

<h2>📄 Gerar Folha de Pagamento</h2>
<form method="GET">
    <select name="funcionario_id" onchange="this.form.submit()">
        <option value="">Selecione o Funcionário</option>
        <?php foreach($funcionarios as $func): ?>
            <option value="<?= $func['id'] ?>" <?= isset($f_id) && $f_id == $func['id'] ? 'selected' : '' ?>>
                <?= $func['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if (isset($f)): ?>
    <div style="background: #eee; padding: 20px; margin-top: 20px; border-radius: 8px;">
        <h3>Resumo: <?= $f['nome'] ?></h3>
        <p>Salário Bruto: R$ <?= number_format($salario_bruto, 2, ',', '.') ?></p>
        <p>Total de Vales a Descontar: <span style="color:red">- R$ <?= number_format($total_vales, 2, ',', '.') ?></span></p>
        <hr>
        <h4>Salário Líquido: R$ <?= number_format($salario_liquido, 2, ',', '.') ?></h4>

        <form action="salvar_folha.php" method="POST">
            <input type="hidden" name="funcionario_id" value="<?= $f['id'] ?>">
            <input type="hidden" name="bruto" value="<?= $salario_bruto ?>">
            <input type="hidden" name="vales" value="<?= $total_vales ?>">
            <input type="hidden" name="liquido" value="<?= $salario_liquido ?>">

            <label>Mês/Ano de Referência:</label>
            <input type="month" name="referencia" required value="<?= date('Y-m') ?>">
            <br><br>
            <button type="submit" style="background: green; color: white; padding: 10px;">Finalizar e Salvar Folha</button>
        </form>
    </div>
<?php endif; ?>