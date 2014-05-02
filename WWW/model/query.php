<?php

	function query_date_nextappointment($mysqli)
	{
		$query = 'SELECT date FROM V_CONSULTATION WHERE (date > now()) ORDER BY date ASC LIMIT 1;';

		$result = $mysqli->query($query);
		$array = $result->fetch_array();

		if ($array != NULL)
		{
			$date = $array['date'];

			$result->free();

			return date('G\hi', $date);
		}

		return false;
	}