<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desis";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$condition = $_GET["comuna"];
$sql = "SELECT nombre FROM comunas WHERE region_id = '$condition'";
$result = $conn->query($sql);

// Crear un array para almacenar los resultados
$comunas = array();

// Recorre las filas para luego agregarlas al array
while($row = $result->fetch_assoc()) {
  $comunas[] = $row;
}

// Salida de los resultados como un objeto JSON
echo json_encode($comunas);

$conn->close();
?>