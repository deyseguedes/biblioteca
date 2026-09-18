<?php
declare(strict_types=1);

namespace Engineer\Biblioteca\Controller;

use Engineer\Biblioteca\Model\User;

class UserController
{
    public function cadastrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
            if ($email === '' || $senha === '') {
                $erro = 'Preencha todos os campos';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro = 'Informe um e-mail válido';
            } elseif (strlen($senha) < 6) {
                $erro = 'Senha deve ter pelo menos 6 caracteres';
            } else {
                $userModel = new User();
                $usuarioExistente = $userModel->buscarPorEmail($email);

                if ($usuarioExistente !== null) {
                    $erro = 'Usuário já cadastrado';
                } else {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                    $userModel->cadastrar($email, $senhaHash);

                    $_SESSION['sucesso'] = 'Cadastro realizado com sucesso. Faça login.';

                    header('Location:' . BASE_URL . '/user/login');
                    exit;
                }
            }
        }
        require_once __DIR__ . '/../View/user/cadastrar.php';
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            if ($email === '' || $senha === '') {
                $erro = 'Preencha todos os campos';
            } else {
                $userModel = new User();
                $usuario = $userModel->buscarPorEmail($email);
                if ($usuario && password_verify($senha, $usuario['senha'])) {
                    session_regenerate_id(true);
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_email'] = $usuario['email'];

                    header('Location: ' . BASE_URL . '/');
                    exit;
                }
                $erro = 'E-mail ou senha incorretos';
            }
        }

        require_once __DIR__ . '/../View/user/login.php';
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();

        header('Location: ' . BASE_URL . '/user/login');
        exit;
    }
}
