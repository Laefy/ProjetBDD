<!DOCTYPE html>

<html>

	<head>
	
	<!-- Famille de caractères -->
		<meta charset="utf-8" />

	<!-- Feuilles de style -->
		<link rel="stylesheet" type="text/css" href="content/index.css" />
		<link rel="stylesheet" type="text/css" href="content/nav.css" />
		<?php 

			if ($session->is_connected())
			{
				print('<link rel="stylesheet" type="text/css" href="content/identity.css" />');
			}
			
			print('<link rel="stylesheet" type="text/css" href="content/'.$page->get_section().'.css"');	
		?>

	<!-- Icone -->
		<link rel="icon" type="image/png" href="content/icon.png" />

	<!-- Titre de page -->
		<?php

			print('<title>'.$page->get_title().'</title>');	
		?>	

	</head>

	<body>
		
		<div id="content">

		<!-- Menu -->
			<?php

				include('view/nav.php');
			?>

		<!-- Barre de recherche (si connecté) -->

		<!-- Section identité (si connecté) -->
			<?php

				if ($session->is_connected())
				{
					include ('view/identity.php');
				}
			?>

		<!-- Contenu de la page -->
			<?php

				include('view/'.$page->get_section().'.php');
			?>

		</div>

	</body>

</html>