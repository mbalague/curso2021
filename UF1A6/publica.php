
<?php
include("funcions.php");

session_start();
$error=FALSE;
$errormsg="";


if(isset($_REQUEST["okp"])){

    setcookie('politica', 1, time() + 365*24*60*60);
    header("location:publica.php");


}

if(isset($_COOKIE["email"])){


    if(validaUsuari($_COOKIE["email"],$_COOKIE["password"])){



            $_SESSION["login"]=$_COOKIE["email"];
            header('location:privada.php');

    }else{

        setcookie('email', null, 0,'/');
        setcookie('password', null, 0,'/');

    }



}


if($_SERVER['REQUEST_METHOD'] == 'POST'&&!isset($_REQUEST["busca"])) {







    $pass=test_input($_REQUEST["password"]);


    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error=TRUE;connectDB('localhost', 'mbalague', 'mbalague', 'mbalague_login2');
        $errormsg.= "Invalid email format";
    }

    $password = test_input($_POST["password"]);
    if (!preg_match("/^[a-zA-Z0-9' ]*$/",$password)) {
        $error=TRUE;
        $errormsg.=  "Only letters and numbers allowed";
    }connectDB('localhost', 'mbalague', 'mbalague', 'mbalague_login2');



    if(!$error){


        if(validaUsuari($_REQUEST["email"],md5($_REQUEST["password"]))){

            echo "Ok de autenticación";
            $_SESSION["login"]=$_REQUEST["email"];

            if(isset($_REQUEST["recorda"])){
                setcookie('email', $_REQUEST["email"], time() + 365*24*60*60,'/');
                setcookie('password', md5($_REQUEST["password"]), time() + 365*24*60*60,'/');
            }

            header('location:privada.php');


        }else{

            echo "Error de autenticación";
            setcookie('contador', null, 0);


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
    <script>
        function check(){
            if(!document.forms[0].email.value.length>0){
                alert("has d'intruduir un email");
            }else{


                location.href="recoverypassword.php?email="+document.forms[0].email.value;
            }




        }

    </script>
    <style>

        ul{
            list-style-type: none;
        }
        ul  li {
            float: left;
        }



    </style>
</head>
<body>


<?php

if(!isset($_COOKIE["politica"])){


?>

política....<br>
<a href="?okp">Accepto</a><br>
<a href="http://www.google.com">No Accepto</a>


<?php

}else{



?>

    <form method="post">
        email:<input type="text" name="email" id=""><br>
        password: <input type="password" name="password" id="">
        autologin<input type="checkbox" name="recorda" id="">
        <input type="submit" value="envia">    </form>
    <br>
    <a href="#" onclick="check();"> Regenerar password</a>
    <a href="register.php">Crear nou usuari</a>
    <a href="#">Veure Cistella</a>
    <?

}






?>




<form method="post">
    <input type="text" name="busca" id="">
    <?

//lista cats


$conn = connectDB('localhost', 'mbalague', 'mbalague', 'mbalague_login2');


    $sql = "select * from categoria ";

if (!$resultado = $conn->query($sql)) {
die("error ejecutando la consulta:".$conn->error);
}

echo "<select name=\"cat\">";
echo " <option value=\"0\">Todas las categorias</option> ";

while($categorias=$resultado->fetch_assoc()){
    echo " <option value=\"".$categorias["id"]."\">".$categorias["nom"]."</option> ";

}


echo "</select>";

?>
    <input type="submit" value="Busca">
</form>

<?php
echo "<ul>";

?>
