<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuarios</title>
</head>
<body>
    <h1>Criar Conta</h1>

    <?php if (isset($erro)) : ?>
        <p>
            <?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    form action="<?= BASE_URL ?> /user/cadastrar" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br><br>
        <button type="submit">Cadastrar</button>
        </form>
        <br>
        <a href="<?= BASE_URL ?>/user/login">Já tenho uma conta</a>
    
</body>
</html>