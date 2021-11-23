<?php
include("./inc/settings.php");
//print_r($_POST);
$query="SELECT * FROM usuarios WHERE nombre_usuario = '$_POST[username]' AND pass= '$_POST[psswrd]'";
echo $query;



// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($query);
//print_r($result);
if ($result->num_rows > 0) {
  
  // output data of each row
  $row = $result->fetch_assoc();
 // echo "Acceso de usuario validado, redirigiendo a la pagina principal.";
  session_start();
  $_SESSION["user"] = $row["nombre_usuario"];

  header("location: BDADMIN.php");

} else {
  echo "Se detecto un acceso ilegal al sistema, su ip esta siendo monitoreada y sera enviada a la policia";
  ?>
  <a href="login.php">Sitio de login</a>
  <?php
}






$conn->close();

?>