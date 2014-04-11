<?php

	function connect()
	{
		$host='sqletud.univ-mlv.fr';
		$user='cnoel';
		$passwd='poulet';
		$db='$user'.'_db';

		$idcon=mysqli_connect($host, $user, $passwd, $db)
			or die('Impossible de se connecter à la base '.'$db');

		return $idcon;
	}

	function disconnect($idcon)
	{
		mysqli_close($idcon);
	}
?>