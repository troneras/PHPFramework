<?php 

namespace App\Core;
/**
* 
*/
class App
{
	protected static $registry = [];

	static function bind($key,$value)
	{
		static::$registry[$key] = $value;
	}

	static function get($key)
	{
		if (!array_key_exists($key, static::$registry)) {
			throw new Exception("No {$key} is bind to the container", 1);
		}
		return static::$registry[$key];
	}
}