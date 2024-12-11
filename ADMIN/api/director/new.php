<?php
require '../../files/conexion.php';
$response = new stdClass();

$name = $_POST['name'];
$co = $_POST['co'];
$div = $_POST['div'];

if (strlen($name) > 255) {
    $response->state = false;
    $response->detail = "El campo Nombre no puede superar 255 caracteres";
} elseif ($name == "") {
    $response->state = false;
    $response->detail = "El campo Nombre no puede ser nulo";
} elseif ($co == "") {
    $response->state = false;
    $response->detail = "El campo Correo no puede ser nulo";
} elseif ($div == "") {
    $response->state = false;
    $response->detail = "No ha seleccionado la division";
} else {
    $query = "INSERT INTO directores VALUES (NULL, '$name', '$co', $div)";
    $res = $con->query($query);
    if ($res) {
        $response->state = true;
    } else {
        $response->state = false;
        $response->detail = "Error al agregar";
    }
}

echo json_encode($response);
