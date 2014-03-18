<?php
 
var_dump($_GET);
var_dump($_POST);

// Instantiates a new connection to the databasse
$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

// check for errors connecting to the database
if ($mysqli->connect_errno) {
    throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (!empty($_POST)) 
{
	
	//check for new todo
	if(isset($_POST['todo']))
	{
		if ($_POST['todo'] != "")
		{
			// add to database
		}
	}
	else if (!empty($_POST['remove']))
	{
		// make sure I have an integer value (with intval or with prepared statements
		// remove item from db
	}
}

// Retrieve a result set using SELECT
$todos = $mysqli->query("SELECT * FROM todos");
 

 
?>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">


	<title>Todo List</title>
</head>
<body>
<div class="container">


<h1>Todo List</h1>
 
<table class="table table-striped">
<? while ($todo = $todos->fetch_assoc()): ?>
	<tr>
		<td><?= $todo['item']; ?> </td>
		<td><button type="button" class="btn btn-danger btn-sm pull-right" onclick="removeById(<?= $todo['id']; ?>)">Remove</button></td>
	</tr>
<? endwhile; ?>
</table>

<h2> Add Items </h2>
<form class="form-horizontal" role="form" action="todo-db.php" method="POST">
	<div class="form-group">
		<label class="sr-only" for="todo">To Do Item</label>
		<input type="text" name="todo" class="form-control" id="todo" placeholder="Enter new to do item">
	</div>
	<button type="submit" class="btn btn-default">Add to do</button>
</form>
 

</div>  <!-- close container -->



<form id="removeForm" action="todo-db.php" method="post">
	<input id="removeId" type="hidden" name="remove" value="">
</form>
 







<script>
	
	var form = document.getElementById('removeForm');
	var removeId = document.getElementById('removeId');
 
	function removeById(id) {
		removeId.value = id;
		form.submit();
	}
 
</script>
 <!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>