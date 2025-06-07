<?php
include '../conexao.php';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM produtos WHERE id = $id";
$res = $conn->query($sql);

$produto = null;
if ($res && $res->num_rows > 0) {
    $produto = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalhes do Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/form.css">
</head>
<body class="container py-4">
  <?php include '../includes/menuadm.php'; ?>
  <h1>Detalhes do Produto</h1>

  <?php if ($produto): ?>
  <ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?= $produto['id'] ?></li>
    <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($produto['nome']) ?></li>
    <li class="list-group-item"><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($produto['descricao'])) ?></li>
    <li class="list-group-item"><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></li>
  </ul>
  <?php else: ?>
    <div class="alert alert-warning">Produto não encontrado.</div>
  <?php endif; ?>

  <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
</body>
</html>
