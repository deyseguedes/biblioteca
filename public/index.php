<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engineer\Biblioteca\Controller\LivroController;

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

define('BASE_URL', $baseUrl);

$controller = new LivroController();

switch ($rota) {
    case '/':
        $controller->index();
        break;

    case '/livros/criar':
        $controller->criar();
        break;
}
