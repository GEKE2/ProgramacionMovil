<?php
header("Content-Type: application/json; charset=UTF-8");

include 'db.php';

$sql = "SELECT * FROM noticias";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo json_encode(array("mensaje" => "No se encontraron datos"));
    exit();
}

echo json_encode($data);

$conn->close();
?>
