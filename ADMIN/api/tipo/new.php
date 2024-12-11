<?php
require '../../files/conexion.php';
$response = new stdClass();

$name = $_POST['name'];

if(strlen($name) > 255){
    $response->state=false;
    $response->detail="El campo Nombre no puede superar 255 caracteres";
}elseif($name == ""){
    $response->state=false;
    $response->detail="El campo Nombre no puede ser nulo";
}else{
    $query = "INSERT INTO tipo VALUES (NULL, '$name')";
    $res = $con->query($query);
    if ($res) {
        $response->state=true;
    }else{
        $response->state=false;
        $response->detail="Error al agregar";
    }
}

echo json_encode($response);