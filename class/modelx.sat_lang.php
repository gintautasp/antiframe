<?php

	class modelxSateliteLang {
	
		public 
        
            $lng_acts = array (
                
                0 => 'Nenustatytas veiksmas'
                , "atp" => 'Perkeliama į puslapį'
        
                , "dbna" => 'Nenustatytas duomenų bazės veiksmas'
                , "dbar" => 'Duomenų bazės atnaujinimas'
        
                , 'rna' => 'Nenustatytas veiksmas su įrašais'
                , "raa2g" => 'Priskyrimas grupei'
                , "ram" => 'Įrašų apjungimas'
                , "raca" => 'Aktyvumo keitimas'
                , "rad" => 'Įrašų šalinimas'
                , "rai" => 'Įrašų importas'
                , "rama" => 'Įrašų keitimas'
        
                , "fau" => 'Failo įkėlimas'
        
                , "r1na" => 'Nenstatytas veiksmas su įrašu'
                , "r1am" => 'Įrašo keitimas'	
                , "r1aa" => 'Įrašo pridėjimas'
                , "r1aar" => 'Susieto įrašo pridėjimas'
            )
            
            , $lng_status = array(
            
                0 => 'nenustatyta'
                , 1 => 'nesėkminga'
                , 2 => 'duomenys teisingi'
                , 3 => 'sėkminga'
                , 4 => 'įvykdyta dalinai'
                , 5 => 'tuščias rezultatas'	
            )
            
            , $css_status = array(
            
                'unknw', 'failed', 'data_ok', 'success', 'partialy', 'empty'
            )
            
            , $main_errors_description = "Klaidos serveryje atliekant veiksmą - "
		
            , $errors_keys = array ( 
            
                'id' => 'identifikatorius'
                , 'rc' => 'parinkti įrašai'
                , 'num_group' => 'grupės nr.'
                , 'db_UPDATE' => 'duomenų keitimo užklausa'
                , 'db_INSERT' => 'duomenų įterpimo užklausa'
                , 'db_DELETE' => 'duomenų šalinimo užklausa'     
                , 'db_INSERT_RELATED' => 'papildomo įterpimo užklausa'   
                , 'db_INSERT_UPDATE' => 'įterpimo/keitimo užklausa'                
                , 'activity' => 'įrašo būsena'
                , 'period_from' => 'periodas nuo'
                , 'period_to' => 'periodas iki'
                , 'periods' => 'periodas'
                , 'request' => 'kreipinys'
                , 'upload' => 'įkėlimas'
                , 'record' => 'įrašas'
                , 'date' => 'data'
                , 'group' => 'grupė'
                , 'seo_url' => 'SEO url'
            )
		
            , $errors_vals = array ( 
            
                'RECORDS_CHECK_IS_NOT_ARRAY' => 'įrašai perduoti blogu formatu'
                , 'RECORDS_CHECK_IS_EMPTY' => 'nepažymėtas nei vienas įrašas'
                , 'NOT_SET' => 'nenustatytas'
                , 'NOT_CORRECT' => 'neteisingas(a)'
                , 'TOO_LONG_SHORT' => 'per daug arba trūksta simbolių' 
                , 'NOT_VALID' => 'negalimas'
                , 'ALREADY_EXIST' => 'jau yra'
                , 'NOT_BETWEEN' => 'nepatenka į privalomas ribas'
                , 'NOT_SELECTED' => 'įrašas neparinktas'
                , 'PERIOD_TO_MUST_GREATHER_PERIOD_FROM' => 'periodo "iki" reikšmė turi buti didesnė už "nuo"'
                , 'MUST_BY_GREATHER_0' => 'turi būti didesnė už 0'
                , 'NOT_SET' => 'nenustatytas'
                , 'BAD_MODELX_CALL' => 'klaida puslapio adrese'
                , 'NOT_IS_UPLOAD_FILE' => 'negautas įkeltas failas'
                , 'FILE_NOT_GOT' => 'neatsiųstas įkeliamas failas'
                , 'NOT_VALID_FILE_TYPE' => 'nepriimtinas failo tipas'
                , 'FILE_ALLREDY_IMPORTED' => 'toks failas jau buvo importuotas'
                , 'HAVE_RELATEDS' => 'turi susietų įrašų'
                , 'NOT_FOUND' => 'nesurastas'
            );
		
		public function other_acts() { return ''; }
		
		public function message ( storage $acts ) {
				
			$message = '';
					
			while ( $acts -> takeNext() ) {
			
				$message .= '<tr><td>' . $this -> lng_acts [ $acts -> key ];
		
				switch ( $acts -> key ) {
					
					case "atp": case "dbna": case "dbar": case "rna": 
					case "ram": case "rai": case "fau": case "r1na":

						$message .= '<td>'; break;
						
					case 'raa2g': case 'rad': case 'rama': case "r1am":
					
						$message .= '<td> pakeista įrašų: ' . $acts -> piece -> affected_rows; break;
						
					case 'r1aa': case 'r1aar':
					
						$message .= '<td> įterptas įrašas id: ' . $acts -> piece -> insert_id; break;
						
					case 'rai':
					
						$message .= '<td> importuota viso/sekm./klaid.' . $acts -> piece -> imported_rows; break;
						
					default:
					
						$message .= '<td>';
					
				}
				$message .= $this -> other_acts();
				
				$message .= '<td class="'  . $this -> css_status [ $acts -> piece -> status ] . '">' . $this -> lng_status [ $acts -> piece -> status ];
			}
			return $message;
		}
		
		public function error ( $action, storage $errors ) { $message = '';
						
			if ( $errors -> amount > 0 ) {
		
				$message = $this -> main_errors_description . $action . ':' . $this -> lstErrors ( $errors );
			}
			return $message;
		}
        
        public function lstErrors ( storage $errors ) { $message = '';
        
            $errors -> start();
        
            if ( $errors -> amount > 0 ) {
        
                while ( $errors -> takeNext() ) {
            
                    $message .= '<br>'
                        . ( 
                                in_array ( $errors -> key, array_keys ( $this -> errors_keys ) )
                            ? 
                                $this -> errors_keys [ $errors->key ] 
                            : 
                                $errors -> key 
                        )
                        . 
                            ' / '
                        . ( 
                                is_string ( $errors -> piece ) 
                            ?
                                ( 
                                        in_array ( $errors -> piece, array_keys ( $this -> errors_vals ) )
                                    ? 
                                        $this -> errors_vals [ $errors ->piece ] 
                                    : 
                                        $errors -> piece 
                                )
                            : 
                                ( 
                                    ( 
                                            in_array ( $errors -> piece -> txt, array_keys ( $this -> errors_vals ) )
                                        ? 
                                            $this -> errors_vals [ $errors -> piece -> txt ] 
                                        : 
                                            $errors -> piece -> txt 
                                    )
                                    . $errors -> piece -> add
                              )
                        );
                }
            }
            return $message;
        }
	}
