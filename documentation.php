<!DOCTYPE html>
<html>
<head>
	<title>Documentation</title>
</head>
<body>
	<h1>Documentation</h1>
	<ul>
		<li><a href="#html">HTML</a></li>
		<li><a href="#css">CSS</a></li>
		<li><a href="#sql">REQUETES SQL</a></li>
		<li><a href="#php">FONCTIONS PHP</a></li>
		<li><a href="#js">SCRIPT JAVASCRIPT</a></li>
	</ul>
	<h2 id="html">HTML</h2>
	<p> 
		utilisation des blocks Header pour l'entete qui contient le fond noir et le titre <quote>Bienvenue</quote>, Main pour grouper tout le reste. A l'intérieur du Main, on y trouve un NAV pour le menu et le sous menu déroulant, ensuite des Sections pour les grands blocs qui contiennent des balises article, aside et div. Enfin le Main contient le footer qui correspond au pied de pages avec les logos des entreprises.<br/>
		Les logos ont été pris sur le site <a href="http://www.flaticon.com/"> flaticon</a> Les droits d'utilisations sont gratuites en  en spécifiant ceci dans sa page.
		<small>
			Icons made by <a href="http://www.freepik.com" target=_blank title="Freepik">Freepik</a> from <a href="http://www.flaticon.com"  target=_blank title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
		</small>
	</p>
	<h2 id="css">CSS</h2>
	<p>
		Utilisation du <a href="https://necolas.github.io/normalize.css/latest/normalize.css">Normalize.css</a> un peu retouché pour avoir un rendu similaire sur tous les navigateurs.<br/>
		Mise en page en flex Plus simple au niveau du rendu: explication <a href="https://www.w3schools.com/css/css3_flexbox.asp"/>ici</a>
	</p>
	<h2 id="sql">LES REQUETES SQL</h2>
	<p>Pour chaque table la première colonne est l'id qui s'autoincremente toute seul donc lors des requetes d'insertion il n'est pas mentionné</p>
	<P>
		Pour insérer un étudiant dans la table etudiants de la base projet_esiee dans la table etudiants<br/>
		Voici un exemple:</br>
		<q>
			INSERT INTO etudiants(nom,prenom,filiere,promotion,entreprise,facebook,linkedin,remarque) VALUES('Perrin', 'Claire','grit','2013','France3','https://facebook.com/perrin_claire','https://linkedin.com/perrin_claire','élève très sérieux'
		</q>;
	</P>
	<p>
		Insérer dans la table photo l'id_etudiant, le nom, prenom et photo de l'élève en suivant ce schéma photo/filiere/promotion/nom_prenom.jpg exemple photo/grit/2017/guerin_pierre.jpg<br/>
		Voici un exemple :<br/>
		<q>
			INSERT INTO photo(id_etudiant,nom,prenom,image) SELECT e.id,e.nom,e.prenom, TRIM(LOWER(CONCAT('photo/',e.filiere,'/',e.promotion,'/',e.nom,'_',e.prenom,'.png'))) FROM etudiants e
		</q>;
		Attention vérifier les données des images et effacer les éventuels espaces persistants manuellemnt pour les noms et/ou prenoms composées, remplacer les ç par un c et enlever les accents.
		<br/>
		La fonction trim permet de supprimer les espaces lors de la concatenation pour les noms ou prenoms composés.<br/>
		LOWER permet de faire de transformer en miniscule la concatenation(addition des caractères) pour respecter le schéma.<br/>
		La fonction Concact permet de pouvoir assembler et avoir le format de stockage final.
	</p>
	<p>
		Insérer les entreprises dans la base de données:<br/>
		Voici un exempl:</br>
		<q>
			INSERT INTO entreprises(nom,logo) VALUES('test',CONCAT('logo/',nom,'.jpg'));
		</q>;
	</p>
	<h4>Explications des fonctions et jointuire SQL</h4>
	<ul>
		<li>MAX : recupère la valeur maximal de la colonne entre par paranthèse dans la requete</li>
		<li>INNER JOIN permet de faire une jointure(lier les tables) pour en faire q'une seule table et ON permet de spécifier la condition de la jointure</li>
	</ul>
	<h2 id="php">LES FUNCTIONS PHP</h2>
	<p>
		<ul>
			<li>htmlspecialchars : supprime les basalies < et > afin d'éviter l'insertion des script du type php, sql, javscript pouer se prévenir du piratage</li>
			<li>include: permet d'inclure des bouts de pages</li>
			<li>echo : pour afficher les balises html et les données récupérées dans les tables à partir des requetes SQL</li>
			<li>while($resultats = $selection->fetch()): pour parcourir les tables et récupérer toutes les informations que les requetes démandent</li>
			<li>$connexion = null : pour vider la connexion est éviter des confusions vu que à chaque appel d'une fonction la connexion est nécessaire</li>
			<li>$_GET['value'] : récupère la valeur saisie dans le url après le "=" par exemple dans etudiant.php?eleve=1, $_GET['eleve'] permet dans transférer id=1 de la page index à la page etudiant</li>
			<li>$selection->closeCursor() : permet de sortir de la boucle, éviter les confusions et vider la mémoire</li>
		</ul>
	</p>
	<h2 id="js">SCRIPT JAVASCRIPT</h2>
	<p>
		Permet d'éviter d'exécuter deux requetss afin de récupréer d'une part uniquement de logo de l'entreprise et de l'autre toutes les informations concernant les étudiants
	</p>
	<ul>
		<li> var img = document.querySelectorAll('.company>span>img'): permet de cibler tous les images génerer par la requete</li>
		<li>var span = document.querySelector('.company>span');:permet de cibler uniquement l'element span qui va contenir l'image</li></li>
		<li>span.style.display='block'; permet de transformer l'element span en un element block afin qu'il occupe toute la ligne et que l'element qui le suit vienne se positionner en bas
	</li>
		<li>span.style.textAlign='center': permet de center l'image qui est contenu dans ce span</li>
		<li>window.onload = function(){
		for(var i =1; i<'img.length;i++'){
			'img[i].style.display="none"': permet au chargement de la page de supprimer tous les images identiques recupérer par la requete et garder que la première grâce à l'initialisation de la boucle à partir de i =1
		</li>
	</ul>
</body>
</html>