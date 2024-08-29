<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "rsa"; 

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Conexión fallida: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM Clientes WHERE ClienteID = $id";
        } else {
            $sql = "SELECT * FROM Clientes";
        }
        $result = $conn->query($sql);
        if ($result === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conn->error]);
        } else {
            $clientes = [];
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
            echo json_encode($clientes);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['Nombre'], $data['Apellido'], $data['Telefono'], $data['CorreoElectronico'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            break;
        }
        $nombre = $conn->real_escape_string($data['Nombre']);
        $apellido = $conn->real_escape_string($data['Apellido']);
        $telefono = $conn->real_escape_string($data['Telefono']);
        $correoElectronico = $conn->real_escape_string($data['CorreoElectronico']);
        $sql = "INSERT INTO Clientes (Nombre, Apellido, Telefono, CorreoElectronico) VALUES ('$nombre', '$apellido', '$telefono', '$correoElectronico')";
        if ($conn->query($sql) === false) {
            echo json_encode(['success' => false, 'message' => 'Error en la inserción: ' . $conn->error]);
        } else {
            echo json_encode(['success' => true]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['ClienteID'], $data['Nombre'], $data['Apellido'], $data['Telefono'], $data['CorreoElectronico'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            break;
        }
        $id = intval($data['ClienteID']);
        $nombre = $conn->real_escape_string($data['Nombre']);
        $apellido = $conn->real_escape_string($data['Apellido']);
        $telefono = $conn->real_escape_string($data['Telefono']);
        $correoElectronico = $conn->real_escape_string($data['CorreoElectronico']);
        $sql = "UPDATE Clientes SET Nombre='$nombre', Apellido='$apellido', Telefono='$telefono', CorreoElectronico='$correoElectronico' WHERE ClienteID=$id";
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

        // Verifica si el cliente existe antes de intentar eliminarlo
        $checkSql = "SELECT * FROM Clientes WHERE ClienteID = $id";
        $checkResult = $conn->query($checkSql);
        if ($checkResult->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'Cliente no encontrado']);
            break;
        }

        $sql = "DELETE FROM Clientes WHERE ClienteID = $id";
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
