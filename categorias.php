<?php
include 'db_conexion.php';
$conexion = $conn;

$action = isset($_GET['action']) ? $_GET['action'] : 'index';


// INDEX
if ($action == 'index') {

    $sql = "SELECT * FROM categorias";
    $res = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Lista de Categorías</h2>
    <a href="categorias.php?action=crear">➕ Crear Nueva Categoría</a>
    <br><br>

    <table border="1" cellpadding="7">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php while($row = $res->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td>
                    <a href="categorias.php?action=visualizar&id=<?= $row['id'] ?>">Ver</a> |
                    <a href="categorias.php?action=editar&id=<?= $row['id'] ?>">Editar</a> |
                    <a href="categorias.php?action=borrar&id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>
</html>
<?php
exit();
}



// CREAR
if ($action == 'crear') {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];

        $sql = "INSERT INTO categorias(nombre) VALUES ('$nombre')";

        if ($conexion->query($sql)) {
            header("Location: categorias.php?action=index&msg=creado");
            exit();
        } else {
            echo "Error: " . $conexion->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Categoría</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Crear Categoría</h2>

    <form method="POST">
        Nombre:<br>
        <input type="text" name="nombre" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="categorias.php?action=index">Volver</a>

</body>
</html>
<?php
exit();
}



// VISUALIZAR
if ($action == 'visualizar') {

    if (!isset($_GET['id'])) { die("ID no enviado"); }

    $id = intval($_GET['id']);
    $res = $conexion->query("SELECT * FROM categorias WHERE id = $id");
    $cat = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de Categoría</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Detalles de Categoría</h2>

    <b>ID:</b> <?= $cat['id'] ?><br><br>
    <b>Nombre:</b> <?= $cat['nombre'] ?><br><br>

    <a href="categorias.php?action=index">Volver</a>

</body>
</html>
<?php
exit();
}



// EDITAR
if ($action == 'editar') {

    if (!isset($_GET['id'])) { die("ID no enviado"); }
    $id = intval($_GET['id']);

    $res = $conexion->query("SELECT * FROM categorias WHERE id = $id");
    $cat = $res->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];

        $sql = "UPDATE categorias SET nombre='$nombre' WHERE id = $id";

        if ($conexion->query($sql)) {
            header("Location: categorias.php?action=index&msg=editado");
            exit();
        } else {
            echo "Error: " . $conexion->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Editar Categoría</h2>

    <form method="POST">
        Nombre:<br>
        <input type="text" name="nombre" value="<?= $cat['nombre'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="categorias.php?action=index">Volver</a>

</body>
</html>
<?php
exit();
}



// BORRAR
if ($action == 'borrar') {

    if (!isset($_GET['id'])) { die("ID no enviado"); }
    $id = intval($_GET['id']);

    $sql = "DELETE FROM categorias WHERE id = $id";

    if ($conexion->query($sql)) {
        header("Location: categorias.php?action=index&msg=eliminado");
        exit();
    } else {
        echo "Error: " . $conexion->error;
    }
}

?>
