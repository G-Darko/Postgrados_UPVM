<?php
require '../../files/conexion.php';
$response = new stdClass();

$usu = $_POST['usu'];
$co = $_POST['co'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
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
} elseif (strlen($pass) > 255) {
    $response->state = false;
    $response->detail = "El campo Contraseña no puede superar 255 caracteres";
} elseif ($pass == "") {
    $response->state = false;
    $response->detail = "El campo Contraseña no puede ser nulo";
} elseif ($pass != $cpass) {
    $response->state = false;
    $response->detail = "Las contraseñas no coinciden";
} else {

    $queryU = "SELECT COUNT(*) as tUsu FROM usuarios WHERE usuario = '$usu'";
    $resU = $con->query($queryU);
    $resTU = $resU->fetch_assoc();
    $tUsu = $resTU['tUsu'];

    $queryC = "SELECT COUNT(*) as tCo FROM usuarios WHERE correo = '$co'";
    $resC = $con->query($queryC);
    $resTC = $resC->fetch_assoc();
    $tCo = $resTC['tCo'];

    if ($tUsu == 0) {
        if ($tCo == 0) {
                $pass = md5($pass);
                $query = "INSERT INTO usuarios VALUES (NULL, '$usu', '$co', '$pass', $rol)";
                $res = $con->query($query);
                if ($res) {
                    $response->state = true;
                } else {
                    $response->state = false;
                    $response->detail = "Error al agregar";
                }
        } else {
            $response->state = false;
            $response->detail = "El correo ya existe";
        }
    }else{
        $response->state = false;
        $response->detail = "El usuario ya existe";
    }
}

echo json_encode($response);