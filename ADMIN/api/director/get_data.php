<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM directores WHERE id_direc = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$name = $row['nombre'];
$co = $row['correo'];
$div = $row['id_div'];

$response->name = $name;
$response->co = $co;
$response->div = $div;

echo json_encode($response);