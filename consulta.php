<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banco";

// Realizar la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se enviaron datos para realizar una consulta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["consulta"])) {
        // Obtener la consulta ingresada por el usuario
        $consulta = $_POST["consulta"];

        // Ejecutar la consulta SQL
        $resultado = $conn->query($consulta);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Obtener los nombres de las columnas
            $nombresColumnas = $resultado->fetch_fields();

            // Crear un arreglo para almacenar los nombres de las columnas
            $nombresColumnasArray = array();

            // Obtener los nombres de las columnas y guardarlos en el arreglo
            foreach ($nombresColumnas as $columna) {
                $nombresColumnasArray[] = $columna->name;
            }

            // Obtener los resultados como un arreglo asociativo
            $resultados = $resultado->fetch_all(MYSQLI_ASSOC);

            // Imprimir la tabla de resultados
            echo "<h3>Resultados</h3>";
            echo "<table>";
            
            // Imprimir la fila de encabezados de la tabla
            echo "<tr>";
            foreach ($nombresColumnasArray as $nombreColumna) {
                echo "<th>" . $nombreColumna . "</th>";
            }
            echo "</tr>";
            
            // Imprimir las filas de datos de la tabla
            foreach ($resultados as $fila) {
                echo "<tr>";
                foreach ($fila as $valor) {
                    echo "<td>" . $valor . "</td>";
                }
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }

        // Liberar memoria del resultado
        $resultado->free_result();
    }
}

// Cerrar la conexión
$conn->close();
?>
