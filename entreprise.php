<!DOCTYPE html>
<html>
<head>
	<title>Nos partenaires</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>
<body>
<?php 
	include_once('headerNav.php');
	include_once('functions.php');
?>
	<section>
		<article>
			<aside class="company">
				<?php
					studentsGroupByOneCompany();
				?>
			</aside>
		</article>
	</section>
<?php
	include_once('partner_footer.php');
?>
<script type="text/javascript">
	var img = document.querySelectorAll('.company>span>img');
	var span = document.querySelector('.company>span');
	span.style.display='block';
	span.style.textAlign='center';
	window.onload = function(){
		for(var i =1; i<img.length;i++){
			img[i].style.display="none";
		}
	};
</script>
</body>
</html>