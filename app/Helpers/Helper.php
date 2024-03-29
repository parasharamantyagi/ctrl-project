<?php

#use Auth;
#use DB;
// namespace App\Helpers; 
if (!function_exists('human_file_size')) {
    function human_file_size($image_name)
    {
		
        return 'images/products/'.$image_name;
 
    }
}
 
if (!function_exists('in_arrayi')) {

    function in_arrayi($needle, $haystack, $strict = false)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack), $strict);
    }
}


if (!function_exists('url_segment')) {
 
    function url_segment($needle)
    {
        return 'active';
    }
}

if (!function_exists('pr_year')) {
 
    function ctrl_year()
    {
		for($i = date('Y') ; $i >= 2010; $i--){
				$inputData[] = $i;
		   }
        return $inputData;
    }
}


if (!function_exists('array_remove_null')) {
	
	function array_remove_null($object)
    {
		$array2 = array_map(function($value) {
				   return $value === NULL ? "" : $value;
				}, $object);
        return $array2;
    }
}

if (!function_exists('api_response')) {
	
	function api_response($status,$message,$data)
    {
        return array("status"=>$status,"message"=>$message,"data"=>$data);
    }
}

if (!function_exists('delete_file')) {
	
	function delete_file($file)
    {
		File::delete(public_path($file));
        return true;
    }
}

if (!function_exists('user_role')) {
	
	function user_role($value = null)
    {
		if(!$value)
			return Auth::user()->role->roll;
		return Auth::user()->role->roll.'/'.$value;
    }
}

if (!function_exists('my_role')) {
	
	function my_role($no = null,$key = null)
    {
		$roles = DB::table('roles')->select('id','roll_id','roll')->get();
		if($no)
		{
			$indexing = (int)$no - 1;
			if(!$key)
				return $roles[$indexing]['_id'];
			return $roles[$indexing]['roll'];
		}else{
			return $roles;
		}
    }
}

if (!function_exists('edit_table')) {
	
	function edit_table($input)
    {
		$result = DB::table('edittables')->where('user_id',strval(Auth::user()->id))->first();
		if($result)
		{
			return ($result[$input]) ? $result[$input] : false;
		}else{
			return false;
		}
    }
}

if (!function_exists('car_model')) {
	
	function car_model($input)
    {
		// ->toArray()
		$result = DB::table('car_brands')->where('brand_name',$input)->get()->toArray();
		$key = array_search($input, array_column($result, 'brand_name'));
		return $result[$key]['art_no'];
		// return $result['art_no'];
    }
}

if (!function_exists('get_language')) {
	
	function get_language($input = null)
    {
		$returnData = array('en'=>'English','fr'=>'French','sp'=>'Spanish','po'=>'Portuguese','sw'=>'Swedish');
		if($input)
			$returnData = (array_key_exists($input,$returnData)) ? $returnData[$input] : $returnData['en'];
		return $returnData;
    }
}

