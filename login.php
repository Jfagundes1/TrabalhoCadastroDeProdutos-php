<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: cadastrar.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Alterando as credenciais para 'joao' e '123'
    if ($usuario == "joao" && $senha == "123") {
        $_SESSION['usuario'] = $usuario;
        header("Location: cadastrar.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form method="POST" action="">
            <label for="usuario">Usuário</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>

            <?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>
        </form>
    </main>
</body>
</html>
