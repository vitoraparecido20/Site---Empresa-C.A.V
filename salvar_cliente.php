<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_social'] ?? '';
    $doc  = $_POST['cnpj_cpf'] ?? '';
    $tel  = $_POST['telefone'] ?? '';
    $mail = $_POST['email'] ?? '';

    try {
        $sql = "INSERT INTO clientes (nome_social, cnpj_cpf, telefone, email) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $doc, $tel, $mail]);

        echo "✅ Cliente salvo com sucesso!";
        echo "<br><a href='index.php'>Voltar ao Menu</a>";
    } catch (PDOException $e) {
        echo "❌ Erro ao salvar no banco: " . $e->getMessage();
    }
}
?>