<?php
$livro = $livro ?? [
    'id' => '',
    'titulo' => '',
    'autor' => '',
    'ano_publicacao' => '',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de edição</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <form action="<?= defined('BASE_URL') ? BASE_URL : '' ?>/livros/editar?id=<?= urlencode((string) $livro['id']) ?>" method="POST">
        <label for="nome">Nome do Livro</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($livro['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <br><br>
        <label for="autor">Autor</label>
        <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($livro['autor'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <br><br>
        <label for="ano">Ano de Publicação</label>
        <input type="number" id="ano" name="ano" value="<?= htmlspecialchars((string) ($livro['ano_publicacao'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        <br><br>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
