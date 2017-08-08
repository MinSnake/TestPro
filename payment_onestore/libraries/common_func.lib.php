<?php
# query error
function my_error_handler($params) 
{
	DB::rollback();
	$_OUT_JSON["rs"] = -1;
	$_OUT_JSON["_ti"] = time();
	$_OUT_JSON["error"] = $params['error'];
	$_OUT_JSON["query"] = $params['query'];
	
	echo json_encode($_OUT_JSON);
	exit;
}

# client ip
if (!function_exists('getallheaders')) 
{
    function getallheaders() 
    {
	    
		$headers = array(); 
		foreach ($_SERVER as $name => $value) 
		{ 
			if (substr($name, 0, 5) == 'HTTP_') 
			{ 
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
			} 
		} 
		return $headers; 
	} 
} 

function hp_get_time() 
{
    list($usec, $sec) = explode(" ", microtime());
    
    return ((float)$usec + (float)$sec);
    
    /*
	    사용 예제
	    $start = hp_get_time();
	    
	    $end = hp_get_time();
		$time = $end - $start;
		$_OUT_JSON['time'] = "수행시간: ".number_format($time,4)."초";
	*/
}

# array key unique
function hb_array_unique($array, $key) 
{ 
	$temp_array = array(); 
	$key_array = array(); 
	
	$i = 0; 
	foreach ( $array as $val ) 
	{
		if ( !in_array($val[$key], $key_array) ) 
		{
			$key_array[$i] = $val[$key]; 
			
			$temp_array[] = $val; 
		} 
		$i++; 
	} 
	
	return $temp_array; 
} 


function http_request($method, $headers, $host, $params)
{  
    $params = array(
	    'http' => array(
		    'method' => $method,
		    'header' => $headers,
			'content' => $params
			)
		);
	#print_r($params);
    $ctx = stream_context_create($params);
    $fp = @fopen($host, 'rb', false, $ctx);
    $ret = false;
    if($fp) {
		$ret = @stream_get_contents($fp);
		fclose($fp);
    }
    return $ret;
}


?>