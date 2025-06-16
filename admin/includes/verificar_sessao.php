<?php
// Inicia a sessão em todas as páginas que incluírem este arquivo.
session_start();

// 1. CABEÇALHOS DE SEGURANÇA (Cache)
// Evita que o navegador guarde cache de páginas seguras. Essencial manter.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 2. VERIFICAÇÃO DE LOGIN
// Se não houver uma sessão 'admin', redireciona para o login.
if (!isset($_SESSION['admin'])) {
    // A localização do login.php a partir da pasta 'inicio' é '../login.php'
    header("Location: ../login.php");
    exit;
}

// 3. VERIFICAÇÃO DE TIMEOUT POR INATIVIDADE
// Define o tempo máximo de inatividade em segundos (ex: 10 minutos = 600 segundos)
$tempo_limite = 10; 

if (isset($_SESSION['ultimo_acesso']) && (time() - $_SESSION['ultimo_acesso'] > $tempo_limite)) {
    // Destrói a sessão se o tempo for excedido
    session_unset();
    session_destroy();
    // Redireciona para o login com a mensagem de timeout
    header("Location: ../login.php?timeout=1");
    exit;
}

// 4. ATUALIZAÇÃO DO TEMPO DE ACESSO
// Se o usuário está ativo, atualiza o tempo do último acesso ("heartbeat").
$_SESSION['ultimo_acesso'] = time();

// Disponibiliza o nome do usuário para a página que incluir este arquivo.
$usuario = $_SESSION['admin'];
?>