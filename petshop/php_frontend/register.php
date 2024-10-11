<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado exitosamente";
        echo "<a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="submit" value="Registrar">
</form>
