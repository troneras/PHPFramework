<?php	
	$router->get('','PagesController@home');
	$router->get('about','PagesController@about');
	$router->get('about/culture','PagesController@aboutCulture');
	$router->get('contact','PagesController@contact');
	$router->get('todos', 'TodosController@index');
	$router->post('todos','TodosController@store');
	$router->post('todos/update','TodosController@update');
	$router->post('todos/delete','TodosController@delete');