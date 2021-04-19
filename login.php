<?php session_start();
require 'functions.php';
require 'admin/config.php';

if (isset($_SESSION['usuario'])) {
	header('login.php');
}
$errores = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];

	try {
	$conexion = conexion($bd_config);
	
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
	
}
//verifica la consulta y si el valor es el mismo
$statement = $conexion ->prepare('SELECT * FROM usuarios WHERE usuario =  :usuario AND pass = :password');
$statement -> execute(array(':usuario' => $usuario,
':password' => $password));

$resultado = $statement->fetch();
if ($resultado !== false) {
	$_SESSION['usuario'] = $usuario;
	header('Location: admin/index.php');
}else{
	$errores .= '<li>Datos Incorrectos</li>';
}

}

/*if ($_SERVER['REQUEST_METHOD']=='POST') {
	$usuario = limpiarDatos($_POST['usuario']);
	$password = limpiarDatos($_POST['password']);

	if ($usuario == $blog_admin['usuario'] && 
		$password == $blog_admin['password']) {
		$_SESION['admin'] = $blog_admin['usuario'];
		header('Location:' . RUTA. '/admin');
	}
}*/
require 'views/login.view.php';


 ?>