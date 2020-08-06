<?php

	function str_php2js ( $phPstring ) {
	
		$excludes = array("\\", "'");
		$changes = array("\\\\", "\\'");
		$jSstring = str_replace ($excludes, $changes, $phPstring);
		$order   = array("\r\n", "\n", "\r");
		$jSstring = str_replace ($order, '\n', $jSstring);
		
		return $jSstring;
	}

	function options_month() {
	
		return  '
			<option value="-01">1</option>
			<option value="-02">2</option>
			<option value="-03">3</option>
			<option value="-04">4</option>
			<option value="-05">5</option>
			<option value="-06">6</option>
			<option value="-07">7</option>
			<option value="-08">8</option>
			<option value="-09">9</option>
			<option value="-10">10</option>
			<option value="-11">11</option>
			<option value="-12">12</option>
		';
	}
	
	function options_year ( $start_year, $add_final_year = false ) {	
	
		$options_year = '';
	
		for ( $year = $start_year, $options_year = ''; $year <= date( "Y" ); $year++ ) { 

			$options_year .= '<option value="' . $year . '">' . $year .  '</option>';
		}
		if ( $add_final_year ) $options_year .=  '<option id="2022">2022</option>';
		
		return  $options_year;
	}
	
	function array2options ( $arr, $def='', $pri = true ) {
	
		$options_str = '';
		
		foreach ( $arr as $val => $name ) {
			
			$selected_str = '';
			
			if ( $val == $def ) $selected_str = ' selected="selected"';
			
			$options_str .= '<option value="' . $val . '"' . $selected_str . '>' . $name . '</option>'; 
		}
		if ( $pri ) echo $options_str;		
		
		else return $options_str;
	}

	function selector_options ($options_list, $selected = false, $disableds = array(), $field_name = false, $field_data = false ) {
	
		$options = ''; $s_data = $field_data ? ' data-' . $field_data . '="' : ''; $data ='';
		
		if ( $selected && ! is_array ( $selected ) ) $selected = array ( $selected );
	
		foreach ( $options_list as $value => $name ) {
		
			$iselected = ''; $disabled = ''; $s_name = '';
			
			if ( in_array ( $value, $disableds) ) $disabled = ' disabled="disabled"';
			
			if ( $selected ) {
			
					if ( in_array( $value, $selected ) ) $iselected = ' selected="selected"';
			}
			
			if ( is_array ( $name ) )  {
			
				$s_name = $name [ $field_name ];
				$data = $s_data . $name [ $field_data ] . '"';
				
				if ( isset ( $name [ 'active' ] )  &&  ! intval ( $name [ 'active' ] ) ) $disabled = ' disabled="disabled"';
			
			} else $s_name = $name;
			
			$options .= '<option value="' . $value. '"' . $data . $disabled . $iselected . '>' . $s_name . '</option>';
		}
		return $options;
	}	

	function period ( $label, $def, $preffix = 'fltR', $start_year = 2012,  $suffix = '', $params = '' ) {
	
		$options_year = hToptions_year( $start_year );
		
		$options_month = hToptions_month();

		if ( $def ) {
		
			$def_year = ' value="' . substr ( $def, 0, 4 ) .'" '; $def_month = ' value="-' . substr ( $def, 5, 2 ) . '" '; 
		}
?>
		<table>
		<tr><td colspan="2"><label for "<?= $preffix ?>period<?= $suffix ?>"><?= $label ?></label>
		<tr>
		<td>
			<select id="<?= $preffix ?>year<?= $suffix ?>" class= "text ui-widget-content ui-corner-all" style="width: 70px; padding: 5px" <?= $params . $def_year  ?>>
				<?= $options_year ?>
			</select>
		<td>
			<select id="<?= $preffix ?>month<?= $suffix ?>"  class= "text ui-widget-content ui-corner-all" style="width: 50px; padding: 5px" <?= $params . $def_month ?>>
				<?= $options_month ?>
			</select>
		</table>
		<input type="hidden" name="<?= $preffix ?>period<?= $suffix ?>" id="<?= $preffix ?>period<?= $suffix ?>" value="0">

<?php
	}