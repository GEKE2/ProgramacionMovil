<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rsa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Conexión fallida: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM Servicios WHERE ServicioID = $id";
        } else {
            $sql = "SELECT * FROM Servicios";
        }
        $result = $conn->query($sql);
        if ($result === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conn->error]);
        } else {
            $servicios = [];
            while ($row = $result->fetch_assoc()) {
                $servicios[] = $row;
            }
            echo json_encode($servicios);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['Nombre'], $data['Descripcion'], $data['Precio'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            break;
        }
        $nombre = $conn->real_escape_string($data['Nombre']);
        $descripcion = $conn->real_escape_string($data['Descripcion']);
        $precio = floatval($data['Precio']);
        $sql = "INSERT INTO Servicios (Nombre, Descripcion, Precio) VALUES ('$nombre', '$descripcion', $precio)";
        if ($conn->query($sql) === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la inserción: ' . $conn->error]);
        } else {
            echo json_encode(['success' => true]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['ServicioID'], $data['Nombre'], $data['Descripcion'], $data['Precio'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            break;
        }
        $id = intval($data['ServicioID']);
        $nombre = $conn->real_escape_string($data['Nombre']);
        $descripcion = $conn->real_escape_string($data['Descripcion']);
        $precio = floatval($data['Precio']);
        $sql = "UPDATE Servicios SET Nombre='$nombre', Descripcion='$descripcion', Precio=$precio WHERE ServicioID=$id";
        if ($conn->query($sql) === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la actualización: ' . $conn->error]);
        } else {
            echo json_encode(['success' => true]);
        }
        break;

    case 'DELETE':
        if (!isset($_GET['id'])) {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
            break;
        }
        $id = intval($_GET['id']);

        // Verifica si el servicio existe antes de intentar eliminarlo
        $checkSql = "SELECT * FROM Servicios WHERE ServicioID = $id";
        $checkResult = $conn->query($checkSql);
        if ($checkResult->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'Servicio no encontrado']);
            break;
        }

        $sql = "DELETE FROM Servicios WHERE ServicioID = $id";
        if ($conn->query($sql) === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la eliminación: ' . $conn->error]);
        } else {
            echo json_encode(['success' => true]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Método no soportado']);
        break;
}

$conn->close();
?>
