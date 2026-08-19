<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Engineer\Biblioteca\Controller\LivroController;

$url = $_GET['url'] ?? '/';

if ($url === '/') {
    $controller = new LivroController();
    $controller->index();
} elseif ($url === '/livros/criar') {
    $controller = new LivroController();
    $controller->criar();
} else {
    http_response_code(404);
    echo "Página não encontrada.";
}
