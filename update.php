<?php
include 'db.php';

// Verificar que se pase el id
if (!isset($_GET['id'])) {
    header("Location: empleados.php");
    exit();
}

$id = intval($_GET['id']);

// Procesar la actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $correo = $conn->real_escape_string($_POST['correo']);

    $sql = "UPDATE empleados SET nombre='$nombre', cargo='$cargo', correo='$correo' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: empleados.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Obtener datos del empleado
$sql = "SELECT * FROM empleados WHERE id=$id";
$resultado = $conn->query($sql);
if ($resultado->num_rows == 0) {
    echo "Empleado no encontrado.";
    exit();
}
$empleado = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Empleado</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Editar Empleado</h2>
  <form method="POST" action="update.php?id=<?php echo $id; ?>">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="<?php echo $empleado['nombre']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="cargo" class="form-label">Cargo</label>
      <input type="text" name="cargo" class="form-control" value="<?php echo $empleado['cargo']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo</label>
      <input type="email" name="correo" class="form-control" value="<?php echo $empleado['correo']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="empleados.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
