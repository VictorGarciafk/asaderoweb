<?php
include("./inc/settings.php");
$conn = new mysqli($host, $username, $password, $dbname);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>asadero</title>
    <link rel="stylesheet" type="text/css" href="css/diseño.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

</head>


<header>

    <div class="menu_bar">
        <a href="#" class="boton-menu"><span class="icon-menu"></span>Menu</a>
    </div>

    <nav>
        <ul>
            <li><a href="#banner"><span class="icon-home3"></span>Inicio</a></li>
            <li><a href="#horario"><span class="icon-clock"></span>Horario</a></li>
            <li><a href="#productos"><span class="icon-user-tie"></span>Menu</a></li>
            <li><a href="#Contacto"><span class="icon-address-book"></span>Contacto</a></li>
        </ul>
    </nav>
</header>

<body>

    <div id="banner">
        <img src="Imagenes//Fondo de presentacion.jpg" alt="Imagen del evento" class="ImagenEvento">
    </div>

    <div id="horario" class="fecha">
      <h1>Horario.</h1>
      <?php
      $sql = "SELECT * FROM informacion";
      $resultHorario = $conn->query($sql);
      $row = $resultHorario->fetch_assoc();

      echo "<p>abierto de:</p><br>";
      echo "<p>".$row['horaAbrir']."</p><br>";
      echo "<p>a</p><br>";
      echo "<p>".$row['horaCerrar']."</p><br>";
      ?>

    </div>

    <div class="A" id="productos">
        <h1>Menu</h1>

        <div class="caja2">

            <?php
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM menu";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {

          echo "<div class='a'>
          <img src='Imagenes/".$row['id_producto']. "/" . $row['imagen_producto'] . "' width='250' title='" . $row['nombre_producto'] . "' alt='logotipo'> 
          <p>" . $row['nombre_producto'] . "</p> 
          <p> precio: " . $row['PRECIO_PRODUCTO'] . "</p> 
          </div>";
            
                }
            } else {
                echo "0 results";
            }
            ?>

        </div>
    </div>

    <div class="Contacto" id="Contacto">
      <h3>¡contáctanos!.</h3>
      <br>
      <?php
      $sql = "SELECT * FROM informacion";
      $resultContacto = $conn->query($sql);
      $row = $resultContacto->fetch_assoc();

      echo "<img src='Imagenes/". $row['logo']."' alt='Contacto'>";
      echo "<ul>";
      echo "<li>Telefono: ". $row['numerocelular']. "";
      echo "</ul>";
      echo "</div>";
    
    ?>

    <footer>
        <div class="footer">
            <p>Unison 2019</p>
        </div>
    </footer>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="barra de navegacion.js"></script>

</body>

</html>