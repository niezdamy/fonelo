<?php

	require_once 'config.class.php';
	
	$conf = new Config();
	
	$conf->server_name = 'localhost';
	//$conf->server_name = '91.231.82.96:8080';
	$conf->server_url = 'http://'.$conf->server_name;
	$conf->app_root = '/fonelo';
	$conf->app_url = $conf->server_url.$conf->app_root;
	$conf->root_path = dirname(__FILE__);
	$conf->action_root = $conf->app_root.'/app/ctrl.php?action=';
	$conf->action_url = $conf->server_url.$conf->action_root;

	ini_set( 'display_errors', 'On' ); 
	error_reporting( E_ALL & ~E_NOTICE );
	
?>