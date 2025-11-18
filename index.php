<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <h1>Cadastro de Produtos</h1>
    </header>
    <main>
        <h2>Bem-vindo ao site de Cadastro de Produtos</h2>
        <p>Esta página é a página inicial do seu projeto.</p>
        <a href="cadastrar.php" class="btn">Acessar catálogo de produtos</a>
    </main>
</body>
</html>

