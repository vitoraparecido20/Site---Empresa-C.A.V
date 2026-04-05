<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletando dados do formulário
    $cliente    = $_POST['cliente'] ?? '';
    $descricao  = $_POST['descricao'] ?? '';
    $valor      = $_POST['valor'] ?? 0;
    $vencimento = $_POST['vencimento'] ?? '';
    $emissao    = date('Y-m-d'); // Pega a data atual automaticamente

    if (!empty($cliente) && !empty($valor)) {
        try {
            $sql = "INSERT INTO recebiveis (cliente, descricao, valor, data_emissao, data_vencimento) 
                    VALUES (:cli, :des, :val, :emi, :ven)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':cli' => $cliente,
                ':des' => $descricao,
                ':val' => $valor,
                ':emi' => $emissao,
                ':ven' => $vencimento
            ]);

            echo "<script>alert('Recebível registrado com sucesso!'); window.location.href='listar_recebiveis.php';</script>";
        } catch (PDOException $e) {
            echo "❌ Erro ao salvar: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Preencha todos os campos obrigatórios.";
    }
}
?>