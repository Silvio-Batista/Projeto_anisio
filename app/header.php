<?php
include('../database/conexao.php');



$login_cookie = $_COOKIE['login'];
if (!isset($login_cookie)) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="shortcut icon" href="../images/anisioico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Feed</title>
</head>

<body>
    <div id="top">

        <a href="index.php"><img src="../images/logo_anisio1.png" alt="logo anisio"></a>
        <form action="" method="get">
            <input type="text" placeholder="Buscar por alguém" autocomplete="off"> <input type="submit" value="Buscar" hidden>
        </form>
        <a href="#" style="text-decoration: none;"><i class="bi bi-chat-dots-fill"></i></a>
        <a href="myprofile.php"><i id="git" class="bi bi-person-fill"></i></a>
    </div>
   
</body>

</html>