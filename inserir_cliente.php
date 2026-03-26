<?php
include 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$sql = "INSERT INTO clientes (nome, email, telefone)
VALUES ('$nome', '$email', '$telefone')";

if ($conn->query($sql) === TRUE) {
    echo "Cliente cadastrado com sucesso!";
} else {
    echo "Erro: " . $conn->error;
}
?>