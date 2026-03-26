<?php
include 'conexao.php';

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "Nome: " . $row['nome'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "Telefone: " . $row['telefone'] . "<br><hr>";
}
?>