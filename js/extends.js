
	function splitx ( delim, str, make_str ) {
		
		ret_arr = [];
		
		// typeof myVar === 'string' || myVar instanceof String
		
		if ( typeof (str) !== 'string' ) {
			
			if ( make_str === false ) {
		
				ret_arr. push ( str ) ;
				
			} else {

				str = make_str + delim + str;
				ret_arr = str.split ( delim );
				ret_arr.shift();
			}
			
		} else {
			
			ret_arr = str.split ( delim );
		}
		return ret_arr;
	}