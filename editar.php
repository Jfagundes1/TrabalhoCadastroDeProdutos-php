<?php include "conexao.php"; ?>

<?php
$id = $_GET["id"];
$sql = "SELECT * FROM produtos WHERE id = $id";
$res = $conn->query($sql);
$produto = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Editar Produto</title>
</head>
<body>

<header><h1>Editar Produto</h1></header>

<main>

<form action="editar.php?id=<?php echo $id; ?>" method="POST" onsubmit="return validar()">
    <label>Nome:</label>
    <input type="text" name="nome" id="nome" value="<?php echo $produto['nome']; ?>">

    <label>Preço:</label>
    <input type="number" name="preco" id="preco" step="0.01" value="<?php echo $produto['preco']; ?>">

    <label>Categoria:</label>
    <select name="categoria_id">
        <?php
            $cat = $conn->query("SELECT * FROM categorias");
            while($c = $cat->fetch_assoc()) {
                $sel = ($c['id'] == $produto['categoria_id']) ? "selected" : "";
                echo "<option $sel value='".$c['id']."'>".$c['nome']."</option>";
            }
        ?>
    </select>

    <button type="submit" class="btn">Atualizar</button>
</form>

<a href="index.php" class="voltar">Voltar</a>

</main>

<?php
if($_POST){
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $cat_id = $_POST["categoria_id"];

    $sql = "UPDATE produtos SET nome='$nome', preco='$preco',
            categoria_id='$cat_id' WHERE id=$id";

    if($conn->query($sql)){
        echo "<script>alert('Atualizado com sucesso!'); window.location='index.php';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

</body>
</html>
