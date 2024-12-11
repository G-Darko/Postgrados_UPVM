<?php
require '../../files/conexion.php';
require '../../files/session_start.php';
$response = new stdClass();

$id = $_POST['id'];
$usu = $_POST['usu'];
$co = $_POST['co'];
$rol = $_POST['rol'];

if (strlen($usu) > 255) {
    $response->state = false;
    $response->detail = "El campo Usuario no puede superar 255 caracteres";
} elseif ($usu == "") {
    $response->state = false;
    $response->detail = "El campo Usuario puede ser nulo";
} elseif (strlen($co) > 255) {
    $response->state = false;
    $response->detail = "El campo Correo no puede superar 255 caracteres";
} elseif ($co == "") {
    $response->state = false;
    $response->detail = "El campo Correo no puede ser nulo";
} elseif (!(comprobar_email($co))) {
    $response->state = false;
    $response->detail = "El Correo introducido no es valido";
} else {

    $queryU = "SELECT COUNT(*) as tUsu FROM usuarios WHERE usuario = '$usu' AND id_usu != $id";
    $resU = $con->query($queryU);
    $resTU = $resU->fetch_assoc();
    $tUsu = $resTU['tUsu'];

    $queryC = "SELECT COUNT(*) as tCo FROM usuarios WHERE correo = '$co' AND id_usu != $id";
    $resC = $con->query($queryC);
    $resTC = $resC->fetch_assoc();
    $tCo = $resTC['tCo'];

    if ($tUsu == 0) {
        if ($tCo == 0) {
            // $pass = md5($pass);
            $query = "UPDATE usuarios SET usuario = '$usu', correo = '$co', id_rol = $rol WHERE id_usu = $id";
            $res = $con->query($query);
            if ($res) {
                if ($id == $id_usu) {
                    $_SESSION['correo'] = $co;
                    $_SESSION['user'] = $usu;
                }
                $response->state = true;
            } else {
                $response->state = false;
                $response->detail = "Error al agregar";
            }
        } else {
            $response->state = false;
            $response->detail = "El correo ya existe";
        }
    } else {
        $response->state = false;
        $response->detail = "El usuario ya existe";
    }
}

echo json_encode($response);
