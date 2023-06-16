<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulario</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<?php

if ($_POST) {
    $nombre = $_POST['nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $bdpassword = "";  
    $bdname = "tabla_examen";


$enterbutton= $_POST['submit'];


$passwordlength= strlen($password);
$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  

if (isset($enterbutton)){
if ($passwordlength < 4 || $passwordlength > 8){
echo "Error de validacion, password invalido . Has to be between 4 and 8 characters";
}


else if (!preg_match ($pattern, $email) ){  
$ErrMsg = "Email is not valid.";  
echo $ErrMsg;  
}
else{



    $conn = new mysqli($servername, $username, $bdpassword, $bdname);
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }

    $sql = "INSERT INTO usuario (nombre, primer_apellido, segundo_apellido, email, login, password)
    VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$email', '$login', '$password')";

    if ($conn->query($sql) == TRUE) {
        echo "Registro completado con éxito"; 


        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}     
}           
}
?>


    <body>
    <?php
    $servername = "localhost";
    $username = "root";
    $bdpassword = ""; 
    $bdname = "tabla_examen";        
           $conn = new mysqli($servername, $username, $bdpassword, $bdname);
           if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
        }
        ?>
        <table border="1">
            <tbody>
            <?php
                    $result = $conn->query("SELECT nombre, primer_apellido, segundo_apellido, email FROM usuario")
                        OR die("Select error");
                    while($row = $result->fetch_assoc()) {
                        echo '<tr><td>' . $row['nombre'] . '</td><td>' . $row['primer_apellido'] . '</td><td>' . $row['segundo_apellido'] . '</td><td>'  . $row['email'] . '</td></tr>';
                    }
                ?>
            </tbody>
        </table>
    </body>


</html>