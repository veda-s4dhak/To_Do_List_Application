<?php
	//getting post data
	$task_id = $_POST['task_id'];

	//This code is used for debugging purposes.
	//You can run tests directly to the php in this block.
	//---------------------------
	//$task_id = 2;
	//---------------------------

	//credentials
	$servername = "50.62.209.83:3306";
	$username = "aagarwal";
	$password = "abc123!@#";
	$dbname = "Task_Manager_DB";

	// Create connection
	$info_correct = 0;

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "DELETE FROM main_task_list WHERE task_id=".$task_id;
		
	mysqli_query($conn, $sql);

	$items = array('info_correct'=>$info_correct);

	echo json_encode($items);	

	//mysqli_close($con);
?>