<?php

	class Session
	{
		private $connected;
		private $user;
		private $connection = false;

		public function __construct()
		{			
			$timestamp_connection = 60 * 15;

			if (isset($_SESSION['session']) && $_SESSION['session']->is_connected() && ($_COOKIE['connected'] || $_SESSION['session']->connection))
			{
				$this->connected = true;
				$this->user = $_SESSION['session']->user;
				setcookie('connected', true, time() + $timestamp_connection);
			}

			else
			{
				$this->connected = false;
			}
		}

		public function is_connected()
		{
			return $this->connected;
		}

		public function authenticate($login, $passwd)
		{
			if ($login != 'Charcutier')
			{
		 		$status['out'] = false;
		 		$status['error'] = 'unknownlogin';
				return $status;
			}

			if ($passwd != 'saucisson')
			{
				$this->disconnect();
				$status['out'] = false;
				$status['error'] = 'invalidpasswd';
				return $status;
			}

			$this->connect($login);

			$status['out'] = true;
			return $status;
		}

		public function connect($login)
		{
			$this->user = $login;
			$this->connected = true;
			$this->connection = true;
		}

		public function disconnect()
		{
			$this->connected = false;
			$this->connection = false;
			setcookie('connected');
		}

		public function save()
		{
			$_SESSION['session'] = $this;
		}

		public function get_user()
		{
			return $this->user;
		}
	}