<?php

	/*
	*  Copyed from http://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
	*										autor: Rathienth Baskaran
	*/
	
	function RandomString ( $length ) {

		$keys = array_merge ( range ( 0, 9 ), range( 'a', 'z' ) );
		
		$key = '';

		for ( $i=0; $i < $length; $i++ ) $key .= $keys [ array_rand ( $keys ) ];

		return $key;

	}
	
    
    function execInBackground ( $cmd ) {
    
        if ( substr( php_uname(), 0, 7 ) == "Windows" ){ 
        
            pclose( popen( "start /B ". $cmd, "r" ) );
            
        } else { 
        
            exec ( $cmd . " > /dev/null &");
        }
    }
    
?>