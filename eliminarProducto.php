<?php
include("./inc/settings.php");
validar();
?>
<?php



$id = $_GET['colum1'];



  $query = "DELETE FROM menu WHERE id_producto=$id;";
  $ruta = 'imagenes/'.$id;

  $conn = new mysqli($host, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  if ($conn->query($query) == TRUE) {
    eliminarDir($ruta);

    header("location:BDADMIN.php");
  } else {
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
  }


  


  function eliminarDir($carpeta)
	{
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
			if (is_dir($archivos_carpeta))
			{
				eliminarDir($archivos_carpeta);
			}
			else
			{
				unlink($archivos_carpeta);
			}
		}
		rmdir($carpeta);
	}


?>