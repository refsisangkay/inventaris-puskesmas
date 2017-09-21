<?php
class Mysql {
	private $mysql;

	public function __construct() {
		global $db;

		$this->db = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
	}

	public function query($query){
		return $this->db->query($query);
	}

	public function row($query){
		return $query->fetch_object();
	}

	public function result($query){
		return $query->fetch_array();
	}

	public function error(){
		return $this->db->error;
	}
}