<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];

$query = "SELECT * FROM slider WHERE id_sli = $id";
$res = $con->query($query);
$row = $res->fetch_assoc();

$re = $row['redir'];
$img = $row['img'];

$response->re = $re;
$response->img = $img;

echo json_encode($response);