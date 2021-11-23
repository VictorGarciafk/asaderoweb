<?php
include("./inc/settings.php");
validar();
?>
<?php

$query = "SELECT id_usuario, nombre_usuario, pass FROM usuarios WHERE id_usuario = " . $_GET['colum1'] . ";";

//echo $query;


$conn = new mysqli($host, $username, $password, $dbname);
$result = $conn->query($query);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($query) == TRUE) {
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

?>
    <form action="updateUsuarios2.php" method="POST">
      <fieldset>
        <legend>Cambie la información del registro.</legend>
        Id: <input type="number" name="identificador" id="" value="<?= $row['id_usuario'] ?>" readonly><br>
        Nombre: <input type="text" name="nombre" id="" value="<?= $row['nombre_usuario'] ?>"><br>
        Contraseña: <input type="text" name="pswd" id="" value="<?= $row['pass'] ?>"><br>
        <br>
        <input type="submit" value="Modificar"><br>
      </fieldset>
    </form>
<?php
  }
} else {
  echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
}


?>