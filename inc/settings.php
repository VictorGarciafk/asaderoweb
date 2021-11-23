<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "asadero";

    function validar(){
        session_start();
    if (empty($_SESSION["user"]))
    {
      echo "Se detecto un acceso ilegal al sistema, su ip esta siendo monitoreada y sera enviada a la policia";
      ?>
      <a href="login.php">Sitio de login</a>
      <?php
      exit();
    }
}
    
?>