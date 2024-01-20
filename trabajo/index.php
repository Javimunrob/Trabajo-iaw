<?php
$errores = '';
$enviado=true;
// Comprobamos que el formulario haya sido enviado con las variables que hayamos puesto en index.view, deben llamarse igual!
if (isset($_POST['submit'])) {
	$Nombre = $_POST['Nombre'];
	$Apellido = $_POST['Apellido'];
    $Email = $_POST['Email'];
	$Pass = $_POST['Password'];

   	if (!empty($Nombre)) { //podemos combrobar con el apellido también

		$Nombre = filter_var($Nombre, FILTER_SANITIZE_SPECIAL_CHARS);//limpia o verifica que es un texto
		//echo $Nombre;
		
	} else {
		$errores .= 'Por favor ingresa un nombre <br />';
		$enviado=false;
	}

	if (!empty($Email)) { //comprobamos que es un email válido y que lo ha enviado
		$Email = filter_var($Email, FILTER_SANITIZE_EMAIL);

		if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
			$errores .= 'Por favor ingresa un correo valido <br />';
			$enviado=false;
		} 

	} else {
		$errores .= 'Por favor ingresa un correo <br />';
		$enviado=false;
	}

	if($enviado==false){ //lanzamos los errores que hayan podido ocurrir
		echo "$errores";
	}

	else{ //si todo ok


	//conectamos con la base de datos que se llama 'prueba_datos'	
		$conexion = new mysqli('localhost', 'root', '', 'consulta');


			if ($conexion->connect_errno){
				die('Lo siento hubo un problema con el servidor');
			}
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$Nombre = $_POST["Nombre"];
					$Apellido = $_POST['Apellido'];
    				$Email = $_POST['Email'];
					$Pass = password_hash($_POST["Password"], PASSWORD_DEFAULT);
				}

				$sql = "INSERT INTO usuarios (Nombre, Password) VALUES ('$Nombre', '$Pass')";

				if ($conexion->query($sql) === TRUE) {
					header("Location: inicio.php");
					exit();
				} else {
					echo "Error: " .$sql . "<br>" . $conexion->error;
				}
	}
}
require 'index.view.php';
?>