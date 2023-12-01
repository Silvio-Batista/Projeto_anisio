<?php
include("../database/conexao.php");

if(isset($_POST['email']) || isset($_POST['senha'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $verificacao = $mysqli->query("SELECT * FROM users WHERE email= '$email' AND password='$senha'");

    if($mysqli->affected_rows <= 0){
        echo '<script>alert("Email ou senha incorreto")</script>';
    } else {
        setcookie('login', $email);
        header('Location: index.php');
    }
}


?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google fonts -->
    <title>Login</title>
</head>

<body>
    <img src="../images/logo_anisio1.png" alt="logo anisio" style="max-width: 150px;"><br>
    <h2>Entrar na conta</h2>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Endereço de Email"><br>
        <input type="password" name="senha" placeholder="Sua senha"><br>
        <input type="submit" value="Entrar">
    </form>
    <h3>Caso não tenha conta ainda, <a href="registrar.php">Cadastre-se</a></h3>
</body>

</html>