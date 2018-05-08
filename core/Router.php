<?php 
namespace App\Core;
/**
* 
*/
class Router 
{
	protected $routes = [
		'GET' => [],
		'POST' => []
	];

	public function load($file)
	{
		$router = new self();
		
		require $file;

		return $router;
	}

	public function define($routes)
	{
		$this->routes = $routes;
	}

	public function get($uri='',$controller='')
	{
		$this->routes['GET'][$uri] = $controller; 
	}

	public function post($uri='',$controller='')
	{
		$this->routes['POST'][$uri] = $controller; 
	}

	public function direct($uri='', $method = '')
	{
		if (!array_key_exists($uri, $this->routes[$method])) {
			throw new Exception("NO ROUTE DEFINED FOR THE url: ".$uri, 404);
		}
		$this->callAction(
			...explode('@', $this->routes[$method][$uri])
		);
		
		
	}

	private function callAction($controller, $action)
	{
		$controller = "App\Controller\\{$controller}";
		$controller = new $controller;

		if (!method_exists($controller, $action)) {
			throw new Exception("No method {$action} exists in controller {$controller}", 1);	
		}

		$controller->$action();
	}
}