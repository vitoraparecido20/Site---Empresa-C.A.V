<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $valor_hora = $_POST['valor_hora'] ?? 0;
    $horas = $_POST['horas_trabalhadas'] ?? 0;

    if ($nome) {
        try {
            $sql = "INSERT INTO funcionarios (nome, cpf, valor_hora, horas_trabalhadas) 
                    VALUES (:nome, :cpf, :valor, :horas)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':valor' => $valor_hora,
                ':horas' => $horas
            ]);

            header("Location: conexao.php?sucesso=1"); // Redireciona de volta
            exit();
        } catch (PDOException $e) {
            echo "Erro ao salvar: " . $e->getMessage();
        }
    }
} else {
    echo "Método não permitido. Use o formulário.";
}