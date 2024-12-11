<?php
require '../../files/conexion.php';
$response = new stdClass();
$null = '<p><br></p>'; // Null es equivalente a esto, porque por defecto quill pone estas etiquetas

$id = $_POST['id'];
$name = $_POST['name'];
$lic = $_POST['lic'];
$mae = $_POST['mae'];
$doc = $_POST['doc'];
$co = $_POST['co'];
$sam = $_POST['sam'];
$niv = $_POST['niv'];
$div = $_POST['div'];

if (strlen($name) > 255) {
    $response->state = false;
    $response->detail = "El campo Nombre no puede superar 255 caracteres";
} elseif ($name == "") {
    $response->state = false;
    $response->detail = "El campo Nombre no puede ser nulo";
} elseif ($lic == "") {
    $response->state = false;
    $response->detail = "El campo Licenciatura no puede ser nulo";
} elseif ($mae == "") {
    $response->state = false;
    $response->detail = "El campo Doctorado no puede ser nulo";
} elseif ($sam == $null) {
    $response->state = false;
    $response->detail = "El campo Samblanza no puede ser nulo";
} elseif ($niv == "") {
    $response->state = false;
    $response->detail = "No ha seleccionado el nivel";
} elseif ($div == "") {
    $response->state = false;
    $response->detail = "No ha seleccionado la division";
} else {

    if ($_FILES['img']['error'] > 0) {
        $response->state = false;
        $response->detail = "Error al subir archivo";
    } else {
        $nameImg = $_FILES['img']['name'];
        $type = $_FILES['img']['type'];
        $size = $_FILES['img']['size'];
        $tmp = $_FILES['img']['tmp_name'];
        if (!($nameImg == "")) {
            // Tamaño maximo de la imagen (5mb)
            if ($size <= 5000000) {
                // extensiones permitidad
                if ($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg" || $type == "image/gif") {

                    $ruta = "../../img/investigadores/";
                    $archivo = $ruta . $nameImg;
                    if (!file_exists($ruta)) {
                        mkdir($ruta);
                    }
                    $subir = "img/investigadores/$nameImg";
                    $query = "UPDATE investigadores SET nombre = '$name', lic = '$lic', maestria = '$mae', doctorado = '$doc', correo = '$co', samblanza = '$sam', img = '$subir', id_niv = $niv, id_div = $div WHERE id_in = $id";
                    if (!file_exists($archivo)) {
                        move_uploaded_file($tmp, $archivo);
                        $res = $con->query($query);
                        if ($res) {
                            $response->state = true;
                        } else {
                            $response->state = false;
                            $response->detail = "Error al agregar";
                        }
                    } else {
                        // Si el archivo ya existe repite las mismas instrucciones, reescribiendo el archivo
                        move_uploaded_file($tmp, $archivo);
                        $res = $con->query($query);
                        if ($res) {
                            $response->state = true;
                        } else {
                            $response->state = false;
                            $response->detail = "Error al agregar";
                        }
                    }
                } else {
                    $response->state = false;
                    $response->detail = "Solo se adminten imagenes (png, jpg, jpeg, gif)";
                }
            } else {
                $response->state = false;
                $response->detail = "El tamaño no puede ser mayor a 5 MB";
            }
        } else {
            // Si no se sube ninguna imagen no actualiza ese apartado
            $query = "UPDATE investigadores SET nombre = '$name', lic = '$lic', maestria = '$mae', doctorado = '$doc', correo = '$co', samblanza = '$sam', id_niv = $niv, id_div = $div WHERE id_in = $id";
            $res = $con->query($query);
            if ($res) {
                $response->state = true;
            } else {
                $response->state = false;
                $response->detail = "Error al agregar";
            }
        }
    }
}

echo json_encode($response);
