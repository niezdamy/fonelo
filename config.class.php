<?php

	class Config{
		public $server_name;
		public $server_url;
		public $app_root;
		public $app_url; 
		public $root_path;
		public $action_root;
		public $action_url;

		public function is_session_started(){
		    if ( php_sapi_name() !== 'cli' ) {
		        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
		            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
		        } else {
		            return session_id() === '' ? FALSE : TRUE;
		        }
		    }
		    return FALSE;
		}
	}
	
?>