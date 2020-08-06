<?php
		
	define ( 'DIR_MAIN', dirname ( __FILE__  ) . '/' );
	
	require DIR_MAIN . 'config.php';

	$db = new db_ex_www ( $conf [ 'db_name' ], $conf [ 'db_user' ], $conf [ 'db_password' ], LOG_ALL_QUERIES );

	require $conf [ 'dir_commons' ] . 'class/struct.php';

	// require $conf [ 'dir_commons' ] . 'class/request.php';

	// include DIR_MAIN . 'class/request.class.php';

	// $rq = new request_dis();
	
	// include DIR_MAIN . 'map_scripts.php';

	// $rq -> find_source ( $map_scripts );

	// require $conf [ 'dir_commons' ] . 'class/response.php';

         /*                                                                                                                                                                   //  echo DIR_MAIN . '<br>';
	if ( $rq -> response -> fields() -> name_mode == NAME_MODE_HTML ) {
	
		require  $conf [ 'dir_commons' ] . 'class/html_page.php';
		require 'class/admin_page.class.php';
            
		$resp = new dis_page();
		$resp -> lang = $conf [ 'default_language' ];
		$resp -> reg_visits();
        			
		require $conf [ 'dir_addons' ] . 'users/settings.php';
		include $conf [ 'dir_commons' ] . 'class/modelx.sat_lang.php';
		require $conf [ 'dir_addons' ] . 'users/user_min.php';
		$er_user = new user_min ();	
        
		require 'class/controller_small.class.php';
		
	} else $resp = new response();
	*/    
 /*
                                                                                                                                                                                
                                                                                                                                                                                                                                                echo '<b> rq / response / fields() </b>:<br><pre>';
                                                                                                                                                                                                                                                print_r ( $rq -> response -> fields() ); echo '</pre><br>';
                                                                                                                                                                                                                                                echo '<b> conf </b>:<br><pre>';    
                                                                                                                                                                                                                                                print_r ( $conf ); echo '</pre><br>';
                                                                                                                                                                                                                                                echo '<b> rq / location </b>:<br><pre>';        
                                                                                                                                                                                                                                                echo $rq -> location .'<br>';
                                                                                                                                                                                                                                        
                                                                                                                                                                            $_syst -> log -> x ( $rq -> response, 'rq' );
                                                                                                                                                                            $_syst -> log -> x ( $rq -> location, 'rq / location' );
                                                                                                                                                                            $_syst -> log -> x ( NAME_LOCATION_SOURCE_MAIN, 'NAME_LOCATION_SOURCE_MAIN' );
                                                                                                                                                                            $_syst -> log -> x ( WWW_SERV, 'www_serv' );
 */                                                                                                                                                                                                                                              
 //    if ( $az_user -> can ( 'access_main' ) ) {
	/*
        switch ( $rq -> location ) {
                
            case NAME_LOCATION_SOURCE_MAIN: 	
            
                include DIR_MAIN . 'addadd/' . $rq -> response -> fields() -> name_script . '/' . $rq -> response -> fields() -> name_script . '.php';	break;
                
            case NAME_LOCATION_SOURCE_ADDON:
            
		include $conf [ 'dir_addons' ] . $rq -> response -> fields() -> name_location . '/' . $rq -> response -> fields() -> name_script . '.php';
                include $conf [ 'dir_modules' ] . $rq -> response -> fields() -> name_location . '/' . $rq -> response -> fields() -> name_script . '.php'; break;
            default:
            
                switch ( $rq -> response -> fields() -> name_mode ) {
            
                    case NAME_MODE_IMAGE:  include  DIR_MAIN  . 'php_img/' . $rq -> response -> flelds() -> name_script . '.php';  break;
        
                    case NAME_MODE_AJAX:  include DIR_MAIN  . 'ajax/' . $rq -> response->flelds() -> name_script . '.php'; 	 break;
                
                    default: include 'addadd/undefined.php';
                }
        }
	*/
/*    } else {
        
        include DIR_MAIN . 'addadd/not_allowed.php';
    } */
    // $_syst -> log -> see ()
    
    include DIR_MAIN . 'index.html.php';
?>