<?php
include("./inc/settings.php");
validar();
?>
<?php



$id2 = $_GET['colum2'];

  $query = "DELETE FROM usuarios WHERE id_usuario=$id2;";

  $conn = new mysqli($host, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($conn->query($query) == TRUE) {
    header("location:BDADMIN.php");
  } else {
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
  }


  





?>