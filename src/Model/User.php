<?php
declare(strict_types=1);

namespace Engineer\Biblioteca\Model;

use Config\Database;
use PDO;

class User{
    private PDO $conexao;

    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->conectar();
    }

    public function cadastrar(string $email, string $senhaHash)
    {
        $sql = 'INSERT INTO user (email, senha) VALUES (:email, :senha)';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->execute();
    }

    public function buscarPorEmail(string $email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email LIMIT 1';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }
}