<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        header("Location: ../login/login.html");
    } catch (Exception $e) {
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
                <h1>Este nome de usuário já existe</h1>
                <a href="../login/login.html">Cadastre novamente com outro nome.</a>
            </div>
        </body>
        </html>';
                exit;
    }
}
?>