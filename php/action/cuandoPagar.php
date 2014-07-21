<?php
	if (isset($_POST["ahora"])) {
		header("Location: ../formPagoPasaje.php");
	} else if (isset($_POST["despues"])) {
		header("Location: ../index.php");
	}
?>