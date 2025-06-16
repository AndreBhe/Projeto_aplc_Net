<?php
session_start();

// ---> INÍCIO DA MODIFICAÇÃO
// Adiciona os cabeçalhos para instruir o navegador a NUNCA usar o cache para esta página.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
// ---> FIM DA MODIFICAÇÃO

// Se o usuário já estiver logado e acessar esta página, destrói a sessão por segurança.
if (isset($_SESSION['admin'])) {
    session_unset();
    session_destroy();
    header("Location: login.php?security_logout=1");
    exit;
}

include 'conexao.php';;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    if ($dados && password_verify($senha, $dados['senha'])) {
        $_SESSION['admin'] = $dados['usuario'];
        $_SESSION['ultimo_acesso'] = time();
        header("Location: inicio/dashboard.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Brew Lab Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/form.css">
</head>
<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
<br><br><br>
<h1><strong>PORTAL DO ADMINISTRADOR</strong></h1>

<div class="form-container">
  <div class="container">
    <h2 class="form-title">LOGIN</h2>
    <form method="POST" class="form">
      <div class="form-group">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>
      </div>

      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
      </div>

      <div class="d-flex gap-3 mt-3">
        <button type="submit">LOGIN</button>
        <button class="btn-custom" onclick="location.href='logout.php'" type="button">VOLTAR</button>
      </div>

      <div class="mt-4 text-center">
        <button type="button" class="btn btn-sm btn-secondary" id="toggle-dark">🌙 Modo Noturno</button>
      </div>
    </form>

    <?php
    if (isset($erro)) {
        echo "<p class='error mt-3'>$erro</p>";
    } elseif (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
        echo "<p class='error mt-3'>Sessão expirada por inatividade. Faça login novamente.</p>";
    // ---> INÍCIO DA MENSAGEM PARA O USUÁRIO
    } elseif (isset($_GET['security_logout']) && $_GET['security_logout'] == 1) {
        echo "<p class='error mt-3'>Por segurança, sua sessão foi encerrada. Faça o login novamente.</p>";
    }
    // ---> FIM DA MENSAGEM PARA O USUÁRIO
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('toggle-dark');
    const body = document.body;

    // Use localStorage para persistir o modo escuro, o cookie é um fallback
    if (localStorage.getItem('modo') === 'dark') {
      body.classList.add('dark-mode');
      document.cookie = "modo=dark; path=/";
    }

    if (toggle) {
      toggle.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        const modo = body.classList.contains('dark-mode') ? 'dark' : 'light';
        localStorage.setItem('modo', modo);
        document.cookie = "modo=" + modo + "; path=/";
      });
    }
  });
</script>
</body>
</html>