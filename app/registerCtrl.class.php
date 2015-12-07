<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	require_once $conf->root_path.'/libs/messages.class.php';
	require_once $conf->root_path.'/app/Database.class.php';
	
	class registerCtrl{
		
		private $msgs;
		private $db;
		
		public function __construct(){
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			$this->db = Database::getInstance();
			//---------------------------------------------
		}
		
		private $username;
		private $email;
		private $password;
		private $password2;
		
		public function checkUser(){
			
			$stmt = $this->db->pdo->prepare("SELECT username FROM users WHERE username=? OR email=?");  
			$stmt->bindValue(1, $this->username, PDO::PARAM_STR); 
			$stmt->bindValue(2, $this->email, PDO::PARAM_STR);  
			$stmt->execute();  
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if( $stmt->rowCount()!=0 )
				return 0;
			else 
				return 1;
		}
		
		function  checkPattern() {
			
			$mailPattern = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
			$loginPattern = '^[a-zA-Z0-9]+$^';
			
			if (!preg_match($mailPattern , $this->email)) { $this->msgs->addError( 'Wprowadziłeś zły adres email' ); return 0;}
			if (!preg_match($loginPattern , $this->username)) { $this->msgs->addError( 'Nazwa użytkownika zawiera niedozwolone znaki.' ); return 0;}
			
		 	return true;
		}
		
		public function getParams(){
			
			$this->username = trim($_REQUEST['username']);
			$this->email = trim($_REQUEST['email']);
			$this->password = trim($_REQUEST['password']);
			$this->password2 = trim($_REQUEST['password2']);
		}
		
		public function validate() {

			if (! (isset ( $this->username ) && isset ( $this->email ) && isset ( $this->password ) && isset ( $this->password2 ))) {
				$this->msgs->addError('Błędne wywołanie aplikacji !');
			}
			if (! $this->msgs->isError()) {
				if ($this->username == "") $this->msgs->addError ( 'Nie podano nazwy użytkownika.' );
				if ($this->email == "") $this->msgs->addError ( 'Nie podano adresu email.' );
				if ($this->password == "") $this->msgs->addError ( 'Nie podano hasła.' );
				if ($this->password2 == "") $this->msgs->addError ( 'Nie potwierdzono hasła.' );
			}
			if (! $this->msgs->isError ()) {
				$this->checkPattern();
				if((strlen($this->username)<3) || (strlen($this->username)>15)) $this->msgs->addError ('Login musi zawierać od 3 do 15 znaków.');
				if((strlen($this->password)<5) || (strlen($this->password)>20)) $this->msgs->addError ('Hasło musi zawierać od 5 do 20 znaków.');
				if ($this->password != $this->password2) $this->msgs->addError ( 'Podane hasła nie są takie same!' );
					else $this->password = hash('sha256', $this->password);
			}
			
			if (! $this->msgs->isError ()) {
				try{
					if($this->checkUser()){
						$stmt = $this->db->pdo->prepare(
							"INSERT INTO `users` (
								`username`, 
								`email`, 
								`password`) 
							 VALUES (
							 	:username, 
							 	:email, 
							 	:password)"
						);
						$stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
						$stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
						$stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
						$stmt->execute();
					}
					else $this->msgs->addError('Podana nazwa użytkownika lub login już istnieje w bazie.');
				}catch(PDOException $e){
					$this->msgs->addError('Problem z rejestracją: '.$e->getMessage());
					die();
				}
				
			}
			return ! $this->msgs->isError ();
		}
		
		public function doRegister(){
			/*
			* The function registers the user with AJAX.
			* Function returns JSON data in the form of a table, which is use in script.js to manage html content.
			*/

			if( isset($_REQUEST['register']) ){
			/* 
			* Check whether the action was called by a Register Button, and not by the link.
			* If action was called by link -> redirect to main page.
			*/

				global $conf;
				$this->getParams();
				
				if ( $this->validate() ){

					$this->msgs->addInfo ( 'Konto zostało utworzone. Możesz się zalogować.' );

					$tmp = new Smarty();
					$tmp->assign('conf',$conf);
					$tmp->assign('msgs',$this->msgs);

					// Rendered html which is placed in a login wrapper.
					$rendered = $tmp->fetch($conf->root_path.'/templates/login_ajax.tpl');
					// Rendered html with messages which is placed before end body tag.
					$messages = $tmp->fetch($conf->root_path.'/templates/messages.tpl');
					
					$return = array();
					$return[0] = 1;
					$return[1] = $rendered;
					$return[2] = $messages;

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
		
		public function generateView(){
			
			global $conf;
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			
			$tmp->display($conf->root_path.'/templates/register.tpl');
			
		}
	
		
	}
	
?>