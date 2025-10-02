<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre    = $_POST['nombre'];
    $apellido  = $_POST['apellido'];
    $correo    = $_POST['correo'];
    $dni       = $_POST['dni'];
    $clave     = $_POST['clave'];
    $direccion = $_POST['direccion'];
    $telefono  = $_POST['telefono'];

   
    $claveHash = password_hash($clave, PASSWORD_DEFAULT);

 
    $sql = "INSERT INTO Usuario (nombre, apellido, correo, dni, contraseña, direccion, telefono, rol_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, '2')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $apellido, $correo, $dni, $claveHash, $direccion, $telefono);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.html'>Inicia sesión</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
