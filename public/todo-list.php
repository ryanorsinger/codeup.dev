<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump)($_POST);

?>
<!DOCTYPE html>
<html>
<head>
        <meta> charset="utf-8">
        <title>To Do List </title>
        <meta name="description" content="Ryan Orsinger's ToDo list">
        <meta name="author" content="Ryan Orsinger">
</head>
<body>


<h1> TODO List: The Awesome To Do List of My Great Agenda! </h1>
	<ul>
		<li> Send my a copy of my resume to Donald </li>
		<li> Call CPS to figure out the bill thing </li>
		<li> Call ATT to figure out the bill thing </li>
		<li> Start writing the layout and questions of my survey </li>
	</ul>

<!-- Below the unordered list, create a form that contains the necessary inputs 
	to add a TODO item to the list. 
	Add a heading above the form describing the function of the form.
 -->

	 <form method="GET" action="">
			<p>
                <label for="newtodo">To Do Item</label>
                <input id="newtodo" name="newtodo" type="text" placeholder="enter a todo">
            </p> 	
     </form>
     
</body>
</html>
