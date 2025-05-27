<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM empleados WHERE id=$id";
    $conn->query($sql);
}
header("Location: empleados.php");
exit();
?>
