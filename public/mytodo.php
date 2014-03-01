<?php
 
class TodoList {
 
	// Set default file name and location
	public $filename = 'data/todo_list.txt';
 
	// Set the defaults items array
	public $items = array();
 
	// Set list items and optional filename
	public function __construct($filename = '') {
		if (!empty($filename)) {
			$this->filename = $filename;
		}
		$this->items = $this->get_list();
	}
 
	// Save array to files
	public function save_file() {
	    $save_list = implode("\n", $this->items);
	    $handle = fopen($this->filename, "w");
	    fwrite($handle, $save_list);
	    fclose($handle);
	}
 
	// Read a txt file, return an array
	public function read_file() {
	    $handle = fopen($this->filename, "r");
	    $contents = fread($handle, filesize($this->filename));
	    fclose($handle);
	    return explode("\n", $contents);
	}
 
	// Returns an array of todo items
	public function get_list() {
		if (filesize($this->filename) > 0) {
			return $this->read_file($this->filename);
		} else {
			return array();
		}
	}
 
	// Add item to list, return new list
	public function add_item($item) {
		$new_item = htmlspecialchars(strip_tags($item));
		array_push($this->items, $new_item);
		$this->save_file();
	}
 
	// Remove item from list, redirect optional
	public function remove_item($key, $redirect = FALSE) {
		unset($this->items[$key]);
		$this->save_file();
		if (is_string($redirect)) {
			header("Location: $redirect");
			exit(0);	
		}	
	}
 
}
 
// Get new instance of TodoList
$tds = new TodoList();
$todo_list = $tds->read_file;

// Check for removal from list - process if exists
if (isset($_GET['remove'])) {
	$todo_list->remove_item($_GET['remove'], 'mytodo.php');
}
 
// Check for new item - process if exists
if (!empty($_POST['newitem'])) {
	$todo_list->add_item($_POST['newitem']);
}

 if (count($_FILES) > 0 && $_FILES['file1']['type'] != 'text/plain') {
        echo "<p>Your file must be a 'text/plain' file type</p>";
        exit(1);
    }
      


    if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
        // Set the destination directory for uploads
        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        // Grab the filename from the uploaded file by using basename
        $newfile = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $newfile;
        // This concatenates the directory with the filename and gives us a saved filename and path.
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

        // explode items from new filename into an array. set the array equal to results;
        // merge the results array onto the items array

        $results = $read_file($saved_filename);
        //var_dump($results);
        //var_dump($items);
        $items = array_merge($items, $results);
        //var_dump($items); 
        save_file($filename, $items);
    }

 
?>
<!DOCTYPE HTML!>
<html>
<head>
	<title>ToDo List</title>
</head>
<body>
	<h1>ToDo List</h1>
	<? if (count($todo_list->items) > 0 ): ?>
		<ul>
			<? foreach ($todo_list->items as $key => $item): ?>
				<li><?= $item; ?> | <a href='/mytodo.php?remove=<?= $key; ?>' name='remove' id='remove'>remove</a></li>
			<? endforeach; ?>
		</ul>
	<? else: ?>
		<p>You have 0 todo items.</p>
	<? endif; ?>
	<h2>Add todos to list</h2>
	<form method="POST" action="">
		<p>
			<label for="newitem">Item to add:</label>
			<input id="newitem" name="newitem" type="text" autofocus='autofocus' placeholder="Enter new TODO item">
		</p>
		<p>
			<input type="submit" value="Add Item">
		</p>
		
	</form>

	<h3> Upload a Text File </h3>

        <form method="POST" enctype="multipart/form-data">
        <p>
            <label for="file1">File to upload: </label>

            <input type="file" id="file1" name="file1">
            <br>
            <input type="submit" value="Upload (Append)">
           
        </p>
    </form>
<hr>
<p></p>
<p></p>
<p></p>
<p></p>
<!-- 	Marilyn Manson found your completed to_do_list.csv!
	Manson found your to do list!
<img src="/img/amused_marilyn_manson.jpg" alt="Oh my!">
 --><hr>
<img src="/img/pirate-todo" alt="YARRRR">
<p>&copy; </p>
</body>
</html>