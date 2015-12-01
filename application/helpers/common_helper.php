<?php 

   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function d($var, $e=false){

	  echo "<pre>";

	  print_r($var);

	  echo "</pre>";
	  
	  if($e) exit;

    }
    function getFullStatus($str){

		switch (strtolower($str)) {
			case 'n':
				$result='Inactive';		
				break;
			case 'y':
				$result='Active';		
				
				break;
			case 's':
				$result='Suspended';		
				
				break;
			case 'd':
				$result='Deleted';		
				break;
			
			default:
				break;
		}
		return $result;
	}
	
	function checkPermisions($type){
		$check = false;
		$CI        = & get_instance();
		$id        = $CI->session->userdata('user_id');
		$user_type = $CI->session->userdata('type');
		if($id && $type==$user_type){
			if(!$CI->db){
				$CI->load->library("database");
			}
			$CI->db->get_where("user_roles", array('user_id' => $id))->row_array();
			$check = true;
		}
		return $check;
	}
	
	function isPermitted($user_type,$permission,$method)
	{
		if($user_type == 'superadmin') return true;
		else
		{
			if(in_array($method, $permission)) return true;
			else return false;
		}
	}

	function isPermittedArray($user_type,$permission,$method_array)
	{
		if($user_type == 'superadmin') return true;
		else
		{
			$cnt = 0;
			foreach ($method_array as $key => $value) 
			{
				if(!in_array($value, $permission)) $cnt++;
			}

			if($cnt == count($method_array)) return false;
			else return true;
			
		}
	}

	function isLogin($id='user_id',$redirect=false,$type='',$type_ar=array()){

		$ci         = & get_instance();
		$id         = $ci->session->userdata($id);

		$check = false;
		if($id){
			$check = true;
			if($type != ''){
				$user_type = $ci->session->userdata('type');

					if($type==$user_type)
						$check = true;
					else
						$check=false;
			}else if(count($type_ar) > 0){
				$user_type = $ci->session->userdata('type');
				if(in_array($user_type, $type_ar))
					$check = true;
				else 
					$check = false;
			}
		}
		if($check){

			return true;

		}else{

			if($redirect){

				redirect($redirect);

			}else{
				
				return false;

			}

		}

	}

	function get(){

		parse_str($_SERVER['REQUEST_URI'],$get);

		$i=0;

		foreach($get as $key => $val){

			if($i==0)

				$key = substr(strstr($key,'?'),1);

			$result[$key] = $val;

		  	$i++;

		}

		return $result;

	}
	
function getShortUrl($longUrl){
	
		$bitly            = new Bitly();
		$loginUsername    = "o_1oqs3u0ekt";
		$apiKey           = "R_3619371f50c30a66315d1454eb046c2a";
		$bitly->setAuthentication($loginUsername, $apiKey);
		$shortUrl         = $bitly->getShortURL($longUrl);
    
		return $shortUrl;
	}

function getShortUrlFromText($text){
		$text_array = explode(' ',$text);
		$i=0;
		foreach($text_array as $txr){
			if(substr($txr,0,7)=='http://' || substr($txr,0,8)=='https://' || substr($txr,0,4)=='www.'){
				if(substr($txr,0,13)!='http://bit.ly')
        			$shortUrl = $this->getShortUrl($txr);
        			if(substr($shortUrl,0,13)=='http://bit.ly')
						$text_array[$i] = $shortUrl;
					}
			$i++;				
		}
		return implode(' ',$text_array);
  }
  
function utime($value,$userTZ,$apply=false)
{
	/*
	if(!$userTZ){
		$userTZ = app()->user->isGuest?app()->param('timeZone'):app()->user->modelData('timeZone');
	}
	*/
	return applyGMT($value,$userTZ,$apply);
}

function applyGMT($value,$offset,$apply=true,$dst=true)
	{
		$difference = $offset*3600;
		if($dst)
			$difference+= date('I',$value)*3600;
		return $apply ? $value - $difference : $value + $difference;
	}
	
function tweetTime($time){
		  $diff = time() - $time;
		  
		  if (date("Y") > date("Y",$time)) return date("M j, Y, H:i",$time);
		  else return date("M j, H:i",$time);
		 
	}
	
