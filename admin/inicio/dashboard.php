<?php
// Cabeçalhos para impedir cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Inclui o verificador de sessão
include '../includes/verificar_sessao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Portal do Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
document.addEventListener('DOMContentLoaded', function () {
    // Encontra o botão que alterna o tema (ele deve ter o id="toggle-dark")
    const toggle = document.getElementById('toggle-dark');
    const body = document.body;

    // Esta parte garante que, mesmo que o cookie não seja lido a tempo,
    // o localStorage (memória do navegador) aplique o modo escuro.
    if (localStorage.getItem('modo') === 'dark') {
        body.classList.add('dark-mode');
    }

    // Adiciona o evento de clique ao botão, se ele existir na página
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