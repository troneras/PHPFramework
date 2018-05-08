<?php 
	namespace App\Controller;

	use App\Core\App;
/**
* 
*/
class TodosController
{
	
	public function index()
	{
		$todos = App::get('database')->selectAll('todos');
		
		$completed = array_filter($todos, function($todo)
		{
			return $todo->completed;
		});
		$incomplete = array_filter($todos, function($todo)
		{
			return !$todo->completed;
		});
		
		return view('todos', compact('todos','completed','incomplete'));
	}

	public function store()
	{
		App::get('database')->insert('todos', [
				"name" => $_POST['name'],
				"completed" => false
		]);
		return redirect('/todos');		
	}

	public function update()
	{
		App::get('database')->update(
			'todos', 
			['id' => $_POST['id']],
			['completed' => (bool)$_POST['completed']]
		);

		return redirect('/todos');		
	}

	public function delete()
	{
		App::get('database')->deleteById('todos',$_POST['id']);

		return redirect('/todos');
	}
}