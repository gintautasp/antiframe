<?php

	define ( 'XNO_ACTION', 0 );
	define ( 'ACTIONX_TO_PAGE', "atp" );

	define ( 'DB_NO_ACTION', "dbna" );
	define ( 'DB_ACTION_RENEW', "dbar" );

	define ( 'FILTER_NOT_SET', "fns" );
	define ( 'FILTER_SUBMITED', "fsmd" );

	define ( 'ERRORX_NOT_SET_REQUIREDS', 'NOT_SET_REQUIREDS' );

	class modelx extends systo {

		public $db;

		public $action = XNO_ACTION;

		public $act1;

		public $fltr;

		public $fltr_qw_parts = array();
		public $not_enough = array();

		public $rSlist;

		public $row1;

		public $row_class = 'light';

		public $ct_row = 0;

		public $lst;

		public $line1;

		public $ct_line = 0;

		public $id = 0;

		public $records = array();

		public $required = array();

		public $num_group = 0;

		public $order_row = array ( 'no' => false, 'up' => ' ASC', 'dw' => ' DESC' );

		public $order_dir = 'no';

		public $order = '';

		public $show;

		public $group;

		public $main_table;

		public $db_data;

		public $id_modifier = false;

		public $limit_count = 200, $page_num = 1, $paging = false, $found_rows = 0, $pages_amount = 1, $lst_pages;

		public $totals;

		public $record_before_change;

		public $modified = 'new';

		public $insert_id, $affected_rows;

		public $flag_debug = false;

		public $res;

		function __construct ( $main_table = 'test' ) {

			global $db;

			parent::__construct();

			$this -> db = $db;

			$this -> act1 = new stdClass;

			$this -> fltr = new stdClass;

			$this -> group = false;

			$this -> main_table = $main_table;

			if  ( ! $this -> _s -> msl ) {

				$this -> _s -> msl = new modelxSateliteLang;
			}
		}

		public function other_fields() { return ''; }

		public function joins() { return ''; }

		public function union() { return ''; }

		public function lst_fields() { return '*'; }

		public function having() { return ''; }

		public function id_field() { return  "`". $this -> main_table . "`.`id`"; }

		public function get1 ( $id = false, $quote = "'", $debug = false ) {

			$iret = false;

			$this -> flag_debug = $debug;

			if ( ( $id_need = $id ) || ( $this -> check_id() &&  $id_need = $this -> id ) ) {

				$qWget1 = 
						"
					SELECT 
						SQL_CALC_FOUND_ROWS `" .  $this -> main_table . "`." . $this -> lst_fields () . "
						" . $this -> other_fields() . " 
					FROM 
						`" . $this -> main_table . "` 
                        " . $this -> joins() . " 
					WHERE 
						" . $this -> id_field () . "=" . $quote . $id_need . $quote . "
						"
					. $this -> group_by()
					. $this -> sqlOrder()
					. $this -> having()
					// . $this->limit()
					. $this -> union();
					
				if ( $debug ) $this -> _s -> log -> x ( $qWget1, '$qwget1' );

				$iret  = fetchRow ( $this -> db -> perform ( $qWget1 ) );
			}
			return $iret;
		}
		
		public function get ( $debug = false, $union = ''  ) {

			$this -> flag_debug = $debug;

			$qWget =  
					$union . "
				SELECT SQL_CALC_FOUND_ROWS `" .  $this->main_table . "`." . $this -> lst_fields () . "
					" . $this -> other_fields() . " 
				FROM `" . $this -> main_table . "` 
					" . $this->joins() . " 
				WHERE " 
					. $this -> which() 
					. $this -> andFltr()
				. $this -> group_by()
				. $this -> having()
				. $this -> sqlOrder()
				. $this -> limit()
				. $this -> union()
						;
			 if ( $debug ) $this -> _s -> log -> x ( $qWget,  'qWget' );
			
			$this -> rSlist = $this->db->perform ( $qWget, 'x', 2, $debug );

			$qWget_rows = "SELECT FOUND_ROWS() AS `found_rows`";
			
			$this -> found_rows = fetchValue ( 'found_rows', $this->db->perform ( $qWget_rows ) );
			
			if ( $this -> paging ) {
			
				$this -> lst_pages = new storage();
				
				$this -> pages_amount = ceil ( $this->found_rows / $this->limit_count );

				for ( $ct = 0; $ct < $this -> pages_amount; $ct++ ) {

					$page_inf = new stdClass;

					$page_inf -> from = $ct * $this -> limit_count + 1;

					if ( $ct == $this -> pages_amount - 1 ) $page_inf -> to = $this -> found_rows;

					else $page_inf -> to = ( $ct + 1 ) * $this -> limit_count;

					$page_inf -> num = $ct + 1;
					$page_inf -> active = false;

					if ( $page_inf -> num  == $this -> page_num ) $page_inf -> active = true;

					$this -> lst_pages -> add ( $page_inf ); 
				}
			}
		}

		public function make_paging_link() {

			$params_str = array();

			foreach ( $_GET as $key => $val ) 

				if ( $key != 'p' ) 

					$params_str[] = $key . '=' . $val;

			$link =  '?' . implode( '&', $params_str ) . '&p=';

			return $link;
		}

		public function limit() {

			$limit_str = '';

			if ( $this -> paging )  {

				$limit_from = ( $this -> page_num -1 ) * $this -> limit_count;
				$limit_str .= '
					LIMIT ' . $limit_from . ', ' . $this->limit_count;
			}
			return $limit_str;
		}

		public function group_by () {

			$group = '';

			if ( $this -> group )  {
            
                $group = 
                        " 
                    GROUP BY " . $this->group . "
                        "
                    ;
            }

			return $group;
		}

		public function which() {

			$where = 
                    "
                1
                    ";
			
			return $where;
		}

		public function def_sql_order() {

			return '';
		}

		public function sqlOrder() {

			$sql_order_str = $this -> def_sql_order();  $reTval = false;

			if ( $this -> order_row [ $this -> order_dir ] ) { 

				$sql_order_str_add  = $this -> order2sqlOrder();

				$sql_order_str = ( ( $sql_order_str !== '' ) ? ( $sql_order_str . ', ' ) : ' ORDER BY ' ) . $sql_order_str_add . $this -> order_row [ $this -> order_dir ]; 
			}
			return $sql_order_str;
		}

		protected function after_take_next ( $take_result ) {

			return $take_result;
		}

		public function take_next() {

			$reTval = false;

			if  ( $this -> rSlist && ( $this->row1 = fetchRow ( $this->rSlist ) ) ) { 

				$reTval = true; 
				$this->ct_row++;

				if  ( $this->row_class == 'light' ) $this->row_class = 'dark';

				else $this->row_class = 'light';
			}

			$reTval = $this->after_take_next ( $reTval );

			return $reTval;
		}

		public function test_records( $res ) {

			$reTval = true;

			if ( ! is_array ( $this -> records ) ) { $reTval = false;

				$res -> errors -> addLike ( 'rc', 'RECORDS_CHECK_IS_NOT_ARRAY' );

			} elseif ( count (  $this -> records ) < 1 ) { $reTval = false;

				$res -> errors -> addLike ( 'rc', 'RECORDS_CHECK_IS_EMPTY' );	
			}
			return $reTval;
		}

		public function assign2group ( $field ) {

			$res = new actionResult; $reTval = true;

			if ( ! $this->test_records( $res ) )  $reTval = false;

			elseif ( $this -> num_group < 1 ) { $reTval = false;

				$this -> errors -> addLike ( 'num_group',  'NOT_CORRECT' );

			} else {
            
                $res -> status = STATUSX_DATA_OK;
            
                if ( 
                        ! $this -> db -> set ( 
                            $this -> main_table, "'" . $field . "'",  $this -> num_group 
                            , '`' . $this -> main_table . '`.`id` IN(' . implode( ',', $this -> records ) . ')' 
                        ) 
                    )  {                                                                                                                    $reTval = false;

                    $this->errors->addLike ( 'db',  'UPDATE' );

                } else { 

                    $res -> status = STATUSX_OK;
                    $res -> affected_rows = $this -> db -> last_afected_rows;
                }
            }

			$this -> actions -> addLike ( RECORDS_ACTION_ASSIGN_TO_GROUP, $res );
		}

		public function change_flag ( $flag, $val, $action = RECORDS_ACTION_CHANGE_FLAG, $directly = false  ) { $reTval = true;

			$this -> action =  $action; 
			$res = new actionResult ( 

				array ( 
					'records' => $this -> records
					, 'flag' => $field
					, 'val' => $val
					, 'directly' => $directly
				)
				,  $this -> action 
			);

			if ( ! $this -> test_records( $res ) )  $reTval = false;

			elseif ( ! is_numeric ( $val ) && ( $directly || ( $val != ( 'NOT `' . $flag . '`' ) ) ) ) {                                $reTval = false;

				$res  -> errors -> addLike ( 'flag',  'NOT_CORRECT' );

			} else {

				$res -> status = STATUSX_DATA_OK; 

				if ( ! $this -> db -> perform ( 
						"
					UPDATE
					    `" . $this -> main_table . "`
					SET 
					    `" . $flag . "` = " . $val . "
					WHERE 
					    `" . $this -> main_table . "`.`id` IN(" . implode( ',', $this -> records ) . ")
					    "
					, 'affected_rows' 
					) )  { 
																						$reTval = false;
					$res -> errors -> addLike ( 'db_UPDATE', end ( $this -> db -> inf_errors ) );

				} else { 

					$res -> status = STATUSX_OK;
					$res -> affected_rows = $this -> db -> last_afected_rows;
				}
			}
			$this -> events -> add ( clone $res );

			return $reTval;
		}
		
		public function change_activity ( $activity = 'NOT `active`' ) {

			return $this -> change_flag ( 'active', $activity, RECORDS_ACTION_CHANGE_ACTIVITY );
		}

		public function delete ( $field = 'flag_exist', $val_del = '0', $id_field = 'id' ) { $reTval = true;

			$this -> action =  RECORDS_ACTION_DELETE; 
			$res = new actionResult ( 

				array ( 
				    'records' => $this -> records
				    , 'field' => $field
				    , 'val_del' => $val_del
				    , 'id_field' => $id_field
				)
				,  $this -> action 
			);

			if ( ! $this -> test_records( $res ) )  $reTval = false;

			else {

			$res -> status = STATUSX_DATA_OK;
            
			if ( ! $this->db->perform ( 
				"
			    UPDATE 
				`" . $this -> main_table . "`  SET `" . $field . "`=" . intval ( $val_del ) . "
			    WHERE 
				`" . $this -> main_table . "`.`". $id_field . "` IN(" . implode( ',', $this -> records ) . ")
				"
				,  'affected_rows' 
				
			    ) )  { 												$reTval = false;
			    
			    $this -> errors -> addLike ( 'db_DELETE', end ( $this -> db -> inf ->errors ) );
			    
			} else { 
			
			    $res -> status = STATUSX_OK;
			    $res -> affected_rows = $this -> db -> last_afected_rows;
			}
		}

            $this -> _s -> events -> add ( clone $res );
            $this -> _s -> log -> x ( $this -> _s -> events, '$this / _s / events with result: ' . intval ( $reTval ) );
			
			return $reTval;
		}
		
		public function deletex () {
 
			$this -> action =  RECORDS_ACTION_DELETEX; 
			$res = new actionResult ( array ( 'records' => $this -> records ),  $this -> action );

			$qw_del =	
					"
				DELETE FROM 
					`" . $this -> main_table . "` 
				WHERE 
					`" . $this -> main_table . "`.`id` IN(" . implode( ',', $this -> records ) . ")
					";
			if ( $this -> flag_debug ) {
					
				$this -> _s -> log -> x ( $qw_del, 'qw / del' );
			}
			$res -> iret = true;

			if ( ! $this -> test_records( $res ) )  									$res -> iret = false;
				
			else {
			
				$res -> status = STATUSX_DATA_OK;                
			
				if ( ! $this -> db -> perform ( 
			
					$qw_del
					,  'affected_rows' 
					
					) )  { 											$res -> iret = false;
				
					$res -> errors -> addLike ( 'db_DELETEX', end ( $this -> db -> inf ->errors ) );
				
				} else { 
			
					$res -> status = STATUSX_OK;
					$res -> affected_rows = $this -> db -> last_afected_rows;
				}
			}
			
			$this -> _s -> events -> add ( clone $res );
			
			return $res -> iret;
		}		
		
		public function make_db_data( $to_add = false ) { 
		
			$this -> db_data  = (array) $this -> act1;
/*			
			foreach ( $this->db_data as $field => & $value ) {
			
				$value = "'" . mysql_real_escape_string ( $value ). "'";
			}
*/		
			if ( $this -> id_modifier ) $this -> db_data [ 'id_modifier' ] = $this -> id_modifier;
			
			return  $this -> db_data;
		}
		
		public function checkData( & $res ) { return true; }

		public function take_from_post ( $preffix = 'eD', $name_id = false, $name_modified = false, $to = 'act1' ) {

			foreach ( (array) $this -> $to  as $field => $value )  

				$this -> $to -> $field = isset ( $_POST [ $preffix . $field ] ) 

					? ( 
						is_string ( $_POST [ $preffix . $field ] ) 
							?  trim ( $_POST [ $preffix . $field ] ) 
							:  $_POST [ $preffix . $field ] 
					) 
					: $value
						;
				
			if ( $name_id ) $this -> id = _cfihod ( $_POST, $name_id, '0' );
			if ( $name_modified ) $this -> modified = _cfihod ( $_POST, $name_modified, 'new' );
		}
		
		public function takeFilterSess ( $prefix = 'fltR' ) {
		
			foreach ( ( array ) $this -> fltr as $field =>$value ) {	
			
				 $this -> fltr -> $field  = _cfihod ( $_SESSION, $prefix . $field, $this -> fltr -> $field );
			}
		}
		
		public function makeFltrQwPart( $field, $value ) {
		
			$qw_part = '';
			
			if ( ( is_string ( $value ) ) &&  ( $value != '' ) ) {			
	
				if ( strpos ( $value, '%' ) !== false ) { 
				
					$qw_part =
							"
						AND
							`" . $this -> main_table . "`.`" . $field . "` LIKE '" . $value . "'
							";
							
				} else {
				
					$qw_part =
							"
						AND
							`" . $this -> main_table . "`.`" . $field . "` LIKE '%" . $value . "%'
							";
				}
			}
			return $qw_part;
		}
		
		public function makeFltrQwParts() {
		
			foreach ( $this -> fltr  as $field => $value ) {
			
				$this -> fltr_qw_parts[] = $this -> makeFltrQwPart( $field, $value );
			}
		}	

		public function andFltr() {
		
			$and_fltr = '';
		
			if ( $this -> fltr_qw_parts ) {
		
				$and_fltr = ' ' . implode ( ' ', $this -> fltr_qw_parts );
			}
			return  $and_fltr;
		}
		
		public function takeFilterPost ( $prefix_session = 'fltR', $prefix_post = 'fltR' ) {
		
			if ( $this -> flag_debug ) $this -> _s -> log -> x ( $prefix_post, '$prefix_post' );
		
			foreach ( ( array ) $this -> fltr as $field => $value ) {
			
				if ( $this -> flag_debug ) $this -> _s -> log -> x ( $value, $field );
			
				$_SESSION [ $prefix_session . $field ] 
					= $this -> fltr -> $field 
					= _cfihod ( $_POST, $prefix_post . $field,  $this -> fltr -> $field );
			}
		}
		
		public function before_modify( $res ) {

			$iret = true;

			if ( ! ( $this -> record_before_change = $this -> get1() ) ) {              $iret = false;

				$res -> errors -> addLike ( 'db', 'NOT_GOT_CHANGING_RECORD' );

			} elseif ( ! $this -> check_modified() ) {                                  $iret = false;

				$res -> errors -> addLike ( 'db', 'RECORD_WAS_CHANGED_DURING_MAKE_CHANGES' );
			}
			return $iret;
		}
		
		public function check_modified() {
		
			$iret = true;
			
			if ( isset ( $this -> record_before_change -> modified ) ) {
			
				$iret = $this -> record_before_change -> modified == $this -> modified;
			}
		
			return $iret;
		}

		public function modify() {

			$this -> action = RECORD_ACTION_MODIFY;

			$this -> make_db_data();

			$res = new actionResult ( $this -> db_data, $this -> action );

			if ( ! $this -> db -> is_record ( $this -> main_table, 'id', "WHERE `id`='" . intval ( $this -> act1 -> id ) . "'" ) ) { $his -> res -> iret = false;
			
				$res -> errors -> add ( 'record', 'NOT_FOUND' );
			
			} elseif ( ! $this -> checkData( $res ) ) $res -> iret  = false;

			elseif ( ! $this -> check_id () ) {

				$res -> iret = false;
				$res -> errors -> addLike ( 'id', 'NOT_SET' );
			}

			elseif ( ! $this -> before_modify( $res ) )                                                $res -> iret = false;

			else {

				$res -> status = STATUSX_DATA_OK;    

				if  ( ! $this -> db -> set ( 

					$this -> main_table
					, $this -> db_data
					, "`" . $this -> main_table . "`.`id`=" . $this -> act_id ()
					, 2
					, true

				) ) {                                                                                     $res -> iret = false;

					$res -> _s  -> errors -> addLike ( 'db', 'UPDATE' );

				} else { 

					$res -> status = STATUSX_OK;
					$this -> affected_rows = $res -> affected_rows = $this -> db -> last_afected_rows;
					$this -> after_modify();
					$this -> unset_id();
					$this -> action = RECORD_NO_ACTION;
				}
			}
			$this -> _s -> log -> x ( clone $res );

			$this -> _s -> events -> add ( clone $res );
		
			return $res -> iret;
		}
		
		public function after_modify() {}
		
		public function act_id () {
		
			return intval ( $this -> id );
		}
		
		public function unset_id () {
		
			$this -> id = 0;
		}
		
		public function check_id () {
		
			return intval ( $this->id ) > 0;
		}
		
		public function add() {
		
			$this -> action = RECORD_ACTION_ADD;

			$this -> make_db_data( true );

			$res = new actionResult ( $this -> db_data, $this -> action ); 

			if ( ! $this -> checkData( $res ) ) $res -> iret = false;

			else { 

					$res -> status = STATUSX_DATA_OK;

				if  ( ! $this -> db -> add ( $this -> main_table, $this -> db_data ) ) { $res -> iret = false;

					$res -> errors -> addLike ( 'db', 'INSERT' );

				} else {

					$res -> status = STATUSX_OK;
					$res -> last_insert_id = $this -> db -> last_insert_id;
					$this -> action = RECORD_NO_ACTION;
				}
			}

			$this -> _s -> events -> add ( clone $res );

			return $res -> iret;
		}

		public function get1page ( $page ) {
		
			$this -> page_num = $page;
				
			$this -> get();
		}		
	}
?>