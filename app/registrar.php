<?php
include('../database/conexao.php');
    error_reporting(0);
    $nome = $_POST['nome'];
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data = date('Y-m-d');

    $emailCheck = $mysqli->query("SELECT * FROM users where email='$email'");
    $dbEmailCheck = $mysqli->affected_rows;

    if ($dbEmailCheck >= 1) {
        echo '<script>alert("Email já cadastrado!")</script>';
    } elseif ($nome == '' or strlen($nome) < 3) {
        echo '<script>alert("Nome incorreto, cadastre outro!")</script>';
    } elseif ($email == '' or strlen($email) < 10) {
        echo '<script>alert("Email incorreto, cadastre outro!")</script>';
    } elseif ($senha == '' or strlen($senha) < 8) {
        echo '<script>alert("Senha incorreta, mínimo 8 caracteres!")</script>';
    } else {
        $inserir = $mysqli->query("INSERT INTO users (nome, nick_name, email, password, data) values ('$nome', '$nick', '$email', '$senha', '$data')") or die($mysqli->error);
        if($inserir){
            setcookie("login", $nick);
            header('Location: index.php');
            
        } else{
            echo '<script>alert("Houve algum erro, tente novamente!")</script>';
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
    <h2>Cadastrar conta</h2>
    <form action="" method="post">
        <label for="nome">Digite seu Nome:</label><br>
        <input type="text" name="nome" placeholder="Nome: "><br>

        <label for="nickname">Digite seu Nick:</label><br>
        <input type="text" name="nick" placeholder="Nick: "><br>

        <label for="email">Digite seu Email:</label><br>
        <input type="email" name="email" placeholder="Endereço de Email:"><br>

        <label for="senha">Digite seu senha:</label><br>
        <input type="password" name="senha" placeholder="Senha:"><br>
        <input type="submit" value="Cadastrar"><br>
    </form>
    <h3>Caso já tenha conta, <a href="login.php">Entrar.</a></h3>
</body>

</html>