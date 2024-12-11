<?php
require '../../files/conexion.php';
require '../../files/session_start.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT pass FROM usuarios WHERE id_usu = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$passBD = $row['pass'];

$pact = $_POST['pact'];
$pact = md5($pact);
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

if ($passBD == $pact) {
    if (strlen($pass) > 255) {
        $response->state = false;
        $response->detail = "El campo Nueva Contraseña no puede superar 255 caracteres";
    } elseif ($pass == "") {
        $response->state = false;
        $response->detail = "El campo Nueva Contraseña no puede ser nulo";
    } elseif ($pass != $cpass) {
        $response->state = false;
        $response->detail = "Las contraseñas para cambiar no coinciden";
    } else {
        $pass = md5($pass);
        $query = "UPDATE usuarios SET pass = '$pass' WHERE id_usu = $id";
        $res = $con->query($query);
        if ($res) {
            if($id == $id_usu){
                $_SESSION['pass'] = $pass;
            }
            $response->state = true;
        } else {
            $response->state = false;
            $response->detail = "Error al agregar";
        }
    }
} else {
    $response->state = false;
    $response->detail = "La contraseña actual es incorrecta";
}

echo json_encode($response);
