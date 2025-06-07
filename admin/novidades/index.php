<?php
include '../conexao.php';

$sql = "SELECT id, titulo, conteudo, data FROM novidades";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Novidades</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-4">Lista de Novidades</h1>
  <?php include '../includes/menuadm.php'; ?>

  <a href="create.php" class="btn btn-success mb-3">+ Adicionar Novidade</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Título</th>
        <th>Conteúdo</th>
        <th>Data e Hora</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['titulo']) ?></td>
            <td><?= htmlspecialchars($row['conteudo']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['data'])) ?></td>
            <td>
              <a href="read.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Ver</a>
              <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta novidade?')">Excluir</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="text-center">Nenhuma novidade encontrada</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
