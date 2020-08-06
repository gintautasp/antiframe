<?php

	define ( 'SHOW_DEBUG_INFO', 1 );

	define ( 'SHOW_EXT_DEBUG_INFO', 0);

	define ( 'SITE_BORN_TIME', '1504224000000' );
	
	define ( 'DATE_START_ACCOUNTING', '2017-08-01' );
	
	error_reporting (E_ALL | E_STRICT | E_WARNING | E_PARSE | E_NOTICE ); // error_reporting ( E_ALL | E_STRICT );

	ini_set ( 'display_errors', '1' );
	
	session_start();

	include 'config_ixion.php';

	ini_set ( 'sendmail_from' , $conf [ 'mail_sender_email' ]  ); 	

	ini_set ( "SMTP", $conf [ 'smtp' ] );
    
	ini_set( 'smtp_port', $conf [ 'smtp_port' ] );    
    
	$conf [ 'allow_registration' ] = true;
	
	$conf [ 'tpl_action_result' ] = DIR_MAIN . 'views/action_result.html.php';
	
	$conf [ 'js_validate' ] = true;

	require $conf [ 'dir_commons' ] . 'class/syst.php';
	
	$_syst = new system();
    
	require $conf [ 'dir_commons' ] . 'class/systo.php';	
	
	require DIR_MAIN . 'functions.php';
    	
	require DIR_MAIN . 'functions_el_html.php';	

	require $conf [ 'dir_commons' ] . 'class/languages.php';

	$lang -> get_from_file ( $conf [ 'default_language' ], $conf [ 'dir_commons' ] . 'lang/db_mysql_user1.php', 'translations' );

	require $conf [ 'dir_commons' ] . 'libs/db_fetch.php';

	require $conf [ 'dir_commons' ] . 'class/db_mysql_user1.php';
	
	require $conf [ 'dir_commons' ] . 'class/db_ex_www.php';


?>