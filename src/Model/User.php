<?php
declare(strict_types=1);

namespace Engineer\Biblioteca\Model;

use Config\Database;
use PDO;

class User
{
    private PDO $conexao;

    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->conectar();
    }

    public function cadastrar(string $email, string $senhaHash): bool
    {
        $sql = 'INSERT INTO user (email, senha) VALUES (:email, :senha)';
        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([':email' => $email, ':senha' => $senhaHash]);
    }

    public function buscarPorEmail(string $email): ?array
    {
        $sql = 'SELECT * FROM user WHERE email = :email LIMIT 1';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':email' => $email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ?: null;
    }
}
