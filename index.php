<?php
	$database_status = "true"; //true = functioning, false = not functioning

	//credentials
	$servername = "50.62.209.83:3306";
	$username = "aagarwal";
	$password = "abc123!@#";
	$dbname = "Task_Manager_DB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) 
	{
	    $database_status = "false";
	} 

	if ($database_status == "true")
	{
		if(mysqli_num_rows(mysqli_query($conn, "SHOW TABLES LIKE 'main_task_list'"))==0) 
			$database_status = "false";
		
	}

	if ($database_status == "false")
	{
		echo "DB not functioning";
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="initial-scale=0.25">
		<!--jQuery CDN-->
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<!--jQuery Mobile CDN -->
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<!--custom reference
		<script src="index.css"></script>-->
		<script src="index.js"></script>
	</head>

	<body>
		<div style="margin-top: 40px;">
			<table style="margin: 0 auto;">
				<tr style="margin-top: 20px;">	
					<div id="main_list" style="margin: 0 auto; height: 583px; width: 585px; border-style: solid; border-width: 5px; overflow: scroll;">
						<div id="in_progress_list">
							<h2 style="text-align: center; font-size: 15px;">Tasks In Progress</h2>
							<ul data-role="listview" class="task_list" id="incomplete_list">
							     
						    </ul>		
						</div>

						<div id="completed_list">
							<h2 style="text-align: center; font-size: 15px;">Completed Tasks</h2>
							<ul data-role="listview" class="task_list" id="complete_list">
						     
						    </ul>		
						</div>	
					</div>
				</tr>
				<tr style="margin-top: 5px;">
					<td>
						<table>
							<tr>
								<td>
									<button id="create_task_btn">Create Task</button>
								</td>
		
								<td>
									<button id="complete_task_btn">Complete Task</button>
								</td>

								<td>
									<button id="incomplete_task_btn">Incomplete Task</button>
								</td>

								<td>
									<button id="delete_task_btn">Delete Task</button>
								</td>
							</tr>
						</table>		
					</td>
				</tr>
				<!--<tr>
					<div id="daily_task_window" style="height: 583px; width: 585px;  border-style: solid; border-width: 5px; overflow: scroll;">
						<div id="daily_task_list">
							<ul data-role="listview">
						    </ul>		
						</div>
						<div id="task_view">
						</div>				
					</div>
				</tr>-->
			</table>
		</div>

		<div data-role="popup" id="popupMenu" data-theme="a" style="margin: 0 auto;">
		    <div data-role="popup" id="create_task_form_popup" data-theme="a" class="ui-corner-all">
		        <div style="padding:10px 20px;">
		           	<form id="create_task_form" action="" method="post" >
						Task: <span class="invalid" id="invalid_1"></span><input id="task_name_input" type="text" name="task_name" placeholder='Enter task'><br>
						Due date: <span class="invalid" id="invalid_2"></span><input id="task_due_input" type="text" name="task_due_date" placeholder='Enter due date'><br>
						<input type="submit" data-theme="b" id="create_task_submit" value="Submit"></input>	
					</form>
		        </div>
		    </div>
		</div>
	</body>
</html>

<!-- Temp Code

	date_default_timezone_set('America/Toronto');

	echo date("l");

	// sql to create table
	/*$sql = "CREATE TABLE main_task_list (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	task_id INT(6) NOT NULL,
	task_name VARCHAR(30) NOT NULL,
	task_due_date VARCHAR(50),
	task_status VARCHAR(30) NOT NULL,
	date_created TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table MyGuests created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}*/

	/*$sql = "INSERT INTO main_task_list (task_id, task_name, task_due_date, task_status)
	VALUES (1, 'envs 200 lab report', 'july monday', 'incomplete')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	$data = mysqli_query($conn, "SELECT * FROM main_task_list");


							     	$data = mysqli_query($conn, "SELECT * FROM main_task_list");

									if (mysqli_num_rows($data) > 0) 
									{
										while($row = mysqli_fetch_assoc($data)) 
									    {
									        if ($row["task_status"] == "incomplete")
									        	echo "<li class='list_reference' id='".$row["task_id"]."'><a class='task_reference' id='".$row["task_id"]."'>".$row["task_name"].", due: ".$row["task_due_date"]."</a></li>";
									    }
									}
							      

							     
							     	$data = mysqli_query($conn, "SELECT * FROM main_task_list");

									if (mysqli_num_rows($data) > 0) 
									{
										while($row = mysqli_fetch_assoc($data)) 
									    {
									        if ($row["task_status"] == "complete")
									        	echo "<li class='list_reference' id='".$row["task_id"]."'><a class='task_reference' id='".$row["task_id"]."'>".$row["task_name"].", due: ".$row["task_due_date"]."</a></li>";
									    }
									}
							      

-->