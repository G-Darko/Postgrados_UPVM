<?php
require '../../files/conexion.php';
$response = new stdClass();

$id = $_POST['id'];
$name = $_POST['name'];

if(strlen($name) > 255){
    $response->state=false;
    $response->detail="El campo Nombre no puede superar 255 caracteres";
}elseif($name == ""){
    $response->state=false;
    $response->detail="El campo Nombre no puede ser nulo";
}else{
    $query = "UPDATE tipo SET nombre = '$name' WHERE id_tipo = $id";
    $res = $con->query($query);
    if ($res) {
        $response->state=true;
    }else{
        $response->state=false;
        $response->detail="Error al actualizar";
    }
}

echo json_encode($response);