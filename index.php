<!DOCTYPE html>
<html>
<head>
    <title>Tabla con Comparación</title>
</head>
<body>
    <form action="index.php" method="post"> <!-- Añade un formulario -->
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tamaño ideal</th>
                <th>Tamaño de balanza</th>
                <th>Comparación</th>
            </tr>
            <tr>
                <td>1</td>
                <td>100</td>
                <td><input type="number" name="balanza1" id="balanza1" onchange="compararTamanos(1)" step="any" /></td>
                <td id="resultado1"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>50</td>
                <td><input type="number" name="balanza2" id="balanza2" onchange="compararTamanos(2)" step="any" /></td>
                <td id="resultado2"></td>
            </tr>
        </table>
        <input type="submit" value="Enviar" /> 
    </form>

    <script>
        function compararTamanos(id) {
            // Obtener los valores de Tamaño ideal y Tamaño de balanza
            var tamanoIdeal = parseFloat(document.querySelector(`tr:nth-child(${id + 1}) td:nth-child(2)`).textContent);
            var tamanoBalanza = parseFloat(document.getElementById(`balanza${id}`).value);

            // Definir el rango de tolerancia
            var rangoTolerancia = 0.10;

            // Realizar la comparación dentro del rango de tolerancia
            if (!isNaN(tamanoBalanza)) {
                if (Math.abs(tamanoBalanza - tamanoIdeal) <= rangoTolerancia) {
                    document.getElementById(`resultado${id}`).textContent = "🟩";
                } else if (tamanoBalanza > tamanoIdeal) {
                    document.getElementById(`resultado${id}`).textContent = "🟥";
                } else {
                    document.getElementById(`resultado${id}`).textContent = "⬜";
                }
            } else {
                document.getElementById(`resultado${id}`).textContent = "Ingresa un número válido";
            }
       }
    </script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $balanza1 = $_POST["balanza1"];
    $balanza2 = $_POST["balanza2"];

    echo "1er: {$balanza1} <br> 2do: {$balanza2}";
}
?>
