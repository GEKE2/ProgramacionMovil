<?php
$servername = "localhost";
$username = "root"; // Por defecto, el usuario de MySQL es 'root'
$password = ""; // Por defecto, la contraseña de MySQL es vacía
$dbname = "rsa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT title, description, price, image FROM services";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header style="background-color: #ff7ea8;" class="text-white text-center py-3">
        <h1>Nuestros Precios</h1>
    </header>

    <div class="container mt-4">
        <h4 class="text-center">Descubre nuestros servicios y precios. Calidad y elegancia al alcance de tu mano.</h4>
        
        <div class="row">
            <?php
            include 'db.php';
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '    <div class="card mb-4">';
                    echo '        <img src="' . $row["image"] . '" class="card-img-top" height="275" alt="' . $row["title"] . '">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . $row["title"] . '</h5>';
                    echo '            <p class="card-text">' . $row["description"] . '</p>';
                    echo '            <h3>$' . $row["price"] . '</h3>';
                    echo '            <a href="#" class="btn btn-primary">Reservar Ahora</a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <footer style="background-color: #ffc1d3;" class="text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Nails RS</h5>
                    <p>Tu destino de confianza para el cuidado y belleza de tus uñas. Visítanos y descubre nuestros servicios exclusivos.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Enlaces Útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-dark">Inicio</a></li>
                        <li><a href="#" class="text-dark">Servicios</a></li>
                        <li><a href="#" class="text-dark">Precios</a></li>
                        <li><a href="#" class="text-dark">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-dark">Email: info@nailsrs.com</a></li>
                        <li><a href="#" class="text-dark">Teléfono: 5546891233</a></li>
                        <li><a href="#" class="text-dark">Dirección: UPVM,Edo Mex</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>

    <footer style="background-color: #ff7ea8;" class="text-white text-center py-3 mt-4">
        <p>&copy; 2024 Nails RS. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>