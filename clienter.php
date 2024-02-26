<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happy";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Consulta para verificar las credenciales
$sql = "SELECT * FROM clientes WHERE correo = '$correo' AND contrasena = '$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    echo "Inicio de sesión exitoso. ¡Bienvenido!";
    // Aquí podrías redirigir al usuario a otra página, por ejemplo:
    // header("Location: dashboard.php");
} else {
    // Credenciales incorrectas
    echo "Correo electrónico o contraseña incorrectos.";
}

$conn->close();
?>
