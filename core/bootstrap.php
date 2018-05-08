<?php 
	use App\Core\App;
	use App\Core\Database\ConnectionManager;
	use App\Core\Database\QueryBuilder;
 // Configuration file

	App::bind('config', require 'config.php');

	App::bind('database', new QueryBuilder(
		ConnectionManager::getConnectionManager(App::get('config'))->getConnection()
	));

function view($name, $data = [])
{
	extract($data);

	return include "app/views/{$name}.view.php";
}


function redirect($location)
{
	header("Location: {$location}");
}

function dd($value='')
{
	die(var_dump($value));
}