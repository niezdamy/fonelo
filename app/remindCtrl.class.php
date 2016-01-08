<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	require_once $conf->root_path.'/libs/messages.class.php';
	require_once $conf->root_path.'/app/Database.class.php';
	//include_once $conf->root_path.'/app/security/class/loginCtrl.class.php';
	
	class remindCtrl{
		
		private $msgs;
		private $db;
		
		public function __construct(){
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			$this->db = Database::getInstance();
			//---------------------------------------------
		}
		
		private $email;
		private $new_pass;
		
		public function checkUser(){
			
			$stmt = $this->db->pdo->prepare("SELECT username FROM users WHERE email=?");  
			$stmt->bindValue(1, $this->email, PDO::PARAM_STR);  
			$stmt->execute();  
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if( $stmt->rowCount()!=0 )
				return true;
			else 
				return false;
		}

		function generatePass($length){
			$uppercase = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'W', 'Y', 'Z');
			$lowercase = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'w', 'y', 'z');
			$number = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
			$chars = array('!','@','#','$','&');

			$pass = NULL;

			for ($i = 0; $i < $length; $i++) {
				$pass .= $uppercase[rand(0, count($uppercase) - 1)];
				$pass .= $lowercase[rand(0, count($lowercase) - 1)];
				$pass .= $number[rand(0, count($number) - 1)];
				$pass .= $chars[rand(0, count($chars) - 1)];
			}

			return substr($pass, 0, $length);

		}
		
		function checkPattern() {
			
			$mailPattern = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
			
			if ( !preg_match($mailPattern , $this->email) ) { 
				$this->msgs->addError( 'Wprowadziłeś zły adres email' ); 
				return 0;
			}
			
		 	return true;
		}	
		
		public function getParams(){
			$this->email = trim($_REQUEST['email']);
			$this->new_pass = $this->generatePass(8);
		}
		
		public function validate() {
				
			if (! ( isset( $this->email ) && isset( $this->new_pass ) ) ) {
				$this->msgs->addError('Błędne wywołanie aplikacji !');
			}
			if (! $this->msgs->isError()) {
				if ($this->email == "") $this->msgs->addError ( 'Nie podano adresu email.' );
			}
			
			if (! $this->msgs->isError ()) {
				try{
					if( $this->checkUser() ){
						$stmt = $this->db->pdo->prepare(
							"UPDATE `users` SET `password` = :new_pass WHERE `email` = :email"
						);
						$stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
						$stmt->bindValue(':new_pass', hash('sha256', $this->new_pass), PDO::PARAM_STR);
						$stmt->execute();
					}
					else $this->msgs->addError('Taki adres email nie jest zarejestrowany w systemie.');
				}catch(PDOException $e){
					$this->msgs->addError('Problem z wygenerowaniem hasła: '.$e->getMessage());
					die();
				}
				
			}
			return ! $this->msgs->isError();
		}
		
		public function doRemind(){
			/*
			* The function generate new password with AJAX.
			* Function returns JSON data in the form of a table, which is use in script.js to manage html content.
			*/

			if( isset($_REQUEST['remind']) ){
			/* 
			* Check whether the action was called by a Remind Button, and not by the link.
			* If action was called by link -> redirect to main page.
			*/

				global $conf;
				$this->getParams();
				
				if ( $this->validate() ){

					$this->msgs->addInfo ( 'Nowe wygenerowane hasło: <span style="font-size: 26px; margin:auto 30px;">'.$this->new_pass.'</span> Zaloguj się!' );
					
					$stmt = $this->db->pdo->prepare("UPDATE `users` SET `invalid_pass` = 0 WHERE email=? ");
					$stmt->bindValue(1, $this->email, PDO::PARAM_STR); 
					$stmt->execute();

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
					$tmp->assign('msgs',$this->msgs); // Error messages are assigneg in validate() function.

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
			/*
			 * Generate only Content
			 */

			global $conf;
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			//$tmp->assign('new_pass',$this->new_pass);
			
			$tmp->display($conf->root_path.'/templates/remind_ajax.tpl');
			
		}
	
		public function generateFullView(){
			/*
			 * Generate full HTML
			 */
			global $conf;
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			//$tmp->assign('new_pass',$this->new_pass);
			
			$tmp->display($conf->root_path.'/templates/remind.tpl');
		}

	}
	
?>