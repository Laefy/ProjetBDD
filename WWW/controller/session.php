<?php

	include_once('controller/page.php');

	/* Classe contenant toutes les informations relatives à la session en cours */
	class session
	{
		private $connected;
		private $user;
		private $mysqli;
		private $page;

		public function __construct()
		{
			session_start();

			$_SESSION['connection_timestamp'] = 60 * 2;

			if (isset($_SESSION['session']))
			{
				$this->connected = $_SESSION['session']->connected;
				$this->user = $_SESSION['session']->user;
				$this->mysqli = $_SESSION['session']->mysqli;
				$this->page = $_SESSION['session']->page;
				$this->page->clear_error();

				if ($this->is_connected())
				{
					include_once('model/connection.php');
					$this->mysqli = connectdb();
				}
			}

			else
			{
				$this->connected = false;
				$this->page = new Page();
			}

			if (!isset($_COOKIE['connected']))
			{
				$this->disconnect();
			}

			else
			{
				setcookie('connected', true, time() + $_SESSION['connection_timestamp']);
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
				$this->page->set_status('unknownlogin');
				return false;
			}

			if ($passwd != 'saucisson')
			{
				$this->page->set_status('invalidpasswd');
				return false;
			}

			$this->user = $login;
			$this->connected = true;

			include_once('model/connection.php');
			$this->mysqli = connectdb();
			setcookie('connected', true, time() + $_SESSION['connection_timestamp']);

			return true;
		}

		public function disconnect()
		{
			if ($this->is_connected())
			{
				include_once('model/connection.php');
				disconnectdb($this->mysqli);

				$this->connected = false;
				setcookie('connected');
			}
		}

		public function save()
		{
			$_SESSION['session'] = $this;
		}

		public function get_page()
		{
			return $this->page;
		}

		public function set_page($page)
		{
			$this->page = $page;
		}

		public function get_mysqli()
		{
			return $this->mysqli;
		}

		public function head($page)
		{
			$this->page->head($page);
		}

		public function get_user()
		{
			return $this->user;
		}
	}