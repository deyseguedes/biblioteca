<?php if(isset($erro)): ?>
    <p style="color: red;"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="<?= defined('BASE_URL') ? BASE_URL : '' ?>/user/login" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Digite seu email" required>
    <br><br>
    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
    <br><br>

    <input type="submit" value="Entrar" name="Entrar">
    <input type="submit" value="cadastrar" name="cadastrar">
    </form>
</body>
</html>