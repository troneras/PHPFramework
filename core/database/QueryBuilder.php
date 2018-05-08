<?php
namespace App\Core\Database;
use PDO;
/**
*  QueryBuilder: makes queries a breeze
*/
class QueryBuilder
{
	private $pdo; 
	
	function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function selectAll($table, $parseTo = NULL)
	{
		// prepare query
		$statement = $this->pdo->prepare("select * from {$table}");

		// execute query
		$statement->execute();

		// return results
		if ($parseTo == NULL) {
			return $statement->fetchAll(PDO::FETCH_CLASS);
		}
		return $statement->fetchAll(PDO::FETCH_CLASS, $parseTo);
	}

	public function insert($table='', $parameters)
	{
		$sql = sprintf('insert into %s (%s) values (%s)',
			$table,
			implode(',',array_keys($parameters)),
			':'.implode(', :',array_keys($parameters))
		);
	
		try {
			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);			
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function update($table='', $conditions, $values)
	{
        
        $sql_condition = implode(',',array_map(function ($k){
        	return $k.' = :'.$k;
        }, array_keys($conditions) ));
        $sql_values = implode(',',array_map(function ($k){
        	return $k.' = :'.$k;
        }, array_keys($values) ));
		$sql = sprintf('update %s SET %s WHERE %s',
			$table,
			$sql_values,
			$sql_condition
		);

		try {	
			$statement = $this->pdo->prepare($sql);

			$statement->execute(array_merge($conditions,$values));			
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function deleteById($table='',$id='')
	{
		$sql = sprintf('delete from %s WHERE id = :id',
			$table
		);

		try {	
			$statement = $this->pdo->prepare($sql);

			$statement->execute(['id' => $id]);			
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}