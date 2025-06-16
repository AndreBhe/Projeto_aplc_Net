<?php
// Inclui o nosso script central de verificação. Ele cuida de TUDO.
include '../includes/verificar_sessao.php'; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Portal do Administrador</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">

    <?php include '../includes/menuadm.php'; ?>

    <br><br><br><br><br><br><br><br>

    <div class="welcome container py-4">
        <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>
        <p>O que você deseja gerenciar?</p>
    </div>


    <script>
    window.addEventListener('pageshow', function(event) {
        // A propriedade 'persisted' é true se a página foi carregada do bfcache
        if (event.persisted) {
            // Força um recarregamento completo da página a partir do servidor.
            window.location.reload();
        }
    });
    </script>
    </body>
</html>