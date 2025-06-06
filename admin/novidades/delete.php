<?php

include '../conexao.php';

    $id = $_GET['id'];

    // Exclui o produto com o ID especificado
    $sql = "DELETE FROM novidades WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: index.php");  // Redireciona após a exclusão
    exit;
?>

