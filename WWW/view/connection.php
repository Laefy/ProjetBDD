<div id="connection_container">

<section id="connection">

	<p>Vous n'&ecirc;tes pas connect&eacute;. Veuillez-vous authentifier.</p>

	<?php

		include_once('controller/page.php');

		$status = $page->get_status();
		$visibility = 'hidden';
		$login = '';
		$passwd = '';
		$error = '';

		if ($status['nologin'])
		{
			$login = 'class="error"';
		}

		if ($status['nopasswd'])
		{
			$passwd = 'class="error"';
		}

		if ($status['unknownlogin'])
		{
			$visibility = 'visible';
			$error = 'L\'identifiant est inconnu';
			$login = 'class="error"';
		}

		if ($status['invalidpasswd'])
		{
			$visibility = 'visible';
			$error = 'Mot de passe invalide';
			$passwd = 'class="error"';
		}

		if (isset($status['login']))
		{
			$login .= ' value="'.$status['login'].'"';
		}

		print('<div class="error" style="height:15px; line-height:15px;" style="visibility: '.$visibility.';">');
		print($error);
		print('</div>');

	?>

	<form method="POST" action="index.php?to=home">

		<input type="hidden" name="connection" value=true />

		<?php

			print('<p>Identifiant :<br/> <input type="text" name="login" '.$login.' /></p>');
			print('<p>Mot de Passe :<br/> <input type="password" name="passwd" '.$passwd.' /> </p>');
		?>

		<p><input type="submit" value="Se connecter" /></p>

	</form>
	
</section>

</div>