function addAcronym($text){
		$text = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', "<a href=\"\\0\" target=\"_blank\">\\0</a>",$text);
		return $text;
  }
  
function addTweetAcronym($text){
		$text = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', "<a href=\"\\0\" target=\"_blank\">\\0</a>",$text);
		$text = preg_replace('!\B@([_a-zA-Z0-9]+)!', "<a href=\"http://twitter.com/\\0\" target=\"_blank\">\\0</a>",$text);
		$text = preg_replace('!\B#([_a-zA-Z0-9]+)!', "<a href=\"http://twitter.com/?q=%23\\0\" target=\"_blank\"><span style=\"color:#0084B4\">\\0</span></a>",$text );
		return $text;
  }
  
function array2json($arr) {
		
		if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
		$parts = array();
		$is_list = false;
	
		//Find out if the given array is a numerical array
		$keys = array_keys($arr);
		$max_length = count($arr)-1;
		if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
			$is_list = true;
			for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
				if($i != $keys[$i]) { //A key fails at position check.
					$is_list = false; //It is an associative array.
					break;
				}
			}
		}
	
		foreach($arr as $key=>$value) {
			if(is_array($value)) { //Custom handling for arrays
				if($is_list) $parts[] = array2json($value); /* :RECURSION: */
				else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
			} else {
				$str = '';
				if(!$is_list) $str = '"' . $key . '":';
	
				//Custom handling for multiple data types
				if(is_numeric($value)) $str .= $value; //Numbers
				elseif($value === false) $str .= 'false'; //The booleans
				elseif($value === true) $str .= 'true';
				else $str .= '"' . addslashes($value) . '"'; //All other things
				// :TODO: Is there any more datatype we should be in the lookout for? (Object?)
	
				$parts[] = $str;
			}
		}
		$json = implode(',',$parts);
		
		if($is_list) return '[' . $json . ']';//Return numerical JSON
		return '{' . $json . '}';//Return associative JSON
} 

if(!function_exists('twitter_time')){
	   function twitter_time($time) {
		  $delta = strtotime("now") - strtotime($time);
		  if ($delta < 60) {
			return 'less than a minute ago';
		  } else if ($delta < 120) {
			return 'about a minute ago';
		  } else if ($delta < (45 * 60)) {
			return floor($delta / 60) . ' minutes ago';
		  } else if ($delta < (90 * 60)) {
			return 'about an hour ago.';
		  } else if ($delta < (24 * 60 * 60)) {
			return floor($delta / 3600) . ' hours ago';
		  } else if ($delta < (48 * 60 * 60)) {
			return '1 day ago';
		  } else {
			return floor($delta / 86400) . ' days ago';
		  }
	   }
	 }
	 
