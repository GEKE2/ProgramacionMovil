<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Noticias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body>
    <header style="background-color: #ff7ea8;" class="text-center py-3">
        <h1>Administrar Noticias</h1>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="acerca.php">Acerca de</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalogos.php">Catálogos</a></li>
                    <li class="nav-item"><a class="nav-link" href="tramites.php">Trámites</a></li>
                    <li class="nav-item"><a class="nav-link" href="servicios.php">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin.php">Administrar Noticias</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h2>Agregar Nueva Noticia</h2>
        <form action="php/insert.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <textarea class="form-control" id="fecha" name="fecha" rows="5" required></textarea>
                <input clas="form-control" type="date" id="fecha"  name="fecha"  rows="5" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <textarea class="form-control" id="autor" name="autor" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Noticia</button>
        </form>
    </div>

    <footer style="background-color: #ff7ea8;" class="text-center py-3 mt-4">
        <p>&copy; 2024 Noticias</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
