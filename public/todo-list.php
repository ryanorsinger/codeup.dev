<? 


require_once('filestore.php');

$todo = new Filestore ();


$items = $todo->read();


//load file
if (!empty($_POST["newitem"])){
	$item = $_POST["newitem"];
	array_push($items, $item);
	$todo->write($items);
}



//remove
if (isset($_GET['remove'])){
	unset($items[$_GET['remove']]);
	$todo->write($items);
	header("Location: todo-list.php");
	exit;
}


if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0){
	var_dump($_FILES);
	var_dump($_POST);
	if ($_FILES['file1']['type'] != 'text/plain') {
		$errorMsg = 'Invalid Filw type';
		echo $errorMsg;
	} else {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$new_file = basename($_FILES['file1']['name']);
		$saved_filename = $upload_dir . $new_file;
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
		$addFile = new Filestore($saved_filename);
		$newitems = $addFile->read_lines();
	  
	    if (isset($_POST['over1']) && $_POST['over1'] == TRUE){
	    	$items = $newitems;
	    }else{
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
</head>
<body>

<h2>TODO List</h2>
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
	<form method="POST" enctype="multipart/form-data" action="/todo-list.php">
		<p>
		<input type="text" id="newitem" name="newitem" autofocus="autofocus" placeholder="add item">
		<input type="submit" value="add" >
		</p>
		<p>
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
</body>
</html>