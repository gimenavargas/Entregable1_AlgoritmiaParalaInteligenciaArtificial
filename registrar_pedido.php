<?php
// Conexión a la base de datos (asumiendo que ya tienes la conexión establecida)
// Reemplaza 'localhost', 'usuario', 'contraseña' y 'basededatos' con tus propios valores
$conexion = new mysqli('localhost', 'root', '', 'happy');

// Verificar si la conexión tiene errores
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $cliente_id = $_POST['cliente_id'];
    $productos = $_POST['productos']; // Array de productos seleccionados

    // Crear un nuevo registro de pedido
    $query_pedido = "INSERT INTO pedidos (cliente_id) VALUES ('$cliente_id')";
    if ($conexion->query($query_pedido) === TRUE) {
        // Obtener el ID del pedido recién creado
        $pedido_id = $conexion->insert_id;

        // Recorrer los productos seleccionados y guardar los detalles del pedido
        foreach ($productos as $producto) {
            $producto_id = $producto['id'];
            $cantidad = $producto['cantidad'];
            $query_detalle = "INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad) VALUES ('$pedido_id', '$producto_id', '$cantidad')";
            $conexion->query($query_detalle);
        }

        echo "El pedido se registró correctamente.";
    } else {
        echo "Error al registrar el pedido: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se ha enviado el formulario, redirigir al formulario de registro de pedidos
    header("Location: formulario_pedido.php");
    exit();
}
?>
