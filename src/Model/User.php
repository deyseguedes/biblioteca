<?php
declare(strict_types=1);

namespace Engineer\Biblioteca\Model;

use Config\Database;
use PDO;

<<<<<<< HEAD
class User 
{
=======
class User{
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6
    private PDO $conexao;

    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->conectar();
    }

<<<<<<< HEAD
    public function cadastrar(string $email, string $senhaHash): void
=======
    public function cadastrar(string $email, string $senhaHash)
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6
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
<<<<<<< HEAD

        return $usuario ?: null;
    }
}

    
=======
        return $usuario ?: null;
    }
}
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6
