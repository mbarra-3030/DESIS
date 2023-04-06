<!DOCTYPE html>
<html>
<head>
	<title>Form Submission</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h2>FORMULARIO DE VOTACIÓN</h2>
	<hr>
	<form id="formDESIS">
		<label>Nombre y Apellido:</label><br>
		<input type="text" id="fullname" name="fullname"><br>
		<div id="fullname_error" class="error">El campo no puede estar vacío.</div>
		<label>Alias:</label><br>
		<input type="text" id="alias" name="alias"><br>
 		<div id="alias_error" class="error">La cantidad de caracteres debe ser mayor a 5 y debe contener letras y
números.</div>
		<label>RUT:</label><br>
		<input type="text" id="rut" name="rut"><br>
		<div id="rut_error" class="error">El RUT no es válido.</div>
		<label>Email:</label><br>
		<input type="email" id="email" name="email">
		<div id="email_error" class="error">El Email no es válido.</div>
		<br><br>
		<select id="regiones-select" name="regiones-select">
		</select>
		<br><br>
		<select id="comunas-select" name="comunas-select">
		</select>
		<br><br>
		<select id="candidatos-select" name="candidatos-select"></select>
		<br><br>
		<div class="checkbox-container">
			<label>Cómo se enteró de nosotros <input type="checkbox" name="option1" value="Option 1" class="checkbox"> Web</label>
		</div>
		<div class="checkbox-container">
			<label><input type="checkbox" name="option2" value="Option 2" class="checkbox"> TV</label>
		</div>
		<div class="checkbox-container">
			<label><input type="checkbox" name="option3" value="Option 3" class="checkbox"> Redes sociales</label>
		</div>
		<div class="checkbox-container">
			<label><input type="checkbox" name="option4" value="Option 4" class="checkbox"> Amigo</label>
		</div>
		<div id="checkbox_error" class="error">Debe elegir al menos dos opciones</div>
		<br><br>
		<input type="submit" value="Votar">
	</form>
	<br>
	<div id="result"></div>
</body>
</html>