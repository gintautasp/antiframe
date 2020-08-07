<?php

	define ( 'ABBR_COUNTRY_UNDEF', 'df' );
	
	class response extends systo {
	
//		public $_s;
	
		public $abbr_lang = ABBR_LANG_UNDEF;
										
		public $params, $links, $db
		
			, $mm // ,main model
			, $sm   // sub model
			;
										
		function __construct () {
/*		
			global $_syst;
		
			$this -> _s = $_syst;			
*/		
			parent::__construct(); 
			
			global $db; $this -> db = $db;
			
			$this -> params = new stdClass;
			
			$this -> params -> id_php_session = session_id();
			
			$this -> ip_addr_remote_2_num();
			
			$this -> params -> abbr_country = _cfihod ( $_SESSION, 'abbr_country',  ABBR_COUNTRY_UNDEF );

			$this -> params -> flag_to_statistic = false;

			$this -> abbr_lang = _cfihod ( $_SESSION, 'abbr_lang', ABBR_LANG_UNDEF );
		}
		
		public function ip_addr_remote_2_num() {
					
			$addr_remote_arr = explode ( '.' , $_SERVER [ 'REMOTE_ADDR' ] );
			
			if ( count ( $addr_remote_arr ) == 4 ) {
			
				$this->params->num_ip_addr_remote =
			
					intval ( $addr_remote_arr [ 0 ] ) * 16777216 + 
					intval ( $addr_remote_arr [ 1 ] ) * 65536 + 
					intval ( $addr_remote_arr [ 2 ] ) * 256 + 
					intval ( $addr_remote_arr [ 3 ] );	
					
			} else $this->params->num_ip_addr_remote = 0;
		}
		
		public function reg_visits() { }
	}
?>