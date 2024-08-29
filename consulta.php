<?php
// Incluir el archivo de conexión a la base de datos
include('db.php');

// Configurar el tipo de contenido a JSON
header('Content-Type: application/json');

// Verificar si la conexión se estableció correctamente
if ($conn->connect_error) {
    echo json_encode(array('error' => 'Error de conexión: ' . $conn->connect_error));
    exit();
}

// Establecer configuración de localización
setlocale(LC_TIME, "es_MX.UTF-8");
setlocale(LC_TIME, "spanish");

// Clase para estructurar los datos de entrada
class CFecha {
    public $dia;
    public $mes;
    public $anio;
}

// Leer y decodificar la entrada JSON
$data = file_get_contents("php://input");
$entrada = json_decode($data);

// Verificar si $entrada es null o vacío y manejarlo adecuadamente
if (empty($entrada) || !isset($entrada->dia) || !isset($entrada->mes) || !isset($entrada->anio)) {
    $entrada = new CFecha();
    $entrada->dia = 0; // Valor por defecto para día (todos los días)
    $entrada->mes = date('m'); // Mes actual como valor por defecto
    $entrada->anio = date('Y'); // Año actual como valor por defecto
}

// Construir la consulta SQL basada en los parámetros de entrada
$sql = "SELECT id, titulo, contenido, DATE_FORMAT(fecha, '%d - %b - %Y') AS fecha, 
               tipoNoticia, publicar 
        FROM consulta 
        WHERE publicar='si' AND 
              (tipoNoticia='uñas acrílicas' OR tipoNoticia='gelish')";

// Añadir condiciones de fecha si se proporciona un día específico
if ($entrada->dia != 0) {
    $sql .= " AND DAY(fecha)=" . $entrada->dia . " AND 
              MONTH(fecha)=" . $entrada->mes . " AND 
              YEAR(fecha)=" . $entrada->anio;
} else {
    $sql .= " AND MONTH(fecha)=" . $entrada->mes . " AND 
              YEAR(fecha)=" . $entrada->anio;
}

$sql .= " ORDER BY fecha DESC";

$resultado = array();

// Ejecutar consulta
$datos = $conn->query($sql);

if ($datos) {
    if ($datos->num_rows > 0) {
        while ($reg = $datos->fetch_assoc()) {
            $titulo = mb_strtoupper($reg['titulo'], 'UTF-8');
            $contenido = nl2br(htmlspecialchars($reg["contenido"]));
            $fecha = htmlspecialchars($reg["fecha"]);

            $item = array(
                'titulo' => $titulo,
                'contenido' => $contenido,
                'fecha' => $fecha
            );

            $resultado[] = $item;
        }
    } else {
        $resultado[] = array(
            'error' => 'No se encontraron noticias.'
        );
    }
} else {
    $resultado[] = array(
        'error' => 'Error de SQL: ' . $conn->error
    );
}

// Devolver resultado en formato JSON
echo json_encode($resultado);

// Liberar resultados y cerrar conexión
$datos->free();
$conn->close();
?>
