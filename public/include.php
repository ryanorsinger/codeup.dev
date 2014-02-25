<?php

	var_dump($_POST);
	var_dump($_GET);

$filename = 'data/todo_list.txt';

// if (filesize($filename) > 0) {
// $items = open_file($filename);
// } else {
// 	$items = ();
// }

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

// save an array to file - 1 value per line
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
    	}

	?>
