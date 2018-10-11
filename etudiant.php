<!DOCTYPE html>
<html>
	<head>
		<title>Fiche détaillé etudiant(e)</title>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
	</head>
	<body>
		<main>
			<?php 
				include('headerNav.php');
				include('bdd/connexionBDD.php');
				include('functions.php');
			?>
			<section>
			<?php
				showStudentDetails();
			?>
			</section>
			<?php
				include('partner_footer.php');
			?>
		</main>
	</body>
</html>