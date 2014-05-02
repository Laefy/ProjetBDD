<?php

	function process_reheading($session)
	{
		include_once('controller/session.php');

		if (!$session->is_connected())
		{
			$session->head('connection');
		}

		else
		{
			$section = array('home', 'agenda', 'consult', 'directory', 'register', 'prescript', 'accounting', 'stock');

			if (!in_array($session->get_page()->get_section(), $section))
			{
				$session->head('unexisting_page');
			}
		}

		return $session;
	}