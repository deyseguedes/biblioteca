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
<<<<<<< HEAD
    public function cadastrar(string $email, string $senhaHash): void
=======
    public function cadastrar(string $email, string $senhaHash)
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6
=======
    public function cadastrar(string $email, string $senhaHash): bool
>>>>>>> 248c69d (Atualizacao para validar o esquema de cadastro e login)
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
        

<<<<<<< HEAD
        $usuario = $stmt->fetch();
<<<<<<< HEAD

=======
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
>>>>>>> 248c69d (Atualizacao para validar o esquema de cadastro e login)
        return $usuario ?: null;
    }
}

    
=======
        return $usuario ?: null;
    }
}
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6
