<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$dbname = 'meu_sistema';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT p.id, p.nome, p.preco, c.nome AS categoria
                     FROM produtos p
                     LEFT JOIN categorias c ON p.categoria_id = c.id");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Produtos Cadastrados</h1>
        <p>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</p>
        <a href="logout.php" class="btn">Sair</a>
    </header>
    <main>
        <h2>Lista de Produtos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo $produto['id']; ?></td>
                    <td><?php echo $produto['nome']; ?></td>
                    <td><?php echo $produto['preco']; ?></td>
                    <td><?php echo $produto['categoria']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
