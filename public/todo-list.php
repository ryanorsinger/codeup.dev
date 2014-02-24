<!DOCTYPE html>
<html>
	<head>
        <title>To Do List </title>
        <meta name="description" content="Ryan Orsinger's ToDo list">
        <meta name="author" content="Ryan Orsinger">
	</head>
	<body>



<h1> TODO List: The Awesome To Do List of My Great Agenda! </h1>

	<?php $todos = ['Send my a copy of my resume to my peeps',
				'Call CPS to figure out the bill thing',
				'Call ATT to figure out the bill thing',
				'Complete the layout for my Survey'];
		var_dump($todos);
	?>
 
	<ul>
		<?php
			foreach($todos as $todo) {
				echo "<li>$todo</li>";
			}
		?>
	</ul>
	

	</body>
	
</html>