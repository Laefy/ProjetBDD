<?php

	class Page
	{
		private $section;						
		private $title;
		private $toward;


		public function __construct($session = false)
		{
			if (isset($_SESSION['page']))
			{
				$this->toward = $_SESSION['page']->toward;
			}

			if ($session && $session->is_connected())
			{
				$this->section = $this->toward ? $this->toward : 'home';
			}

			else
			{
				$this->section = 'connection';
			}

			$this->set_title();
		}

		public function set_title()
		{
			switch ($this->section)
			{
				case 'connection':
					$this->title ='Authentification';
					break;

				case 'home':
					$this->title ='Accueil';
					break;

				case 'agenda':
					$this->title ='Agenda';
					break;

				case 'consult':
					$this->title ='Consultations';
					break;

				case 'directory':
					$this->title ='Client&egrave;le';
					break;

				case 'register':
					$this->title ='Registre Animalier';
					break;

				case 'prescript':
					$this->title ='Prescriptions';
					break;

				case 'accounting':
					$this->title ='Comptabilit&eacute;';
					break;

				case 'stock':
					$this->title ='Stocks';
					break;

				case 'research':
					$this->title ='R&eacute;sultat de la recherche';
					break;

				default:
					$this->title ='Page Introuvable';
					break;
			}					
		}

		public function get_section()
		{
			return $this->section;
		}

		public function get_title()
		{
			return $this->title;
		}

		public function head($to)
		{
			$this->toward = $to;
		}

		public function save()
		{
			$_SESSION['page'] = $this;
		}
	}