<?php

	/*
	*	Klasa ta obsługuje stronę ze statystykami itp. Lecz wszystkie funkcje potrzebne do działania ( setStats ) znajdują się w klasie mainPage,
	*	ponieważ to ona głównie zajmuje się wysyłaniem danych do bazy.
	*/

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	
	class profilePageCtrl{
		
		private $msgs;
		private $db;
		
		public function __construct(){
			session_start();
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			$this->db = Database::getInstance();
			//---------------------------------------------
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
		
		public function generateView(){
			
			global $conf;
			
			$user_data = $this->getUserData();
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			if ($this->getUserData()){
				$tmp->assign('user_data',$user_data);
			}
			$tmp->inheritance_merge_compiled_includes = false;
			
			$tmp->display($conf->root_path.'/templates/profilePage/content.tpl');
			
		}
	
	}
	
?>