<?php
    session_start();
    if(isset($_POST["user"]) and isset($_POST["pass"])){
        $_SESSION["user"]=$_POST["user"];
        $_SESSION["pass"]=$_POST["pass"];
        $user=$_POST["user"];
        $pass=md5($_POST["pass"]);
        $conn= new mysqli('localhost', 'mbalague', 'mbalague', 'mbalague_ProvaUF1');
        $sql="SELECT username, password FROM usuaris_examen";
        $result = $conn->prepare($sql);
        $result->execute();
        $result->bind_result($tusername, $tpassword);
     
        while($result->fetch()) {
           if ($user==$tusername and $pass=$tpassword){
                header("Location: home.php");
           }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form type="pruebaalex.php" method="post">
        <p>Username: <input type="text" name="user"/></p></br>
        <p>Password: <input type="password" name="pass"/></p></br>
        <input type="submit" name="Entrar"/></br>
        <a href="recordar.php">Regenrerar Password</a>
        
    </form>
</body>
</html>