function GetColumn($a=array(), $column='id', $null=true, $column2=null)
    {
        $ret = array();
        @list($column, $anc) = preg_split('/[\s\-]/',$column,2,PREG_SPLIT_NO_EMPTY);
				
        foreach( $a AS $one )
        {   
			
			if ( $null || @$one[ $column ])
                $ret[] = @$one[ $column ].($anc?'-'.@$one[$anc]:'');
        } 
        return $ret;
    }
	
	function GetObjectColumn($a=array(), $column='id', $null=true, $column2=null)
    {
        $ret = array();
        @list($column, $anc) = preg_split('/[\s\-]/',$column,2,PREG_SPLIT_NO_EMPTY);
				
        foreach( $a AS $one )
        {   
			
			if ( $null || @$one->$column)
                $ret[] = @$one->$column .($anc?'-'.@$one[$anc]:'');
        } 
        return array_unique($ret);
    }
	
	/* support 2-level now */
    function AssColumn($a=array(), $column='id')
    {
        $two_level = func_num_args() > 2 ? true : false;
        if ( $two_level ) $scolumn = func_get_arg(2);

        $ret = array(); settype($a, 'array');
        if ( false == $two_level )
        {   
            foreach( $a AS $one )
            {   
                if ( is_array($one) ) 
                    $ret[ @$one[$column] ] = $one;
                else
                    $ret[ @$one->$column ] = $one;
            }   
        }   
        else
        {   
            foreach( $a AS $one )
            {   
                if (is_array($one)) {
                    if ( false==isset( $ret[ @$one[$column] ] ) ) {
                        $ret[ @$one[$column] ] = array();
                    }
                    $ret[ @$one[$column] ][ @$one[$scolumn] ] = $one;
                } else {
                    if ( false==isset( $ret[ @$one->$column ] ) )
                        $ret[ @$one->$column ] = array();

                    $ret[ @$one->$column ][ @$one->$scolumn ] = $one;
                }
            }
        }
        return $ret;
    }
	
  function BSort($inputArray, $start, $rest) {
   for ($j = $start; $j <= $i; $j++) {
       for ($i = $rest - 1; $i >= $start;  $i--) {
          for ($j = $start; $j <= $i; $j++) {
			 if ($inputArray[$j]->update_time > $inputArray[$j+1]->update_time) {
                $tempValue = $inputArray[$j+1];
                $inputArray[$j+1] = $inputArray[$j];
                $inputArray[$j] = $tempValue;
             }
          }
		  }
       	return $inputArray;
		}
	 }
	 
	 function niceUrl($url) {
	 	$url = trim($url);

        $prohibited = array(' ', '!', "'", '"', '@', '#', '$', '%', '^', '&', '*', '?', ',', '/', '<', '>', ':', ';',
                            'é', 'è', '{', '}', ')', '(');
        $replace = array('-', '', '', '', '', '', '', '', '', '-', '', '', '', '', '', '', '', '', '',
                         'e', 'e', '', '', '', '');
        $tem = strtolower(str_replace($prohibited, $replace, $url));

        $str = "";
        $prv="";$nw="";

        for($i=0;$i<strlen($tem);$i++)
        {
        	$nw = $tem[$i];
        	if($prv==$nw && ($prv=='-' || $prv=='e')) $str = $str;
        	else $str = $str.$nw;

        	$prv=$tem[$i];
        }

        return $str;
    }
	
	function salt($length=4)
	{
		srand((double)microtime()*1000000);
		
		$randSym  = "!@#$%^&*()_+=-';:,<.>`~?[]{}";
		$randChar = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; 
		
		$salt = array();
		
		while($length > 0) {
			$str = $length%2==0 ? $randSym : $randChar;
			$salt[] = $str[rand() % strlen($str) - .04];
			$length--;
		}
		
		shuffle($salt);
		
		// reseed
		mt_srand(); 
		
		return(implode("", $salt));
	}
	
	function randomCode($length=20)
	{
		srand((double)microtime()*1000000);
		
		$randSym  = "123456789";
		$randChar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; 
		
		$code = array();
		
		while($length > 0) {
			$str = $length%4==0 ? $randSym : $randChar;
			$code[] = $str[rand() % strlen($str) - .04];
			$length--;
		}
		
		shuffle($code);
		
		// reseed
		mt_srand(); 
		
		return(implode("", $code));
	}
	 
	 function hashPassword($password,$salt){
	 	return md5(md5(md5($password).$salt).$password);
	 }
	 
	 function getUserAvatar($image){
	
		if($image && file_exists(ROOT_DIR.'/asset/upload/user/'.$image)){
			return base_url().'asset/upload/user/'.$image;
		}else{
			return base_url().'asset/images/user_avatar.png';
		}
	 }
	 
	 function getStoryAvatar($image){
	
		if($image && file_exists(ROOT_DIR.'/asset/upload/story/'.$image)){
			return base_url().'asset/upload/story/'.$image;
		}else{
			return base_url().'asset/images/noPicture.gif';
		}
	 }
	 
	 function RecursiveMkdir($path) {
		if (!file_exists($path)) {
			RecursiveMkdir(dirname($path));
			@mkdir($path, 0777, true);
			@chmod($path, 0777);
		}
	}
	
	function getAge($birthday){
	 	return floor( (time()-strtotime($birthday) )/(365*86400) );
	}
	
	function tweet_Time($a){
	  
    $b = strtotime("now");
    //get timestamp when tweet created
    $c = $a;//strtotime
    //get difference
    $d = $b - $c;
	//$t=$a-$d; 
	
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;
        
    if(is_numeric($d) && $d > 0) {
        if($d < $minute) return floor($d) . "s";
        //if less then 2 minutes
        if($d < $minute * 2) return "1m";
        //if less then hour
        if($d < $hour) return floor($d / $minute) . "m";
        //if less then 2 hours
        if($d < $hour * 2) return "1hr";
        //if less then day
        if($d < $day) return floor($d / $hour) . "hr";
        //if more then day, but less then 2 days
        if($d > $day) return date("jS M,Y g:i a",$a);
    }
}

	function uploadPhotos($url, $params){
		
		$headers = array();
		$ch = curl_init();
		
		// First go to the home-page
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERAGENT, "facebook-php-3.0");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		//curl_setopt($curl, CURLOPT_HTTPHEADER, array($headers, "Content-Type: multipart/form-data")); 
		$result = curl_exec ($ch);
		curl_close($ch);
		return json_decode($result);
	}
	
	function addToFiles($key, $url)
	{
		$tempName = tempnam('/tmp', 'php_files');
		$originalName = basename(parse_url($url, PHP_URL_PATH));
	
		$imgRawData = file_get_contents($url);
		file_put_contents($tempName, $imgRawData);
		return $image = $_FILES[$key] = array(
			'name' => $originalName,
			'type' => 'image/jpeg',
			'tmp_name' => $tempName,
			'error' => 0,
			'size' => strlen($imgRawData),
		);
	}
	
	function getDatesFromRange($start, $end) {
		$realEnd = new DateTime($end);
		$realEnd->add(new DateInterval('P1D'));
	
		$period = new DatePeriod(
			 new DateTime($start),
			 new DateInterval('P1D'),
			 $realEnd
		);
	
		foreach($period as $date) { 
			$array[] = strtotime( $date->format('Y-m-d') ); 
		}
	
		return $array;
	}
	
	function getGeoLocationFromIP( $ip = null ){
	
		$reip = ( $_SERVER['SERVER_NAME']=='localhost' || $_SERVER['SERVER_NAME']=='rasel' ) ? '182.160.103.107' : $_SERVER['REMOTE_ADDR'];
		$ip = $ip ? $ip : $reip;
		$array = array( 'url' => 'http://ip-api.com/' . $ip );
		$data =  explode( '<table id="georesults">', strip_tags( file_get_contents('http://ip-api.com/' . $ip) , '<table>' ) );
		$data =  explode( '</table>', $data[1] );
		$data =  nl2br(  $data[0] );
		$data =  explode( '<br />', $data );
		
		foreach($data as $da){
			if($da){
				$d =  explode( ':', $da );
				if(trim($d[0]))
				$array[strtolower(trim($d[0]))] = trim($d[1]);
			}	
		}
		
		return $array;
	}
	
	
	function getAddressFromLatLong( $latlng = null /* Latitude and Longitude joined with comma seperator. example : 23.712435726991252,90.43048894726564*/ ){
	
		$ch = curl_init();	
		
		// GET THE XML FILE WITH RESUALTS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/2.0 (compatible; MSIE 3.02; Update a; AK; Windows 95)");
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?latlng=". $latlng ."&sensor=false"  );
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$address = curl_exec($ch);
		return json_decode( $address );
	}
	
	function xml_entities($text, $charset = 'UTF-8') {
		// Debug and Test
		// $text = "test &amp; &trade; &amp;trade; abc &reg; &amp;reg; &#45;";
		
	
		// First we encode html characters that are also invalid in xml
		$text = htmlentities ( $text, ENT_QUOTES, $charset, false );
		
		// XML character entity array from Wiki
		// Note: &apos; is useless in UTF-8 or in UTF-16
		$arr_xml_special_char = array ("&quot;", "&amp;", "&lt;", "&gt;" );
		
		// Building the regex string to exclude all strings with xml special char
		$arr_xml_special_char_regex = "(?";
		foreach ( $arr_xml_special_char as $value ) {
			$arr_xml_special_char_regex .= "(?!$value)";
		}
		$arr_xml_special_char_regex .= ")";
		
		// Scan the array for &something_not_xml; syntax
		$pattern = "/$arr_xml_special_char_regex&([a-zA-Z0-9]+;)/";
		
		// Replace the &something_not_xml; with &amp;something_not_xml;
		$replacement = '&amp;${1}';
		return preg_replace ( $pattern, $replacement, $text );
	}
	
	function StaticDataArrays( $key ){
		$array = array(
					'titles' => array("Mr","Mrs","Miss","Ms","Chief","Dr","Air Vice Marshall","Alhaji","Ambassador","Architect","Barr","Bishop","Brig","Brig GEN","CAPT","Chief(Mrs)","Commander","Dr(Mrs)","Elder","Hajia","Hajia(Chief)","Eng & Dr(Mrs)","His Excellency","Lt Col","Major","Major Gen","Master","Professor","Rev Sis","Reverend","Senator"),
					'yes_no' => array('Yes','No'),
					'gender' => array('Male','Female'),
					'user_type' => array('user','admin')

				);
				
		return $array[$key];
	}
	
	function StaticProgressBarArrays( $key ){
		$array = array(
					'marin_front_bar' => array('Your Details','Your Quote'),
					'frontend_quote' => array('Your Details','Your Quote','Final Details','Pay Now','Completed'),
					'renew' => array('Enter Your details','Quote details','Payment','Confirm')
				);
				
		return $array[$key];
	}

	function convert_number_to_words($number) {

		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'One',
			2                   => 'Two',
			3                   => 'Three',
			4                   => 'Four',
			5                   => 'Five',
			6                   => 'Six',
			7                   => 'Seven',
			8                   => 'Eight',
			9                   => 'Nine',
			10                  => 'Ten',
			11                  => 'Eleven',
			12                  => 'Twelve',
			13                  => 'Thirteen',
			14                  => 'Fourteen',
			15                  => 'Fifteen',
			16                  => 'Sixteen',
			17                  => 'Seventeen',
			18                  => 'Eighteen',
			19                  => 'Nineteen',
			20                  => 'Twenty',
			30                  => 'Thirty',
			40                  => 'Fourty',
			50                  => 'Fifty',
			60                  => 'Sixty',
			70                  => 'Seventy',
			80                  => 'Eighty',
			90                  => 'Ninety',
			100                 => 'Hundred',
			1000                => 'Thousand',
			1000000             => 'Million',
			1000000000          => 'Billion',
			1000000000000       => 'Trillion',
			1000000000000000    => 'Quadrillion',
			1000000000000000000 => 'Quintillion'
		);

		if (!is_numeric($number)) {
			return false;
		}

		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'$this->convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . convert_number_to_words(abs($number));
		}

		$string = $fraction = null;
	
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= convert_number_to_words($remainder);
				}
				break;
		}

		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
	
		return $string;
  }

  function genRandomString($length = 4) 
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $num_set = '0123456789';
	    $low_ch_set = 'abcdefghijklmnopqrstuvwxyz';
	    $high_ch_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	    $randomString = '';

	    $randomString .= $num_set[rand(0, strlen($num_set) - 1)];
	    $randomString .= $low_ch_set[rand(0, strlen($low_ch_set) - 1)];
	    $randomString .= $high_ch_set[rand(0, strlen($high_ch_set) - 1)];

	    

	    for ($i = 0; $i < $length-3; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }

	    $randomString = str_shuffle($randomString);

	    return $randomString;
	}

	function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13))
	        return $number. 'th';
	    else
	        return $number. $ends[$number % 10];
	}

	function toNumber($target){ // remove (,) from number
		$target = trim($target);
        $switched = str_replace(',', '', $target);
       	
       	if(is_numeric($switched)){
            return floatval($switched);
        } else {
            return $target;
        }
    }

    function quoteReplace($sen)
	{
	  $tem = str_replace("'", "''", $sen);
	  return $tem;
	}

	function interswitchErrorMessage($code)
	{
		$message_array = array(
			'X00' => 'Account error, please contact your bank',
			'X03' => 'The amount requested is above the limit permitted by your bank, please contact
					  your bank',
			'X04' => 'The amount requested is too low',
			'X05' => 'The amount requested is above the limit permitted by your bank, please contact
					  your bank',
			'14'  => 'The card number inputted is invalid, please re-try with a valid card number',
			'38'  => 'Incorrect security details provided. Pin tries exceeded.',
			'55' => 'Incorrect security details provided.',
			'56' => 'Incorrect card details, please verify that the expiry date inputted is correct',
			'57' => 'Your bank has prevented your card from carrying out this transaction, please
					 contact your bank',
			'61' => 'Your bank has prevented your card from carrying out this transaction, please
					 contact your bank',
			'75' => 'Incorrect security details provided. Pin tries exceeded.',
			'00' => 'Approved by Financial Institution',
			'01' => 'Refer to Financial Institution',
			'02' => 'Refer to Financial Institution, Special Condition',
			'03' => 'Invalid Merchant',
			'04' => 'Pick-up card',
			'05' => 'Do Not Honor',
			'06' => 'Error',
			'07' => 'Pick-Up Card, Special Condition',
			'08' => 'Honor with Identification',
			'09' => 'Request in Progress',
			'10' => 'Approved by Financial Institution, Partial',
			'11' => 'Approved by Financial Institution, VIP',
			'12' => 'Invalid Transaction',
			'13' => 'Invalid Amount',
			'15' => 'No Such Financial Institution',
			'16' => 'Approved by Financial Institution, Update Track 3',
			'17' => 'Customer Cancellation',
			'18' => 'Customer Dispute',
			'19' => 'Re-enter Transaction',
			'20' => 'Invalid Response from Financial Institution',
			'21' => 'No Action Taken by Financial Institution',
			'22' => 'Suspected Malfunction',
			'23' => 'Unacceptable Transaction Fee',
			'24' => 'File Update not Supported',
			'26' => 'Duplicate Record',
			'27' => 'File Update Field Edit Error',
			'28' => 'File Update File Locked',
			'29' => 'File Update Failed',
			'30' => 'Format Error',
			'31' => 'Bank Not Supported',
			'32' => 'Completed Partially by Financial Institution',
			'33' => 'Expired Card, Pick-Up',
			'34' => 'Suspected Fraud, Pick-Up',
			'35' => 'Contact Acquirer, Pick-Up',
			'36' => 'Restricted Card, Pick-Up',
			'37' => 'Call Acquirer Security, Pick-Up',
			'38' => 'PIN Tries Exceeded, Pick-Up',
			'39' => 'No Credit Account',
			'40' => 'Function not supported',
			'41' => 'Lost Card, Pick-Up',
			'42' => 'No Universal Account',
			'44' => 'No Investment Account',
			'51' => 'Insufficient Funds',
			'52' => 'No Check Account',
			'53' => 'No Savings Account',
			'54' => 'Expired Card',
			'55' => 'Incorrect PIN',
			'56' => 'No Card Record',
			'59' => 'Suspected Fraud',
			'60' => 'Contact Acquirer',
			'62' => 'Restricted Card',
			'63' => 'Security Violation',
			'64' => 'Original Amount Incorrect',
			'65' => 'Exceeds withdrawal frequency',
			'66' => 'Call Acquirer Security',
			'67' => 'Hard Capture',
			'68' => 'Response Received Too Late',
			'75' => 'PIN tries exceeded',
			'77' => 'Intervene, Bank Approval Required',
			'78' => 'Intervene, Bank Approval Required for Partial Amount',
			'90' => 'Cut-off in Progress',
			'91' => 'Issuer or Switch Inoperative',
			'92' => 'Routing Error',
			'93' => 'Violation of law',
			'94' => 'Duplicate Transaction',
			'95' => 'Reconcile Error',
			'96' => 'System Malfunction',
			'98' => 'Exceeds Cash Limit',
			'A0' => 'Unexpected error',
			'A4' => 'Transaction not permitted to card holder, via channels',
			'Z0' => 'Transaction Status Unconfirmed',
			'Z1' => 'Transaction Error',
			'Z2' => 'Bank account error',
			'Z3' => 'Bank collections account error',
			'Z4' => 'Interface Integration Error',
			'Z5' => 'Duplicate Reference Error',
			'Z6' => 'Incomplete Transaction',
			'Z7' => 'Transaction Split Pre-processing Error',
			'Z8' => 'Invalid Card Number, via channels',
			'Z9' => 'Transaction not permitted to card holder, via channels',
			'Z25' => 'This transaction does not exist on WebPAY'					
		);
		
		return $message_array[$code];
	}