<?php

	var_dump($_POST);
	var_dump($_GET);


$filename = 'data/todo_list.txt';

$items = open_file($filename);


// this reads a file and returns the contents as an array
		function open_file($filename) {
    		$handle = fopen($filename, "r");
    		$contents = fread($handle, filesize($filename));
    		fclose($handle);
    		$contents_array = explode("\n", $contents);
    		$items = $contents_array;
    		return $items;
    	}

// save an array to file - 1 value per line
    	function save_file($filename, $items) {
    		$itemStr = implode("\n", $items);
    		$handle = fopen($filename, "w");
    		fwrite($handle, $itemStr);
    		fclose($handle);
    	}


		// check if $_POST['new_todo'] is set
    	if(isset($_POST['new_todo'])) {
    		// echo "WE HAVE A NEW ITEM!";
    		$item = ($_POST['new_todo']);
			$results = array_push($items, $item);
			save_file($filename, $items);
			header("Location: todo-list.php");
    	}


    	// We use the GET here to remove the item
		if(!empty($_GET)) {
    		array_splice($items, $_GET['remove'], 1);
			save_file($filename, $items);
			header("Location: todo-list.php");
    	}

	?>


<!DOCTYPE html>
<html>
	<head>
        <title>To Do List </title>
        <meta name="description" content="Ryan Orsinger's To Do list">
        <meta name="author" content="Ryan Orsinger">
	</head>
	<body>

<h1> TODO List: The Awesome To Do List of My Great Agenda! </h1>
		
 
	<ul>
		<?php
			foreach($items as $key => $item) { ?>
				<li>
				<?php echo $item; ?>
				<a href="?remove=<?php echo $key; ?>">Remove Item;</a></li>	
				<?php } ?>
	</ul>




	<h2> Enter New To Do Items </h2>




	<form method="POST" action="">
   		 <p>
      	  <label for="new_todo">New To Do</label>
     	   <input id="new_todo" name="new_todo" type="text" placeholder="type new todo here">
  	 	</p>
  	  		<p>
       		<input type="submit">
		</form>


	

	</body>
	
</html>