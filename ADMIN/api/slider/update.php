<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];
$re = $_POST['re'];

if($re == ""){
    $response->state=false;
    $response->detail="El campo Link no puede ser nulo";
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

                    $ruta = "../../img/slider/";
                    $archivo = $ruta . $nameImg;
                    if (!file_exists($ruta)) {
                        mkdir($ruta);
                    }
                    $subir = "img/slider/$nameImg";
                    $query = "UPDATE slider SET img = '$subir', redir = '$re' WHERE id_sli = $id";
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
            // Si no se sube ninguna imagen se quedara con la predeterminada
            $query = "UPDATE slider SET redir = '$re' WHERE id_sli = $id";
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