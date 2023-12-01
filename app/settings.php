<?php
include('header.php');
$infoo = $mysqli->query("SELECT * FROM users WHERE email = '$login_cookie'");
$info = mysqli_fetch_assoc($infoo);
    if(isset($_POST['criar'])){
        $nome = $_POST['nome'];
        $nick = $_POST['nick'];
        $senha = $_POST['senha'];
        if ($nome == ""){
            echo '<script>alert("O nome não pode estar vazio!")</script>';
        } elseif($nick == ""){
            echo '<script>alert("O nick não pode estar vazio!")</script>';
        } elseif ($senha == ""){
            echo '<script>alert("A senha não pode estar vazia!")</script>';
        } else{
            $query = $mysqli->query("UPDATE users SET nome = '$nome', nick_name = '$nick', password = '$senha' WHERE email = '$login_cookie'");
            if($query){
                header('Location: myprofile.php');
            } else{
                echo '<script>alert("Algo deu errado, tente novamente!")</script>';
            }
        }
    }
    if(isset($_POST['cancel'])){
        header('Location: myprofile.php');
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
    <!-- <img name="logo" src="../images/logo anisio.jpg" alt="logo anisio" style="max-width: 150px;"><br> -->
    <h2>Alterar conta</h2>
    <form action="" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" value="<?=$info['nome']?>"><br>

        <label for="nickname">Nick:</label><br>
        <input type="text" name="nick" value="<?=$info['nick_name']?>"><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" placeholder="Senha:"><br>
        <input type="submit" value="Alterar" name="criar">
        <input type="submit" value="Voltar" name="cancel">
    </form>
</body>

</html>