if (!function_exists('get_country')) {
	
	function get_country($input = null)
    {
		$countries = array(
							"AF" => "Afghanistan",
							"AL" => "Albania",
							"DZ" => "Algeria",
							"AS" => "American Samoa",
							"AD" => "Andorra",
							"AO" => "Angola",
							"AI" => "Anguilla",
							"AQ" => "Antarctica",
							"AG" => "Antigua and Barbuda",
							"AR" => "Argentina",
							"AM" => "Armenia",
							"AW" => "Aruba",
							"AU" => "Australia",
							"AT" => "Austria",
							"AZ" => "Azerbaijan",
							"BS" => "Bahamas",
							"BH" => "Bahrain",
							"BD" => "Bangladesh",
							"BB" => "Barbados",
							"BY" => "Belarus",
							"BE" => "Belgium",
							"BZ" => "Belize",
							"BJ" => "Benin",
							"BM" => "Bermuda",
							"BT" => "Bhutan",
							"BO" => "Bolivia",
							"BA" => "Bosnia and Herzegovina",
							"BW" => "Botswana",
							"BV" => "Bouvet Island",
							"BR" => "Brazil",
							"IO" => "British Indian Ocean Territory",
							"BN" => "Brunei Darussalam",
							"BG" => "Bulgaria",
							"BF" => "Burkina Faso",
							"BI" => "Burundi",
							"KH" => "Cambodia",
							"CM" => "Cameroon",
							"CA" => "Canada",
							"CV" => "Cape Verde",
							"KY" => "Cayman Islands",
							"CF" => "Central African Republic",
							"TD" => "Chad",
							"CL" => "Chile",
							"CN" => "China",
							"CX" => "Christmas Island",
							"CC" => "Cocos (Keeling) Islands",
							"CO" => "Colombia",
							"KM" => "Comoros",
							"CG" => "Congo",
							"CD" => "Congo, the Democratic Republic of the",
							"CK" => "Cook Islands",
							"CR" => "Costa Rica",
							"CI" => "Cote D'Ivoire",
							"HR" => "Croatia",
							"CU" => "Cuba",
							"CY" => "Cyprus",
							"CZ" => "Czech Republic",
							"DK" => "Denmark",
							"DJ" => "Djibouti",
							"DM" => "Dominica",
							"DO" => "Dominican Republic",
							"EC" => "Ecuador",
							"EG" => "Egypt",
							"SV" => "El Salvador",
							"GQ" => "Equatorial Guinea",
							"ER" => "Eritrea",
							"EE" => "Estonia",
							"ET" => "Ethiopia",
							"FK" => "Falkland Islands (Malvinas)",
							"FO" => "Faroe Islands",
							"FJ" => "Fiji",
							"FI" => "Finland",
							"FR" => "France",
							"GF" => "French Guiana",
							"PF" => "French Polynesia",
							"TF" => "French Southern Territories",
							"GA" => "Gabon",
							"GM" => "Gambia",
							"GE" => "Georgia",
							"DE" => "Germany",
							"GH" => "Ghana",
							"GI" => "Gibraltar",
							"GR" => "Greece",
							"GL" => "Greenland",
							"GD" => "Grenada",
							"GP" => "Guadeloupe",
							"GU" => "Guam",
							"GT" => "Guatemala",
							"GN" => "Guinea",
							"GW" => "Guinea-Bissau",
							"GY" => "Guyana",
							"HT" => "Haiti",
							"HM" => "Heard Island and Mcdonald Islands",
							"VA" => "Holy See (Vatican City State)",
							"HN" => "Honduras",
							"HK" => "Hong Kong",
							"HU" => "Hungary",
							"IS" => "Iceland",
							"IN" => "India",
							"ID" => "Indonesia",
							"IR" => "Iran, Islamic Republic of",
							"IQ" => "Iraq",
							"IE" => "Ireland",
							"IL" => "Israel",
							"IT" => "Italy",
							"JM" => "Jamaica",
							"JP" => "Japan",
							"JO" => "Jordan",
							"KZ" => "Kazakhstan",
							"KE" => "Kenya",
							"KI" => "Kiribati",
							"KP" => "Korea, Democratic People's Republic of",
							"KR" => "Korea, Republic of",
							"KW" => "Kuwait",
							"KG" => "Kyrgyzstan",
							"LA" => "Lao People's Democratic Republic",
							"LV" => "Latvia",
							"LB" => "Lebanon",
							"LS" => "Lesotho",
							"LR" => "Liberia",
							"LY" => "Libyan Arab Jamahiriya",
							"LI" => "Liechtenstein",
							"LT" => "Lithuania",
							"LU" => "Luxembourg",
							"MO" => "Macao",
							"MK" => "Macedonia, the Former Yugoslav Republic of",
							"MG" => "Madagascar",
							"MW" => "Malawi",
							"MY" => "Malaysia",
							"MV" => "Maldives",
							"ML" => "Mali",
							"MT" => "Malta",
							"MH" => "Marshall Islands",
							"MQ" => "Martinique",
							"MR" => "Mauritania",
							"MU" => "Mauritius",
							"YT" => "Mayotte",
							"MX" => "Mexico",
							"FM" => "Micronesia, Federated States of",
							"MD" => "Moldova, Republic of",
							"MC" => "Monaco",
							"MN" => "Mongolia",
							"MS" => "Montserrat",
							"MA" => "Morocco",
							"MZ" => "Mozambique",
							"MM" => "Myanmar",
							"NA" => "Namibia",
							"NR" => "Nauru",
							"NP" => "Nepal",
							"NL" => "Netherlands",
							"AN" => "Netherlands Antilles",
							"NC" => "New Caledonia",
							"NZ" => "New Zealand",
							"NI" => "Nicaragua",
							"NE" => "Niger",
							"NG" => "Nigeria",
							"NU" => "Niue",
							"NF" => "Norfolk Island",
							"MP" => "Northern Mariana Islands",
							"NO" => "Norway",
							"OM" => "Oman",
							"PK" => "Pakistan",
							"PW" => "Palau",
							"PS" => "Palestinian Territory, Occupied",
							"PA" => "Panama",
							"PG" => "Papua New Guinea",
							"PY" => "Paraguay",
							"PE" => "Peru",
							"PH" => "Philippines",
							"PN" => "Pitcairn",
							"PL" => "Poland",
							"PT" => "Portugal",
							"PR" => "Puerto Rico",
							"QA" => "Qatar",
							"RE" => "Reunion",
							"RO" => "Romania",
							"RU" => "Russian Federation",
							"RW" => "Rwanda",
							"SH" => "Saint Helena",
							"KN" => "Saint Kitts and Nevis",
							"LC" => "Saint Lucia",
							"PM" => "Saint Pierre and Miquelon",
							"VC" => "Saint Vincent and the Grenadines",
							"WS" => "Samoa",
							"SM" => "San Marino",
							"ST" => "Sao Tome and Principe",
							"SA" => "Saudi Arabia",
							"SN" => "Senegal",
							"CS" => "Serbia and Montenegro",
							"SC" => "Seychelles",
							"SL" => "Sierra Leone",
							"SG" => "Singapore",
							"SK" => "Slovakia",
							"SI" => "Slovenia",
							"SB" => "Solomon Islands",
							"SO" => "Somalia",
							"ZA" => "South Africa",
							"GS" => "South Georgia and the South Sandwich Islands",
							"ES" => "Spain",
							"LK" => "Sri Lanka",
							"SD" => "Sudan",
							"SR" => "Suriname",
							"SJ" => "Svalbard and Jan Mayen",
							"SZ" => "Swaziland",
							"SE" => "Sweden",
							"CH" => "Switzerland",
							"SY" => "Syrian Arab Republic",
							"TW" => "Taiwan, Province of China",
							"TJ" => "Tajikistan",
							"TZ" => "Tanzania, United Republic of",
							"TH" => "Thailand",
							"TL" => "Timor-Leste",
							"TG" => "Togo",
							"TK" => "Tokelau",
							"TO" => "Tonga",
							"TT" => "Trinidad and Tobago",
							"TN" => "Tunisia",
							"TR" => "Turkey",
							"TM" => "Turkmenistan",
							"TC" => "Turks and Caicos Islands",
							"TV" => "Tuvalu",
							"UG" => "Uganda",
							"UA" => "Ukraine",
							"AE" => "United Arab Emirates",
							"GB" => "United Kingdom",
							"US" => "United States",
							"UM" => "United States Minor Outlying Islands",
							"UY" => "Uruguay",
							"UZ" => "Uzbekistan",
							"VU" => "Vanuatu",
							"VE" => "Venezuela",
							"VN" => "Viet Nam",
							"VG" => "Virgin Islands, British",
							"VI" => "Virgin Islands, U.s.",
							"WF" => "Wallis and Futuna",
							"EH" => "Western Sahara",
							"YE" => "Yemen",
							"ZM" => "Zambia",
							"ZW" => "Zimbabwe"
							);
		// array(
							// "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina",
							// "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize",
							// "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory",
							// "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic",
							// "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the",
							// "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
							// "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia",
							// "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia",
							// "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe",
							// "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras",
							// "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan",
							// "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan",
							// "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg",
							// "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique",
							// "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco",
							// "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger",
							// "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay",
							// "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda",
							// "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal",
							// "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
							// "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname",
							// "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan",
							// "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan",
							// "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
							// "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)",
							// "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"
						// );
		// if($input)
			// $returnData = (array_key_exists($input,$returnData)) ? $returnData[$input] : $returnData['en'];
		return $countries;
    }
}

