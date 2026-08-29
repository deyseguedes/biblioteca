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
    public function editar(): void
    {
    session_start();

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '/');
        exit;
    }

    $livroModel = new Livro();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['nome'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $anoPublicacao = $_POST['ano'] ?? '';

        $livroModel->editar($id, $titulo, $autor, (int)$anoPublicacao);
        $_SESSION['sucesso'] = 'Edição efetuada com sucesso';
        header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '/');
        exit;
        
        }

        $livro = $livroModel->buscarPorId($id);
        if ($livro === null) {
            header('Location: ' . (defined('BASE_URL') ? BASE_URL : '') . '/');
            exit;
        }

        require_once __DIR__ . '/../View/livros/editar.php';
}
}
