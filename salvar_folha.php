<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $f_id = $_POST['funcionario_id'];
    $bruto = $_POST['bruto'];
    $total_vales = $_POST['vales'];
    $liquido = $_POST['liquido'];
    $ref = explode('-', $_POST['referencia']); // Separa ano e mês

    try {
        $pdo->beginTransaction();

        // 1. Salva na tabela de folha
        $sql = "INSERT INTO folha_pagamento (funcionario_id, mes_referencia, ano_referencia, salario_bruto, total_vales, salario_liquido, data_fechamento) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$f_id, $ref[1], $ref[0], $bruto, $total_vales, $liquido, date('Y-m-d')]);

        // 2. Atualiza os vales para 'Descontado' para não aparecerem na próxima folha
        $upd = $pdo->prepare("UPDATE vales SET status = 'Descontado' WHERE funcionario_id = ? AND status = 'A descontar'");
        $upd->execute([$f_id]);

        $pdo->commit();
        echo "<script>alert('Folha fechada com sucesso!'); window.location.href='listar_folhas.php';</script>";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
    }
}