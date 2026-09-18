<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['sucesso'])): ?>
        <p><?= htmlspecialchars($_SESSION['sucesso'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php unset($_SESSION['sucesso']); ?>
    <?php endif; ?>

    <form action="<?= defined('BASE_URL') ? BASE_URL : '' ?>/user/login" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Digite seu email" required>
        <br><br>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        <br><br>
        <button type="submit">Entrar</button>
    </form>
    <br>
    <a href="<?= defined('BASE_URL') ? BASE_URL : '' ?>/user/cadastrar">Cadastrar</a>
</body>
</html>
