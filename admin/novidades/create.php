<?php
include '../includes/verificar_sessao.php';
include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $conteudo = $_POST['conteudo'];
  $data_postagem = date('Y-m-d H:i:s');

  $stmt = $conn->prepare("INSERT INTO novidades (titulo, conteudo, data) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $titulo, $conteudo, $data_postagem);
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/form.css"> </head>
<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
  <?php include '../includes/menuadm.php'; ?>
  <br><br><br>
  <h1>Adição de Novidade</h1> <div class="form-container">
    <div class="container">
      <h2 class="form-title">Nova Novidade</h2>
      <form method="POST" class="form">
        <div class="form-group">
          <label for="titulo">Título:</label>
          <input type="text" id="titulo" name="titulo" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="conteudo">Conteúdo:</label>
          <textarea id="conteudo" name="conteudo" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit">Salvar</button>
        <a href="index.php" class="btn btn-secondary mt-2 w-100">Cancelar</a>
      </form>
    </div>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('toggle-dark');
    const body = document.body;

    
    if (localStorage.getItem('modo') === 'dark') {
        body.classList.add('dark-mode');
    }

    
    if (toggle) {
        toggle.addEventListener('click', function () {
            // Adiciona ou remove a classe 'dark-mode' do corpo da página
            body.classList.toggle('dark-mode');
            
            // Verifica se o modo escuro está ativo ou não para salvar a escolha
            const modo = body.classList.contains('dark-mode') ? 'dark' : 'light';
            
            // Salva a escolha no localStorage para uma troca mais rápida
            localStorage.setItem('modo', modo);
            
            // Salva a escolha em um cookie para que o PHP possa ler no próximo carregamento de página
            document.cookie = "modo=" + modo + "; path=/; SameSite=Lax";
        });
    }
});
</script>
</body>
</html>