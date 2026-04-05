<?php
try {
    $pdo = new PDO("sqlite:database.db");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Todas as tabelas necessárias
    $pdo->exec("CREATE TABLE IF NOT EXISTS funcionarios (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT, cpf TEXT, valor_hora REAL, horas_trabalhadas INTEGER)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS clientes (id INTEGER PRIMARY KEY AUTOINCREMENT, nome_social TEXT, cnpj_cpf TEXT, telefone TEXT, email TEXT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS recebiveis (id INTEGER PRIMARY KEY AUTOINCREMENT, cliente TEXT, valor REAL, data_vencimento DATE, status TEXT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS vales (id INTEGER PRIMARY KEY AUTOINCREMENT, funcionario_id INTEGER, valor REAL, data_vale DATE, status TEXT)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS folha_pagamento (id INTEGER PRIMARY KEY AUTOINCREMENT, funcionario_id INTEGER, mes_referencia TEXT, salario_liquido REAL)");

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>