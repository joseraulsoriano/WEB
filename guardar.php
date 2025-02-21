<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    if (empty($nombre)) {
        $errors[] = "El nombre completo es requerido.";
    }

    if (empty($email)) {
        $errors[] = "El correo electrónico es requerido.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no es válido.";
    }

    if (empty($password)) {
        $errors[] = "La contraseña es requerida.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (empty($errors)) {
        $data = "Nombre: $nombre, Email: $email, Contraseña: $password\n";
        file_put_contents('usuarios.txt', $data, FILE_APPEND);
        header("Location: confirmacion.html");
        exit();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>