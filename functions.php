<?php
	function showStudentsByYear($msg,$year,$limit,$bool){
		/*
			@params(string,integer,integer,boolean) IT SHOWS ALL STUDENTS IN WEBPAGE promos.php BY YEAR AND ONLY 5 BY PROMOTION IN index.php WEBPAGE FROM 2014 TO 2017
			it uses in promo.php
		*/
		include('bdd/connexionBDD.php');
		$html = '<section>';
			$html .= '<h4> '.$msg.' </h4>';
			$html .= '<article>';
				$html .='<aside class="promo">';
					$requete = 'SELECT e.id,e.nom,e.prenom,e.entreprise,p.image FROM etudiants e INNER JOIN photo p ON e.id = p.id_etudiant WHERE promotion = '.$year.' ORDER BY nom LIMIT '.$limit ;
					$selection = $connexion -> query($requete) or die(print_r($connexion->errorInfo()));
					while($resultats = $selection->fetch()){
						if(isset($resultats['id']) && isset($resultats['nom']) && isset($resultats['prenom']) && isset($resultats['entreprise']) && isset($resultats['image'])){
							$html .= '<div class="studFive">';
								$html .='<span><a href="etudiant.php?eleve='.$resultats['id'].'"><img src="'.$resultats['image'].'" alt="image étudiant" title = "'.$resultats['nom'].' '.$resultats['prenom'].'"/></a></span>';
								$html .= '<ul class="para">';
									$html .= '<li>' .$resultats['nom']. '</li>';
									$html .= '<li> ' .$resultats['prenom']. '<li/>';
									$html .= '<li>Travaille chez '.$resultats['entreprise'].'</li>';
								$html .= '</ul>';
							$html .='</div>';
						}
					}
					$selection->closeCursor();
					if($bool == true){
				$html.= '</aside>';
				$html.= '<div class="more">';
					$html.='<a href="promo.php?annee='.$year.'"><button>Voir plus</button></a>';
				$html.='</div>';
			$html.='</article>';
					}
				$html.= '</aside>';
			$html.='</article>';
		$html.='</section>';
		$connexion = null;
		echo $html;
	}

	function showStudentDetails(){
		/*
			@params(integer) Show all details about the student. Databases have been gotten in three tables etudiants, entreprises and photo
			it uses in etudiant.php
		*/
		include('bdd/connexionBDD.php');
		$_GET['eleve'] = htmlspecialchars($_GET['eleve']);
		$idStudent = $_GET['eleve'];
		$idSecure='SELECT MAX(id) AS totalStudent FROM etudiants';
		$idSecure=$connexion->query($idSecure);
		$idSecureResult=$idSecure->fetch();
		$idSecure->closeCursor();
		$html = '<article>';
		if(isset($idStudent) && preg_match('@^[1-9]([0-9]){0,2}$@', $idStudent) && $idStudent <= $idSecureResult['totalStudent']){// SECURE URI VALUE
			$requete ='SELECT e.nom,e.prenom,e.promotion,e.filiere,e.facebook, e.linkedin, e.remarque, w.logo,p.image FROM etudiants e INNER JOIN  entreprises w ON e.entreprise = w.nom INNER JOIN photo p ON p.id_etudiant =e.id WHERE e.id = '.$idStudent;
			$selection = $connexion -> query($requete) or die(print_r($connexion->errorInfo()));
			while($resultats = $selection->fetch()){
				if(isset($resultats['nom']) && isset($resultats['prenom']) && isset($resultats['promotion']) && isset($resultats['filiere']) && isset($resultats['facebook']) && isset($resultats['linkedin']) && isset($resultats['remarque']) && isset($resultats['logo']) && isset($resultats['image'])){//PREVENT AGAINST SQL INJECTIONS
					$html .= '<div class="student">';
						$html .='<figure><img src="' .$resultats['image']. '" alt="image etudiant(e)" title = "'.$resultats['nom'].' '.$resultats['prenom'].'"/></figure>';
						$html .= '<ul class="para">';
							$html .= '<li>'.$resultats['nom']. ' ' .$resultats['prenom']. '</li>';$html .= '<li>Promotion de ' .$resultats['filiere'].' '.$resultats['promotion']. '</li>';
							$html .= '<li>' .$resultats["remarque"].'</li>';
							$html .= '<li><a href="'.$resultats['facebook'].' " target="_blank"><img src ="logo/facebook.png"/></li>';
							$html .= '<li><a href="' .$resultats['linkedin']. '" target = "_blank"><img src= "logo/linkedin.png"/></a></li>';
							$html .= '<li><img class ="icon" src="'.$resultats["logo"].'"/></li>';
						$html .= '</ul>';
					$html .= '</div>';
					echo $html;
				}
			}
			$selection->closeCursor();
		}
		else{
			//WHEN THE USER CHANGE URL PARAM eleve AND THE VALUE NOT IN [1,(Max Students In etudiants Table)]
			echo "<p class='alert'>L'information demandé n'existe pas!</p>";
		}
		echo '</article>';
		$connexion = null;
	}

	function showCompanies(){
		//Shows all pictures of companies in the database entreprises. it uses all footers
		include('bdd/connexionBDD.php');
		$html = '<footer>';
			$html .= '<h2 id="partner">La liste non exhaustive des entreprises chez lesquelles nos élèves y travaillent</h2>';
			$html .='<div id="entreprise">';
				$requete = 'SELECT id,nom,logo FROM entreprises ORDER BY nom';
				$selection = $connexion -> query($requete) or die(print_r($connexion->errorInfo()));
				while($resultats = $selection -> fetch()){
					if(isset($resultats['id']) && isset($resultats['nom']) && isset($resultats['logo'])){//PREVENT AGAINST SQL INJECTIONS
						$html .=  '<figure>';
							$html .= '<a href="entreprise.php?societe='.$resultats["id"].'"><img alt = "Logo de l\'entreprise" src="'.$resultats["logo"].'" title = "Logo de l\'entreprise '.$resultats["nom"].'"/></a>';
						$html .= '</figure>';
					}
				}
				$selection -> closeCursor();
			$html .= '</div>';
			$connexion = null;
			$html .= '<p id="copyright">Glodie Tshimini 2017</p>';
		$html .= '</footer>';
		echo $html;
	}

	function studentsGroupByOneCompany(){
		//Shows all students work for the company clicked
		$idEnt = htmlspecialchars($_GET['societe']);
		include('bdd/connexionBDD.php');
		$idSecure='SELECT MAX(id) AS IdMax FROM entreprises';
		$idSecure=$connexion->query($idSecure);
		$idSecureResult=$idSecure->fetch();
		$idSecure->closeCursor();
		if(isset($_GET['societe']) AND preg_match('@^[1-9]([0-9]){0,1}$@', $_GET['societe']) AND $_GET['societe'] <= $idSecureResult['IdMax']){//ISAFETY AGAINST UNAPPROPRIETE VALUE INSERTED IN URL
			$requete = 'SELECT e.id,e.nom,e.prenom,e.filiere,e.promotion,e.entreprise, w.logo ,p.image FROM etudiants e INNER JOIN entreprises w ON e.entreprise = w.nom INNER JOIN photo p ON p.id_etudiant = e.id WHERE w.id='.$idEnt.' ORDER BY promotion';
			$selection = $connexion->query($requete) or die(print_r($connexion->errorInfo()));
			while($resultats=$selection->fetch()){
				if(isset($resultats['id']) && isset($resultats['nom']) && isset($resultats['prenom']) && isset($resultats['filiere']) && isset($resultats['promotion']) && isset($resultats['entreprise']) && isset($resultats['logo']) && isset($resultats['image'])){//PREVENT AGAINST SQL INJECTIONS
					$html = '<span><img src="'.$resultats['logo'].'"/></span>';
						$html .= '<div class="more">';
							$html .= '<div class = "studComp">';
								$html .= '<span><a href="etudiant.php?eleve='.$resultats['id'].'"><img src = "'.$resultats["image"].'"/></a></span>';
								$html .= '<ul class="paraStudComp">';
									$html .= '<li>'.$resultats["nom"]. ' '.$resultats["prenom"]. '</li>';
									$html .= '<li>Promotion ' .$resultats["filiere"]. '</li>';
									$html .= '<li>Année ' .$resultats["promotion"]. '</li>';
								$html .=  '</ul>';
							$html .= '</div>';
						$html .= '</div>';
					echo $html;
				}
			}
			$selection->closeCursor();
			$connexion=null;
		}
		else{
			//WHEN THE USER CHANGE URL PARAM societe AND THE VALUE NOT IN [1,(Max Companies In entreprise Table)]
			echo "<p class='alert'>L'information demandé n'existe pas!</p>";
		}
	}

	function allStudentsGroupByCompany(){
		//Shows all students and group by company
		include('bdd/connexionBDD.php');
		$requete = 'SELECT e.id AS e_id ,e.nom,e.prenom,e.promotion,e.filiere, w.logo,p.image FROM etudiants e INNER JOIN  entreprises w ON e.entreprise = w.nom INNER JOIN photo p ON p.id_etudiant =e.id ORDER BY w.nom';
		$selection = $connexion->query($requete) or die(print_r($connexion->errorInfo()));
		while($resultats=$selection->fetch()){
			if(isset($resultats['e_id']) && isset($resultats['nom']) && isset($resultats['prenom']) && isset($resultats['filiere']) && isset($resultats['promotion']) && isset($resultats['logo']) && isset($resultats['image'])){//PREVENT AGAINST SQL INJECTIONS
					$html ='<div class = "studAll">';
						$html .= '<figure><img src="'.$resultats["logo"].'"/></figure>';
						$html .= '<a href="etudiant.php?eleve='.$resultats['e_id'].'"><img src = "'.$resultats["image"].'"/></a>';
						$html .= '<ul class="paraStudAll">';
							$html .= '<li>' .$resultats['nom']. ' ' .$resultats["prenom"]. '</li>';
							$html .= '<li>de la promotion ' .$resultats["filiere"]. '</li>';
							$html .= '<li>de l\'année ' .$resultats["promotion"]. '</li>';
						$html .= '</ul>';
					$html .= '</div>';
					echo $html;
			}
		}
		$selection->closeCursor();
		$connexion=null;
	}
?>
