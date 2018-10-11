<!DOCTYPE html>
<html>
	<head>
		<title>Page d'accueil</title>
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
				<h2>Nos promotions</h2>
					<?php
						showStudentsByYear('Promotion Grit 2017',2017,5,true);
						showStudentsByYear('Promotion Grit 2016',2016,5,true);
						showStudentsByYear('Promotion Grit 2015',2015,5,true);
					?>
			</section>
			<?php
				include('partner_footer.php');
			?>
		</main>
	</body>
</html>