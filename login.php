<?php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['user'] = $username;
    header("Location: dashboard.php");
} else {
    echo "Usuário ou senha incorretos!";
}
?>
