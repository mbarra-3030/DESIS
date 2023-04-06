<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desis";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, nombre FROM regiones";
$result = $conn->query($sql);

// Crear un array para almacenar los resultados
$regiones = array();

// Recorre las filas para luego agregarlas al array
while($row = $result->fetch_assoc()) {
  $regiones[] = $row;
}

// Salida de los resultados como un objeto JSON
echo json_encode($regiones);

$conn->close();
?>