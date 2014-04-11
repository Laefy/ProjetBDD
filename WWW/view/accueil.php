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
				
				<h1>Accueil</h1>

				<?php

					if ($_SESSION['connected'])
					{

					}

					else
					{
						include('view/connection.php');
					}
				?>

				<?php

					include('view/footer.php');
				?>

			</section>

		</div>

	</body>

</html>