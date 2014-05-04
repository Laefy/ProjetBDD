<!DOCTYPE html>

<html>

	<head>
	
	<!-- Famille de caractères -->
		<meta charset="utf-8" />

	<!-- Feuilles de style -->
		<link rel="stylesheet" type="text/css" href="content/css/index.css" />
		<link rel="stylesheet" type="text/css" href="content/css/nav.css" />
		<?php 

			if ($session->is_connected())
			{
				print('<link rel="stylesheet" type="text/css" href="content/css/identity.css" />');
				print('<link rel="stylesheet" type="text/css" href="content/css/search.css" />');
				print('<link rel="stylesheet" type="text/css" href="content/css/mainframe.css" />');	
			}
			
			print('<link rel="stylesheet" type="text/css" href="content/css/'.$page->get_section().'.css" />');	
		?>

	<!-- Icone -->
		<link rel="icon" type="image/png" href="content/img/icon_main.png" />

	<!-- Titre de page -->
		<?php

			print('<title>'.$page->get_title().'</title>');	
		?>	

	<!-- Fonctions JavaScript -->
		<script type="text/javascript" src="content/js/form.js"></script>
		<script type="text/javascript" src="content/js/view.js"></script>

	</head>

	<body>
	
		<div id="content">

		<!-- Menu -->
			<?php

				include('view/nav.php');
			?>

			<?php

			/* Si connecté */

				if ($session->is_connected())
				{

				/* Barre de recherche */
					include('view/search.php');

				/* Section identité */
					include('view/identity.php');

				/* Contenu de la page */
					print('<section id="mainframe">');
					include('view/'.$page->get_section().'.php');
					print('</section>');	

					print('<script type="text/javascript">

						resize_content();
						skip_nav();

					</script>');
				}

			/* Sinon */

				else
				{
					include('view/'.$page->get_section().'.php');
				}
			?>

		</div>

	</body>

</html>