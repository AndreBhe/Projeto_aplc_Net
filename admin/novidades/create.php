<?php
include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $conteudo = $_POST['conteudo'];
  $data_postagem = date('Y-m-d H:i:s'); // Pega a data e hora atual do sistema

  $stmt = $conn->prepare("INSERT INTO novidades (titulo, conteudo, data) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $titulo, $conteudo, $data);
  $stmt->execute();

  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Novidade</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-4">Nova Novidade</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Conteúdo</label>
      <textarea name="conteudo" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
