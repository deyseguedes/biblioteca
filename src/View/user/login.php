<<<<<<< HEAD
<?php
if(isset($erro)):?>
    <p style="color: red;"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>;
    
<?php endif; ?>
=======
<?php if(isset($erro)): ?>
    <p style="color: red;"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="<?= (defined('BASE_URL') ? BASE_URL : '') ?>/user/login" method="post">
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email" required>
        <br><br>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
        <br><br>
        <input type="submit" value="Entrar" nome="Entrar">
        <input type="submit" value="Cadastrar" nome="Cadastrar">
        
    </form>
</body>
</html>


=======
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
>>>>>>> c6d462397a13f23e9be5e794a094722060f38ec6
