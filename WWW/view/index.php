<!DOCTYPE html>

<html>

	<head>
		
		<meta charset="utf-8" />
		<link rel="stylesheet" href="content/stylesheet.css" />
		<title>Accueil</title>		

	</head>

	<body>
		
		<div id="content">

			<?php

				include('view/nav.php');
				include('view/cal.php');
			?>

			<section class="main block">
				
				<?php

					include('view/'.$_SESSION['page'].'.php');
					
					include('view/footer.php');
				?>

			</section>

		</div>

	</body>

</html>