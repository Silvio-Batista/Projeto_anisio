<?php
include("header.php");

$id = $_GET['id'];
$saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");

$saber = mysqli_fetch_assoc($saberr);
$email = $saber['email'];

if ($email == $login_cookie) {
    header('Location: myprofile.php');
}

$pubs = $mysqli->query("SELECT * FROM publs WHERE user='$email' ORDER BY id desc");




?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../images/anisioico.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/index.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
</head>

<body>
    <?php
    if ($saber['imagem_profile'] == "") {
        echo '<i class="bi bi-person-square" id="profile"></i>';
    } else {
        echo '<img src="upload/' . $saber['imagem_profile'] . '" id="profile">';
    }
    ?>
    <div id="menu">
        <h2><?= $saber['nome'] . " " . $saber['nick_name'] ?></h2><br>
        <input type="submit" value="Adicionar Amigo" >
        <?php 
        $amigos = $mysqli->query("SELECT * FROM amizades WHERE de = '$login_cookie' AND para='$email' OR para='$login_cookie' AND de='$email'");
        $amigoss = mysqli_fetch_assoc($amigos);
        if (mysqli_affected_rows($amigos) >= 1 and $amigoss["aceite"]=="sim"){
            echo '<input type="submit" value="Remover Amigo" name="remover">';
        } else if(mysqli_affected_rows($amigos) >= 1 and $amigoss["aceite"]=="nao"){
            echo '<input type="submit" value="Canelar Pedido" name="cancelar">';
        } else{
            echo '<input type="submit" value="Adicionar Amigo" name="add">';
        }

        ?>
    </div>
    <?php
    while ($pub = mysqli_fetch_assoc($pubs)) {
        $email = $pub['user'];
        $saberr = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
        $saber = mysqli_fetch_assoc($saberr);
        $nome = $saber['nome'] . " " . $saber['nick_name'];
        $id = $pub['id'];

        if ($pub['imagem'] == "") {
            echo '<div class="pub" id="' . $id . '">
                <p> <a href="profile.php?id' . $id . '">' . $nome . ' </a> - ' . $pub['data'] . '</p>
                <span>' . $pub['texto'] . '</span>
                </div>';
        } else {
            echo '<div class="pub" id="' . $saber['id'] . '">
                <p> <a href="profile.php?id' . $saber['id'] . '">' . $nome . ' </a> - ' . $pub['data'] . '</p>
                <span>' . $pub['texto'] . '</span>
                <img src="upload/' . $pub['imagem'] . '">
                </div>';
        }
    }
    ?>
    <footer>
        <p>Mural de dúvidas <a href="https://www.instagram.com/eetepaanisioteixeira/">Anisio Teixeira</a>, 2023 - Developed By <a href="https://github.com/Silvio-Batista"><i class="bi bi-github"></i>Silvio</a></p>
    </footer>
</body>

</html>