<section id="identity">

	<?php

		include_once('controller/session.php');

		print('<p>Bonjour M. '.$session->get_user().',<br/>nous sommes le</p>');
	?>

	<p id="identity_calendar"></p>
	<p id="identity_rdv"></p>

	<script type="text/javascript">	

		set_calendar();

	</script>

	<p class="icon">
		<a title="Vider la base de donn&eacute;es" class="clear icon" onClick="clear_db();"></a>
		<a title="D&eacute;connexion" class="disconnect icon" onClick="disconnect();"></a>
	</p>
	
</section>