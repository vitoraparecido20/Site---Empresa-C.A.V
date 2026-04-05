CREATE TABLE IF NOT EXISTS funcionarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    cpf TEXT,
    valor_hora REAL,
    horas_trabalhadas INTEGER
);

CREATE TABLE IF NOT EXISTS clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_social TEXT NOT NULL,
    cnpj_cpf TEXT,
    telefone TEXT,
    email TEXT
);

CREATE TABLE IF NOT EXISTS recebiveis (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cliente_id INTEGER,
    descricao TEXT,
    valor REAL,
    vencimento DATE
);