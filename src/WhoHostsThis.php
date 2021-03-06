<?php

namespace WhoHostsThis;

/**
 * Base class for WhatCMS API wrapper
 *
 */
class WhoHostsThis{

	protected $api_key		= '';
	protected $endpoint		= 'https://www.who-hosts-this.com/APIEndpoint';


	/**
	 * Initialize WhoHostsThis
	 *
	 */
	public function __construct($api_key){

		$this->api_key = $api_key;

	}


	/**
	 * Detect the hosting provider of a given url
	 * If the api request fails, guzzle may throw an exception
	 *
	 * @param string $check_url The url you would like to check for a hosting provider. Example: https://www.who-hosts-this.com
	 * @param bool $assoc Whether or not to return the result as an associative array. Defaults to true
	 *
	 * return mixed Returns NULL if the json response cannot be decoded. Returns associate array if the $assoc argument is true. Otherwise, returns object
	 */
	public function CheckUrl($check_url, $assoc = true){

		$query			= array();
		$query['key']	= $this->api_key;
		$query['url']	= $check_url;

		$url			= $this->endpoint . '?'. http_build_query($query, null,'&', PHP_QUERY_RFC3986 );

		$client			= new \GuzzleHttp\Client();
		$response		= $client->request('GET', $url );

		$content		= $response->getBody()->__toString();
		$result			= json_decode($content, $assoc);

		return $result;
	}



}

