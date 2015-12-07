<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	require_once $conf->root_path.'/libs/messages.class.php';	// czy to musi być? MOgę usunąć po wprowadzeniu dobrego maina
	require_once $conf->root_path.'/app/Database.class.php';
	
	class loginCtrl{
		
		private $username;
		private $password;
		
		private $msgs;
		private $db;
		
		public function __construct(){
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			$this->db = Database::getInstance();
			//---------------------------------------------
		}
		
		public function getParams(){
			$this->username = $_REQUEST['login'];
			$this->password = $_REQUEST['password'];
		}
		
		public function validate() {
			
			if ($this->username == "") $this->msgs->addError ( 'Nie podano loginu' );
			if ($this->password == "") $this->msgs->addError ( 'Nie podano hasła' );

			if (! $this->msgs->isError ()) {
				
				//LOGOWANIE------------------------------------------------------------
				
				$this->password = hash('sha256', $this->password);
				
				try{
				$stmt = $this->db->pdo->prepare("SELECT * FROM users WHERE username=? AND password=?");  
				$stmt->bindValue(1, $this->username, PDO::PARAM_STR);  
				$stmt->bindValue(2, $this->password, PDO::PARAM_STR);  
				$stmt->execute();
				}catch(PDOException $e){
					$this->msgs->addError('Problem z logowaniem: '.$e->getMessage());
					echo ($e->getMessage());
					die();
				}
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if($stmt->rowCount()!=0){
					session_start();
					$_SESSION['logged'] = true;
          			$_SESSION['id'] = $row['user_id'];
					$_SESSION['user_login'] = $row['username'];
					//$_SESSION['user_role'] = $row['role'];
				}
				else{
					$this->msgs->addError('Niepoprawny login lub hasło');
				}
				
				//---------------------------------------------------------------------
				
			}
			
			return ! $this->msgs->isError ();
		}
		
		public function doLogin(){
			if( isset($_REQUEST['loginSubmit']) ){
			/* 
			* Check whether the action was called by a Register Button, and not by the link.
			* If action was called by link -> redirect to main page.
			*/

				global $conf;
				$this->getParams();
				if ($this->validate()){
					$return = array();
					$return[0] = 1;
					echo json_encode($return);
					exit();
				} else {
					$return = array();
					$tmp = new Smarty();
					$tmp->assign('msgs',$this->msgs);

					// Rendered html with messages which is placed before end body tag.
					$rendered = $tmp->fetch($conf->root_path.'/templates/messages.tpl');

					$return[0] = 0;
					$return[1] = $rendered;

					echo json_encode($return);
					exit();
				}

			}else{
				// Return to main page
				global $conf;
				header("Location: ".$conf->app_url."/");
			}
		}
		
		public function doLogout(){
			global $conf;
			session_start();
			session_destroy();
			header("Location: ".$conf->app_url."/");
		}
	
		public function generateView(){
			
			global $conf;
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			
			$tmp->display($conf->root_path.'/templates/login.tpl');
			
		}
	}
	
?>