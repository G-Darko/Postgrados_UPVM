<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM usuarios WHERE id_usu = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$usu = $row['usuario'];
$co = $row['correo'];
$rol = $row['id_rol'];

$response->usu = $usu;
$response->co = $co;
$response->rol = $rol;

echo json_encode($response);