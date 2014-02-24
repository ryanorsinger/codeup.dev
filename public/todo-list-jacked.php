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

<?php
session_start();

$username = 'codeup';
$password = 'letmein';

if ($_GET['logout'] == TRUE) {
	$_SESSION = array();
	session_destroy();
	header("Location: todo-list.php";
}

if (!empty($_POST)) {
	if ($_POST['username'] == $username && $_POST['password'] == $password) {
		$_SESSION['logged_in'] == TRUE;
	}
}

if ($_SESSION['logged_in']==TRUE) {
	echo "<p>You are logged in.</p>";
	echo "<p><a href'/lecture.php?logout=true'>Log out</a></p>";
}

?>

<!-- 
$things = ['Send my a copy of my resume to my inner circle',
				'Call CPS to figure out the bill thing',
				'Call ATT to figure out the bill thing',
				'Start writing the layout and questions of my survey'];

?>
	<ul>
		<?php> foreach ($things as $thing) {
				echo "<li>$thing</li>";
			}	 
		?>
	</ul> -->

<!-- Below the unordered list, create a form that contains the necessary inputs 
	to add a TODO item to the list. 
	Add a heading above the form describing the function of the form.
 -->
<!-- 
	 <form method="GET" action="">
			<p>
                <label for="newtodo">To Do Item</label>
                <input id="newtodo" name="newtodo" type="text" placeholder="enter a todo">
            </p> 	
     </form> -->
     
</body>
</html>

