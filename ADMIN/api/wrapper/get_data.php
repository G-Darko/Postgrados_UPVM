<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM wrapper WHERE id_wra = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$ti = $row['titulo'];
$des = $row['descripcion'];
$re = $row['redir'];
$img = $row['img'];

$response->ti = $ti;
$response->des = $des;
$response->re = $re;
$response->img = $img;

echo json_encode($response);