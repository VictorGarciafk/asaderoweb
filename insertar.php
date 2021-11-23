<?php
include("./inc/settings.php");
validar();

$validar = $_POST['enviar'];


if ($validar == 'AceptarUser') {
  $identificador = $_POST['identificador'];
  $nombre = $_POST['nombre'];
  $pass = $_POST['contraseña'];
  


  $query = "INSERT INTO usuarios (id_usuario, nombre_usuario, pass) VALUES ($identificador, '$nombre', '$pass');";

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($conn->query($query) == TRUE) {
    header("location:BDADMIN.php");
  } else {
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
  }
}


if ($validar == 'AceptarProducto') {
  $identificador = $_POST['identificador'];
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];
  $archivoNombre = $_FILES["archivo"]["name"];

  
  $query = "INSERT INTO menu (id_producto, nombre_producto, PRECIO_PRODUCTO, imagen_producto) VALUES ($identificador, '$nombre', '$precio', '$archivoNombre');";
  $conn = new mysqli($host, $username, $password, $dbname);


  
  

  if ($conn->query($query) == TRUE) {
    if($_FILES["archivo"]["error"]>0){
  
    } else {
    
    $permitidos = array("image/png","image/jpeg","image/jpg");
    
    if(in_array($_FILES["archivo"]["type"], $permitidos)){
        
        $ruta = 'imagenes/'.$identificador.'/';
        $archivo = $ruta.$archivoNombre;
        
        if(!file_exists($ruta)){
            mkdir($ruta);
        }
        
        if(!file_exists($archivo)){
            
            $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
            
            if($resultado){
                echo "Archivo Guardado";
                } else {
                echo "Error al guardar archivo";
            }
            
            } else {
            echo "Archivo ya existe";
        }
        
        } else {
        echo "Archivo no permitido o excede el tamaño";
    }
    
  }

      header("location:BDADMIN.php");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  } else {
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
  }
}

?>