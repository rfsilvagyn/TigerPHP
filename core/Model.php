<?php
class Model {

	protected $db;
	protected $dbradius;

	public function __construct() {
		global $db;
		global $dbradius;
		$this->db = $db;
		$this->dbradius = $dbradius;
	}

}
?>
