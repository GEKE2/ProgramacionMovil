<?php
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Login successful"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
?>
