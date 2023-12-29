<?php
function authenticateUser($username, $password) {
    global $conn;
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $password = md5($password); // Asegúrate de utilizar un método más seguro en un entorno de producción

    $query = "SELECT id, nombre FROM Usuarios WHERE nombre='$username' AND contraseña='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        return $user;
    } else {
        return false;
    }
}
?>
