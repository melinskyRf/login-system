<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel</title>
</head>
<body>
  <h1>Bem-vindo, <?php echo $_SESSION['user']; ?>!</h1>
  <a href="logout.php">Sair</a>
</body>
</html>
