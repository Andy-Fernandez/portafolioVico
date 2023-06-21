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

// Verificar si se enviaron datos para eliminar registros
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tabla"]) && isset($_POST["id"])) {
        // Obtener la tabla y el ID del registro a eliminar
        $tabla = $_POST["tabla"];
        $id = $_POST["id"];

        // Construir la sentencia SQL para eliminar el registro
        $sql = "DELETE FROM " . $tabla . " WHERE id = " . $id;

        // Ejecutar la sentencia SQL
        if ($conn->query($sql) === TRUE) {
            echo "Registro eliminado exitosamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
