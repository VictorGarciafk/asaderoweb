<?php
include("./inc/settings.php");
validar();
?>
<?php 
    $query = "UPDATE usuarios SET nombre_usuario = '".$_POST['nombre']."', pass = '".$_POST['pass']."' WHERE id_usuario = ".$_POST['identificador'].";";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ( $conn->query($query)== TRUE){
    header("location:BDADMIN.php");
}else{
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>" ;

}
?>