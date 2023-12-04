<?php
include ("header.php");
if(isset($_POST['save'])){
    if($_FILES['file']['error']>0){
        echo '<script>alert("Você precisa escolher uma foto!")</script>';
    } else {
        $n = rand(0, 100000);
        $img = $n.$_FILES["file"]["name"];

        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$img);

        $query = $mysqli->query("UPDATE users SET imagem_profile = '$img' WHERE email = '$login_cookie'" );
        
        if($query){
            header("Location: myprofile.php");
        } else {
            echo '<script>alert("Não foi possivel allterar sua foto de perfil, tente novamente!")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #3401cc;
        }

        h2 {
            margin-top: 10%;
            text-align: center;
            color: #FFF;
            font-size: 49px;
        }

        form.alterar {
            display: block;
            margin: auto;
            text-align: center;
            height: 200px;
            width: 350px;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px #666;
            border-radius: 5px;
            
        }

        input[type="submit"] {
            width: 100px;
            height: 25px;
            border: none;
            border-radius: 3px;
            background-color: #3401cc;
            color: #FFF;
            cursor: pointer;
            
        }
        

        footer {
            left: 0;
            bottom: 0;
            position: fixed;
            text-align: center;
            color: #666;
            padding-bottom: 20px;
            align-items: center;
            height: 35px;
            width: 100%;
            background: #fefefe;
            box-shadow: 0 0 6px #000;
        }

        footer i {
            font-size: 25px;
        }

        footer a {
            text-decoration: none;
            color: #3401cc;
        }

        footer a:hover {
            text-decoration: none;
            color: #dc1617;
        }
    </style>
    <title>Alterar foto de perfil</title>
</head>

<body>
    <h2>Alterar foto de perfil</h2>
    <form class="alterar" method="post" enctype="multipart/form-data"> <br> <br> 
        <input type="file" name="file" id="file-input" ><br><br> <br>
        <input type="submit" value="Alterar" name="save">
    </form>
    <footer>
        <p>Mural de dúvidas <a href="https://www.instagram.com/eetepaanisioteixeira/">Anisio Teixeira</a>, 2023 - Developed By <a href="https://github.com/Silvio-Batista"><i class="bi bi-github"></i>Silvio</a></p>
    </footer>
</body>

</html>