CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    telefone VARCHAR(20)
);

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cargo VARCHAR(50),
    salario DECIMAL(10,2)
);

CREATE TABLE recebiveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100),
    valor DECIMAL(10,2),
    data_vencimento DATE,
    status VARCHAR(20)
);