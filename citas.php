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
            $sql = "SELECT * FROM Citas WHERE CitaID = $id";
        } else {
            $sql = "SELECT * FROM Citas";
        }
        $result = $conn->query($sql);
        $citas = [];
        while ($row = $result->fetch_assoc()) {
            $citas[] = $row;
        }
        echo json_encode(['data' => $citas]);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $clienteID = $conn->real_escape_string($data['ClienteID']);
        $empleadoID = $conn->real_escape_string($data['EmpleadoID']);
        $servicioID = $conn->real_escape_string($data['ServicioID']);
        $fechaHora = $conn->real_escape_string($data['FechaHora']);
        $estado = $conn->real_escape_string($data['Estado']);
        $sql = "INSERT INTO Citas (ClienteID, EmpleadoID, ServicioID, FechaHora, Estado) VALUES ('$clienteID', '$empleadoID', '$servicioID', '$fechaHora', '$estado')";
        echo json_encode(['success' => $conn->query($sql)]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $citaID = intval($data['CitaID']);
        $clienteID = $conn->real_escape_string($data['ClienteID']);
        $empleadoID = $conn->real_escape_string($data['EmpleadoID']);
        $servicioID = $conn->real_escape_string($data['ServicioID']);
        $fechaHora = $conn->real_escape_string($data['FechaHora']);
        $estado = $conn->real_escape_string($data['Estado']);
        $sql = "UPDATE Citas SET ClienteID='$clienteID', EmpleadoID='$empleadoID', ServicioID='$servicioID', FechaHora='$fechaHora', Estado='$estado' WHERE CitaID=$citaID";
        echo json_encode(['success' => $conn->query($sql)]);
        break;

    case 'DELETE':
        // Verifica si se está eliminando por cliente o servicio
        if (isset($_GET['clienteId'])) {
            // Elimina todas las citas asociadas a un cliente
            $clienteId = intval($_GET['clienteId']);
            $sql = "DELETE FROM Citas WHERE ClienteID = $clienteId";
        } elseif (isset($_GET['servicioId'])) {
            // Elimina todas las citas asociadas a un servicio
            $servicioId = intval($_GET['servicioId']);
            $sql = "DELETE FROM Citas WHERE ServicioID = $servicioId";
        } else {
            // Elimina una cita específica
            $id = intval($_GET['id']);
            $sql = "DELETE FROM Citas WHERE CitaID = $id";
        }

        $success = $conn->query($sql);
        echo json_encode(['success' => $success]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Método no soportado']);
        break;
}

$conn->close();
?>
