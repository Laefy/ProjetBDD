<?php

	function process_get($session)
	{
		if (isset($_GET['disconnect']))
		{
			$session->disconnect();
		}

		if (isset($_GET['clear']))
		{
			if ($session->is_connected())
			{
				include_once('model/init.php');
				drop_databases($session->get_mysqli());
				initialize_databases($session->get_mysqli());
			}
		}

		if (isset($_GET['to']))
		{
			$session->head($_GET['to']);
		}

		return $session;
	}

