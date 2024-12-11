<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM tipo WHERE id_tipo = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$name = $row['nombre'];

$response->name = $name;

echo json_encode($response);