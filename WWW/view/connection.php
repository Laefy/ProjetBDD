<div id="connection_container">

<section id="connection">

	<p>Vous n'&ecirc;tes pas connect&eacute;. Veuillez-vous authentifier.</p>

	<div id="connection_error" class="error">
	</div>

	<form id="connection_form">

		<?php

			print('<p>Identifiant :<br/> <input type="text" name="login" /></p>');
			print('<p>Mot de Passe :<br/> <input type="password" name="passwd" /></p>');
		?>

		<p><a onClick="connect();"></a></p>

	</form>
	
</section>

</div>
