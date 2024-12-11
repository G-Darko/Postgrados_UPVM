<?php 
	session_start();
	if (!isset($_SESSION['id'])) {
		header('Location: ../ADMIN');
	}
	$id_usu = $_SESSION['id'];
	$id_rol = $_SESSION['rol'];
	
	$correo = $_SESSION['correo'];
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	
	if ($id_rol == 1) {
		$rol = 'Administrador';
	}
