<?php
/*
 * functions for database transactions
 * used for creating, deleting, selecting, updating, inserting database/records/tables
 */
require 'DbAccess.php';


//creates a database | database table | delete a row - args = sql statement 
function sql_create($sqlstatement){
	try{
		$con = connection();
		$con->exec($sqlstatement);
		echo "sql statement successfully executed";
	}catch(PDOException $e){
		echo "error caught: ".$e->getMessage();
	}
}



//prepared insert - requies sql statement, bind names and values as args
function prepared_insert($sql, $bindname, $bindValue){
	try{
		$con = connection();
		$stmt = $con->prepare($sql);
		foreach(array_combine($bindname, $bindValue) as $db_vars=> $bd_input){
			$stmt->bindParam(":$db_vars", $db_vars);
			
		}
		$stmt->execute();
		echo "Records successfully created<\n";
		
	}catch(PDOException $e){
		echo "error caught: ".$e->getMessage();
	}
}




//inserts multiple records - args is an array of sql insert statements
function sql_multi_insert($sqlStatementArray){
	try{
		$con = connection();
		$con->beginTransaction();
		$count = 0;
		foreach($sqlStatementArray as $record){
			$con->exec($record);
		}
		$con->commit();
		echo $count++." Records entered...<\n";
	}catch(PDOException $e){
		$con->rollBack();
		echo "error caught: ".$e->getMessage();
	}
}

//gets or updates the data from the database based on the query type = (select | update)
function get_data($query, $sqlStatement){
	try{
		$con = connection();
		$stmt = $con->prepare($sqlStatement);
		$stmt->execute();
		
		switch($query){
			case 'select':
				$results = $stmt->fetchAll();
				$count = 0;
				foreach($results as $row){
					display_data($row);//function that displays the data
					$count++;
					
				}
				no_results_msg($count);
				break;
			case 'update':
				echo $stmt->rowCount()." record updated successfull";
				break;
			default:
				"an error has occured: \n";
		}
	}catch(PDOException $e){
		echo "error caught: ".$e->getMessage();
	}
}

function no_results_msg($count){
	if($count <= 0){
		echo "No Results Found \n";
	}
}
//displays the data
function display_data($row){
	echo "<p>{$row['NAME']}</p>";
	echo "<p>{$row['AGE']}</p>";
	echo "<p>{$row['ID']}</p>";
}


