<?php
require 'funciones.php';
$conexion = conexion('bd_ecoss','root','');
if (!$conexion) {
	die();
	# code...
}

$id = isset($_GET['id']) ? (int)$_GET['id']: false;
if (!$id) {
	header('Location: index.php');
	# code...
}
$statement = $conexion->prepare('SELECT * FROM fotos WHERE id = :id');
$statement->execute(array(':id' => $id));
$foto = $statement->fetch();
if (!$foto) {
	header('Location index.php');
	# code...
}
	require 'views/foto.view.php';
?>