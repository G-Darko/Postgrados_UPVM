<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "DELETE FROM slider WHERE id_sli = $id";
$res = $con->query($query);
if ($res) {
    $response->state = true;
} else {
    $response->state = false;
    $response->detail = "Error al eliminar";
}

echo json_encode($response);