<?php
session_start();
include('db.php');
class Usuarios {
    public $Email;
    public $Contrasena;
    public $Respuesta;
}
// FORMATO TEXTO DE VARIABLE Y VALOR
$objetoJson = new Usuarios();
$data = file_get_contents("php://input");
// Parseo de datos
$entrada = json_decode($data, false);

if (!isset($entrada->Email) || !isset($entrada->Contrasena)) {
    $objetoJson->Respuesta = "Error";
    echo json_encode($objetoJson);
    exit();
}
$Email = mysqli_real_escape_string($conn, $entrada->Email);
$Contrasena = mysqli_real_escape_string($conn, $entrada->Contrasena);
$sql = "SELECT * FROM usuarios WHERE Correo='$Email' AND Contrasena='$Contrasena'";
$datos = mysqli_query($conn, $sql) or die("Error de SQL");

if (mysqli_num_rows($datos) == 0) {
    $fila = mysqli_fetch_assoc($datos);
    $objetoJson->Nombre = $fila['correo'];
    $objetoJson->Respuesta = "OK";
    echo json_encode($objetoJson);
}else {
    $objetoJson->Respuesta = "Error";
    echo json_encode($objetoJson);
}

mysqli_free_result($datos);
mysqli_close($conn);
?>