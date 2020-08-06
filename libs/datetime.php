<?php

	function is_leap_year ( $year ) {
	
		return ( ( ( $year % 4 ) == 0 ) && ( ( ( $year % 100 ) != 0 ) || ( ( $year % 400 ) == 0 ) ) );
	}
	
	function dp_last_month_day ( $year, $month ) {
	
		$month_days = array ( 31, 28 + intval ( is_leap_year ( $year ) ), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
		
		return _cfihod ( $month_days, $year );
	}
	
	function _period_of ( $str_like_date ) {
	
		return intval ( substr ( $str_like_date, 0, 4 ) )*100  + intval ( substr ( $str_like_date, 5, 2 ) );  
	}
