<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include '../conexao.php'; 
$usuario = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Usuários</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos.css"> 
</head>
<body>

  <?php include '../includes/menuadm.php'; ?>

  <div class="container py-4">
    <h2 class="mb-4">Usuários Cadastrados</h2>

    <a href="create.php" class="btn btn-success mb-3 ms-2">Novo Usuário</a>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Nome</th><th>Endereco</th><th>Telefone</th><th>Email</th><th>Sexo</th><th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM usuarios";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['endereco'] ?></td>
            <td><?= $row['telefone'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['sexo'] ?></td>
            <td>
              <a href="read.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Ver</a>
              <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
