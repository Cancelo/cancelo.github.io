<?php
	include("mysql.inc.php");

		if(!isset($_POST['nombre']) || !isset($_POST['nivel']) || !isset($_POST['puntuacion']) || !isset($_POST['bonus']) || !isset($_POST['total'])) {
			echo "<script>alert('No se han recibido parámetros'); window.location = 'index.php';</script>";
		}
		elseif($_POST['nombre']=='' || !isset($_POST['nivel']) || $_POST['puntuacion']=='' || $_POST['bonus']=='' || $_POST['total']=='') {
			echo "<script>alert('Datos incorrectos'); window.location = 'index.php';</script>";
		}
		else {
			$nombre=htmlentities(addslashes($_POST['nombre']));
			$nivel=htmlentities(addslashes($_POST['nivel']));
			$puntuacion=htmlentities(addslashes($_POST['puntuacion']));
			$bonus=htmlentities(addslashes($_POST['bonus']));
			$total=htmlentities(addslashes($_POST['total']));
$fecha=strftime("%d/%m/%Y - %H:%M");
$ip=$_SERVER['REMOTE_ADDR'];

if($nivel<=32 && $bonus<=15003 && $puntuacion<=15503) {
$cheat=0;
}
else {
$cheat=1;
}

			conecta($c);
			mysqli_select_db($c, "u101581480_space");

			$sql="insert into jugador value (0,'$nombre','$nivel','$puntuacion', '$bonus', '$total', '$fecha', '$ip', '$cheat')";

			$resultado=mysqli_query($c,$sql);

			if($resultado) {
				echo "<script>alert('Tu puntuación se ha guardado'); window.location = 'index.php';</script>";
			}
			else {
				$error=mysqli_error($c);
				echo "<script>alert('Ha ocurrido un error con la Base de datos'); window.location = 'index.php';</script>";
			}
		}
?>		