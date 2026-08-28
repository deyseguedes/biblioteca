<?php
namespace Config;
use PDO;
use PDOException;
class Database
{
    private string $host = 'localhost';
    private string $dbName = 'biblioteca';
    private string $usuario = 'root';
    private string $senha = '';
    

    public function conectar(): PDO
    {
        try {
            $conexao = new  PDO(
            "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4",
            $this->usuario,
            $this->senha
            );
            $conexao->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
            );
            $conexao->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
            $conexao->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );
            return $conexao;

        }catch(PDOException $erro){
            die('Erro ao conectar com o banco: '. $erro->getMessage());
        }
    
    }

}

