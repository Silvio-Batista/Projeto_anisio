<?php
include("header.php");

$pubs = $mysqli->query("SELECT * FROM publs ORDER BY id desc");

if (isset($_POST['publish'])) {
    if ($_FILES["file"]["error"] > 0) {
        $texto = $_POST["texto"];
        $hoje = date("Y-m-d");

        if ($texto == "") {
            echo '<script>alert("Texto vazio, porfavor insira algo!")</script>';
        } else {
            $query = $mysqli->query("INSERT INTO publs (user, texto, data) values ('$login_cookie', '$texto', '$hoje')") or die($mysqli->error);

            if ($query) {
                header("Location: ./");
            } else {
                echo '<script>alert("Aconteu algo errado, tente novamente mais tarde!")</script>';
            }
        }
    } else {
        $n = rand(0, 1000000);
        $img = $n . $_FILES["file"]["name"];

        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $img);

        $texto = $_POST["texto"];
        $hoje = date("Y-m-d");
        if ($texto == "") {
            echo '<script>alert("Texto vazio, porfavor insira algo!")</script>';
        } else {
            $query = $mysqli->query("INSERT INTO publs (user, texto, imagem, data) values ('$login_cookie', '$texto', '$img','$hoje')") or die($mysqli->error);

            if ($query) {
                header("Location: ./");
            } else {
                echo '<script>alert("Aconteu algo errado, tente novamente mais tarde!")</script>';
            }
        }
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
    <div id="publish">
        <form method="post" enctype="multipart/form-data">
            <br>
            <textarea placeholder="Digite sua dúvida" name="texto"></textarea>
            <label for="file-input">
                <i class="bi bi-camera" title="Inserir uma imagem"></i>
            </label>
            <input type="submit" value="Publicar" name="publish">
            <input type="file" name="file" id="file-input" hidden>
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
                <p> <a href="profile.php?id='.$id.'">' . $nome . ' </a> - ' . $pub['data'] . '</p>
                <span>' . $pub['texto'] . '</span>
                </div>';
        } else {
            echo '<div class="pub" id="' . $saber['id'] . '">
                <p> <a href="profile.php?id='.$saber['id'].'">' . $nome . ' </a> - ' . $pub['data'] . '</p>
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