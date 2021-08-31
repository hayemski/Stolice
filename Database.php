<?php
	class Database {
		private $hostname = 'localhost';
		private $username = 'root';
		private $password = '';
		private $dbname;
		private $dblink;    
		private $result;    
		private $records;   
		private $affected;  
		
		function __construct($dbname) {
			$this->dbname = $dbname;
			$this->Connect();
		}
		
		public function getResult() {
			return $this->result;
		}
		
		function Connect() {
			$this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
			if($this->dblink ->connect_errno) {
			    printf('Konekcija neuspešna: %s\n', $this->dblink->connect_error);
			    exit();
			}
			$this->dblink->set_charset('utf8');
		}
		
		function select($table = "proizvodi", $columns = '*', $join_table = "", $join_key1 = "", $join_key2 = "", $where = null, $order = null) {
			$q = 'SELECT '. $columns .' FROM '. $table;  
    		if($join_table != null)
				$q .= ' JOIN ' . $join_table . ' ON ' . $table . '.' . $join_key1 . ' = ' . $join_table . '.' . $join_key2;
            if($where != null)  
                $q .= ' WHERE ' . $where;
            if($order != null)  
                $q .= ' ORDER BY ' . $order;
			$this->ExecuteQuery($q);
		}
		
		function insert($table = "proizvodi", $rows = "naziv,idtip,velicina,boja,materijal", $values) {      
			$query_values = implode(',', $values);
			$insert = 'INSERT INTO ' . $table;
            if($rows != null) {  
                $insert .= ' (' . $rows . ')';
            }  
    		$insert .= ' VALUES (' . $query_values . ')';
			if($this->ExecuteQuery($insert))
				return true;
			else 
				return false;
		}
		
		function update($table = "proizvodi", $id, $keys, $values) {
			$set_query = array();
			for($i = 0; $i < sizeof($keys); $i++) {
				$set_query[] = $keys[$i] . " = '" . $values[$i] . "'";
			}
			$set_query_string = implode(',', $set_query);
			$update = "UPDATE " . $table . " SET " . $set_query_string . " WHERE idproizvod=" . $id;
			if(($this->ExecuteQuery($update)) && ($this->affected >0))
				return true;
			else
			    return false;
		}
		
		function delete($table = "proizvodi", $keys, $values) {
			$delete = "DELETE FROM " . $table . " WHERE " . $keys[0] . " = '" . $values[0] . "'";
			if($this->ExecuteQuery($delete))
				return true;
			else
			    return false;
		}
		
		function ExecuteQuery($query) {
			if($this->result = $this->dblink->query($query)) {
				if(isset($this->result->num_rows)) 
					$this->records = $this->result->num_rows;
				if(isset($this->dblink->affected_rows)) 
					$this->affected = $this->dblink->affected_rows;
				return true;
			} else {
				return false;
			}
		}
	}
