<?php
    
	//1: Wczytanie pliku config
	require_once dirname(__FILE__).'/config.php';
    
    //2: Wczytanie kontrolera. Po wczytaniu configa mamy dostęp do obiektu conf
	include $conf->root_path.'/app/ctrl.php';
    
    // NIE ZDAMY <3
    
?>