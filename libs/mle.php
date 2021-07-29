<?php
	/**
	 * Patikrina ar reikšmė papuola į intervalą. Intervalas tikrinamas imtinai.
	 * Jeigu $from yra null, tuomet, tenkins visos reikšmės, kurios yra <= $to.
	 * Jeigu $to yra null, tuomet, tenkins visos reikšmės, kurios yra >= $from.
	 * @param mixed $test - testuojama reikšmė
	 * @param mixed $from - Pradžios rėžis (arba null)
	 * @param mixed $to - Pabaigos rėžis (arba null)
	 * @return bool
	 */
	function _between ( $test, $from, $to ) {
		if ( is_null ( $test ) ) {
			return false;
		}
		return ( ( $test >= $from ) || is_null( $from ) ) && ( ( $test <= $to ) || is_null( $to ) );
	}
	/**
	* Grazina asociatyvaus masyvo arba objekto savybes reiksme, pagal nurodyta indeksa (savybes pavadinima) 					(eng.  [A]rray [V]alue [I]f [H]as [O]r [D]efault - avihod )
	* arba nurodyta reiksme pagal nutylejima jei reiksme nenustatyta (nera masyve arba objekte) 							(eng. return value of asscociative array $arr element if it is set with $key)
	*@param $arr mixed - associative array or object  												(eng. or return $default value if not set. )
	*@param $key - string masyvo indeksas arba objekto savybe
	*@return mixed
	*/
	function _cfihod ( $arr, $key, $def ) {
		$iret = $def;		
		if ( is_array ( $arr ) && isset ( $arr [ $key ] ) ) $iret = $arr [ $key ];
		if ( is_object ( $arr ) && ( method_exists ( $arr, '__get' ) || property_exists ( $arr, $key ) ) ) $iret = $arr->$key; 
		return $iret;
	}
    
	function _cfihodd ( $arr, $keys = array(), $def ) { // _cfihod (d)eep
    
		foreach ( $keys as $key ) { 

			$iret = $def;

			if ( is_array ( $arr ) && isset ( $arr [ $key ] ) ) { 
		    
				$iret = $arr [ $key ]; 
				$arr = $iret; 
			
			} elseif ( is_object ( $arr ) && ( method_exists ( $arr, '__get' ) || property_exists ( $arr, $key ) ) ) { 
		    
				$iret = $arr -> $key; 
				$arr = $iret;
			
			} else {
		    
				$arr = array();
			}        
		}
		
		return $iret;
	}    
	function _addAroundOrIfNot3 ( $add_before, $value, $add_after = '', $value_if_not = '' ) {
		return ( is_string ( $value ) && ( $value !== '' ) ) ? ( $add_before . $value . $add_after ) : $value_if_not;
	}
	function _have_value ( $arrVar, $testKey ) { return ( isset ( $arrVar [ $testKey ] ) && $arrVar [ $testKey ] ); }		function toFixed ( $num, $dec )  {			return number_format ( $num, $dec, '.', '' );	}
	
	function toString ( $val ) {
	
		$ret = $val;
	
		if ( is_bool ( $val ) ) {
		
			$ret = ( $val ? 'b/tiesa' : 'b/melas' );

		}
		
		return $ret;
	}
	
	function take_from_post ( $fields_values ) {
	
		foreach ( $fields_values  as $field => $value )  $fields_values [ $field ] = isset ( $_POST [ $field ] ) ? trim ( $_POST [ $field ] ) : $value;
		
		return $fields_values;
	}	
	

