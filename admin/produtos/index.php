<?php
include '../conexao.php';


$sql = "SELECT id, nome, descricao, preco FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Produtos</title>
  <link rel="stylesheet" href="../estilos.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

<?php include '../includes/menuadm.php'; ?>
  <h1 class="mb-4">Lista de Produtos</h1>

  <a href="create.php" class="btn btn-success mb-3">+ Novo Produto</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= htmlspecialchars($row['descricao']) ?></td>
            <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
            <td>
              <a href="read.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Ver</a>
              <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="text-center">Nenhum produto encontrado</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
