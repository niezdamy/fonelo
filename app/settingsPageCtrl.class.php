<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	
	class settingsPageCtrl{
		
		private $msgs;
		private $db;
		
		private $user_data;
		
		public function __construct(){
			session_start();
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			$this->db = Database::getInstance();
			//---------------------------------------------
			
			$this->user_data = $this->getUserData();
		}
		
		private $password;
		private $password2;
		private $seniority;
		private $target;
		private $text;
		private $main_image;
		
		public function getParams(){
			
			$this->password = trim($_REQUEST['formPassword']);
			$this->password2 = trim($_REQUEST['formPassword2']);
			$this->seniority = $_REQUEST['formSeniority'];
			$this->target = $_REQUEST['formTarget'];
			$this->text = $_REQUEST['formText'];
			$this->main_image = $_REQUEST['formImage'];
		}
		
		public function getUserData(){
			try{
				$stmt = $this->db->pdo->prepare("SELECT * FROM users WHERE user_id=:user");  
				$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
				$stmt->execute();
			}catch(PDOException $e){
				$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
			}  
			if($stmt->rowCount()!=0) return $stmt->fetch(PDO::FETCH_ASSOC);	
			else return 0;
		}
		
		public function changeImage(){
			try{
				$this->main_image = $_REQUEST['formImage'];
				if (isset($this->main_image)){
					if ($this->main_image != $this->user_data['main_image']){
						$stmt = $this->db->pdo->prepare("UPDATE `users` SET 
							`main_image` = :main_image 
							WHERE `user_id` = :user_id");
						$stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
						$stmt->bindValue(':main_image', $this->main_image, PDO::PARAM_INT);
						$stmt->execute();
						$this->msgs->addInfo('Zdjęcie zostało zmienione');
					} else $this->msgs->addInfo('Wybrałeś zdjęcie, które aktualnie jest Twoim głównym zdjęciem');
				}else $this->msgs->addError('Błędne wywołanie aplikacji');
				$this->generateView();
			}catch(PDOException $e){
				$this->msgs->addError('Problem ze zmianą zdjęcia: '.$e->getMessage());
			}
		}
		
		public function validate() {
			if(isset($_POST['changeSettings'])){
				
				$this->getParams();
				
				if (isset($this->password) && ($this->password !="") && ($this->password2 !="")) {
					if((strlen($this->password)<5) || (strlen($this->password)>20)) $this->msgs->addError ('Hasło musi zawierać od 5 do 20 znaków.');
					if ($this->password != $this->password2) $this->msgs->addError ( 'Podane hasła nie są takie same!' );
						else $this->password = hash('sha256', $this->password);
				}
				
				if ($this->user_data['seniority'] != $this->seniority) $this->msgs->addInfo('Zaktualizowano seniority.');
				if ($this->user_data['target'] != $this->target) $this->msgs->addInfo('Zaktualizowano cel.');
				if (($this->user_data['text'] != $this->text)) $this->msgs->addInfo('Zaktualizowano opis profilu.');
				
				if (! $this->msgs->isError ()) {
					try{
						$stmt = $this->db->pdo->prepare("UPDATE `users` SET 
							`password` = :password,
							`seniority` = :seniority,
							`target` = :target,
							`text` = :text 
							WHERE `user_id` = :user_id");
						$stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
						$stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
						$stmt->bindValue(':seniority', $this->seniority, PDO::PARAM_STR);
						$stmt->bindValue(':target', $this->target, PDO::PARAM_STR);
						$stmt->bindValue(':text', $this->text, PDO::PARAM_STR);
						$stmt->execute(); 
						
					}catch(PDOException $e){
						$this->msgs->addError('Problem ze zmianą ustawień: '.$e->getMessage());
					}
					
				}
			return ! $this->msgs->isError ();
			}
			return 0;
		}
		
		public function changeSettings(){
			global $conf;
			if ($this->validate()){
				$this->msgs->addInfo('Ustawienia zostały zmienione');
				$this->generateView(); 
			} else {
				$this->generateView(); 
			}
		}
		
		public function generateView(){
			
			global $conf;
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			$tmp->assign('user_data',$this->user_data);
			
			$tmp->inheritance_merge_compiled_includes = false;
			
			$tmp->display($conf->root_path.'/templates/settingsPage/content.tpl');
			
		}
	
	}
	
?>