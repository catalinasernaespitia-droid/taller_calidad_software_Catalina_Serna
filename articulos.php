<?php
include_once "db_conexion.php"; 
$conexion = $conn;

// Obtener acción
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Listar categorías
function obtenerCategorias($conexion) {
    $sql = "SELECT * FROM categorias";
    return $conexion->query($sql);
}

// =========================
// ========== INDEX ========
// =========================
if ($action == 'index') {

    $sql = "SELECT articulos.*, categorias.nombre AS categoria 
            FROM articulos 
            LEFT JOIN categorias ON articulos.categoria_id = categorias.id";

    $res = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Artículos</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Lista de Artículos</h2>
    <a href="articulos.php?action=crear">➕ Crear nuevo artículo</a>
    <br><br>
    <table border="1" cellpadding="7">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

        <?php while($row = $res->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['categoria'] ?></td>
                <td>$<?= number_format($row['precio'], 2) ?></td>
                <td>
                    <a href="articulos.php?action=visualizar&id=<?= $row['id'] ?>">Ver</a> |
                    <a href="articulos.php?action=editar&id=<?= $row['id'] ?>">Editar</a> |
                    <a href="articulos.php?action=borrar&id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar este artículo?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>
</html>
<?php 
exit();
}



// =============================
// ======== CREAR ==============
// =============================
if ($action == 'crear') {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $categoria_id = $_POST["categoria_id"];

        $sql = "INSERT INTO articulos(nombre, descripcion, precio, categoria_id)
                VALUES ('$nombre', '$descripcion', '$precio', '$categoria_id')";

        if ($conexion->query($sql)) {
            header("Location: articulos.php?action=index&msg=creado");
            exit();
        } else {
            echo "Error: " . $conexion->error;
        }
    }

    $categorias = obtenerCategorias($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Artículo</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Crear Artículo</h2>

    <form method="POST">
        Nombre:<br>
        <input type="text" name="nombre" required><br><br>

        Descripción:<br>
        <textarea name="descripcion" required></textarea><br><br>

        Precio:<br>
        <input type="number" step="0.01" name="precio" required><br><br>

        Categoría:<br>
        <select name="categoria_id" required>
            <?php while ($c = $categorias->fetch_assoc()) { ?>
                <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
            <?php } ?>
        </select><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="articulos.php?action=index">Volver</a>

</body>
</html>
<?php 
exit();
}



// =============================
// ========= VISUALIZAR ========
// =============================
if ($action == 'visualizar') {

    if (!isset($_GET['id'])) { die("ID no enviado"); }

    $id = intval($_GET['id']);

    $sql = "SELECT articulos.*, categorias.nombre AS categoria 
            FROM articulos 
            LEFT JOIN categorias ON articulos.categoria_id = categorias.id
            WHERE articulos.id = $id";

    $res = $conexion->query($sql);
    $art = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Artículo</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Detalles del Artículo</h2>

    <b>Nombre:</b> <?= $art['nombre'] ?><br>
    <b>Descripción:</b> <?= $art['descripcion'] ?><br>
    <b>Precio:</b> $<?= $art['precio'] ?><br>
    <b>Categoría:</b> <?= $art['categoria'] ?><br><br>

    <a href="articulos.php?action=index">Volver</a>

</body>
</html>
<?php 
exit();
}



// =============================
// ========= EDITAR ============
// =============================
if ($action == 'editar') {

    if (!isset($_GET['id'])) { die("ID no enviado"); }
    $id = intval($_GET['id']);

    $res = $conexion->query("SELECT * FROM articulos WHERE id = $id");
    $art = $res->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $categoria_id = $_POST["categoria_id"];

        $sql = "UPDATE articulos SET
                nombre='$nombre',
                descripcion='$descripcion',
                precio='$precio',
                categoria_id='$categoria_id'
                WHERE id = $id";

        if ($conexion->query($sql)) {
            header("Location: articulos.php?action=index&msg=editado");
            exit();
        } else {
            echo "Error al actualizar: " . $conexion->error;
        }
    }

    $categorias = obtenerCategorias($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Artículo</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h2>Editar Artículo</h2>

    <form method="POST">

        Nombre:<br>
        <input type="text" name="nombre" value="<?= $art['nombre'] ?>" required><br><br>

        Descripción:<br>
        <textarea name="descripcion" required><?= $art['descripcion'] ?></textarea><br><br>

        Precio:<br>
        <input type="number" step="0.01" name="precio" value="<?= $art['precio'] ?>" required><br><br>

        Categoría:<br>
        <select name="categoria_id" required>
            <?php while ($c = $categorias->fetch_assoc()) { ?>
                <option value="<?= $c['id'] ?>" <?= $c['id'] == $art['categoria_id'] ? 'selected' : '' ?>>
                    <?= $c['nombre'] ?>
                </option>
            <?php } ?>
        </select><br><br>

        <button type="submit">Actualizar</button>

    </form>

    <br>
    <a href="articulos.php?action=index">Volver</a>

</body>
</html>
<?php 
exit();
}



// =============================
// ========= BORRAR ============
// =============================
if ($action == 'borrar') {

    if (!isset($_GET['id'])) { die("ID no enviado"); }
    $id = intval($_GET['id']);

    $sql = "DELETE FROM articulos WHERE id = $id";

    if ($conexion->query($sql)) {
        header("Location: articulos.php?action=index&msg=eliminado");
        exit();
    } else {
        echo "Error: " . $conexion->error;
    }
}

?>
