<?php
include("./inc/settings.php");
validar();

$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>BDD</title>
  <link rel="stylesheet" type="text/css" href="css/diseñoBD.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <script>
    function confirmar() {
      if (confirm("Va a eliminar un registro, �est� usted seguro?")) {
        return true;
      }
      return false;
    }
  </script>
</head>

<body>

<div class="titulo">
<h1>ASADERO ALTAR</h1>
<H2>Control de sistema</H2>
</div>

  <br>

  <div class="usuarios">
    <h1>USUARIOS</h1>
    <?php
    // Create connection
    $sql = "SELECT id_usuario, nombre_usuario, pass FROM usuarios";
    $result = $conn->query($sql);
    //print_r($result);
    if ($result->num_rows > 0) {
      echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Eliminar</th><th>Modificar</th></tr>";
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "\n<tr>\n\t<td>" . $row["id_usuario"] . "</td>\n\t<td>" . $row["nombre_usuario"] . "</td>";
        echo "<td><a href='eliminarUsuario.php?colum2=" . $row["id_usuario"] . "' onclick='return confirmar()'><img src='eliminar.png'></a></td><td>
          <a href='updateUsuarios.php?colum1=" . $row["id_usuario"] . "' onclick='return confirmar()'><img src='update.png'></td></tr>\n";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    ?>

    <br>
    <form action="insertar.php" method="post">

      <fieldset>
        <legend>Inserte la informacion del nuevo registro</legend>
        Id: <input type="number" name="identificador" id="" value="" required><br>
        Nombre: <input type="text" name="nombre" id="" value=""><br>
        contraseña: <input type="text" name="contraseña" id="" value=""><br>
        
        <br>
        <input type="submit" name ="enviar" value="AceptarUser"><br>
      </fieldset>
    </form>
  </div>

  <br><br>

  <div class="menu">
  <h1>PRODUCTO</h1>
    <?php
    $sql2 = "SELECT id_producto, nombre_producto, PRECIO_PRODUCTO FROM menu";
    $result2 = $conn->query($sql2);
    //print_r($result);
    if ($result2->num_rows > 0) {
      echo "<table border='1'><tr><th>ID</th><th>Name</th><th>precio</th><th>Eliminar</th><th>Modificar</th></tr>";
      // output data of each row
      while ($row = $result2->fetch_assoc()) {
        echo "\n<tr>\n\t<td>" . $row["id_producto"] . "</td>\n\t<td>" . $row["nombre_producto"] . "</td>\n\t<td>" . $row["PRECIO_PRODUCTO"] . "</td>";
        echo "<td><a href='eliminarProducto.php?colum1=" . $row["id_producto"] ."' onclick='return confirmar()'><img src='eliminar.png'></a></td><td>
          <a href='updateProducto.php?colum1=" . $row["id_producto"] . "' onclick='return confirmar()'><img src='update.png'></td></tr>\n";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    ?>


    <br>
    <form action="insertar.php" method="POST" enctype="multipart/form-data" autocomplete="off">

      <fieldset>
        <legend>Inserte la informacion del nuevo registro</legend>
        Id: <input type="number" name="identificador" id="" value="" required><br>
        Nombre: <input type="text" name="nombre" id="" value=""><br>
        precio: <input type="number" name="precio" id="" value=""><br>
        imagen: <input type="file" class="custom-file-input" id="archivo" name="archivo"><br>
        <br>
        <input type="submit" name ="enviar" value="AceptarProducto"><br>
      </fieldset>
    </form>
  </div>

  <br><br>


  <div class="informacion">
  <h1>INFORMACION</h1>
    <?php
    $sql3 = "SELECT imagenPortada, logo, horaAbrir, horaCerrar, numerocelular, id_informacion FROM INFORMACION";
    $result = $conn->query($sql3);
    //print_r($result);
    if ($result->num_rows > 0) {
      echo "<table border='1'><tr><th>numerocelular</th><th>horaAbrir</th><th>horaCerrar</th><th>imagenPortada</th><th>logo</th>";
      // output data of each row
      $row = $result->fetch_assoc();
        echo "\n<tr>\n\t<td>" . $row["numerocelular"] . "</td>\n\t<td>" . $row["horaAbrir"] . "</td>\n\t<td>" . $row["horaCerrar"] . "</td>\n\t<td>" . $row["imagenPortada"] . "</td>\n\t<td>" . $row["logo"] . "</td>";
      
      echo "</table>";
    } else {
      echo "0 results";
    }

    ?>


    <br>
    <form action="updateInformacion.php" method="POST" enctype="multipart/form-data" autocomplete="off">

      <fieldset>
        <legend>Inserte la informacion del nuevo registro</legend>
        numeroCelular: <input type="number" name="celular" id="" value=<?= $row['numerocelular'] ?>><br>
        horaAbierto: <input type="time" name="abrir" id="" value="<?= $row['horaAbrir'] ?>"><br>
        horaCerrar: <input type="time" name="cerrar" id="" value="<?= $row['horaCerrar'] ?>"><br>
        imagenPortada: <input type="file" class="custom-file-input" id="" name="portada"><br>
        Logo: <input type="file" class="custom-file-input" id="" name="Logo"><br>
        <br>
        <input type="submit" name ="enviar" value="AceptarProducto"><br>
      </fieldset>
    </form>
  </div>
  <br>

  <a href="logout.php">log out</a>
  <br>
</body>

</html>