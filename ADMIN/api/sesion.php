<?php
require '../files/conexion.php';
session_start();
$response = new stdClass();

$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user == "") {
    $response->state = false;
    $response->detail = "Se requiere el usuario";
} elseif ($pass == "") {
    $response->state = false;
    $response->detail = "Se requiere la contraseña";
} else {
    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' OR correo = '$user' ";
    $resultado = $con->query($sql);
    $num = $resultado->num_rows;
    if ($num > 0) {
        $row = $resultado->fetch_assoc();
        $passBD = $row['pass'];
        $id_rol = $row['id_rol'];
        $passC = md5($pass);
        if ($id_rol == 1) {
            if ($passBD == $passC) {
                $response->state = true;
                $_SESSION['id'] = $row['id_usu'];
                $_SESSION['user'] = $row['usuario'];
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['rol'] = $row['id_rol'];
                $_SESSION['pass'] = $row['pass'];
                //header("Location: ../dashboard.php");
            } else {
                $response->state = false;
                $response->detail = "La contraseña es incorrecta";
            }
        } else {
            $response->state = false;
            $response->detail = "El usuario no es adminstrador";
        }
    } else {
        $response->state = false;
        $response->detail = "El usuario no existe";
    }
}

echo json_encode($response);
