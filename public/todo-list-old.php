<?php

function read_file($filename) {
		$handle = fopen($file, "r");
		$setFile = filesize($file)
}






<!DOCTYPE html>
<html>
	<head>
        <title>To Do List </title>
        <meta name="description" content="Ryan Orsinger's To Do list">
        <meta name="author" content="Ryan Orsinger">
	</head>
	<body>

<h1> TODO List: The Awesome To Do List of My Great Agenda! </h1>

	<?php 
	var_dump($_POST);
	var_dump($_GET);


	// load todo.txt
	// add items from todo.txt to $items array 

	

		$filename = '/vagrant/exercises/data/todo.txt';
		$items = open_file($filename);
		

		function open_file($filename) {
    		$handle = fopen($filename, "r");
    		$contents = fread($handle, filesize($filename));
    		fclose($handle);
    		$contents_array = explode("\n", $contents);
    		$items = $contents_array;
    		return $items;
    	}

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
    	}
		
		if(isset($_GET['remove'])) {
       		$itemID = ($_GET['remove']);
			$results = unset($items, $itemID);
			save_file($filename, $items);
    	}

	?>

		
 
	<ul>
		<?php
    		foreach($items as $key => $item) {
          	echo "<li>$item<a href='?remove=$key'>Remove Item</a></li>";
    		}
		?>
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