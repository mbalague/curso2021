<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method="post">
        <p>Escriu la teva contrassenya (only letters): </p><input type="password" name="regPass"><br>
        <p>Escriu el correu que vols utilitzar: </p><input type="text" name="regUser"><br> 
        <input type="submit" value="ok">
    </form>
    <?php
        require "llibreria.php";

        if ($_SERVER['REQUEST_METHOD']=='POST'){
            if (isset($_POST["regUser"]) and isset($_POST["regPass"])) {
                $conn = new mysqli('localhost', 'mbalague', 'mbalague', 'mbalague_');

               
                $regUser = $_REQUEST["regUser"];
                $regPass = $_REQUEST["regPass"];
                $comprovaciomail = validacio($regUser);
                $comprovaciopass = validaciopass($regPass);

                if ($comprovaciomail == TRUE and $comprovaciopass == TRUE){ 
                    $sql = "INSERT INTO USER (user, `Password` , email, id_rol) VALUES ('$regUser', '$regPass', 'user', 2)";
                    $result = (mysqli_query($conn, $sql) or die("Error: ". mysqli_error($conn)));
                    header ("Location: http://dawjavi.insjoaquimmir.cat/mbalague/UF1/a5/session.php");
                }else {
                    echo "Assegurat que escrius un mail i una contrassenya correcta";
                }
            }
        }
    ?>


</body>
</html>