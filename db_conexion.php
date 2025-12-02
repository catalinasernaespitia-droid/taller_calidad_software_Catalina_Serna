<?php
// db_conexion.php (EN LA RAÍZ)

define("DB_SERVER", "localhost");
define("DB_USER", "root"); 
define("DB_PASS", ""); 
define("DB_NAME", "ferreteria_bd");

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Fallo la conexión a la base de datos: " . $conn->connect_error);
}

$conn->set_charset("utf8");

function close_db_connection($conn) {
    if ($conn instanceof mysqli && $conn->ping()) {
        $conn->close();
    }
}
?>