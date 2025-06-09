<?php include '../conexao.php';
$id = $_GET['id'] ?? 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $sexo = $_POST['sexo'];
  $stmt = $conn->prepare("UPDATE usuarios SET nome=?, email=?, telefone=?, sexo=? WHERE id=?");
  $stmt->bind_param("ssssi", $nome, $email, $telefone, $sexo, $id);
  $stmt->execute();
  header("Location: index.php");
  exit;
}
$res = $conn->query("SELECT * FROM usuarios WHERE id=$id");
$usuario = $res->fetch_assoc(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/form.css">
</head>
<body class="container py-4">
  <h1>Editar Usuário</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" value="<?= $usuario['nome'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Endereco</label>
      <input type="text" name="endereco" class="form-control" value="<?= $usuario['endereco'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Telefone</label>
      <input type="text" name="telefone" class="form-control" value="<?= $usuario['telefone'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= $usuario['email'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Sexo</label>
      <select name="sexo" class="form-select" required>
        <option <?= $usuario['sexo'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
        <option <?= $usuario['sexo'] == 'Feminino' ? 'selected' : '' ?>>Feminino</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>