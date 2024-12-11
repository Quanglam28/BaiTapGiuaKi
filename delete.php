

<?php
include "connect.php";

$id = $_GET['id'];
$conn->query("DELETE FROM table_students WHERE id = $id");
header("Location: students.php");

$conn->close();
?>
