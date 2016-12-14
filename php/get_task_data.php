<?php
	//credentials
	$servername = "50.62.209.83:3306";
	$username = "aagarwal";
	$password = "abc123!@#";
	$dbname = "Task_Manager_DB";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$data = mysqli_query($conn, "SELECT * FROM main_task_list");

	$row_count = 0;
	$task_ids = null;
	$task_names = null;
	$task_due_dates = null;
	$task_statuses = null;

	while($row = mysqli_fetch_assoc($data)) 
	{
		$task_ids[$row_count] = $row["task_id"];
		$task_names[$row_count] = $row["task_name"];
		$task_due_dates[$row_count] = $row["task_due_date"];
		$task_statuses[$row_count] = $row["task_status"];

		$row_count++;
	}

	$items = array('task_ids'=>$task_ids, 'task_names'=>$task_names, 'task_due_dates'=>$task_due_dates, 'task_statuses'=>$task_statuses, 'row_count'=>$row_count);
	echo json_encode($items);	
?>