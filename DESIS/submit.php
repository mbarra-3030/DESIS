<?php

// Se conecta a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desis";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Obtiene los datos del formulario
$fullname = $_POST['fullname'];
$alias = $_POST['alias'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$region = mysqli_real_escape_string($conn, $_POST['regiones-select']); // retorna el indice
$comuna = mysqli_real_escape_string($conn, $_POST['comunas-select']);
$candidato = mysqli_real_escape_string($conn, $_POST['candidatos-select']); // retorna el indice
$option1 = isset($_POST['option1']) ? 1 : 0; // web
$option2 = isset($_POST['option2']) ? 1 : 0; // tv
$option3 = isset($_POST['option3']) ? 1 : 0; // redes sociales
$option4 = isset($_POST['option4']) ? 1 : 0; // amigo

$sqlRegion = "SELECT nombre FROM regiones WHERE id = '$region'";
$result = $conn->query($sqlRegion);
while($row = $result->fetch_assoc()) {
    $region = $row["nombre"];
    $region = str_replace("'","\'",$region); // en caso de que exista un apostrofe
}

$sqlCandidatos = "SELECT NombreApellido FROM candidatos WHERE id = '$candidato'";
$result = $conn->query($sqlCandidatos);
while($row = $result->fetch_assoc()) {
    $candidato = $row["NombreApellido"];
}

// verifica si el valor ya existe en la base de datos
$sqlRut = "SELECT * FROM votacion WHERE Rut = '$rut'";
$result = $conn->query($sqlRut);

if ($result->num_rows > 0) {
    // Entra a este bloque de codigo solo si el RUT existe
    $response = array('status' => 'success', 'message' => 'No se pudo votar debido a que el rut ya existe');
    echo json_encode($response);
} else {
    // inserta los datos a la tabla votacion
    $sql = "INSERT INTO votacion (NombreApellido, Alias, Rut, Email, Region, Comuna, Candidato, OpcionWeb, OpcionTV, OpcionRedesSociales, OpcionAmigo) 
    VALUES ('$fullname', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', $option1, $option2, $option3, $option4)";

    if (mysqli_query($conn, $sql)) {
        $response = array('status' => 'success', 'message' => 'El formulario de votación se ha enviado con éxito');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success', 'message' => 'El formulario de votación no se ha podido enviar');
        echo json_encode($response);
    }
}

// Cierra la conexion MySQL
mysqli_close($conn);

?>
