<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $clave  = $_POST['clave'];

    $sql = "SELECT id_usuario, nombre, apellido, contraseña, rol_id FROM Usuario WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($clave, $row['contraseña'])) {
       
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre']     = $row['nombre'];
            $_SESSION['rol']        = $row['rol_id'];

         
            if ($row['rol_id'] == '1') {
                header("Location: admin.php"); 
            } else {
                header("Location: cliente.php");
            }
            exit;
        } else {
            echo "Contraseña o datos incorrectos.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
