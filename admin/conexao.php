<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS') ?: 'root';
$banco = getenv('DB_NAME') ?: 'empresa';

$conn = new mysqli($host, $user, $senha, $banco);
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>
