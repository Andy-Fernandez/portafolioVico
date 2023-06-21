<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtener los datos del formulario
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "contactame";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
  }

  // Insertar los datos en la tabla
  $sql = "INSERT INTO formulario_contacto (nombre, correo, mensaje) VALUES ('$name', '$email', '$message')";

  if ($conn->query($sql) === TRUE) {
    echo "¡Gracias por contactarnos! Tu mensaje ha sido enviado.";
    echo '<br><br><a href="index.html">Volver a la página de inicio</a>';
  } else {
    echo "Ha ocurrido un error al enviar el mensaje. Por favor, inténtalo nuevamente.";
    echo '<br><br><a href="index.html">Volver a la página de inicio</a>';
  }

  $conn->close();
}
?>
