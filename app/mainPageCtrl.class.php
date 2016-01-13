<?php

	require_once $conf->root_path.'/libs/smarty/Smarty.class.php';
	require_once $conf->root_path.'/libs/messages.class.php';
	
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
		
		private $name;
		private $surname;
		private $telephone;
		private $street;
		private $postcode;
		private $city;		
		private $group_name;

		private $edit_id;
        
		public function getParams(){
			
			$this->name = $_REQUEST['inputName'];
			$this->surname = $_REQUEST['inputSurname'];
      		$this->telephone = $_REQUEST['inputTelephone'];
			$this->street = $_REQUEST['inputStreet'];
			$this->postcode = $_REQUEST['inputPostcode'];
			$this->city = $_REQUEST['inputCity'];
			
			if ( $_REQUEST['inputGroup'] != 'addNew')
				$this->group_name = $_REQUEST['inputGroup'];
			else $this->group_name = $_REQUEST['inputNewGroup'];
			
		}
		
		
		/* Funkcja dodająca kontakt do bazy */
		public function addContact() {

			global $conf;
			$this->getParams();
			
			if(isset($_POST['send'])){ // Sprawdzenie czy został wciśnięty przycisk wysłania kontaktu do bazy danych
				
				// Sprawdzenie czy pola zostały wypełnione
				if (! ( isset($this->name) && isset($this->surname) && isset($this->telephone) && isset($this->street) && isset($this->postcode) && isset($this->city) )) {
					$this->msgs->addError('Błędne wywołanie aplikacji!');
				}
				if (! $this->msgs->isError ()) {
					try{

						$stmt = $this->db->pdo->prepare(
							"INSERT INTO contacts (
								owner_id, 
								name, 
								surname, 
								telephone,
								street, 
								postcode, 
								city,
								group_name
							)VALUES (
								:owner_id, 
								:name, 
								:surname, 
								:telephone,
								:street, 
								:postcode, 
								:city,
								:group_name)"
						);
						$stmt->bindValue(':owner_id', $_SESSION['id'], PDO::PARAM_INT);
						$stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
						$stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
						$stmt->bindValue(':telephone', $this->telephone, PDO::PARAM_STR);
						$stmt->bindValue(':street', $this->street, PDO::PARAM_STR);
						$stmt->bindValue(':postcode', $this->postcode, PDO::PARAM_STR);
						$stmt->bindValue(':city', $this->city, PDO::PARAM_STR);
						$stmt->bindValue(':group_name', $this->group_name, PDO::PARAM_STR);
						$stmt->execute();

						if ( $stmt->rowCount() != 0 ) 
							$this->msgs->addInfo('Pomyślnie dodano kontakt.');
						else
							$this->msgs->addError( 'Błąd w dodawaniu kontaktu.');

					}catch(PDOException $e){
						$this->msgs->addError('Problem z dodaniem kontaktu: '.$e->getMessage());
						die();
					}
					
				}
			}
			$this->generateView(); 
		}

		
	/* Funkcja edytująca kontakt w bazie */
	public function editContact() {
		if(isset($_POST['edit-contact'])){
			
			$this->getParams();
			
			if (! $this->msgs->isError ()) {
				try{
					
					$stmt = $this->db->pdo->prepare("UPDATE `contacts` SET 
						`name` = :name,
						`surname` = :surname,
						`telephone` = :telephone,
						`street` = :street, 
						`postcode` = :postcode,
						`city` = :city
						WHERE `id_contact` = :id_contact");

					$stmt->bindValue(':id_contact', $_POST['edit-contact'], PDO::PARAM_INT);
					$stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
					$stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
					$stmt->bindValue(':telephone', $this->telephone, PDO::PARAM_STR);
					$stmt->bindValue(':street', $this->street, PDO::PARAM_STR);
					$stmt->bindValue(':postcode', $this->postcode, PDO::PARAM_STR);
					$stmt->bindValue(':city', $this->city, PDO::PARAM_STR);
					$stmt->execute(); 

					// Sprawdzanie czy kontakt nie został już usunięty
					if ( $stmt->rowCount() != 0 ) 
						$this->msgs->addInfo('Dane zostały zmienione.');
					else
						$this->msgs->addError( 'Błąd w zmianie danych.');
					
				}catch(PDOException $e){
					$this->msgs->addError('Problem z edycją: '.$e->getMessage());
				}
				
			}
		}
		$this->generateView(); 
	}
	
	/* Funkcja usuwająca kontakt z bazy */
	public function delContact(){
		global $conf;
		
		try{
			$stmt = $this->db->pdo->prepare("SELECT * FROM contacts WHERE owner_id=:user ORDER BY `id_contact` DESC");  
			$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
			$stmt->execute();
		}catch(PDOException $e){
			$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
		}

		if ($_POST['id_contact']){
			try{
				$stmt = $this->db->pdo->prepare("DELETE FROM `contacts` WHERE `id_contact` = :id_contact");
				$stmt->bindValue(':id_contact', $_POST['id_contact'], PDO::PARAM_INT);  
				$stmt->execute();

				// Sprawdzanie czy kontakt nie został już usunięty
				if ( $stmt->rowCount() != 0 ) 
					$this->msgs->addInfo( 'Pomyślnie usunęto kontakt.'.$stmt->rowCount() );
				else
					$this->msgs->addError( 'Kontakt został już wcześniej usunięty.' );
				
				$this->generateView();

			}catch(PDOException $e){
				$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
			}
			
		}else{
			$this->msgs->addError('Nieprawidłowe wywołanie aplikacji');
		}
	}

	public function getContacts(){
		try{
			$stmt = $this->db->pdo->prepare("SELECT * FROM contacts WHERE owner_id=:user ORDER BY `id_contact` DESC");  
			$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
			$stmt->execute();
		}catch(PDOException $e){
			$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
		}
		if($stmt->rowCount()!=0) return $stmt->fetchAll(PDO::FETCH_ASSOC);	
		else return 0;
	}

	public function searchContact(){
		$search = $_POST['search-query'];
		try{
			
			$stmt = $this->db->pdo->prepare('SELECT * FROM contacts WHERE 
				name LIKE :name OR
				surname LIKE :surname OR 
				telephone LIKE :telephone OR 
				street LIKE :street OR 
				postcode LIKE :postcode OR 
				city LIKE :city OR
				group_name LIKE :group'
			);
			$name = "%".$search."%";
			$surname = "%".$search."%";
			$telephone = "%".$search."%";
			$street = "%".$search."%";
			$postcode = "%".$search."%";
			$city = "%".$search."%";
			$group = "%".$search."%";

			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
			$stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
			$stmt->bindParam(':street', $street, PDO::PARAM_STR);
			$stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
			$stmt->bindParam(':city', $city, PDO::PARAM_STR);
			$stmt->bindParam(':group', $group, PDO::PARAM_STR);
			$stmt->execute();

		}catch(PDOException $e){
			$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
			echo $e->getMessage();
		}
		if($stmt->rowCount()!=0){
			$return = $stmt->fetchAll(PDO::FETCH_ASSOC);	
			echo json_encode($return);
			exit();
		}
		else{
			echo json_encode(NULL);
			exit();
		};
	}

	public function getAllGroups(){
		try{
			// SELECT DISTINCT(Date) AS Date FROM buy ORDER BY Date DESC;
			$stmt = $this->db->pdo->prepare("SELECT DISTINCT(group_name) FROM contacts"); 
			$stmt->execute();
		}catch(PDOException $e){
			$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
		}  
		if($stmt->rowCount()!=0){
			return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
		} 
		else return 0;
	}

	/* Funkcja usuwająca grupę z bazy */
	public function delGroup(){
		global $conf;
		
		// try{
		// 	$stmt = $this->db->pdo->prepare("SELECT * FROM contacts WHERE owner_id=:user ORDER BY `id_contact` DESC");  
		// 	$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
		// 	$stmt->execute();
		// }catch(PDOException $e){
		// 	$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
		// }

		if ($_POST['group_name']){
			try{
				$stmt = $this->db->pdo->prepare("DELETE FROM `contacts` WHERE owner_id=:user AND `group_name` = :group_name");
				$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);  
				$stmt->bindValue(':group_name', $_POST['group_name'], PDO::PARAM_STR);  
				$stmt->execute();

				// Sprawdzanie czy kontakt nie został już usunięty
				if ( $stmt->rowCount() != 0 ) 
					$this->msgs->addInfo( 'Pomyślnie usunęto grupę.'.$stmt->rowCount() );
				else
					$this->msgs->addError( 'Grupa została już wcześniej usunięta.' );
				
				$this->generateView();

			}catch(PDOException $e){
				$this->msg->addError('Wystąpił nieoczekiwany problem'.$e->getMessage());
			}
			
		}else{
			$this->msgs->addError('Nieprawidłowe wywołanie aplikacji');
		}
	}


	
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
			
			$contact_data = $this->getContacts();
			$groups = $this->getAllGroups();
			$user_data = $this->getUserData();
			
			$tmp = new Smarty();
			$tmp->assign('conf',$conf);
			$tmp->assign('msgs',$this->msgs);
			
			if ($contact_data){
				$tmp->assign('contact_data',$contact_data);
			}

			if ($groups){
				$tmp->assign('groups',$groups);
			}

			if ($user_data){
				$tmp->assign('user_data',$user_data);
			}

			$tmp->inheritance_merge_compiled_includes = false;
			
			$tmp->display($conf->root_path.'/templates/mainPage/content.tpl');
            
			
		}
	/*-------------------------------------------------------------------------------------------------------------------------------*/
	

	


	}
	
?>