<?php
namespace Engineer\Biblioteca\Controller;

class LivroController
{
    public function index(): void
    {
       require_once __DIR__ . '/../View/livros/index.php';
    }

    public function criar(): void
    {
        require_once __DIR__ . '/../View/livros/criar.php';
        echo "Criando um novo livro...";
    }
}