<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $func_id   = $_POST['funcionario_id'];
    $valor     = $_POST['valor'];
    $data_vale = $_POST['data_vale'];
    $motivo    = $_POST['motivo'] ?? '';

    try {
        $sql = "INSERT INTO vales (funcionario_id, data_vale, valor, motivo) 
                VALUES (:f_id, :dt, :vl, :mt)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':f_id' => $func_id,
            ':dt'   => $data_vale,
            ':vl'   => $valor,
            ':mt'   => $motivo
        ]);

        echo "<script>alert('Vale registrado com sucesso!'); window.location.href='listar_vales.php';</script>";
    } catch (PDOException $e) {
        echo "Erro ao salvar vale: " . $e->getMessage();
    }
}