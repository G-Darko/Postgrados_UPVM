<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "DELETE FROM tipo WHERE id_tipo = $id";
$res = $con->query($query);
if ($res) {
    $response->state = true;
} else {
    $response->state = false;
    $response->detail = "Error al eliminar";
}

echo json_encode($response);
