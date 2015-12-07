<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	
	class contactCtrl{
		
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
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			$tmp->assign('user_data',$this->user_data);
			
			$tmp->inheritance_merge_compiled_includes = false;
			
			$tmp->display($conf->root_path.'/templates/contactPage/content.tpl');
			
		}
	
	}
	
?>