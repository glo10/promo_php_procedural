<!DOCTYPE html>
<html>
	<head>
		<title>Tous nos etudiants depuis 2002</title>
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
				<h2>Tous nos etudiants GRIT depuis 2002</h2>
				<article>
					<aside class="promo">
						<?php
							allStudentsGroupByCompany();
						?>
					</aside>
				</article>
			</section>
			<?php
				include('partner_footer.php');
			?>
		</main>
	</body>
</html>