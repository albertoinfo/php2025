<?php
/**
 * Calcula la letra de control asociado a un nif
 * @param int $digitos
 * @return string
 */
function calculaNIF(int $digitos): String
	{

		return " ";
	}

?>
<html>

<head>
	<meta charset="UTF-8">
	<title>Calcula NIF</title>
</head>

<body>
	
	<?php if  ($_SERVER['REQUEST_METHOD'] == "GET" ) : ?>
	
		<form method='POST'>
			<p>DNI: <input type='text' name='dni'></p>
			<input type='submit' value='Enviar' />
		</form>
	<?php else :?>
		<?php // Proceso el formulario ?>
		
	<?php endif ?>
	
</body>

</html>