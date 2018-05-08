<?php 
namespace App\Core;
/**
* 
*/
class Request
{
	
	static function uri()
	{
		if (isset($_SERVER['REDIRECT_URL'])) {			
			return trim(
				parse_url($_SERVER['REDIRECT_URL'], PHP_URL_PATH),
				'/'
			);
		}
		return '';
	}

	static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}