<?php
	require_once $conf->root_path.'/libs/messages.class.php';

	class Database{
		//SINGLETON-------------------------------------------------------
        private static $instance;
		public static function getInstance(){
			if(self::$instance == null) self::$instance = new Database();
			return self::$instance;
	    }
		//----------------------------------------------------------------
		
		private $msgs;
		public $pdo;
		
		public function __construct(){
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			//---------------------------------------------
			$this->connectDB();
		}
		
		public function connectDB(){
			
			//$mysql_host = '91.231.82.96:8080'; 
			$mysql_host = 'localhost'; 
			$username = 'root';
			$password = '';
			$database = 'fonelo';
			 
			try{
				$this->pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database, $username, $password );
				//echo 'Połączenie nawiązane!';
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				$this->msgs->addError ($e->getMessage());
				//echo 'Problem z połączeniem: '.$e->getMessage();
				die();
			}
		}
	}
	
?>