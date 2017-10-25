<?php
/**
 * A simple OAuth consumer for CakePHP.
 *
 * Requires the OAuth library from http://oauth.googlecode.com/svn/code/php/
 *
 * Copyright (c) by Daniel Hofstetter (http://cakebaker.42dh.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 */

require('OAuth.php');
App::import('Core', 'http_socket');

// using an underscore in the class name to avoid a naming conflict with the OAuth library
class OAuth_Consumer {
	private $url = null;
	private $consumerKey = null;
	private $consumerSecret = null;
	private $fullResponse = null;

	private $headerParams = array();

	public function __construct($consumerKey, $consumerSecret = '') {
		$this->consumerKey = $consumerKey;
		$this->consumerSecret = $consumerSecret;
	}

	/**
	 * Call API with a GET request
	 */
	public function get_($accessTokenKey, $accessTokenSecret, $url, $getData = array()) {
		$accessToken = new OAuthToken($accessTokenKey, $accessTokenSecret);
		$request = $this->createRequest('GET', $url, $accessToken, $getData);

		return $this->doGet($request->to_url());
	}

	/**
	 * 將oauth信息放在header中提交到server
	 * @param
	 * @author Adam.Lu
	*/
	public function get($accessTokenKey, $accessTokenSecret, $url, $getData = array(), $realm='') {
		$accessToken = new OAuthToken($accessTokenKey, $accessTokenSecret);
		$request = $this->createRequest('GET', $url, $accessToken, array());
		$header = array('header'=> array('Authorization'=>  $this->makeHeaders($request->get_parameters(), $realm)) );
		return $this->doGet($url, $getData, $header);
	}

	public function getAccessToken($accessTokenURL, $requestToken, $httpMethod = 'POST', $parameters = array()) {
		$this->url = $accessTokenURL;
		$queryStringParams = OAuthUtil::parse_parameters($_SERVER['QUERY_STRING']);
		if ( isset($queryStringParams['oauth_verifier']) ) { // ADD BY adam.lu
			$parameters['oauth_verifier'] = $queryStringParams['oauth_verifier'];
		}
		$request = $this->createRequest($httpMethod, $accessTokenURL, $requestToken, $parameters);
		return $this->doRequest($request);
	}

	/**
	 * Useful for debugging purposes to see what is returned when requesting a request/access token.
	 */
	public function getFullResponse() {
		return $this->fullResponse;
	}

	/**
	 * @param $requestTokenURL
	 * @param $callback An absolute URL to which the Service Provider will redirect the User back when the Obtaining User
	 * 					Authorization step is completed. If the Consumer is unable to receive callbacks or a callback URL
	 * 					has been established via other means, the parameter value MUST be set to oob (case sensitive), to
	 * 					indicate an out-of-band configuration. Section 6.1.1 from http://oauth.net/core/1.0a
	 * @param $httpMethod 'POST' or 'GET'
	 * @param $parameters
	 */
	public function getRequestToken($requestTokenURL, $callback = 'oob', $httpMethod = 'POST', $parameters = array()) {
		$this->url = $requestTokenURL;
		$parameters['oauth_callback'] = $callback;
		$request = $this->createRequest($httpMethod, $requestTokenURL, null, $parameters);
		return $this->doRequest($request);


	}


	/**
	 * Call API with a POST request
	 */
	public function post($accessTokenKey, $accessTokenSecret, $url, $postData = array()) {
		$accessToken = new OAuthToken($accessTokenKey, $accessTokenSecret);
		$request = $this->createRequest('POST', $url, $accessToken, $postData);
		return $this->doPost($url, $request->to_postdata());
	}
	
	/**
	 * Call API with a POST request
	 */
	public function post_payment($accessTokenKey, $accessTokenSecret, $url, $postData = array()) {
	    $accessToken = new OAuthToken($accessTokenKey, $accessTokenSecret);
	    $request = $this->createRequestPayment('POST', $url, $accessToken, $postData);
	    return $this->doPost($url, $request->to_postdata());
	}

	protected function createOAuthToken($response) {
		if (isset($response['oauth_token']) && isset($response['oauth_token_secret'])) {
			return new OAuthToken($response['oauth_token'], $response['oauth_token_secret']);
		}

		return null;
	}

	private $singleConsumer = null;              // ADD BY adam.lu

