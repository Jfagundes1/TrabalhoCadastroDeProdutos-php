<?php
include "conexao.php";

$id = $_GET["id"];

$sql = "DELETE FROM produtos WHERE id = $id";

if($conn->query($sql)){
    echo "<script>alert('Excluído!'); window.location='index.php';</script>";
} else {
    echo "Erro: " . $conn->error;
}
?>
