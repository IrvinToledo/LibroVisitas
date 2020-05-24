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


<!-- Necesitaremos crear una nueva tabla en la base de datos ya existente llamada libro1.Para crear esa tabla seguiremos los mismos pasos que en el ejemplo del foro, solo cambian los nombres y que no debemos crear el campo respuestas ni el campo identificador o podemos crear una copia de la tabla ya existente con la siguiente consulta mysql CREATE TABLE tabla_nueva LIKE tabla_original; en este caso seria CREATE TABLE libro1 LIKE foro1;.

El primer fichero que crearemos se llamara indexlibro.php. Sera la pagina principal del libro de visitas y en ella veremos todos los mensajes ordenados segun su antiguedad y con la fecha de creacion

Al igual que en el foro, junto al tiotulo de cada mensaje pondremos un enlace con la palabra "Ver" donde podremos pulsar para leer el mensaje del libro de visitas que haya puesto el visitante. -->
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
<u>Libro de visitas</u>
</font></p>

<!-- Inicia la creacion de una tabla para organizar la informacion-->
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
	<!-- <br><br> Dos saltos de linea y <tr> una fila en la tabla   -->
	<br><br><tr>
	<!-- Define una celda de la tabla <td> -->
	<td width='5%'>
	</td>
	<td widtg='55%'>
	<b>TITULO</b>
	</td>
	<td width='40%'>
	<b>FECHA</b>
	</td>

</tr>
</table>

<?php  
include '../conexion.php';

$enlace = mysqli_connect($host_db, $user_db, $pass_db, $db_name);

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
$consulta = mysqli_query($enlace, "SELECT * FROM libro1 ORDER BY fecha DESC");

    /* obtener el array asociativo */
    echo "<hr size = 10 color = ffffff width = 100% aling = left>";
	while ($row = mysqli_fetch_array($consulta)) {
    	$titulo = $row["titulo"];
    	$id = $row["id"];
    	$titulo = $row["titulo"];
    	$fecha = $row["fecha"];
    echo ("<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n");
	echo ("<tr>\n");
	echo ("<td width='5%'><a href=librolibro.php?id=$id>Ver</a></td>\n");
	echo("<td width='55%'>$titulo</a></td>\n");
	echo("<td width='40%'>".date("d-m-y",$fecha)."</td>\n");
	echo ("</tr>\n");
	echo ("</table>\n");
	echo '<hr size=2 color = ffffff width=100% align=left>';
    }

?>
<font face='arial' size='1'>
<a href='formulariolibro.php'>Añadir mensaje
</a></font>