if (!function_exists('vehicle_type')) {
	
	function vehicle_type()
    {
		return array('car','light_truck','heavy_truck','trailer','bus','aircraft','tram','crane','electric_loco','steam_loco','diesel_loco');
    }
}

if (!function_exists('sequence_led_motor_config')) {
	
	function sequence_led_motor_config($inputData,$name)
    {
		// sequence_text 
		$key = array_search($name, array_column($inputData, 'sequence_key'));
		if ($key !== FALSE){
			if($inputData[$key]['led_motor_config'] && $inputData[$key]['led_motor_config'] == 'on'){
				$resultData = array(
								'sequence_name'=>$inputData[$key]['sequence_name'],
								'on_mode_color_2'=>$inputData[$key]['on_mode_color_2'],
								'on_mode_align_text'=>array_key_exists('on_mode_align_text',$inputData[$key]) ? $inputData[$key]['on_mode_align_text'] : ''
							);
				if(array_key_exists('on_sequence_text_name',$inputData[$key]) && $inputData[$key]['on_sequence_text_name']){
					$resultData['sequence_text'] = $inputData[$key]['on_sequence_text_name'];
				}else{
					$resultData['sequence_text'] = "";
				}
				if(array_key_exists('on_mode_image',$inputData[$key]) && $inputData[$key]['on_mode_image']){
					$resultData['on_mode_image'] = $inputData[$key]['on_mode_image'];
				}
				return $resultData;
			}else{
				$resultData = array(
								'sequence_name'=>$inputData[$key]['sequence_name'],
								'on_mode_color_2'=>$inputData[$key]['off_mode_color_2'],
								'on_mode_align_text'=>array_key_exists('off_mode_align_text',$inputData[$key]) ? $inputData[$key]['off_mode_align_text'] : ''
							);
				if(array_key_exists("off_mode_image",$inputData[$key]) && $inputData[$key]['off_mode_image']){
					$resultData['on_mode_image'] = $inputData[$key]['off_mode_image'];
				}else{
					$resultData['on_mode_image'] = 'assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_13.png';
				}
				if(array_key_exists("off_sequence_text_name",$inputData[$key]) && $inputData[$key]['off_sequence_text_name']){
					$resultData['sequence_text'] = $inputData[$key]['off_sequence_text_name'];
				}else{
					$resultData['sequence_text'] = '';
				}
				return $resultData;
			}
		}else{
			return array();
		}
    }
}

if (!function_exists('pr')) {
	
	function pr($value)
    {
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		die;
    }
}


if (!function_exists('prAr')) {
	
	function prAr($value)
    {
		echo '<pre>';
		print_r($value->toArray());
		echo '</pre>';
		die;
    }
}




