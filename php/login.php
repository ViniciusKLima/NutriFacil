<?php
include 'config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: ../opcoes-NF/opcoes.php");
    } else {
        echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Incorreto</title>
</head>
<body>
<style>
    body{
        margin: 0;
        padding: 0;
        display: flex;
        overflow: hidden;
        font-family: arial;
        background: linear-gradient(to right, #3C593D, #438E46, #9FD873);
    }

    div{
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
    }

    h1{
        max-width: 60%;
    }

    a{
        color: inherit;
    }

</style>

    <div>
        <h1>Usuário ou senha incorretos! :(</h1>
        <a href="../login/login.html">Faça login novamente.</a>
    </div>
</body>
</html>';
        exit;
    }
}
?>