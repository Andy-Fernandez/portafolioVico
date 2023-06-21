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

// Verificar si se enviaron datos para cargar en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["datos"])) {
        // Obtener los datos ingresados por el usuario
        $datos = $_POST["datos"];

        // Separar las sentencias SQL en un arreglo
        $sentencias = explode(";", $datos);

        // Iniciar una transacción
        $conn->begin_transaction();

        try {
            // Ejecutar cada sentencia SQL en la transacción
            foreach ($sentencias as $sentencia) {
                // Ejecutar la sentencia SQL
                if (!empty(trim($sentencia))) {
                    $conn->query($sentencia);
                }
            }

            // Confirmar la transacción
            $conn->commit();

            echo "Datos cargados exitosamente.";
        } catch (Exception $e) {
            // Revertir la transacción si hay un error
            $conn->rollback();

            echo "Error al cargar los datos: " . $e->getMessage();
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
