<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	require_once $conf->root_path.'/libs/messages.class.php';	// czy to musi być? MOgę usunąć po wprowadzeniu dobrego maina
	//require_once $conf->root_path.'/app/Database.class.php';
	//include_once $conf->root_path.'/app/security/class/loginCtrl.class.php';
	
	class mainPageCtrl{
		
		private $msgs;
		private $db;
		
		public function __construct(){
			session_start();
			//SINGLETON------------------------------------
			$this->msgs = messages::getInstance();
			$this->db = Database::getInstance();
			//---------------------------------------------
        }
		
		private $training_date;
		private $training_duration;
		private $hearth_rate;
		private $burned_callories;
		private $biceps_size;
		private $weight;
		private $description;
		private $progress;
		
		private $seniority;
		
		private $total_trainings;
		private $total_kcal;
		private $kcal_per_workout ;
		private $burned_hamb;
		
        
		public function getParams(){
			
			$this->training_date = $_REQUEST['formDate'];
			$this->training_duration = $_REQUEST['formDuration'];
      		$this->hearth_rate = $_REQUEST['formHR'];
			$this->burned_callories = $_REQUEST['formCallories'];
			$this->biceps_size = $_REQUEST['formSize'];
			$this->weight = $_REQUEST['formWeight'];
			$this->description = $_REQUEST['formDescription'];
		}
		
		
	/*--Funkcja wysyłająca dane do bazy danych ------------------------------------------------------------------------------------*/
		public function validate() {
			
			if(isset($_POST['send'])){		// Sprawdzenie czy został wciśnięty przycisk wysłania treningu do bazy danych
				if (! (isset ( $this->training_date ) && isset ( $this->training_duration ))) {
					$this->msgs->addError('Błędne wywołanie aplikacji!');
				}
				if (! $this->msgs->isError()) {
					if ($this->training_date == "") $this->msgs->addError ( 'Nie podano daty treningu.' );
					if ($this->training_duration == "") $this->msgs->addError ( 'Nie podano czasu trwania treningu.' );
				}
				if (! $this->msgs->isError ()) {
					$this->setProgress('add');	// Ustawienie odpowiedniego progresu. Funkcja SetProgress ustawia progres przed wysłaniem do bazy.
					try{
						$stmt = $this->db->pdo->prepare(
							"INSERT INTO trainings (
								user, 
								date, 
								duration, 
								hr,
								callories, 
								size, 
								weight, 
								description
							)VALUES (
								:user, 
								:date, 
								:duration, 
								:hr,
								:callories, 
								:size, 
								:weight, 
								:description)"
						);
						$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);
						$stmt->bindValue(':date', $this->training_date, PDO::PARAM_STR);
						$stmt->bindValue(':duration', $this->training_duration, PDO::PARAM_STR);
						$stmt->bindValue(':hr', $this->hearth_rate, PDO::PARAM_INT);
						$stmt->bindValue(':callories', $this->burned_callories, PDO::PARAM_INT);
						$stmt->bindValue(':size', $this->biceps_size, PDO::PARAM_INT);
						$stmt->bindValue(':weight', $this->weight, PDO::PARAM_INT);
						$stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
						$stmt->execute();
					}catch(PDOException $e){
						$this->msgs->addError('Problem z dodaniem treningu: '.$e->getMessage());
						echo ('Problem z dodaniem treningu: '.$e->getMessage());
						die();
					}
					
				}
				return ! $this->msgs->isError ();
			}
			return 0;
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
		
		
	/*-------------------------------------------------------------------------------------------------------------------------------*/	
		function  checkPattern() {
			
			$check=true;
			$checkInf=false;
			
			$datePattern = '/^(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](19|20)\d\d$/';
			$durationPattern = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/';
			$HRPattern = '/^[0-9]{2,3}|[0-9]{0}$/';
			$kcalPattern = '/^[0-9]{1,4}|[0-9]{0}$/';
			$sizePattern = '/^[0-9]{2,3}|[0-9]{0}$/';
			$weightPattern = '/^[0-9]{2,3}|[0-9]{0}$/';
			
			if (!preg_match($datePattern , $this->training_date)) { 
				$this->msgs->addError( 'Zły format daty lub jej brak.' ); $check = false;
			}
			if (!preg_match($durationPattern , $this->training_duration)) { 
				$this->msgs->addError( 'Zły format czasu trening lub jego brak.' ); $check = false;
			}
			
			if (isset($this->hearth_rate)){
				if (!preg_match($HRPattern , $this->hearth_rate)) { 
					$this->msgs->addError( 'Zły format tętna.' ); $check = false; 
				}
			}
			
			if (isset($this->burned_callories)){
				if (!preg_match($kcalPattern , $this->burned_callories)) { 
					$this->msgs->addError( 'Zły format spalonych kalorii.' ); $check = false;
				}
			}
			
			if (isset($this->biceps_size)){
				if (!preg_match($sizePattern , $this->biceps_size)) { 
					$this->msgs->addError( 'Zły format rozmiaru bica.' ); $check = false;
				}
			}
			
			if (isset($this->weight)){
				if (!preg_match($weightPattern , $this->weight)) { 
					$this->msgs->addError( 'Zły format wagi.' ); $check = false;
				}
			}
			
			$tab = Array('hearth_rate', 'burned_callories', 'biceps_size', 'weight', 'description');
			foreach ($tab as $value){
				if($this->$value==""){$checkInf = true; break;}
			}
			
			if($checkInf)
				$this->msgs->addInfo( 'Brak jednego z dodatkowych parametrów. Pomagają one w precyzowaniu Twoich osiągnięć. Następnym razem o nich pamiętaj!' );
			
      		return $check;
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
		
	/*Główna funkcja wysyłająca dane z formularza do bazy danych.--------------------------------------------------------------------*/
		public function addWorkout(){
			global $conf;
			$this->getParams();												// Pobranie parametrów z formularza.
			$this->checkPattern();											// Walidacja parametrów
			if ($this->validate()){											// Wysłanie do bazy
				$this->setStats('add');											// Ustawienie statystyk. Funkcja dodaje dane do tabeli Userów.										
				$this->msgs->addInfo( 'Pomyślnie dodano trening.' );
				$this->generateView();
				//header("Location: ".$conf->app_url."/");
			} else {
				$this->generateView(); 
			}
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
	
	/*Główna funkcja wysyłająca dane z formularza do bazy danych.--------------------------------------------------------------------*/
		public function delWorkout(){
			global $conf;
			
			if ($_POST['id_training']){
				$this->setStats('del');
				$this->setProgress('del');
				
				$stmt = $this->db->pdo->prepare("DELETE FROM `trainings` WHERE `id_training` = :id_training");
				$stmt->bindValue(':id_training', $_POST['id_training'], PDO::PARAM_INT);  
				$stmt->execute();
				
				$this->msgs->addInfo( 'Pomyślnie usunęto trening.' );
				$this->generateView();
				
			}else $this->msgs->addError('Nieprawidłowe wywołanie aplikacji');
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
		
	/*-------------------------------------------------------------------------------------------------------------------------------*/	
		public function getWorkouts(){
			try{
				$stmt = $this->db->pdo->prepare("SELECT * FROM trainings WHERE user=:user ORDER BY `id_training` DESC");  
				$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
				$stmt->execute();
			}catch(PDOException $e){
				$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
			}
			if($stmt->rowCount()!=0) return $stmt->fetchAll(PDO::FETCH_ASSOC);	
			else return 0;
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
	/*-------------------------------------------------------------------------------------------------------------------------------*/	
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
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
	
	/*-------------------------------------------------------------------------------------------------------------------------------*/	
		public function setStats($type){
			
			$result = $this->getUserData();
			
			if ($type == 'add') {			
				$this->total_trainings = $result['total_trainings'] + 1;						
				$this->total_kcal = $result['total_kcal'] + $this->burned_callories;			
				$this->kcal_per_workout =  round($this->total_kcal/$this->total_trainings, 2);		
				$this->burned_hamb = round($this->total_kcal/500, 2);
			}
			
			
			if ($type == 'del') {	
				if ($_POST['id_training']){
					try{
						$stmt = $this->db->pdo->prepare("SELECT * FROM trainings WHERE id_training=:id_training");  
						$stmt->bindValue(':id_training', $_POST['id_training'], PDO::PARAM_INT);  
						$stmt->execute();
						$result1 = $stmt->fetch(PDO::FETCH_ASSOC);
					}catch(PDOException $e){
						$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
					}
					$this->total_trainings = $result['total_trainings'] - 1;						
					$this->total_kcal = $result['total_kcal'] - $result1['callories'];			
					$this->kcal_per_workout =  round(($result['total_kcal'] - $result1['callories'])/($result['total_trainings'] - 1), 2);		
					$this->burned_hamb = round(($result['total_kcal'] - $result1['callories'])/500, 2);
				}
			}
								
			
			try{	/*AKTUALIZACJA STATYSTYK*/
				$stmt = $this->db->pdo->prepare("UPDATE `users` SET 
					`total_trainings` = :total_trainings,
					`total_kcal` = :total_kcal,
					`kcal_per_workout` = :kcal_per_workout,
					`burned_hamb` = :burned_hamb 
					WHERE `user_id` = :user_id");
				$stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
				$stmt->bindValue(':total_trainings', $this->total_trainings, PDO::PARAM_INT);
				$stmt->bindValue(':total_kcal', $this->total_kcal, PDO::PARAM_INT);
				$stmt->bindValue(':kcal_per_workout', $this->kcal_per_workout, PDO::PARAM_INT);
				$stmt->bindValue(':burned_hamb', $this->burned_hamb, PDO::PARAM_INT);
				$stmt->execute(); 
			}catch(PDOException $e){
				$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());	
			}
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
		
	/*-------------------------------------------------------------------------------------------------------------------------------*/
		public function setProgress($type){
			/*
			*	Funkcja ta ustawia odpowiednie parametry dla tworzenia postępu, które są uzależnione od stażu.
			*	Funkcja wywoływana jest w funkcji validate (przesyłu danych)
			*/
			try{ /*POBRANIE AKTUALNEGO PROGRESSU*/
				$stmt = $this->db->pdo->prepare("SELECT progress FROM users WHERE user_id=:user");  
				$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
				$stmt->execute();  
				if($stmt->rowCount()!=0){
					
					$result = $stmt->fetch(PDO::FETCH_BOTH);
					$this->progress= $result['progress'];
					try{/*POBRANIE STAŻU W CELU ODPOWIEDNIEGO SKALOWANIA*/
						$stmt = $this->db->pdo->prepare("SELECT seniority FROM users WHERE user_id=:user");  
						$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
						$stmt->execute();  
						if($stmt->rowCount()!=0){
							
							$result = $stmt->fetch(PDO::FETCH_BOTH);
							$this->seniority= $result['seniority'];
							
							if ($type =='add'){
								switch ($this->seniority) {
									case 'Amateur':
										$this->progress = $this->progress+1.5 ;
										break;
									case 'Semi-professional':
										$this->progress = $this->progress+1 ;
										break;
									case 'Professional':
										$this->progress = $this->progress+0.7 ;
										break;
									case 'World class':
										$this->progress = $this->progress+0.5 ;
										break;
									case 'Legendary':
										$this->progress = $this->progress+0.3 ;
										break;
								}
							}
							
							if ($type =='del'){
								switch ($this->seniority) {
									case 'Amateur':
										$this->progress = $this->progress-1.5 ;
										break;
									case 'Semi-professional':
										$this->progress = $this->progress-1 ;
										break;
									case 'Professional':
										$this->progress = $this->progress-0.7 ;
										break;
									case 'World class':
										$this->progress = $this->progress-0.5 ;
										break;
									case 'Legendary':
										$this->progress = $this->progress-0.3 ;
										break;
								}
							}
							
							try{/*AKTUALIZACJA PROGRESSU*/
								$stmt = $this->db->pdo->prepare("UPDATE `users` SET `progress` = :progress WHERE `user_id` = :user");
								$stmt->bindValue(':progress', $this->progress, PDO::PARAM_INT);  
								$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
								$stmt->execute(); 
							}catch(PDOException $e){
								$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());	
							}
							
						}
					}catch(PDOException $e){
						$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());	
					}
					
				}
			}catch(PDOException $e){
				$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
			}
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
		
		
	/*-------------------------------------------------------------------------------------------------------------------------------*/
		public function uploadPhoto(){
			global $conf;
			
			$plik_tmp = $_FILES['plik']['tmp_name'];
			$plik_nazwa = $_FILES['plik']['name'];
			$plik_rozmiar = $_FILES['plik']['size'];
			
			if(is_uploaded_file($plik_tmp)) {
				$meta = pathinfo($plik_nazwa);
				$ext = $meta['extension'];
				if ($ext =="jpg")
				{
					$stmt = $this->db->pdo->prepare("UPDATE `users` SET `avatar` = :avatar WHERE `user_id` = :user");
					$stmt->bindValue(':avatar', $_SESSION['user_login'], PDO::PARAM_STR);  
					$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
					$stmt->execute();
					
					move_uploaded_file($plik_tmp, "../images/profile_photos/".$_SESSION['user_login'].".jpg");
					$this->msgs->addinfo('Plik został dodany pomyślnie');
				}
				else $this->msgs->addError('Nieprawidłowe rozszerzenie pliku.');
			}else $this->msgs->addError('Wystąpił problem z dodaniem pliku. Prawdopodobnie plik nie spełnia wymogów.');
			
			$this->generateView();
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
	
	/*-------------------------------------------------------------------------------------------------------------------------------*/	
		public function generateView(){
			
			global $conf;
			
			$workout_data = $this->getWorkouts();
			$user_data = $this->getUserData();
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			
			if ($this->getWorkouts()){
				$tmp->assign('workout_data',$workout_data);
			}
			if ($this->getUserData()){
				$tmp->assign('user_data',$user_data);
			}
			$tmp->inheritance_merge_compiled_includes = false;
			
			$tmp->display($conf->root_path.'/templates/mainPage/content.tpl');
            
			
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	
	}
	
?>