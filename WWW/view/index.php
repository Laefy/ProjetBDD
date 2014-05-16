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
				print('<link rel="stylesheet" type="text/css" href="content/css/details.css" />');	
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
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="js/connect.js"></script>
		<script type="text/javascript" src="js/date.js"></script>
		<script type="text/javascript" src="js/form.js"></script>
		<script type="text/javascript" src="js/link.js"></script>
		<script type="text/javascript" src="js/view.js"></script>
		<script type="text/javascript" src="js/details.js"></script>
		<script type="text/javascript" src="js/add.js"></script>
		<script type="text/javascript" src="js/type.js"></script>
		<script type="text/javascript" src="js/insert.js"></script>
		<script type="text/javascript" src="js/table.js"></script>

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

					print('<div id="leftcolumn">');
					include('view/identity.php');
					print('</div>');


				/* Contenu de la page */

					include('view/main.php');


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