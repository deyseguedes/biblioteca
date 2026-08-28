<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livros</title>
</head>
<body>
    <h1>Cadastrar Livro</h1>
    <form action="<?= defined('BASE_URL') ? BASE_URL : '' ?>/livros/criar" method="POST">
        <label for="nome">Nome do Livro</label>
        <input type="text" id="nome" name="nome">
        <br><br>
        <label for="autor">Autor</label>
        <input type="text" id="autor" name="autor">
        <br><br>
        <label for="ano">Ano de Publicação</label>
        <input type="number" id="ano" name="ano">
        <br><br>
        <button type="submit">Cadastrar</button>
</form>
</body>
</html>