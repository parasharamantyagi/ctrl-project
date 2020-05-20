<?php

use Auth;
use DB;
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
				   return $value === "" ? NULL : $value;
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
		$returnData = array('en'=>'english');
		if($input)
			$returnData = (array_key_exists($input,$returnData)) ? $returnData[$input] : $returnData['en'];
		return $returnData;
    }
}

if (!function_exists('get_country')) {
	
	function get_country($input = null)
    {
		$countries = array(
							"Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina",
							"Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize",
							"Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory",
							"Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic",
							"Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the",
							"Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
							"Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia",
							"Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia",
							"French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe",
							"Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras",
							"Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan",
							"Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan",
							"Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg",
							"Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique",
							"Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco",
							"Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger",
							"Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay",
							"Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda",
							"Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal",
							"Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
							"South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname",
							"Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan",
							"Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan",
							"Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
							"United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)",
							"Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"
						);
		// if($input)
			// $returnData = (array_key_exists($input,$returnData)) ? $returnData[$input] : $returnData['en'];
		return $countries;
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




