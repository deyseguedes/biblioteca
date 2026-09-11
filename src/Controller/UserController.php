<?php
declare(strict_types=1);

namespace Engineer\Biblioteca\Controller;
use Engineer\Biblioteca\Model\User;

class UserController{

public function Cadastrar()
{
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])){
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $userModel = new User();
        $userModel->cadastrar($email, $senhaHash);

        header('Location: ' . BASE_URL . '/user/login');
        exit;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Entrar'])){
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $userModel = new User();
        $usuario = $userModel->buscarPorEmail($email);
        if($usuario && password_verify($senha, $usuario['senha'])){
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header('Location: ' .BASE_URL.'/' );
            exit;
        }
        $erro = "Email ou senha incorretos";
    }
        
    require_once __DIR__ . '/../View/User/login.php';
}
}