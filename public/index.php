<?php

declare(strict_types=1);
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Engineer\Biblioteca\Controller\LivroController;
use Engineer\Biblioteca\Controller\UserController;

$caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$baseUrl = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Em uma instalacao em subpasta, remove /biblioteca/public da rota.
if ($baseUrl !== '' && str_starts_with($caminho, $baseUrl)) {
    $caminho = substr($caminho, strlen($baseUrl));
} else {
    $baseUrl = '';
}



$rota = '/' . trim($caminho, '/');
$rota = $rota === '/' ? '/' : rtrim($rota, '/');

$rotaPublica = $rota === '/user/login';

if (!$rotaPublica && !isset($_SESSION['usuario_id'])) {
    define('BASE_URL', $baseUrl);
    header('Location:' . BASE_URL . '/user/login');
    exit;
}



define('BASE_URL', $baseUrl);


$controller = new LivroController();
$userController = new UserController();
switch ($rota) {
    case '/':
        $controller->index();
        break;

    case '/livros/criar':
        $controller->criar();
        break;
    case '/livros/editar':
        $controller->editar();
        break;

    case '/user/login':
        $userController->cadastrar();
        break;

    case '/livros/excluir':
        $controller->excluir();
        break;
}
