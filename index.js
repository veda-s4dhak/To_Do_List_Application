$(document).ready(function() 
{
	init();

	create_task();

	delete_task();

	complete_task();

	incomplete_task();

	populate_main_task_list();

	$(document).on('click', ".task_reference", function() 
	{
		current_task = $(this).attr("id"); 
	});
});

function init()
{
	window.current_task = null;

	//$("#create_task_form").hide();
}

function delete_task()
{
	$('#delete_task_btn').click(function() 
	{
		if (current_task == null)
			alert("You must select a task first!");
		else
		{
			$.post("php/delete_task.php", "task_id="+current_task).done(function(data) 
			{			
				obj = jQuery.parseJSON(data);

				info_correct = obj.info_correct;

				if (info_correct == 0) 
				{
					//alert("Task Deleted.");
					$('.task_list').empty();
					populate_main_task_list();

					return false;
				}
			});
		}
	});
}

function create_task()
{
	$('#create_task_btn').click(function() 
	{
		$("#create_task_form_popup").popup("open");
	});

	$("#create_task_form").submit(function(e) 
	{
		e.preventDefault();

		$.post("php/insert_task.php", $("#create_task_form").serialize()).done(function(data) 
		{			
			obj = jQuery.parseJSON(data);

			info_correct = obj.info_correct;

			if (info_correct == 0) {
				//alert("Task Created.");
				$('.task_list').empty();
				populate_main_task_list();

				return false;
			} else if (info_correct == 1) {
				$("#invalid_1").text("Invalid Entry! See the instructions on the left").show().fadeOut(2000);
				return false;
			} else if (info_correct == 2) {
				$("#invalid_2").text("Invalid Entry! See the instructions on the left").show().fadeOut(2000);
				return false;
			}	
		});

		return false;
	});
}

function complete_task()
{
	$('#complete_task_btn').click(function() 
	{
		if (current_task == null)
			alert("You must select a task first!");
		else
		{
			$.post("php/complete_task.php", "task_id="+current_task).done(function(data) 
			{			
				obj = jQuery.parseJSON(data);

				info_correct = obj.info_correct;

				if (info_correct == 0) 
				{
					$('.task_list').empty();
					populate_main_task_list();

					return false;
				}
			});
		}
	});
}

function incomplete_task()
{
	$('#incomplete_task_btn').click(function() 
	{
		if (current_task == null)
			alert("You must select a task first!");
		else
		{
			$.post("php/incomplete_task.php", "task_id="+current_task).done(function(data) 
			{			
				obj = jQuery.parseJSON(data);

				info_correct = obj.info_correct;

				if (info_correct == 0) 
				{
					$('.task_list').empty();
					populate_main_task_list();

					return false;
				}
			});
		}
	});
}

function populate_main_task_list()
{
	$.ajax({
		url: 'php/get_task_data.php',
		data: '', 
		dataType: 'json',
		success: function(data) {
			var task_names = data.task_names,
				task_ids = data.task_ids,
				task_due_dates = data.task_due_dates;
				task_statuses = data.task_statuses;
				row_count = parseInt(data.row_count);

				for (i=0; i < row_count; i++)
				{
					if (task_statuses[i] == 'incomplete')
					{
						$("#incomplete_list").append( "<li class='list_reference' id='"+task_ids[i]+"'><a class='task_reference' id='"+task_ids[i]+"'>"+task_names[i]+", due: "+task_due_dates[i]+"</a></li>" );
						$("#incomplete_list").listview("refresh");
					}
					else
						if (task_statuses[i] == 'complete')
						{
							$("#complete_list").append( "<li class='list_reference' id='"+task_ids[i]+"'><a class='task_reference' id='"+task_ids[i]+"'>"+task_names[i]+", due: "+task_due_dates[i]+"</a></li>" );
							$("#complete_list").listview("refresh");
						}
				}
		}
	});	
}