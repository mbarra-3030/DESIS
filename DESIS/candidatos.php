<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desis";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, NombreApellido FROM candidatos";
$result = $conn->query($sql);

// Crear un array para almacenar los resultados
$candidatos = array();

// Recorre las filas para luego agregarlas al array
while($row = $result->fetch_assoc()) {
  $candidatos[] = $row;
}

// Salida de los resultados como un objeto JSON
echo json_encode($candidatos);

$conn->close();
?>