<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM maestria WHERE id_ma = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$name = $row['nombre'];
$ob = $row['objetivo'];
$pi = $row['pingreso'];
$req = $row['req'];
$pe = $row['pegreso'];
$campo = $row['campo'];
$compe = $row['competencias'];
$img = $row['img'];
$tipo = $row['id_tipo'];
$div = $row['id_div'];
$op = $row['opT']; 

$response->name = $name;
$response->ob = $ob;
$response->pi = $pi;
$response->req = $req;
$response->pe = $pe;
$response->campo = $campo;
$response->compe = $compe;
$response->img = $img;
$response->tipo = $tipo;
$response->div = $div;
$response->op = $op;

echo json_encode($response);