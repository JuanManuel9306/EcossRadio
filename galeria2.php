<?php 
	require 'funciones.php';
$fotos_por_pagina=12;
$pagina_actual= (isset($_GET['p']) ? (int)$_GET['p']:1);
$inicio = ($pagina_actual > 1) ? $pagina_actual * $fotos_por_pagina - $fotos_por_pagina:0;

$conexion = conexion('bd_ecoss','root','');
if (!$conexion) {
	//Aqui mata la pagina pero se debe redireccionar a una pagina de error
	die();
}
$statement = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM fotos ORDER BY id DESC LIMIT $inicio, $fotos_por_pagina");
$statement->execute();
$fotos = $statement->fetchAll();
if (!$fotos) {
	header('Location: error.php');//Aqui se debe redireccionar a una pagina de error
}
$statement = $conexion->prepare("SELECT FOUND_ROWS() as total_filas");
$statement->execute();

$total_post = $statement->fetch()['total_filas'];

$total_paginas = ceil($total_post / $fotos_por_pagina);
	require 'views/galeria2.view.php';
?>