<?php
include("./inc/settings.php");
validar();
?>
<?php

$archivoNombre = $_FILES["archivo"]["name"];
$identificador = $_POST['identificador'];

if ($archivoNombre == null) {
    $query = "UPDATE Menu SET nombre_producto = '" . $_POST['nombre'] . "', PRECIO_PRODUCTO = '" . $_POST['precio'] . "' WHERE id_producto = " . $identificador . ";";
} else {
    $query = "UPDATE Menu SET nombre_producto = '" . $_POST['nombre'] . "', PRECIO_PRODUCTO = '" . $_POST['precio'] . "', imagen_producto = '" . $archivoNombre . "' WHERE id_producto = " . $identificador . ";";
}


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($query) == TRUE) {

    if (!$archivoNombre == null) {
        if ($_FILES["archivo"]["error"] > 0) {
        } else {

            $permitidos = array("image/png", "image/jpeg", "image/jpg");

            if (in_array($_FILES["archivo"]["type"], $permitidos)) {

                $ruta = 'imagenes/' . $identificador . '/';
                $archivo = $ruta . $archivoNombre;

                if (!file_exists($ruta)) {
                    mkdir($ruta);
                } elseif (file_exists($ruta)) {


                    eliminarDir($ruta);

                    mkdir($ruta);
                }

                if (!file_exists($archivo)) {

                    $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

                    if ($resultado) {
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
    }



    header("location:BDADMIN.php");
} else {
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
}



function eliminarDir($carpeta)
{
    foreach (glob($carpeta . "/*") as $archivos_carpeta) {
        if (is_dir($archivos_carpeta)) {
            eliminarDir($archivos_carpeta);
        } else {
            unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
}
?>