<?php
if(isset($_SESSION['sucesso'])){
    echo $_SESSION['sucesso'];
    unset($_SESSION['sucesso']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Biblioteca</title>
</head>

<body>

    <?php $livros = $livros ?? []; ?>

    <h1>Livros cadastrados</h1>

    <a href="<?= defined('BASE_URL') ? BASE_URL : '' ?>/livros/criar">
        Cadastrar livro
    </a>
    <a href="<?= defined('BASE_URL') ? BASE_URL : '' ?>/livros/editar">
        Editar livro
    </a>

    <hr>

    <?php if (empty($livros)): ?>

        <p>Nenhum livro cadastrado.</p>

    <?php endif; ?>

    <?php foreach ($livros as $livro): ?>

        <h2>
            <?= htmlspecialchars($livro['titulo'], ENT_QUOTES, 'UTF-8') ?>
        </h2>

        <p>
            Autor:
            <?= htmlspecialchars($livro['autor'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            Ano:
            <?= htmlspecialchars((string) $livro['ano_publicacao'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <hr>

    <?php endforeach; ?>

</body>

</html>