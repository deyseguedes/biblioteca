<?php
namespace Engineer\Biblioteca\Model;

use Config\Database;
use PDO;

class Livro
{
    private PDO $conexao;

    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->conectar();
    }

    public function listar(): array
    {
        $sql = 'SELECT * FROM livros ORDER BY ano_publicacao DESC';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar(string $titulo, string $autor, int $anoPublicacao): void
    {
        $sql = 'INSERT INTO livros (titulo, autor, ano_publicacao) VALUES (:titulo, :autor, :ano_publicacao)';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':ano_publicacao', $anoPublicacao);
        $stmt->execute();
    }
    public function editar(int $id, string $titulo, string $autor, int $anoPublicacao): void
    {
        $sql = 'UPDATE livros SET titulo = :titulo, autor = :autor, ano_publicacao = :ano_publicacao WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':ano_publicacao', $anoPublicacao);
        $stmt->execute();
    }
    public function buscarPorId(int $id): ?array
    {
        $sql = 'SELECT * FROM livros WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $livro = $stmt->fetch(PDO::FETCH_ASSOC);
        return $livro ?: null;
    }
}

