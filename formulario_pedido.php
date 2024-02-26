<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pedido</title>
</head>
<body>
    <h2>Registro de Pedido</h2>
    <form action="registrar_pedido.php" method="post">
        <label for="cliente_id">ID del Cliente:</label>
        <input type="text" id="cliente_id" name="cliente_id" required>
        <br><br>
        <label>Productos:</label><br>
        <input type="checkbox" name="productos[1][id]" value="1"> Producto 1 <input type="number" name="productos[1][cantidad]" value="1" min="1"><br>
        <input type="checkbox" name="productos[2][id]" value="2"> Producto 2 <input type="number" name="productos[2][cantidad]" value="1" min="1"><br>
        <!-- Agrega más productos según sea necesario -->
        <br>
        <button type="submit">Registrar Pedido</button>
    </form>
</body>
</html>
