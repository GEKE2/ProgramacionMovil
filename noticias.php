<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Noticia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header style="background-color: #ff7ea8;" class="text-white text-center py-3">
        <h1>Noticias</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="acerca.php">Acerca de</a></li>
            <li class="nav-item"><a class="nav-link" href="catalogos.php">Catálogos</a></li>
            <li class="nav-item"><a class="nav-link" href="tramites.php">Trámites</a></li>
            <li class="nav-item"><a class="nav-link" href="servicios.php">Servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="admin.php">Administrar Noticias</a></li> <!-- Enlace a la página de administración -->
        </ul>
    </div>
</nav>

    </header>

    <div class="container mt-4">
        <?php
        include 'php/db.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM noticia WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<h2>' . $row["titulo"] . '</h2>';
            echo '<p>' . $row["contenido"] . '</p>';
            echo '<p><small>Publicado el ' . $row["fecha"] . '</small></p>';
        } else {
            echo '<p>Noticia no encontrada.</p>';
        }

        $conn->close();
        ?>
    </div>

    <footer style="background-color: #ff7ea8;" class="text-white text-center py-3 mt-4">
        <p>&copy; 2024 Noticias</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
