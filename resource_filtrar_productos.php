<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Buscador de Productos</h1>

    <!-- Campo de búsqueda -->
    <input type="text" id="buscar" placeholder="Buscar productos por nombre">
    <button id="btn-buscar">Buscar</button>

    <!-- Resultados -->
    <div id="resultados">
        <p>Escribe en el buscador para encontrar productos.</p>
    </div>

    <script>
        $(document).ready(function () {
            // Manejo del botón de buscar
            $('#btn-buscar').on('click', function () {
                var nombre = $('#buscar').val();

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '?action=buscar-productos',
                    method: 'GET',
                    data: { nombre: nombre },
                    success: function (response) {
                        // Mostrar los resultados en el div
                        $('#resultados').html(response);
                    },
                    error: function () {
                        $('#resultados').html('<p>Hubo un error al realizar la búsqueda.</p>');
                    }
                });
            });

            // Buscar mientras se escribe
            $('#buscar').on('keyup', function () {
                var nombre = $(this).val();

                // Realizar la solicitud AJAX
                $.ajax({
                    url: 'index.php?action=buscar-productos',
                    method: 'GET',
                    data: { nombre: nombre },
                    success: function (response) {
                        $('#resultados').html(response);
                    },
                    error: function () {
                        $('#resultados').html('<p>Hubo un error al realizar la búsqueda.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>