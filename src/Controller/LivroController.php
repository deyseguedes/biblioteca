<?php
namespace Engineer\Biblioteca\Controller;
use Engineer\Biblioteca\Model\Livro;

class LivroController
{
    public function index(): void
    {
        $livroModel = new Livro();
        $livros = $livroModel->listar();
        require_once __DIR__ . '/../View/livros/index.php';
    }

    public function criar(): void
    {
       session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['nome'] ?? '';
            $autor = $_POST['autor'] ?? '';
            $anoPublicacao = $_POST['ano'] ?? '';

            $livroModel = new Livro();
            $livroModel->criar($titulo, $autor, (int)$anoPublicacao);
            $_SESSION['sucesso'] = 'Cadastro efetuado com sucesso';
            header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '');
            exit;
        }
        require_once __DIR__ . '/../View/livros/criar.php';
    }
}