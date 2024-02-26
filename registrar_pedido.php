<?php
// Conectar a la base de datos (reemplaza los valores con los de tu propia configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "happy";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$cliente_id = $_POST['cliente_id'];
$productos = $_POST['productos']; // Este sería un array con los IDs de los productos seleccionados

// Verificar si se ha enviado el formulario de registro de pedido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado al menos un producto
    if (!isset($_POST['productos']) || empty($_POST['productos'])) {
        echo "Error: Debe seleccionar al menos un producto.";
        exit;
    }
    
    // Verificar disponibilidad de productos en stock
    foreach ($_POST['productos'] as $producto_id => $cantidad) {
        // Obtener la cantidad en stock del producto
        $sql_stock = "SELECT stock FROM productos WHERE id = $producto_id";
        $result = $conn->query($sql_stock);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stock_disponible = $row["stock"];
            // Verificar si hay suficiente stock
            if ($cantidad > $stock_disponible) {
                echo "Error: No hay suficiente stock para el producto seleccionado.";
                exit;
            }
        } else {
            echo "Error: El producto seleccionado no existe.";
            exit;
        }
    }}

// Insertar el pedido en la tabla de pedidos
$sql_pedido = "INSERT INTO pedidos (cliente_id) VALUES ($cliente_id)";
if ($conn->query($sql_pedido) === TRUE) {
    $pedido_id = $conn->insert_id;

    // Insertar los detalles del pedido en la tabla detalles_pedido
    foreach ($productos as $producto_id => $cantidad) {
        $sql_detalles = "INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad) VALUES ($pedido_id, $producto_id, $cantidad)";
        $conn->query($sql_detalles);
    }

} else {
    echo "Error: Método de solicitud incorrecto.";
}
