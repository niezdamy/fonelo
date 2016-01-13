<?php
	require_once dirname (__FILE__).'/../config.php';
	
	require_once $conf->root_path.'/libs/messages.class.php';
    $msgs = messages::getInstance();
    
	require_once $conf->root_path.'/app/Database.class.php';
    $db = Database::getInstance();
	
    
	$action = $_REQUEST['action'];
	
	switch ($action) {
		default :

			if ( !$conf->is_session_started() ){
				session_start();
			} 
			
			if(!isset($_SESSION['logged'])){
                include_once $conf->root_path.'/app/loginCtrl.class.php';
				$tmp = new loginCtrl();
				$tmp->generateView();
				
				exit();
			}else{ 
				require_once $conf->root_path.'/app/mainPageCtrl.class.php';
	            $tmp = new mainPageCtrl();
				$tmp->generateView();
				//header("Location: ".$conf->app_url);
				//die();
			}
		break;
		
		case 'zaloguj' :
			require_once $conf->root_path.'/app/loginCtrl.class.php';
			$tmp = new loginCtrl();
			$tmp->doLogin();
		break;
		
		case 'wyloguj' :
			require_once $conf->root_path.'/app/loginCtrl.class.php';
			$tmp = new loginCtrl();
			$tmp->doLogout();
		break;
		
		case 'rejestruj' :
			require_once $conf->root_path.'/app/registerCtrl.class.php';
			$tmp = new registerCtrl();
			$tmp->generateView();
		break;
		
		case 'zarejestruj' :
			require_once $conf->root_path.'/app/registerCtrl.class.php';
			$tmp = new registerCtrl();
			$tmp->doRegister();
		break;

		case 'przypomnij' :
			require_once $conf->root_path.'/app/remindCtrl.class.php';
			$tmp = new remindCtrl();
			$tmp->generateView();
		break;

		case 'wygeneruj' :
			require_once $conf->root_path.'/app/remindCtrl.class.php';
			$tmp = new remindCtrl();
			$tmp->doRemind();
		break;
		
		case 'main' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
            $tmp = new mainPageCtrl();
			$tmp->generateView();
		break;
    
		case 'addContact' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
			$tmp = new mainPageCtrl();
			$tmp->addContact();
		break;

		case 'editContact' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
			$tmp = new mainPageCtrl();
			$tmp->editContact();
		break;
		
		case 'delContact' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
			$tmp = new mainPageCtrl();
			$tmp->delContact();
		break;

		case 'delGroup' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
			$tmp = new mainPageCtrl();
			$tmp->delGroup();
		break;

		case 'searchContact' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
			$tmp = new mainPageCtrl();
			$tmp->searchContact();
		break;



		
		case 'uploadPhoto' :
			require_once $conf->root_path.'/app/mainPageCtrl.class.php';
			$tmp = new mainPageCtrl();
			$tmp->uploadPhoto();
		break;
		
		case 'viewProfile' :
			require_once $conf->root_path.'/app/profilePageCtrl.class.php';
			$tmp = new profilePageCtrl();
			$tmp->generateView();
		break;
		
		case 'viewSettings' :
			require_once $conf->root_path.'/app/settingsPageCtrl.class.php';
			$tmp = new settingsPageCtrl();
			$tmp->generateView();
		break;
		
		case 'changeSettings' :
			require_once $conf->root_path.'/app/settingsPageCtrl.class.php';
			$tmp = new settingsPageCtrl();
			$tmp->changeSettings();
		break;
		
		case 'changeImage' :
			require_once $conf->root_path.'/app/settingsPageCtrl.class.php';
			$tmp = new settingsPageCtrl();
			$tmp->changeImage();
		break;
		
		// case 'showPresentation' :
		// 	require_once $conf->root_path.'/app/presentationPageCtrl.class.php';
		// 	$tmp = new presentationPageCtrl();
		// 	$tmp->generateView();
		// break;
		
		case 'showContact' :
			require_once $conf->root_path.'/app/contactCtrl.class.php';
			$tmp = new contactCtrl();
			$tmp->generateView();
		break;
    
  //   	case 'setTutorial' :
		// 	require_once $conf->root_path.'/app/presentationPageCtrl.class.php';
		// 	$tmp = new presentationPageCtrl();
		// 	$tmp->setTutorial();
		// break;
		
	}
?>