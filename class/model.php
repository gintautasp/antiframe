<?php

	define ( 'NO_ACTION', 0 );

	define ( 'STATUS_UNDEFINED', 0 );
	define ( 'STATUS_FAILED', 1 );
	define ( 'STATUS_OK', 2 );
	define ( 'STATUS_PARTIALLY_OK', 3 );
	define ( 'STATUS_GOT_EMPTY_RESULT', 4 ); 
	
	define ( 'ERROR_NOT_SET_REQUIREDS', 'NOT_SET_REQUIREDS' );
    
	class model extends systo {
		
		public $db;
		
		public $dbg;
		
		public $action = NO_ACTION;
		
		public $status = STATUS_UNDEFINED;
		
		public $act1;
		
		public $not_enough = array();
						
		public $rSlist;
		
		public $row1;
		
		public $ct_row = 0;
		
		public $lst;
		
		public $line1;
		
		public $ct_line = 0;
	
		public $id = 0;	
		
		public $cmp_row_sql = array ( 'lt' => '<', 'le' => '<=', 'gt' => '>', 'ge' => '>=', 'eq' => '=', 'ne' => '<>' );
		
		public $cmp_row_html = array ( '0' => '--',  'lt' => '&lt;', 'le' => '&le;', 'gt' => '&gt;', 'ge' => '&ge;', 'eq' => '=', 'ne' => '&ne;' );
		
		public $order_circle = array ( 'no' => 'up', 'up' => 'dw', 'dw' => 'no' );
		
		public $order_row = array ( 'no' => false, 'up' => ' ASC', 'dw' => ' DESC' );
		
		public $order_dir = 'no';
		
		public $order = '';
		
		public $show;
        
		public $msl;
	
		function __construct() {
		
			global $db;
			
			parent::__construct();
            
			$this -> db = $db;
			
			$this -> act1 = new stdClass;
			
			$this -> show = new stdClass;
			            
			if  ( ! $this -> _s -> msl ) {            
			    
				$this -> _s -> msl = new modelxSateliteLang;
			}
		}
		
		public function sql_order() {
		
			$sql_order_str = '';
			
			if ( $this -> order_row [ $this->order_dir ] ) { 
				
				$sql_order_str  = $this->translate_post_2_sql_4_order();

				$this->order_links [ $this->order ] = '?by=' . $this->order . '&dr=' . $this->order_circle [ $this->order_dir ]; 
				$this->order_button_class [ $this->order ] = 'sfarr' . $this->order_circle [ $this->order_dir ];				
				$sql_order_str = ' ORDER BY ' . $sql_order_str . $this->order_row [ $this->order_dir ]; 
			}
			return $sql_order_str;
		}		
		
		public function check_required ( $params ) {
			
			$reTval = true;
			
			foreach ( $params as $param ) 
			
				if ( ! in_array ( $param, array_keys ( ( array ) $this->act1 ) ) )  { 
			
					$reTval = false; 
					$this->not_enough[] = $param;
					
					if ( ! in_array ( ERROR_NOT_SET_REQUIREDS,  $this->errors->arr ) ) $this->errors->add ( ERROR_NOT_SET_REQUIREDS );
				}

			return $reTval;
		}
		
		public function take_next() {
		
			$reTval = false;
			
			if  ( $this->rSlist && ( $this->row1 = fetchRow ( $this->rSlist ) ) ) { 
			
				$reTval = true; 
				$this->ct_row++;
			}
			
			return $reTval;
		}
	}
?>