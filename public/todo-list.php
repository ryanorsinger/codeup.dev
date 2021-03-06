<? 

require_once('filestore.php');

class InvalidInputException extends Exception {}

$todo = new Filestore ();

$items = $todo->read();


// throw exception if form submit is empty or if string is > 240 characters
try {
	if (isset($_POST['newitem']) && (empty($_POST['newitem']))) {
		throw new InvalidInputException("New To Do item must contain information");
	}

	if ((isset($_POST['newitem'])) && (strlen($_POST['newitem']) > 240)) {
		throw new InvalidInputException('New todo Item must be less than 240 characters');
	}
	// add item and write item to $todo instance of object
	if (!empty($_POST["newitem"])){
		$item = $_POST["newitem"];
		array_push($items, $item);
		$todo->write($items);
	}

} catch (InvalidInputException $e) {
	echo "Please try again. A new to-do item must contain information and be less than 240 characters.";
}


//remove item when remove link is clicked
if (isset($_GET['remove'])){
	unset($items[$_GET['remove']]);
	$todo->write($items);
	header("Location: todo-list.php");
	exit;
}

// upload a new TXT file of to dos 

if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0){
	//var_dump($_FILES);
	//var_dump($_POST);
	if ($_FILES['file1']['type'] != 'text/plain') {
		$errorMsg = 'Invalid File type';
		echo $errorMsg;
	} else {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$new_file = basename($_FILES['file1']['name']);
		$saved_filename = $upload_dir . $new_file;
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
		$addFile = new Filestore($saved_filename);
		$newitems = $addFile->read();
	  
	    if (isset($_POST['over1']) && $_POST['over1'] == TRUE){
	    	$items = $newitems;
	    } else {
			foreach ($newitems as $key => $item) {
	        	array_push($items, $item);
	    	}
		} 
    $todo->write($items);    
    }
}


    
?>

<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
	<link rel="stylesheet" href="css/site.css">
</head>
<body>

<h1>TODO List</h1>
<ul>
	<? foreach ($items as $key => $item) {
		$newTodo = $key + 1; ?>
		<?= "<li>" . htmlspecialchars(strip_tags($item)) . " <a href='?remove=$key'>Remove Item</a></li>";
} ?>

		<? if (isset($saved_filename)) { ?>
		<?= "<p>You can download your file <a href='/uploads/{$new_file}'>here</a>.</p>";
}
?>
 		<? if (!empty($errorMsg))  { ?>
 		<p><?= $errorMsg; ?></p>
 		<? } ?>
</ul>
<hr>
	<form method="POST" enctype="multipart/form-data" action="/todo-list.php" id="form1">
		<p>
		<input type="text" id="newitem" name="newitem" autofocus="autofocus" placeholder="add item">
		<input type="submit" value="add" >
		</p>
		<p>
	</form>
	<hr>
	<form method="POST" enctype="multipart/form-data" action="/todo-list.php" id="form2">
		<label for="file1">add file:</label>
		<input type="file" id="file1" name="file1" >
		</p>
		<p>
		<input type="submit" value="Upload" >
		<form method="POST">
		<label><input type="checkbox" id="over1" name="over1" value="checked">Over Write</label>
		</form>
		</p>
	</form>

<hr>	

<!-- <div> 
Marilyn Manson saw your todo-list and correlated it with your address book!
<br>
<img src="/img/amused_marilyn_manson.jpg" alt="Manson has your Address Book!">
 -->
</body>
</html>