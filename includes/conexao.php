<?php
$host = getenv('MYSQL_HOST') ?: 'localhost';
$user = getenv('MYSQL_USER') ?: 'root';
$senha = getenv('MYSQL_PASSWORD') ?: '';
$banco = getenv('MYSQL_DATABASE') ?: 'empresa';

$conn = new mysqli($host, $user, $senha, $banco);
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>
