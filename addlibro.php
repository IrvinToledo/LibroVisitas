<!-- SEGURIDAD EN LA SESION DE LA PAGINA -->
<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Inicia Sesion para acceder a este contenido.<br>";
   echo "<br><a href='login.html'>Login</a>";
   echo "<br><br><a href='index.html'>Registrarme</a>";
   header('Location: http://localhost/logincbtis/login.html');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion


exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();
header('Location: http://localhost/logincbtis/login.html');//redirige a la página de login, modifica la url a tu conveniencia
echo "Tu sesion a expirado,
<a href='login.html'>Inicia Sesion</a>";
exit;
}
?>

<!-- El siguiente fichero de obligada creacion es addlibro.php. Sera el encargado de procesar el mensaje para que lo insertemos en la base de datos y que quede almacenado para poder visualizarlo con el resto. -->
<html>
<head>
<title>Creación de un portal con PHP y MySQL</title>
</head>
<body bgcolor="#303030">
<body text= "#E5E5E5">
<font face = "tahoma">
<font size = "2">
<body link = "#E5E5E5" vlink="E0E0E0">

<?php  
$fecha = time();
$mensaje = $_GET['mensaje'];
$titulo = $_GET['titulo'];
$autor = $_GET['autor'];

include '../conexion.php';

$conexion = mysqli_connect($host_db, $user_db, $pass_db, $db_name);

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

$insercion = mysqli_query($conexion, "INSERT INTO libro1 (autor,titulo,mensaje,fecha) VALUES ('$autor','$titulo','$mensaje','$fecha')");

echo 'REGISTRO INSERTADO CORRECTAMENTE';
echo "<br>";

$consulta = mysqli_query($conexion, "SELECT '$mensaje' FROM libro1 WHERE mensaje='$mensaje'");

while ($registro = mysqli_fetch_row($consulta))
{
echo '<tr>';
	foreach ($registro as $clave)
	{
		echo '<td>',$clave,'</td>';
	}

}
echo "<br>";
echo "<br>";
echo "<a href=indexlibro.php> Volver a la pagina principal</a></font></center>";
?>