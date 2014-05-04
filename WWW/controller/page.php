<?php

	/* Classe qui contient toutes les informations relatives à la page sur laquelle on se trouve, ainsi que celles qui doivent être affichées */
	class Page
	{
		private $section;						/* section de la page dans laquelle on se trouve */

		private $calendar;						/* information pour le calendrier */

		public $status;							/* ture si pas d'erreur, erreur sinon */


		public function set_status($status, $value = true)
		{
			$this->status[$status] = $value;
		}

		public function get_status()
		{
			return $this->status;
		}

		public function clear_error()
		{
			unset($this->status);
		}

		public function get_title()
		{
			switch ($this->section)
			{
				case 'connection':
					return 'Authentification';

				case 'home':
					return 'Accueil';

				case 'agenda':
					return 'Agenda';

				case 'consult':
					return 'Consultations';

				case 'directory':
					return 'Client&egrave;le';

				case 'register':
					return 'Registre Animalier';

				case 'prescript':
					return 'Prescriptions';
				
				case 'accounting':
					return 'Comptabilit&eacute;';

				case 'stock':
					return 'Stocks';

				case 'research':
					return 'R&eacute;sultat de la recherche';

				default:
					return 'Page Introuvable';
			}
		}

		public function head($page)
		{
			$this->section = $page;
		}

		public function get_section()
		{
			return $this->section;
		}

		public function update($session)
		{
			include_once('controller/session.php');

			$this->calendar['day'] = date('j');

			switch (date('n')) 
			{
				case '1':
					$this->calendar['month'] = 'JAN';
					break;

				case '2':
					$this->calendar['month'] = 'FEV';
					break;

				case '3':
					$this->calendar['month'] = 'MARS';
					break;

				case '4':
					$this->calendar['month'] = 'AVR';
					break;

				case '5':
					$this->calendar['month'] = 'MAI';
					break;

				case '6':
					$this->calendar['month'] = 'JUIN';
					break;

				case '7':
					$this->calendar['month'] = 'JUIL';
					break;

				case '8':
					$this->calendar['month'] = 'AOUT';
					break;

				case '9':
					$this->calendar['month'] = 'SEPT';
					break;

				case '10':
					$this->calendar['month'] = 'OCT';
					break;

				case '11':
					$this->calendar['month'] = 'NOV';
					break;

				case '12':
					$this->calendar['month'] = 'DEC';
					break;
			}

			if ($session->is_connected())
			{
				include_once('model/query.php');
				$this->calendar['appointment'] = query_date_nextappointment($session->get_mysqli());
			}
		}

		public function get_date_nextappointment()
		{
			return $this->date_nextappointment;
		}

		public function get_calendar()
		{
			return $this->calendar;
		}
	}