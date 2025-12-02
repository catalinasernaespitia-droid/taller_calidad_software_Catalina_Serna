<?php
$password = 'cata1234';
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
echo "Contraseña: " . $password . "<br>";
echo "Hash generado: " . $hashed_password . "<br>";
?>