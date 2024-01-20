<?php
$errores = '';
$enviado=true;
// Comprobamos que el formulario haya sido enviado con las variables que hayamos puesto en index.view, deben llamarse igual!

$conexion = new mysqli('localhost', 'root', '', 'consulta');


if (isset($_POST['submit'])) {
	$Nombre = $_POST['Nombre'];
	$Pass = $_POST['Password'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Nombre = $_POST["Nombre"];
		$Apellido = $_POST['Apellido'];
    	$Email = $_POST['Email'];
        $Pass = $_POST["Password"];

        $sql = "SELECT * FROM Usuarios WHERE Nombre = '$Nombre'";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (!password_verify($Pass, $row['Contraseña'])){
                header("Location: https://es.wikipedia.org/wiki/Paulo_Dybala");
                exit();
        } else {
            echo "Credenciales incorrectas";
        }
        }
    }
}

?>


<!DOCTYPE html>
<!-- Página que ve el usuario -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio sesion</title>
		<link rel="stylesheet" href=estilosINICIO.css> <!--  link a los estilos css de todas las webs-->
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'> <!-- fuente de texto de google font -->
</head>
<body>
	<H1> INICIA SESION ANDA </H1> <!-- Titulo de la web -->
	<div class="wrap"> 
		<!-- contenedor --> 
	<form action=" " name="formulario" method="post"> <!-- Usamos el método post para recoger lo que seleccione el usuario en unas variables -->

<!-- Placeholder es lo que le aparece al usuario en la web, name es como se llama la variable que recogeremos con post y type el tipo de datos que introduce el usuario -->
		<!-- El nombre es un texto -->
		<input type="text" placeholder="Nombre:" name="Nombre" id="nombre">
		<br>
		<!-- El apellido es un texto -->
		<input type="text" placeholder="Apellido:" name="Apellido" id="apellido">
		<br>
		<!-- El password es un tipo password -->
		<input type="password" placeholder="Contraseña:" name="Password" id="pass">
		<br>
		<br>
		<!-- El email es tipo email -->
		<input type="email" placeholder="Correo:" name="Email" id="email">
		<br>
	

		<input type="submit" name="submit" class="btn primary" value="Send"> <!-- boton para enviar los datos -->
	</form>
	<!-- Poner imagen en la web -->
	<!--<img src="logo.jpg" alt="logo" alt="Logo" />-->
	</div>


</body>