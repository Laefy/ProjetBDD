Vous n'&ecirc;tes pas connect&eacute;. Veuillez-vous authentifier.

<form method="POST" action="index.php">

	<?php

		if (isset($_SESSION['err_connection']))
		{
			print($_SESSION['err_connection'].'<br/>');
		}

		$deflogin = isset($_COOKIE['login']) ? 'value='.$_COOKIE['login'] : '';

		print('Identifiant : <input type="text" name="login"'.$deflogin.' /> <br/>');
		print('Mot de Passe : <input type="password" name="passwd" />');

	?>

	<input type="hidden" name="connection" value=true />
	<input type="submit" value="Valider" />

</form>