<?php
include("header.php");
error_reporting(0);
$id = $_GET['id'];
$saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");

$saber = mysqli_fetch_assoc($saberr);
$email = $saber['email'];

if ($email == $login_cookie) {
    header('Location: myprofile.php');
}

$pubs = $mysqli->query("SELECT * FROM publs WHERE user='$email' ORDER BY id desc");

if (isset($_POST['add'])){
    var_dump("testando");
    add();
}
var_dump($saber['email']);
function add(){
    var_dump("testando");
    include('../database/conexao.php');
    $login_cookie = $_COOKIE['login'];
    if (!isset($login_cookie)) {
        header("Location: login.php");
    }
    $id = $_GET["id"];
    $saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];
    $data = date("Y-m-d");

    $ins = $mysqli->query("INSERT INTO amizades (de, para, data) values ('$login_cookie', '$email', '$data')");

    if ($ins) {
        var_dump("testando");
        header("Location: profile.php?id=" . $id);
    } else {
        echo '<script>alert("Erro ao enviar pedido de amizade...")</script>';
    }
}

if (isset($_POST['cancelar'])){

    cancel();
}
function cancel() {

    include('../database/conexao.php');
    $login_cookie = $_COOKIE['login'];
    if (!isset($login_cookie)) {
        header("Location: login.php");
    }
    $id = $_GET["id"];
    $saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = $mysqli->query("DELETE FROM amizades WHERE de = '$login_cookie' and para = '$email'");

    if ($ins) {
        header("Location: profile.php?id=" . $id);
    } else {
        echo '<script>alert("Erro ao cancelar pedido de amizade...")</script>';
    }
}
if (isset($_POST['remover'])){

    remove();
}
function remove(){

    include('../database/conexao.php');
    $login_cookie = $_COOKIE['login'];
    if (!isset($login_cookie)) {
        header("Location: login.php");
    }
    $id = $_GET["id"];
    $saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = $mysqli->query("DELETE FROM amizades WHERE de = '$login_cookie' and para = '$email' or de = '$email' and para = '$login_cookie'");

    if ($ins) {
        header("Location: profile.php?id=" . $id);
    } else {
        echo '<script>alert("Erro ao desfazer amizade...")</script>';
    }
}
if (isset($_POST['aceitar'])) {
    var_dump("testando");
    aceitar();
}
function aceitar()
{
    var_dump("testando");
    include('../database/conexao.php');
    $login_cookie = $_COOKIE['login'];
    if (!isset($login_cookie)) {
        header("Location: login.php");
    }
    $id = $_GET["id"];
    $saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = $mysqli->query("UPDATE amizades SET aceite = 'sim' WHERE de = '$email' and para = '$login_cookie' or de = '$login_cookie' and para = '$email'");

    if ($ins) {
        header("Location: profile.php?id=" . $id);
    } else {
        echo '<script>alert("Erro ao aceitar pedido de amizade...")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../images/anisioico.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../images/anisioico.ico" type="image/x-icon">
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
        <form method="post">
            <?php
            $amigos = $mysqli->query("SELECT * FROM amizades WHERE de = '$login_cookie' AND para='$email' OR para='$login_cookie' AND de='$email'");
            $amigoss = mysqli_fetch_assoc($amigos);
            var_dump($mysqli->affected_rows);
            if ($mysqli->affected_rows >= 1 && $amigoss["aceite"] == "sim") {
                echo '<input type="submit" value="Remover Amigo" name="remover">';
            } else if ($mysqli->affected_rows >= 1 and $amigoss["aceite"] == "" and $amigoss["para"] == "$login_cookie") {
                echo '<input type="submit" value="Aceitar Pedido" name="aceitar">';
            } else if ($mysqli->affected_rows >= 1 and $amigoss["aceite"] == "" and $amigoss["de"] == "$login_cookie") {
                echo '<input type="submit" value="Cancelar Pedido" name="cancelar">';
            } else {
                echo '<input type="submit"  value="Adicionar Amigo" name="add">';
            }

            ?>
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