<?php
function conexion($tabla, $usuario, $pass){
	try {
		$conexion = new PDO("mysql:host=localhost;dbname=$tabla", $usuario,$pass);
		return $conexion;
		
	} catch (PDOException $e) {
		return false;
	}

}
function id_imagen($id){
	return $id;

}


