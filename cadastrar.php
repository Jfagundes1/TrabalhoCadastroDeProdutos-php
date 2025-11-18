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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, categoria_id) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $preco, $categoria_id]);

    echo "<p>Produto cadastrado com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Produtos</h1>
        <p>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</p>
        <a href="logout.php" class="btn">Sair</a>
    </header>
    <main>
        <h2>Cadastro de produtos</h2>
        <form method="POST" action="cadastrar.php">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="preco">Preço do Produto:</label>
            <input type="text" id="preco" name="preco" required>

            <label for="categoria_id">Categoria do Produto:</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php
                $stmt = $pdo->query("SELECT * FROM categorias");
                $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($categorias as $categoria) {
                    echo "<option value='" . $categoria['id'] . "'>" . $categoria['nome'] . "</option>";
                }
                ?>
            </select>

            <button type="submit">Cadastrar Produto</button>
        </form>
        
        <a href="produtos.php" class="btn">Ver Produtos Cadastrados</a>
    </main>
</body>
</html>
