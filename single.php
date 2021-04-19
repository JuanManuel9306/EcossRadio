<?php 
require 'admin/config.php';
require 'functions.php';

$conexion = conexion($bd_config);
$id_articulo = id_articulo($_GET['id']);
if (!$conexion) {
	header('Location: error.php');
}
if (empty($id_articulo)) {
	//si el usuario intenta inyectar codigo redirije
	header('Location: index.php');
}
$post =obtener_post_por_id($conexion,$id_articulo);
if (!$post) {
	//si no hay post redirigimos a galeria
	header('Location:index.php');
}
$post = $post[0];
require 'views/single.view.php';
 ?>