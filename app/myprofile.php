<?php
include("header.php");

error_reporting(0);
$saberr = $mysqli->query("SELECT * FROM users WHERE email = '$login_cookie'");

$saber = mysqli_fetch_assoc($saberr);
$email = $saber['email'];

if ($email == $login_cookie) {
    // header('Location: myprofile.php');
}

$pubs = $mysqli->query("SELECT * FROM publs WHERE user='$email' ORDER BY id desc");

if (isset($_POST['settings'])){
    header('Location: settings.php');
}


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
    echo '<a href="#"><i class="bi bi-person-square" id="profile"></i></a>';
} else {
    echo '<a href="#"><img src="upload/' . $saber['imagem_profile'] . '" id="profile"></a>';
}
    ?>
    <div id="menu">

        <form action="" method="POST">
            <h2><?= $saber['nome'] . " " . $saber['nick_name'] ?></h2><br>
            <input type="submit" value="Alterar Info" name="settings"> <input type="submit" name="amigos" value="Ver amigos">
        </form>

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
                <p> <a href="profile.php?id=' . $id . '">' . $nome . ' </a> - ' . $pub['data'] . '</p>
                <span>' . $pub['texto'] . '</span>
                </div>';
        } else {
            echo '<div class="pub" id="' . $saber['id'] . '">
                <p> <a href="profile.php?id=' . $saber['id'] . '">' . $nome . ' </a> - ' . $pub['data'] . '</p>
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