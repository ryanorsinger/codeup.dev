<?php

var_dump($_GET);

var_dump($_POST);

// delete from todo_table where id= ? (put in the id of what you )



$todolist = [
			'take out the trash',
			'mow the yard',
			'buy groceries'
			];


?>

<html>
	<head>
		<title></title>
	</head>

<body>
	
	<h1>Todo List </h1>

<ul>

	<? foreach($todolist as $key => $item): ?>
		<li><?= $item; ?> <button onclick="removeById(<?= $key; ?>)">Remove</a></li>
	<? endforeach; ?>
</ul>

<form action="todo-db.php" id="removeForm">
	<input id="removeId" name="remove" value="">

</form>

<button onclick="remove('1')">Remove Test</button>

<script>
	var form = document.getElementById('removeForm');
	var removeId = document.getElementById('removeId');

	function removeById(id) {
		removeId.value = id;
		form.submit();
	}

</script>


</body>

</html>