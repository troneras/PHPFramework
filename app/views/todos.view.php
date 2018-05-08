<?php include('partials/head.php');?>
	<h1>Simple TODO APP</h1>
	<h2>Completed</h2>

	<ul>
		<?php foreach ($completed as $todo): ?>
			<li>
				<strike><?= $todo->name; ?></strike>
				<form action="/todos/update" method="POST">
					<input type="hidden" name="id" value="<?= $todo->id; ?>">
					<input type="hidden" name="completed" value="0">
					<button type="submit">Mark as incomplete</button> 
				</form>
				<form action="/todos/delete" method="POST">
					<input type="hidden" name="id" value="<?= $todo->id; ?>">
					<button type="submit">Delete</button> 
				</form>
			</li>
		<?php endforeach; ?>
	</ul>

	<h2>Incomplete</h2>
	<ul>
		<?php foreach ($incomplete as $todo): ?>
			<li>
				<?= $todo->name; ?> 
				<form action="/todos/update" method="POST">
					<input type="hidden" name="id" value="<?= $todo->id; ?>">
					<input type="hidden" name="completed" value="1">
					<button type="submit">Mark as Complete</button> 
				</form>
				<form action="/todos/delete" method="POST">
					<input type="hidden" name="id" value="<?= $todo->id; ?>">
					<button type="submit">Delete</button> 
				</form>
			</li>
			
		<?php endforeach; ?>
	</ul>

	<h2>Create new TODO</h2>
	<form method="POST" action="todos">
		<input type="text" name="name">
		<button type="submit">Create</button>
	</form>
<?php include('partials/footer.php'); ?>