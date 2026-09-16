<?php
if(isset($erro)):?>
    <p style="color: red;"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>;
    
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
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


