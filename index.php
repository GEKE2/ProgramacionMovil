<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body>
    <header style="background-color: #ff7ea8;" class="text-center py-3 text-white">
        <h1>Noticias</h1>
        
    </header>

    <div class="container mt-4">
        <div class="row">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            include 'db.php';
            if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM noticia ORDER BY fechaPublicacion DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card">';
                    if ($row["imagen"]) {
                        echo '<img src="' . $row["imagen"] . '" class="card-img-top" alt="Imagen de la noticia">';
                    }
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["titulo"] . '</h5>';
                    echo '<p class="card-text">' . $row["contenido"] . '</p>';
                    echo '<p class="card-text">' . $row["fechaPublicacion"].'</p>';
                    echo '<p class="card-text">' . $row["autor"].'</p>';
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay noticias disponibles.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <footer style="background-color: #ff7ea8;" class="text-center py-3 mt-4 text-white">
        <p>&copy; 2024 Noticias</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
