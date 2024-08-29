<?php
header("Content-Type: application/json; charset=UTF-8");

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rsa";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados desde la aplicación
$input = json_decode(file_get_contents("php://input"), true);
$periodo = $input['Periodo'];
$fecha = $input['Fecha'];

// Construir la consulta SQL basada en el período
switch ($periodo) {
    case 'Día':
        $sql = "SELECT * FROM consulta WHERE fecha = '$fecha' AND publicar = 'si'";
        break;
    case 'Mes':
        $sql = "SELECT * FROM consulta WHERE MONTH(fecha) = MONTH('$fecha') AND YEAR(fecha) = YEAR('$fecha') AND publicar = 'si'";
        break;
    case 'Año':
        $sql = "SELECT * FROM consulta WHERE YEAR(fecha) = YEAR('$fecha') AND publicar = 'si'";
        break;
    default:
        $sql = "SELECT * FROM consulta WHERE publicar = 'si'";
        break;
}

// Ejecutar la consulta y obtener los resultados
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $noticias = array();
    while ($row = $result->fetch_assoc()) {
        $noticias[] = $row;
    }
    echo json_encode($noticias);
} else {
    echo json_encode([]);
}

$conn->close();
?>
