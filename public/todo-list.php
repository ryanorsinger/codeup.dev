<?php



$filename = 'data/todo_list.txt';

// set the items array to the file contents if the file exists, otherwise make it an empty array
$items = (filesize($filename) > 0) ? $items = open_file($filename) : array();

// this reads a file and returns the contents as an array
		function open_file($filename) {
    		$handle = fopen($filename, "r");
    		$contents = fread($handle, filesize($filename));
    		fclose($handle);
    		$contents_array = explode("\n", $contents);
    		$items = $contents_array;
    		return $items;
    	}

// save an array to file as a flat file with items delimited by a newline
    	function save_file($filename, $items) {
    		$itemStr = implode("\n", $items);
    		$handle = fopen($filename, "w");
    		fwrite($handle, $itemStr);
    		fclose($handle);
    	}


		// check if $_POST['new_todo'] is set
    	if (!empty($_POST['new_todo'])) {
    		// echo "WE HAVE A NEW ITEM!";
    		$item = ($_POST['new_todo']);
			$results = array_push($items, $item);
			save_file($filename, $items);
			header("Location: todo-list.php");
    	}


    	// We use the GET here to remove the item
		if(!empty($_GET['remove'])) {
    		array_splice($items, $_GET['remove'], 1);
			save_file($filename, $items);
			header("Location: todo-list.php");
			die();
    	}

	// Verify there were uploaded files and no errors
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
    	// Set the destination directory for uploads
	    $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
	    // Grab the filename from the uploaded file by using basename
	    $filename = basename($_FILES['file1']['name']);
	    // Create the saved filename using the file's original name and our upload directory
	    $saved_filename = $upload_dir . $filename;
	    // This concatenates the directory with the filename and gives us a saved filename and path.
	    // Move the file from the temp location to our uploads directory
	    move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
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
    		foreach($items as $key => $item) {
         		 echo "<li>$item <a href='?remove=$key'>Remove Item</a></li>";
    		}
		?>
	</ul>


	<h3> Enter New To Do Items </h3>

	<form method="POST" enctype="multipart/form-data" action="">
   		 <p>
      	  <label for="new_todo">New To Do</label>
     	  <input id="new_todo" name="new_todo" type="text" autofocus="autofocus" placeholder="type new todo here">
       	<br>
       		<input type="submit" value="Add Item">
       	
       	
		</form>

<h3> Upload a Text File </h3>
	<?php
	// 	Check if we saved a file
	if (isset($saved_filename)) {
    	// If we did, show a link to the uploaded file
	    echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";
	}
	?>

		<form method="POST" enctype="multipart/form-data">
    	<p>
        	<label for="file1">File to upload: </label>
        	<input type="file" id="file1" name="file1">
    	</p>
    	<p>
        	<input type="submit" value="Upload">
    </p>
</form>


		<img src="/img/pirate-todo" alt="YARRRR">


	</body>
	
</html>