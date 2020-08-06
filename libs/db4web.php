<?php

	function get_filters ( $group, $val = '' ) {
	
		global $db;
	
		$qw_get_selectors = 
				"
			SELECT
				`val`
				, `name`
				, `fltr_val`
			FROM
				`dat_fltr_selectors`
			WHERE
				`grupe`='" . $group . "'
				" . ( $val ? " AND `val`='"  . $val .  "'" : '' ) . "
				";
			$iret = '';
			
		if ( $val ) {
		
			$iret =  fetchValue (  'fltr_val', $db -> perform ( $qw_get_selectors ) );
			
		} else {
		
			$iret = fetchObjectsArray ( $db -> perform ( $qw_get_selectors ) );
		}
		return $iret;
	}		

	function get_filters_as_options ( $group, $selected ) {
	
		$html_options = '';
		
		if ( $selectors  = get_filters ( $group ) ) {
					
			foreach ( $selectors as $selector )  {
			
				$html_selected = '';
				
				if ( $selected == $selector->val ) $html_selected = ' selected="selected" ';
			
				$html_options .= '<option value="' . $selector->val . '"' . $html_selected . '>' 
							. $selector->name . '</option>';
			}
		}
		return $html_options;
	}	