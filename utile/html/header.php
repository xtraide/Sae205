<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/<?= $css ?>.css">
	<title>SAE 203</title>
</head>

<body>
	<header>
		<?php include_once("nav.php"); ?>
	</header>
	<?php
	include "../utile/link/linkPdo.php";
	include "../utile/function.php";
	session_start();

	if (empty($_SESSION['verified'])) {

		if (empty($_COOKIE['id'])) {

			header("Location: login.php");
	?>
			<script>
				alert("vous devez etre connecter pour utiliser cette page vous allez etre rediriger vers la page de connection ")
			</script>
			
			<?php
			die;
		} else {

			$result = execute("SELECT * FROM `utilisateur` WHERE id = :id", [
				"id" => $_COOKIE['id']
			]);
			while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
				foreach ($row as $row) {

					if ($row['verified'] != 1) {
			?>
						<script>
							alert("vous devez verifier votre adresse mail  pour utiliser cette page vous allez etre rediriger vers la page de connection ")
						</script>
	<?php
						
					} else {

						$_SESSION['verified'] = 1;
					}
				}
			}
		}
	}
