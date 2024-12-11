<?php
require 'conexion.php';
session_start();
unset($_SESSION['id']);
header('Location: ../');
mysqli_close($conexion);
exit();