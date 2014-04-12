<footer class="main">

	<?php

		if ($_SESSION[connected])
		{
			print('<a href="index.php?clear=true">Vider les tables</a> - <a href="index.php?disc=true">D&eacute;connection</a>');
		}
	?>

</footer>