<?php

	function connectdb()
	{
		$host = 'sqletud.univ-mlv.fr';
		$user = 'cnoel';
		$passwd = 'poulet';
		$db = $user.'_db';

		$mysqli = new mysqli($host, $user, $passwd, $db);

		if ($mysqli->connect_errno)
		{
			die('Impossible de se connecter &agrave; la base de donn&eacute;es '.$db.' : '.$mysqli->connect_error.'.<br/>');
		}

		/* Réinitialisation éventuelle des tables */
		if (isset($_GET['clear']) && $_GET['clear'])
		{
			include_once('model/init.php');
			drop_databases($mysqli);
			unset($_GET['clear']);
		}
		
		include_once('model/init.php');
		initialize_databases($mysqli);

		return $mysqli;
	}

	function disconnectdb($mysqli)
	{
		$mysqli->close();
	}
?>