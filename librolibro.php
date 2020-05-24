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

<!-- Para terminar con el libro de visitas, el ultimo fichero que necesitamos es librolibro.php, que sera el encargado de mostrarnos el contenido de los mensajes del libro que queremos visualizar.
Cada vez que pulsemos en un mensaje para visualizarlo, podremos ver su contenido. Para ello necesitaremos el siguiente fichero. -->
<html>
<head>
<title>Creación de un portal con PHP y MySQL</title>
</head>
<body bgcolor="#303030">
<body text= "#E5E5E5">
<font face = "tahoma">
<font size = "2">
<body link = "#E5E5E5" vlink="E0E0E0">
<p aling = "center">
<font size = "4">	
<u>Leyendo mensajes del libro de visitas</u>
</font></p>

<?php  
include '../conexion.php';

$conexion = mysqli_connect($host_db, $user_db, $pass_db, $db_name);

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

$id = $_GET['id'];

$consulta = mysqli_query($conexion, "SELECT * FROM libro1 WHERE id = '$id' ORDER BY fecha DESC");

	while ($row = mysqli_fetch_array($consulta)) {
    	$titulo = $row["titulo"];
    	$autor = $row["autor"];
    	$mensaje = $row["mensaje"];
    	$id = $row["id"];
    	$fecha = $row["fecha"];
    echo "<table><tr><td>TITULO: $titulo </td><tr";
	echo "<td>AUTOR: $autor </td><tr>";
	echo "<td>MENSAJE: $mensaje </td><tr></table>";
	echo "<center><font face=arial size=1>";
	echo "<br><br>";
	echo "<a href=indexlibro.php>Volver al libro de visitas</a></font></center>";

    }

?>