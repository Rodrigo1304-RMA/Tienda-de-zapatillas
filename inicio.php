<?php

$conexion = mysqli_connect("localhost", "root", "", "calzado");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


$sql = "SELECT nombre, precio, imagen FROM productos WHERE destacado = 1 LIMIT 4";
$resultado = mysqli_query($conexion, $sql);

echo '<section class="productos-destacados">';


if (mysqli_num_rows($resultado) > 0) {
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo '<div class="producto-card">';
        echo '<img src="imagenes/' . $fila["imagen"] . '" alt="' . $fila["nombre"] . '">';
        echo '<h3>' . $fila["nombre"] . '</h3>';
        echo '<p>Precio: $' . $fila["precio"] . '</p>';
        echo '<a href="producto.php?id=' . $fila["id"] . '" class="btn-ver">Ver Detalle</a>';
        echo '</div>';
    }
} else {
    echo "<p>No hay productos destacados por el momento.</p>";
}

echo '</section>';


mysqli_close($conexion);
?>
