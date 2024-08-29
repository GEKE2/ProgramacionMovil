<?php
include ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $contenido = $conn->real_escape_string($_POST['contenido']);
    $fecha = date("Y-m-d");
    $autor = $conn->real_escape_string($_POST['autor']);

    // Manejar la subida de la imagen
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $publicado = $conn->real_escape_string($_POST['publicado']);

    // Comprobar si el archivo es una imagen real
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen = "uploads/" . basename($_FILES["imagen"]["name"]);

            $sql = "INSERT INTO noticia (titulo, contenido, fecha, imagen) VALUES ('$titulo', '$contenido', '$fecha', '$imagen')";

            if ($conn->query($sql) === TRUE) {
                echo "Nueva noticia insertada correctamente. <a href='../admin.php'>Volver</a>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    } else {
        echo "El archivo no es una imagen.";
    }

    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
