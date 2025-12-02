<?php
// logout.php (EN LA RAÍZ)
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
?>