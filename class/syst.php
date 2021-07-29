<?php

	require $conf [ 'dir_commons' ] . 'libs/mle.php';
	require __DIR__ . '/log.php';
	require __DIR__ . '/storage.php';

	class system {
	
		public $conf, $log, $msl = false, $errors, $actions;
	
		function __construct() {
		
			global $conf;
	
			$this -> conf = $conf;
			$this -> log = new log ( _cfihod ( $conf, 'dir_logs', '' ) );
			$this -> events = new storage;
			$this -> errors = new storage;
			
			set_error_handler ( array ( $this-> log, 'php_error' ) );
		}
	}