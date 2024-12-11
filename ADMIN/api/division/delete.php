<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "DELETE FROM division WHERE id_div = $id";
$res = $con->query($query);
if ($res) {
    $response->state = true;
} else {
    $response->state = false;
    $response->detail = "Error al eliminar";
}

echo json_encode($response);
