<?php
	//getting post data
	$task_name = $_POST['task_name'];
	$task_due_date = $_POST['task_due_date'];

	//This code is used for debugging purposes.
	//You can run tests directly to the php in this block.
	//---------------------------
	//$task_name = 'test';
	//$task_due_date = '2';
	//---------------------------

	//credentials
	$servername = "50.62.209.83:3306";
	$username = "aagarwal";
	$password = "abc123!@#";
	$dbname = "Task_Manager_DB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//validating the data
	//-----------------------------------
	$info_correct = 0;

	if (CheckTaskField($task_name) == false)
		$info_correct = 1;
	else if (CheckDueDateField($task_due_date) == false)
		$info_correct = 2;
	//-----------------------------------

	if ($info_correct == 0)
	{
		$task_id = next_task_id($conn, "main_task_list");

		$sql = "INSERT INTO main_task_list (task_id, task_name, task_due_date, task_status)
		VALUES (".$task_id.", '".$task_name."', '".$task_due_date."', 'incomplete')";
		
		mysqli_query($conn, $sql);
	}

	$items = array('info_correct'=>$info_correct);

	echo json_encode($items);	

	//mysqli_close($con);

?>

<?php //functions
	function CheckTaskField($value) 
	{
    	if(empty($value)) 
       		return false;
    	if ( strpos($value, "'") !== false) 
     		return false;
    	if ( strpos($value, '"') !== false) 
     		return false;

    	return true;
	}

	function CheckDueDateField($value) 
	{
    	if ( strpos($value, "'") !== false) 
     		return false;
    	if ( strpos($value, '"') !== false) 
     		return false;

    	return true;
	}

	function options_same($arg1,$arg2)
	{
		if ( ($arg1 == $arg2) AND ($arg1 != null) )
			return true;
		else
		 	return false; 
	}

	function next_task_id($conn, $table_name) //this function finds the rowID that is to be used for the new row being inserted
	{
		$data = mysqli_query($conn, "SELECT * FROM ".$table_name);

		$currentGreatestTaskID = -1;

		if (mysqli_num_rows($data) > 0) 
		{
			while($row = mysqli_fetch_assoc($data)) 
				if ($currentGreatestTaskID < $row['task_id'])
					$currentGreatestTaskID = $row['task_id'];
		}

		return $currentGreatestTaskID+1;
	}
?>