<?php
require '../../files/conexion.php';
$response = new stdClass();
$null = '<p><br></p>'; // Null es equivalente a esto, porque por defecto quill pone estas etiquetas
$id = $_POST['id'];
$name = $_POST['name'];
$ob = $_POST['ob'];
$pi = $_POST['pi'];
$req = $_POST['req'];
$pe = $_POST['pe'];
$campo = $_POST['campo'];
$compe = $_POST['compe'];
$tipo = $_POST['tipo'];
$div = $_POST['div'];
$op = $_POST['op']; // No obligatorio

if (strlen($name) > 255) {
    $response->state = false;
    $response->detail = "El campo Nombre no puede superar 255 caracteres";
} elseif ($name == "") {
    $response->state = false;
    $response->detail = "El campo Nombre puede ser nulo";
} elseif ($ob == $null) {
    $response->state = false;
    $response->detail = "El campo Objetivo puede ser nulo";
} elseif ($pi == $null) {
    $response->state = false;
    $response->detail = "El campo Perfil de Ingreso puede ser nulo";
} elseif ($req == $null) {
    $response->state = false;
    $response->detail = "El campo Requisitos de Ingreso puede ser nulo";
} elseif ($pe == $null) {
    $response->state = false;
    $response->detail = "El campo Perfil de Egreso puede ser nulo";
} elseif ($campo == $null) {
    $response->state = false;
    $response->detail = "El campo Campo de Trabajo puede ser nulo";
} elseif ($compe == $null) {
    $response->state = false;
    $response->detail = "El campo Competencias profecionales puede ser nulo";
} elseif ($tipo == "") {
    $response->state = false;
    $response->detail = "No ha seleccionado el tipo";
} elseif ($div == "") {
    $response->state = false;
    $response->detail = "No ha seleccionado la division";
} else {
    if ($op == $null) {
        $op = "";
    }

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

                    $ruta = "../../img/maestrias/";
                    $archivo = $ruta . $nameImg;
                    if (!file_exists($ruta)) {
                        mkdir($ruta);
                    }
                    $subir = "img/maestrias/$nameImg";
                    $query = "UPDATE maestria SET nombre = '$name', objetivo = '$ob', pingreso = '$pi', req = '$req', pegreso = '$pe', campo = '$campo', competencias = '$compe', img = '$subir', id_tipo = $tipo, id_div = $div, opT = '$op' WHERE id_ma = $id";
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
            $query = "UPDATE maestria SET nombre = '$name', objetivo = '$ob', pingreso = '$pi', req = '$req', pegreso = '$pe', campo = '$campo', competencias = '$compe', id_tipo = $tipo, id_div = $div, opT = '$op' WHERE id_ma = $id";
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
