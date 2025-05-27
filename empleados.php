<?php
include 'db.php';

// Procesar el envío del formulario para agregar empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $correo = $conn->real_escape_string($_POST['correo']);

    $sql = "INSERT INTO empleados (nombre, cargo, correo) VALUES ('$nombre', '$cargo', '$correo')";
    if ($conn->query($sql) === TRUE) {
        header("Location: empleados.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Obtener lista de empleados
$sql = "SELECT * FROM empleados";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Empleados</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <link href="styles.css" rel="stylesheet">
  <!-- Fuente personalizada -->
   
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body style="background-color: #e91e63"> <!-- Fondo rosa claro -->

<div class="container py-5">
  <!-- Título principal -->
  <h2 class="mb-4 text-center text-uppercase text-pink">Gestión de Empleados</h2>
  <a href="index.html" class="btn btn-secondary mb-4">Volver al Inicio</a>

  <!-- Formulario para agregar empleado -->
  <div class="card shadow mb-4">
    <div class="card-header bg-pink text-white">Agregar Empleado</div>
    <div class="card-body">
      <form method="POST" action="empleados.php">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control border-pink" required>
        </div>
        <div class="mb-3">
          <label for="cargo" class="form-label">Cargo</label>
          <input type="text" name="cargo" class="form-control border-pink" required>
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" name="correo" class="form-control border-pink" required>
        </div>
        <button type="submit" name="agregar" class="btn btn-pink">Agregar</button>
      </form>
    </div>
  </div>

  <!-- Tabla de empleados -->
  <table class="table table-hover shadow">
    <thead class="bg-pink text-white">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cargo</th>
        <th>Correo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($resultado->num_rows > 0): ?>
      <?php while($fila = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?php echo $fila['id']; ?></td>
          <td><?php echo $fila['nombre']; ?></td>
          <td><?php echo $fila['cargo']; ?></td>
          <td><?php echo $fila['correo']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro de eliminar este registro?');">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
        <tr>
          <td colspan="5" class="text-center">No se encontraron empleados.</td>
        </tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
