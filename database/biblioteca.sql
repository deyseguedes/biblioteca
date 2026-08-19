CREATE DATABASE biblioteca
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE biblioteca;

CREATE TABLE livros (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    isbn VARCHAR(20) UNIQUE,
    categoria VARCHAR(100),
    ano_publicacao YEAR,
    quantidade_total INT UNSIGNED NOT NULL DEFAULT 1,
    quantidade_disponivel INT UNSIGNED NOT NULL DEFAULT 1,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE leitores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE emprestimos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    livro_id INT UNSIGNED NOT NULL,
    leitor_id INT UNSIGNED NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_prevista_devolucao DATE NOT NULL,
    data_devolucao DATE NULL,
    status ENUM('emprestado', 'devolvido') NOT NULL DEFAULT 'emprestado',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_emprestimos_livro
        FOREIGN KEY (livro_id)
        REFERENCES livros(id),

    CONSTRAINT fk_emprestimos_leitor
        FOREIGN KEY (leitor_id)
        REFERENCES leitores(id)
);