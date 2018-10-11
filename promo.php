<!DOCTYPE html>
<html>
	<head>
		<title>Promotion Grit</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<body>
		<?php
			$annee = htmlspecialchars($_GET['annee']);
			include('headerNav.php');
			include('bdd/connexionBDD.php');
			//SECURE VALUE OF annee IN URL
			$secure='SELECT MAX(promotion) AS maxYear FROM etudiants';
			$secure=$connexion->query($secure);
			$secureResult=$secure->fetch();
			$secure->closeCursor();
			$connexion=null;
			include('functions.php');
			if(isset($annee) && preg_match('@^20([0-9]){2}$@',$annee) && $annee <= $secureResult['maxYear']){
				showStudentsByYear('Toute la promotion Grit de ' .$annee,$annee,20,false);	
			}
			else{
				echo'<p class="alert">Les informations n\'existe pas!</p>';
			}
			include('partner_footer.php');
		?>
	</body>
</html>