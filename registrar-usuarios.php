<!--este es un comentario en html-->

<?php
//este es un comentario en php
	/*VARIABLES PARA LA CONEXION DE DATOS*/
	
$host_db = "localhost";
$user_db ="root";
$pass_db ="";
$db_name = "login";
$tbl_name ="usuarios";
//Encriptacion del pass a la DB
$form_pass = $_POST['password'];
$hash = password_hash($form_pass, PASSWORD_BCRYPT);
//Conectamos con la BD
$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
if ($conexion->connect_error){
die("La conecion falló:" . $conexion->connect_error);
}
//Buscar un usuario repetido
$buscarUsuario = "SELECT * FROM $tbl_name
WHERE nombre_usuario = '$_POST[username]'";

$result= $conexion->query($buscarUsuario);

$count = mysqli_num_rows($result);

if ($count == 1) {
 echo "<br />". "El Nombre de Usuario ya existe." . "<br />";
 echo "<a href='index.html'>Por favor escoga otro Nombre</a>";
	}
else {
 $query = "INSERT INTO usuarios (nombre_usuario, password)
 VALUES ('$_POST[username]', '$hash')";

 if ($conexion->query($query) === TRUE) {
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
echo "<h5>" . "Nuevo Login: " . "<a href='index.html'>Login</a>" . "</h5>"; 

 }
else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
}
 mysqli_close($conexion);
	
?>