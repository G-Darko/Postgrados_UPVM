<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM investigadores WHERE id_in = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$name = $row['nombre'];
$lic = $row['lic'];
$mae = $row['maestria'];
$doc = $row['doctorado'];
$co = $row['correo'];
$sam = $row['samblanza'];
$img = $row['img'];
$niv = $row['id_niv'];
$div = $row['id_div'];

$response->name = $name;
$response->lic = $lic;
$response->mae = $mae;
$response->doc = $doc;
$response->co = $co;
$response->sam = $sam;
$response->img = $img;
$response->niv = $niv;
$response->div = $div;

echo json_encode($response);