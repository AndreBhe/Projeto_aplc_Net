<?php
include '../conexao.php';

date_default_timezone_set('America/Sao_Paulo');

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $data = date('Y-m-d H:i:s'); // Atualiza a data para o momento da edição

    $update_sql = "UPDATE novidades SET titulo = ?, conteudo = ?, data = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);

    if (!$stmt) {
        die("Erro na preparação: " . $conn->error);
    }

    $stmt->bind_param("sssi", $titulo, $conteudo, $data, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

// Buscar dados existentes
$sql = "SELECT * FROM novidades WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$novidade = $result->fetch_assoc();

if (!$novidade) {
    die("Novidade não encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Novidade</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/form.css">
</head>
<body class="container py-4">
  <h1 class="mb-4">Editar Novidade</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($novidade['titulo']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Conteúdo</label>
      <textarea name="conteudo" class="form-control" rows="5" required><?= htmlspecialchars($novidade['conteudo']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
