<?php
include("./inc/settings.php");
validar();
?>
<?php

$id = $_GET['colum1'];

$query = "SELECT id_producto, nombre_producto, PRECIO_PRODUCTO, imagen_producto FROM menu WHERE id_producto = " . $id . ";";

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
    <form action="updateProducto2.php" method="POST" enctype="multipart/form-data" autocomplete="off">
      <fieldset>
        <legend>Cambie la información del registro.</legend>
        Id: <input type="number" name="identificador" id="" value="<?= $row['id_producto'] ?>" readonly><br>
        Nombre: <input type="text" name="nombre" id="" value="<?= $row['nombre_producto'] ?>"><br>
        precio: <input type="number" name="precio" id="" value="<?= $row['PRECIO_PRODUCTO'] ?>"><br>
        imagen: <input type="file" class="custom-file-input" id="" name="archivo"><br>

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