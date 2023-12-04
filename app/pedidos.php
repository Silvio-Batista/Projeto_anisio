<?php
include("header.php");

$pubs = $mysqli->query("SELECT * FROM amizades WHERE para='$login_cookie' and aceite='' ORDER BY id desc");

if (isset($_GET['id'])) {
    var_dump("testando");
    include('../database/conexao.php');
    $id = $_GET["id"];
    $saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = $mysqli->query("UPDATE amizades SET aceite = 'sim' WHERE de = '$email' and para = '$login_cookie' or de = '$login_cookie' and para = '$email'");

    if ($ins) {
        header("Location: pedidos.php");
    } else {
        echo '<script>alert("Erro ao aceitar pedido de amizade...")</script>';
    }
}
if (isset($_GET['remove'])){
    include('../database/conexao.php');
    $id = $_GET["remove"];
    $saberr = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $saber = mysqli_fetch_assoc($saberr);
    $email = $saber['email'];

    $ins = $mysqli->query("DELETE FROM amizades WHERE de = '$login_cookie' and para = '$email' or de = '$email' and para = '$login_cookie'");

    if ($ins) {
        header("Location: pedidos.php");
    } else {
        echo '<script>alert("Erro ao recusar amizade...")</script>';
    }
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
    while ($pub = mysqli_fetch_assoc($pubs)) {
        $email = $pub['de'];
        $saberr = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
        $saber = mysqli_fetch_assoc($saberr);
        $nome = $saber['nome'];
        $nick = $saber['nick_name'];
        $id = $saber['id'];
        
        echo
        '
        <div class="pub" id="' . $id . '">
        <p><a href="profile.php?id=' . $saber['id'] . '">Ver perfil de ' . $nome . '</a> - ' . $pub['data'] . '</p>
        <span class="pedidos">' . $nome . ' Quer ser seu amigo</span> <br>
        <a href="pedidos.php?id=' . $id . '"><input type="submit" value="Aceitar" name="aceitar"></a>
        <a href="pedidos.php?remove=' . $id . '"><input type="submit" value="Recusar" name="recusar"></a><br>
        </div>
        ';
    }
        echo '<h2 class="pedidos">Não existem mais pedidos de amizade</h2>';
    
    ?>
    
    <footer>
        <p>Mural de dúvidas <a href="https://www.instagram.com/eetepaanisioteixeira/">Anisio Teixeira</a>, 2023 - Developed By <a href="https://github.com/Silvio-Batista"><i class="bi bi-github"></i>Silvio</a></p>
    </footer>
</body>

</html>