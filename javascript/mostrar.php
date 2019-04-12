<html lang="es">
	<head>
            <meta charset="UTF-8"/>
            <title>Proyecto Js - SpaceRunner</title>
            <meta name="keywords" content="js, javascript, canvas, html5, juego, runner"/>
            <meta name ="description" content="Space Runner es un mini juego creado con JavaScript y Canvas"/>
            <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
<div id="main">
		<?php

			include_once("mysql.inc.php");
			conecta($c);

				if($c==null) {
					echo "Fallo de conexión";
				}
				else {
					mysqli_select_db($c, "u101581480_space");

					$sql="select * from jugador where cheat='0' order by total desc";

					$resultado=mysqli_query($c, $sql);

					if($resultado) {

						$filas=mysqli_num_rows($resultado);

						if($filas==0) {
							echo "No hay resultados";
						}
						else {
							$pos=1;
							$clase='fila1';
							echo "<table>";
							echo "
								<tr id='cabeceraTabla'>
									<th>Posición</th>
									<th>Nombre</th>                        
									<th>Nivel</th>
									<th>Puntuación</th>
									<th>Bonus</th>                        
									<th>Puntuación TOTAL</th>
								</tr>
							";
							while($registro=mysqli_fetch_array($resultado)) {

								$nombre=$registro['nombre'];
								$nivel=$registro['nivel'];
								$puntuacion=$registro['puntuacion'];
								$bonus=$registro['bonus'];
								$total=$registro['total'];

								if($pos % 2 != 0) {
									$clase='fila1';
								}
								else {
									$clase='fila2';
								}
								echo "
									<tr class='$clase'>
										<td>$pos</td>
										<td>$nombre</td>                        
										<td>$nivel</td>
										<td>$puntuacion</td>
										<td>$bonus</td>
										<td>$total</td>
									</tr>
								";
								$pos++;							
							}

							echo "</table>";
						}
					}
					else {
						$error=mysqli_error($c);
						echo $error;
					}
				}
				mysqli_close($c);
			?>
</div>
	</body>
</html>