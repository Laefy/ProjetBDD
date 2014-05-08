<?php

	class Db
	{
		private $host = 'sqletud.univ-mlv.fr';
		private $user = 'cnoel';
		private $passwd = 'poulet';
		private $name = 'cnoel_db';
		private $mysqli;

		public function __construct($reconstruct = false)
		{
			$this->mysqli = new mysqli($this->host, $this->user, $this->passwd, $this->name);

			if ($this->connect_errno)
			{
				die('Impossible de se connecter &agrave; la base de donn&eacute;es '.$this->name.' : '.$this->mysqli->connect_error.'.<br/>');
			}

			if ($reconstruct)
			{
				$this->connect();
			}
		}

		public function create()
		{
			/* Création de V_Médicament, V_Traitement, V_Localite, V_Proprietaire, V_Entreprise, V_Particulier, V_Espece, V_Animal, V_Consultations et V_Soins */

			$files = array('Traitement', 'Proprietaire', 'Animal', 'Consultation');

			foreach ($files as $file) 
			{			
				$query = file_get_contents('db/V_'.$file.'.sql');
				$this->mysqli->multi_query($query);
							
				do 
				{
				    if ($result = $this->mysqli->store_result()) 
				    {
				        $result->free();
				    }

				} while ($this->mysqli->more_results() && $this->mysqli->next_result());
			}
		}

		public function clear()
		{
			$tables = array('SOINS', 'CONSULTATION', 'ANIMAL', 'ESPECE', 'ENTREPRISE', 'PARTICULIER', 'PROPRIETAIRE', 'LOCALITE', 'TRAITEMENT', 'MEDICAMENT');

			foreach ($tables as $table) 
			{
				$query = 'DROP TABLE V_'.$table;
				$this->mysqli->query($query);

				if ($result = $this->mysqli->store_result()) 
			    {
			        $result->free();
			    }
			}
		}

		public function select_one($table, $label, $id)
		{
			$query = 'SELECT * FROM '.$table.' WHERE ('.$table.'.'.$label.' = '.$id.')';
			$this->mysqli->query($query);

			if ($result = $this->mysqli->store_result())
			{
				$row = $result->fetch_array();
				$result->free();
				return $row;
			}

			return null;
		}

		public function select_first_from($table, $label, $limitB, $limitU)
		{
			$query = 'SELECT '.$label.' FROM '.$table.' WHERE ('.$label.' > '.$limitB.' && '.$label.' < '.$limitU.') ORDER BY '.$label.' ASC LIMIT 1';
			$this->mysqli->query($query);

			if ($result = $this->mysqli->store_result())
			{
				$row = $result->fetch_array();

				if ($row)
				{
					$val = $row[$label];
					$result->free();
					return $val;
				}
			}
			
			return null;
		}

		public function select_all($table)
		{
			$query = 'SELECT * FROM '.$table;
			$this->mysqli->query($query);

			if ($result = $this->mysqli->store_result())
			{
				return $result;
			}

			return null;
		}

		public function get_one_row($result)
		{
			$row = $result->fetch_array();

			if (!$row)
			{
				$result->free();
			}

			return $row;
		}

		public function insert_one($table, $values)
		{
			$cols = '';
			$vals = '';
			$nb = 0;

			foreach ($values as $label => $value)
			{
				if ($nb == 0)
				{
					$cols = $label;
					$vals = $value;
				}

				else
				{
					$cols .= ', '.$label;
					$vals .= ', '.$value;
				}

				$nb ++;
			}

			$query = 'INSERT INTO '.$table.'('.$cols.') VALUES ('.$vals.')';
			$this->mysqli->query($query);

			if ($result = $this->mysqli->store_result)
			{
				$result->free();
			}
		}

		public function exists($table, $label, $id)
		{
			$row = $this->select_one($table, $label, $id);

			if ($row)
				return true;

			else
				return false;
		}

		public function connect()
		{
			$this->create();
		}

		public function disconnect()
		{
			$this->close();
		}

		public function get_last_insert_id()
		{
			$query = 'SELECT LAST_INSERT_ID()';
			$this->mysqli->query($query);

			if ($result = $this->mysqli->store_result())
			{
				$row = $result->fetch_array();
				$result->free();
				return $row[0];
			}

			return null;
		}
	}