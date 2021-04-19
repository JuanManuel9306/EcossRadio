<?php 
require 'admin/config.php';
require 'functions.php';
$conexion = conexion($bd_config);
if (!$conexion) {
	header('Location: error.php');
}
//obtener_post();
//echo pagina_actual();
$posts = obtener_post($blog_config['post_por_pagina'],$conexion);
//print_r($post);
if (!$posts) {
	header('Location: error.php');
}
require 'views/noticias2.view.php';

 ?>