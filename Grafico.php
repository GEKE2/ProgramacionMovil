<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - Nails RS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header style="background-color: #ff7ea8;" class="text-white text-center py-3">
        <h1>Estadísticas - Nails RS</h1>
    </header>

    <div class="container mt-5">
        <h1 class="text-center">Uso de Uñas Postizas y Gelish</h1>
        <p class="text-center">Descubre cuántas mujeres prefieren usar uñas postizas y gelish según nuestras encuestas recientes.</p>
        
        <div style="max-width: 600px; margin: 0 auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <footer style="background-color: #ffc1d3;" class="bg-light text-center text-lg-start mt-5">
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
    </footer>

    <footer style="background-color: #ff7ea8;" class="text-white text-center py-3 mt-4">
        <p>&copy;  2024 Nails RS. Todos los derechos reservados.</p>
    </footer>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Uñas Postizas', 'Gelish', 'Otro'],
                datasets: [{
                    label: 'Uso por Mujeres',
                    data: [70, 50, 30], // Aquí puedes ajustar los datos según tus estadísticas
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
