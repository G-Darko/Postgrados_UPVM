<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM division WHERE id_div = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$name = $row['nombre'];

$response->name = $name;

echo json_encode($response);