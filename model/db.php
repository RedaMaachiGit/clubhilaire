<?php

 class DB {

  private $_servername = "mysql-yourtask.alwaysdata.net";
  private $_username = "yourtask";
  private $_password = "redareda";
  private $_dbname = "yourtask_clubhilaire";
  private $_port = "3306";
  private $_connectDB;





/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 public function getConnectDb(){
		return $this->_connectDB;
	  }

	 private function setConnectDb($connect_db) {
		 $this->_connectDB = $connect_db;
	 }

	 private function getServername(){
		 return $this->_servername;
	 }

	  private function getUsername(){
		 return $this->_username;
	 }

	  private function getDBname(){
		 return $this->_dbname;
	 }

 	 private function getPassword(){
 		 return $this->_password;
 	 }

 	 private function getPort(){
 		 return $this->_port;
 	 }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////OPEN/CLOSE///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function connect() {

    $connect_db = new mysqli( $this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDBname() , $this->getPort());

		if ( mysqli_connect_errno() ) {
			printf("Connection failed: %s\ ", mysqli_connect_error());
			exit();
		}

    $this->setConnectDb($connect_db);

	}

	public function close() {
		$this->getConnectDb()->close();
	}
 }

  ?>