	private function createConsumer() {
		if ( $this->singleConsumer === null ) { // ADD BY adam.lu
            $this->singleConsumer = new OAuthConsumer($this->consumerKey, $this->consumerSecret);
		}
		 return $this->singleConsumer;
	}

	private function createRequest($httpMethod, $url, $token, array $parameters) {
		$consumer = $this->createConsumer();
		$request = OAuthRequest::from_consumer_and_token($consumer, $token, $httpMethod, $url, $parameters);
		$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);
		return $request;
	}
	
	private function createRequestPayment($httpMethod, $url, $token, array $parameters) {
	    $consumer = $this->createConsumer();
	    $request = OAuthRequest::from_consumer_and_token($consumer, $token, $httpMethod, $url, $parameters);
	    $request->sign_request_payment(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);
	    return $request;
	}

	private function doGet($url, $getData = array(), $header = array()) {
		$socket = new HttpSocket();
		return $socket->get($url, $getData, $header);
	}

	private function doPost($url, $data) {
		$socket = new HttpSocket();
		return $socket->post($url, $data);
	}

	private function doRequest($request) {
		if ($request->get_normalized_http_method() == 'POST') {
			$data = $this->doPost($this->url, $request->to_postdata());
// 			debug(array('at consumer:data from server'=>$data), 'oauth');
		} else {
			$data = $this->doGet($request->to_url());
			//debug(array('at consumer:data from server'=>$data));
		}
		$this->fullResponse = $data;
		$response = array();
		parse_str($data, $response);
		return $this->createOAuthToken($response);
	}

	/**
	 * 效仿豆瓣API請求方式
	 * 进行POST、PUT、DELETE请求时，
	 * 豆瓣暂时不支持使用在url中或者post form中传递OAuth参数。
	 * 因此你只能选择在header中传递OAuth参数
	 * @param string $method       post | get | delete | put
	 * @param string $accessToken
	 * @param string $url api      的地址
	 * @param array  $parameters   键值对的参数
	 * @param string $extra        附加值(非array)
	 * @param string $realm
	 */
	public function callApi($method, $accessToken, $url, $parameters = array(), $extra, $realm=null){
		$consumer = $this->createConsumer();
		$request = OAuthRequest::from_consumer_and_token($consumer, $accessToken, 'POST', $url);
		if ( !empty($parameters) ) {
			foreach ( $parameters as $k => $v ) {
				$request->set_parameter($k, $v);
			}
		}
		$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $accessToken);
		return $this->call($method, $url, $request->get_parameters(), $extra, $realm);
	}



	/**
	 *
	 * 通header中传递OAuth参数
	 * @param unknown_type $url
	 * @param array $headers
	 * @param array $extra
	 * @throws OAuthException
	 */
	public function call($method, $url, array $headers=array(), $extra=null, $realm=null) {
		if ( $realm != null ) {
			$headersStr = $this->makeHeaders($headers, $realm);
		} else {
			$headersStr = $this->makeHeaders($headers);
		}
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$scheme = parse_url($url, PHP_URL_SCHEME);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, ($scheme == 'https'));
		switch($method) {
			case 'POST':
				var_dump($headersStr);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/atom+xml', $headersStr));
				curl_setopt($curl, CURLOPT_POST, true);
				if ( $extra ) {
					if ( is_array($extra) ) {
						$extra = http_build_query($extra);
					}
				    curl_setopt($curl, CURLOPT_POSTFIELDS, $extra);
				}
				break;
			case 'PUT':
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/atom+xml', $headersStr));
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
				if ( $extra ) {
					if ( is_array($extra) ) {
						$extra = http_build_query($extra);
					}
				    curl_setopt($curl, CURLOPT_POSTFIELDS, $extra);
				}
				break;
			case 'DELETE':
				curl_setopt($curl, CURLOPT_HTTPHEADER, array($headersStr));
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
				if ( $extra ) {
					if ( is_array($extra) ) {
						$extra = http_build_query($extra);
					}
				    curl_setopt($curl, CURLOPT_POSTFIELDS, $extra);
				}
				break;
			default :
				//GET is the default
				if ($headers) {
					curl_setopt($curl, CURLOPT_HTTPHEADER, array($headers));
				}
		}
		$response = curl_exec($curl);
		if (!$response) {
			$response = curl_error($curl);
			throw new OAuthException("curl error : $response");
		}
		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return array(
			'content' => $response,
			'http_code' => $http_code,
		);
	}

	var $curl_timeout = 10;
	function call2($request, $method, $pbody='') {
		// Initialize a curl session
		$session = curl_init($request);

		// set any curl options that you might need.

		// curl return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, true);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_TIMEOUT, $this->curl_timeout);

		switch ($method) {
			case 'DELETE':
				curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'DELETE');
				break;
			case 'PUT': // This is a PUT by a setRawData string, not by file-handle
				//curl_setopt($session, CURLOPT_PUT, true);
				curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PUT');
				break;
			case 'POST':
				curl_setopt($session, CURLOPT_POST, true);
				break;
			default:
			case 'GET':
				curl_setopt($session, CURLOPT_HTTPGET, true);
				break;
			case 'HEAD':
				curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'HEAD');
				break;
		}

		if(!empty($pbody)) {
			curl_setopt($session, CURLOPT_POSTFIELDS, $pbody);
		}

		// send request, this is the response(xml)
		$response = curl_exec($session);

		// clase session
		curl_close($session);
		$parse_response = $this->parseResponse($response);

		$status_code = $parse_response['code'];
		$response_body = $parse_response['body'];

		switch ($status_code) {
			case 200:
				break;
			case 503:
				die('Your call to MASS Web Services failed and returned an HTTP status of 503. That means: Service unavailable. An internal problem prevented us from returning data to you.');
				break;
			case 403:
				die('Your call to MASS Web Services failed and returned an HTTP status of 403. That means: Forbidden. You do not have permission to access this resource, or are over your rate limit.');
				break;
			case 400:
				// You may want to fall through here and read the specific XML error
				die('Your call to MASS Web Services failed and returned an HTTP status of 400. That means:  Bad request. The parameters passed to the service did not match as expected. The exact error is returned in the XML response.');
				break;
			default:
				return 'Your call to MASS Web Services returned an unexpected HTTP status of:' . $status_code;
		}

		// Get the XML from the response, bypassing the header

		if (!($xml = strstr($response_body, '<?xml'))) {
			$result = null;
		} else {
			return array(
			    'content' => $response_body,
			    'http_code' => $status_code,
		    );

			$xml = new Xml($response_body);
			$result = $xml->toArray();
		}

		//return new SimpleXMLElement($response);
		return $result;
	}

		private function parseResponse($response) {
		if (!$response) {
			return array("code" => '無法識別的域名', "header" => '', "body" => '');
		}
		if (substr_count($response, 'HTTP/1.') > 1) { // yet another weird bug. CURL seems to be appending response bodies together
            $chunks = preg_split('@(HTTP/[0-9]\.[0-9] [0-9]{3}.*\n)@', $response, -1, PREG_SPLIT_DELIM_CAPTURE);
            $this_response = array_pop($chunks);
            $this_response = array_pop($chunks) . $response;
        }

        list($response_headers, $response_body) = explode("\r\n\r\n", $response, 2);
        $response_header_lines = explode("\r\n", $response_headers);

        $http_response_line = array_shift($response_header_lines);
        if (preg_match('@^HTTP/[0-9]\.[0-9] 100@',$http_response_line, $matches)) {
            return $this->_parseResponse($response_body);
        } else if(preg_match('@^HTTP/[0-9]\.[0-9] ([0-9]{3})@',$http_response_line, $matches)) {
            $response_code = $matches[1];
        }
		return array("code" => $response_code, "header" => $response_header_lines, "body" => $response_body);
	}

	/**
	 * 构造header头
	 */
	public function makeHeaders(array $headers, $realm = '') {
		if($realm) {
			//$out = 'Authorization: OAuth realm="' . OAuthUtil::urlencode_rfc3986($realm) . '",';
			$out = 'OAuth realm="' . OAuthUtil::urlencode_rfc3986($realm) . '",';
		} else {
			//$out = 'Authorization: OAuth ';
			$out = 'OAuth ';
		}

		$params = array();
		ksort($headers);
		foreach ($headers as $k => $v) {
			//只处理oauth开头的
			if (substr($k, 0, 5) != "oauth") continue;

			$params[] = OAuthUtil::urlencode_rfc3986($k). '="' .
						OAuthUtil::urlencode_rfc3986($v). '"';
		}
		return $out . implode(',', $params);
	}


}
