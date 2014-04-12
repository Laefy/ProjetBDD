<h1>Authentification</h1>

<section id="connection" class="text">

	<p>Vous n'&ecirc;tes pas connect&eacute;. Veuillez-vous authentifier.</p>

	<?php

		$visibility = 'style="visibility: hidden;"';
		if (isset($_SESSION['err_connection']) && $_SESSION['err_connection'])
		{
			$errlogin = $_SESSION['err_type'] == 'nologin' ? 'class="errbgcolor"' : '';
			$errpasswd = $_SESSION['err_type'] == 'nopasswd' ? 'class="errbgcolor"' : '';

			if ($_SESSION['err_type'] == 'uklogin')
			{
				$errstring = 'L\'identifiant est inconnu';
				$visibility = 'style="visibility: visible;"';
			}

			else if ($_SESSION['err_type'] == 'invpasswd')
			{
				$errstring = 'Mot de passe invalide';
				$visibility = 'style="visibility: visible;"';
			}
		}

		print('<div class="error" style="height: 20px;"'.$visibility.'>');
		print($errstring);
		print('</div>');

	?>

	<form method="POST" action="index.php">

		<?php

			$deflogin = isset($_SESSION['login']) ? 'value='.$_SESSION['login'] : '';
			print('Identifiant :<br/> <input type="text" name="login" '.$deflogin.' '.$errlogin.' /> <br/>');
			print('Mot de Passe :<br/> <input type="password" name="passwd" '.$errpasswd.' /> <br/>');
		?>

		<input type="hidden" name="connection" value=true />
		<input type="submit" value="Se connecter" />

	</form>
	
</section>
