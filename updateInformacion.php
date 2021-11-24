<?php
include("./inc/settings.php");
validar();
?>
<?php

$portadaNombre = $_FILES["portada"]["name"];
$logoNombre = $_FILES["Logo"]["name"];

if ($portadaNombre != null && $logoNombre != null) {
    $query = "UPDATE INFORMACION SET numerocelular = '" . $_POST['celular'] . "', horaAbrir= '" . $_POST['abrir'] . "', horaCerrar = '" . $_POST['cerrar'] . "' , logo= '" . $logoNombre . "' , imagenPortada= '" . $portadaNombre . "' WHERE id_informacion = 1;";
} elseif($portadaNombre != null) {
    $query = "UPDATE INFORMACION SET numerocelular = '" . $_POST['celular'] . "', horaAbrir= '" . $_POST['abrir'] . "', horaCerrar = '" . $_POST['cerrar'] . "' , imagenPortada= '" . $portadaNombre . "' WHERE id_informacion = 1;";
}elseif($logoNombre != null){
    $query = "UPDATE INFORMACION SET numerocelular = '" . $_POST['celular'] . "', horaAbrir= '" . $_POST['abrir'] . "', horaCerrar = '" . $_POST['cerrar'] . "' , logo= '" . $logoNombre . "' WHERE id_informacion = 1;";
}elseif($portadaNombre == null && $logoNombre == null){
    $query = "UPDATE INFORMACION SET numerocelular = '" . $_POST['celular'] . "', horaAbrir= '" . $_POST['abrir'] . "', horaCerrar = '" . $_POST['cerrar'] . "' WHERE id_informacion = 1;";

}


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($query) == TRUE) {

    if($portadaNombre != null){
        $portadainput = "portada";
        $rutaportada = "portada";
        actualizarArchivo($portadaNombre, $portadainput, $rutaportada);
        
    }

    if($logoNombre != null){
        $logoinput = "Logo";
        $rutalogo = "logo";
        actualizarArchivo($logoNombre, $logoinput, $rutalogo);
    }


    header("location:BDADMIN.php");
} else {
    echo "Algo salio mal <a href='http://localhost/proyectAsadero/BDADMIN.php'> clic aqui para volver al crud</a>";
}




function actualizarArchivo($archivo, $input, $rutainput){
    if (!$archivo == null) {
        if ($_FILES[$input]["error"] > 0) {
        } else {

            $permitidos = array("image/png", "image/jpeg", "image/jpg");

            if (in_array($_FILES[$input]["type"], $permitidos)) {

                $ruta = 'imagenes/' . $rutainput . '/';
                $archivo = $ruta . $archivo;

                if (!file_exists($ruta)) {
                    mkdir($ruta);
                } elseif (file_exists($ruta)) {


                    eliminarDir($ruta);

                    mkdir($ruta);
                }

                if (!file_exists($archivo)) {

                    $resultado = @move_uploaded_file($_FILES[$input]["tmp_name"], $archivo);

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