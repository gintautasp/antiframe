<?php

	define ( 'WORK_MODE', 'LOCAL' );
	
	define ( 'LOG_ALL_QUERIES', false );
	
	define ( 'ERROR_SCOPE_VARS', false );
	
	define ( 'DEBUG_BACKTRACE', false );

	define ( 'WWW_SERV', 'http://' . $_SERVER [ 'SERVER_NAME' ] . '/' /* . $_SERVER [ 'SERVER_NAME' ] .  '/' */ );

	// define ( 'WWW_DUSTS', 'http://' . $_SERVER [ 'SERVER_NAME' ] . '/dusts/' );
		
	$conf = array (
	
		  'dir_commons' => realpath ( DIR_MAIN . '../commons_/' ) . '/' 
		
		, 'db_name' => 'ernadas'

		, 'db_user' => 'root'

		, 'db_password' => ''

		, 'default_language' => 'lt'
		
		, 'default_timezone' => 'Europe/Vilnius'
		
		, 'dir_uploads' => realpath ( DIR_MAIN . '../uploads/' ) . '/'
        
		, 'dir_users_data' => realpath (  DIR_MAIN . '../users_data/' ) . '/'        
		
		, 'dir_logs' => realpath ( DIR_MAIN  . '../logs/' ) . '/'

		, 'key_page_selector' => 'er19'

		, 'smtp' => 'zumba.hostika.net'		
        
		, 'smtp_port' => 465        

		, 'mail_sender_email' => 'info@webtools.shared.town'

		// , 'id_menu_spec' => array()

		// , 'id_link_goods_categories' => 33		

	);

	// print_r ( $conf );

	function _link_to ( $seo_link = '' )  {
		 
		global $conf;
		return WWW_SERV . ( ( $seo_link == '' ) ? '' : ( '?' .  $conf [ 'key_page_selector' ] . '=' . $seo_link  ) );
	}   