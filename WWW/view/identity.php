<section id="identity">

	<?php

		include_once('controller/page.php');
		$calendar = $page->get_calendar();

		print('<p>Bonjour M. '.$session->get_user().',<br/>nous sommes le</p>');

		print('<p>'.$calendar['day'].'<br/>'.$calendar['month'].'</p>');

		if ($calendar['appointment'] != false)
		{
			print('<p>Votre prochain rendez-vous est pr&eacute;vu &agrave; '.$calendar['appointment'].'.</p>');
		}

		else
		{
			print('<p>Vous n\'avez aucun rendez-vous pr&eacute;vu aujourdh\'hui.</p>');
		}
	?>

</section>